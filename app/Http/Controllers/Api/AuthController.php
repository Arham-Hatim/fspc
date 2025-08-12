<?php

namespace App\Http\Controllers\Api;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Mail\PasswordResetOtpMail;
use App\Models\User;
use App\Models\UserPasswordResetOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->whereNull('deleted_at'),
            ],
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        try {

            $user = User::onlyTrashed()->where('email', $request->email)->first();

            if ($user) {
                $user->restore();
                $user->update([
                    'name' => $request->name,
                    'password' => Hash::make($request->password),
                    'device_token' => $request->has('device_token') ? $request->device_token : null,
                ]);
            } else {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'device_token' => $request->has('device_token') ? $request->device_token : null,
                ]);
            }

            $user->tokens()->delete();
            $token = $user->createToken('user')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Registration successful.',
                'token' => $token,
                'token_type' => 'bearer',
                'user' => $user,
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'Server error',
                'errors' => [$ex->getMessage()]
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();

                if ($request->has('device_token')) {
                    $user->device_token = $request->device_token;
                    $user->save();
                }

                $user->tokens()->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'User Logged in successfully',
                    'token' => $user->createToken('user')->plainTextToken,
                    'token_type' => 'bearer',
                    'data' => $user,
                ], 200);

            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Email or Password does not matched.',
                ], 401);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'Server error',
                'errors' => [$ex->getMessage()]
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        $request->user()->update([
            'device_token' => null
        ]);
        return response()->json([
            'status' => true,
            'message' => 'User Logged out',
        ], 200);
    }

    public function editProfile(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => ['nullable', 'string', Rule::unique('users')->ignore($user->id)],
            'gender' => 'nullable|in:male,female',
            'dob' => 'nullable|date',
            'image' => 'nullable|image|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $data = $request->except('_token', 'id');

            if ($request->hasFile('image')) {
                $data['image'] = Helpers::upload('users-image', $request->image->extension(), $request->file('image'), $user->image);
            }

            $result = tap($user)->update($data);

            if ($result) {
                return response()->json([
                    'status' => true,
                    'message' => 'Profile updated successfully',
                    'user' => $result
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to update profile',
                ], 500);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'Server error',
                'errors' => [$ex->getMessage()],
            ], 500);
        }
    }

    public function deleteAccount()
    {
        try {
            $user = Auth::user();
            if ($user) {

                $user->tokens()->delete();
                $user->update([
                    'device_token' => null
                ]);
                $user->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'User account deleted successfully',
                ], 200);
            }

            return response()->json([
                'status' => false,
                'message' => 'User not found',
            ], 404);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while deleting the account.',
                'errors' => [$ex->getMessage()],
            ], 500);
        }
    }

    public function sendOtpForPasswordReset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                Rule::exists('users', 'email')->whereNull('deleted_at'),
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        try {

            $user = User::where('email', $request->email)->first();
            if (!empty($user->provider)) {
                return response()->json([
                    'status' => false,
                    'message' => 'You signed up using ' . ucfirst($user->provider) . '. Please login using that method.',
                ], 400);
            }

            $otp = rand(100000, 999999);
            $expiresAt = Carbon::now()->addMinutes(30);

            UserPasswordResetOtp::updateOrCreate(
                ['email' => $request->email],
                ['otp' => $otp, 'expires_at' => $expiresAt]
            );

            Mail::to($request->email)->send(new PasswordResetOtpMail($otp));
            return response()->json(['message' => 'OTP sent successfully.']);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'Server error',
                'errors' => [$ex->getMessage()]
            ], 500);
        }
    }

    public function verifyOtpAndResetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $otpRecord = UserPasswordResetOtp::where('email', $request->email)->where('otp', $request->otp)->first();

            if (!$otpRecord || $otpRecord->expires_at < now()) {
                optional($otpRecord)->delete();
                return response()->json(['message' => 'Invalid or expired OTP.'], 401);
            }

            $user = User::where('email', $request->email)->first();
            $user->update(['password' => Hash::make($request->password)]);

            $user->tokens()->delete();
            $otpRecord->delete();

            return response()->json(['message' => 'Password reset successful.']);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'Server error',
                'errors' => [$ex->getMessage()]
            ], 500);
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = Auth::user();

            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'The current password is incorrect.',
                ], 400);
            }

            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Password changed successfully.',
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'Server error',
                'errors' => [$ex->getMessage()]
            ], 500);
        }
    }

}
