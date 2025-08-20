@extends('admin.layouts.master')
<style>
    .materialInfoContainer {
        background: #454545;
        border-radius: 10px;
        padding: 10px;
    }

    .upload-container {
        width: 100%;
        /* max-width: 800px; */
        margin: 0px auto;
        border: 2px dashed #aaa;
        padding: 20px;
        text-align: center;
        position: relative;
    }

    .upload-container img {
        max-width: 100%;
        max-height: 300px;
        /* display: none; */
        margin-top: 10px;
    }

    .upload-icon {
        font-size: 50px;
        color: orange;
    }

    .upload-text {
        margin-top: 10px;
    }

    .file-input {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        top: 0;
        left: 0;
    }
</style>
@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Driver</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:;">All Drivers</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Update Driver</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase white">Update Driver</h6>
                        <hr />
                        <div class="p-4 border rounded">
                            <form class="row g-3 needs-validation" action="{{ route('driver.update', $driver->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @if ($errors->any())
                                    <div class="alert alert-danger mt-2">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success mt-2">
                                        <p>{{session('success')}}</p>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">Driver Name*</label>
                                    <input type="text" name="name" value="{{$driver->name}}" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">Driver Email*</label>
                                    <input type="email" name="email" value="{{$driver->email}}" class="form-control"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">Driver Phone*</label>
                                    <input type="text" name="phone" value="{{$driver->phone}}" class="form-control"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">Password*</label>
                                    <input type="password" name="password" class="form-control" autocomplete="new-password">
                                </div>

                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">Confirm Password*</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">Driver’s License*</label>
                                    <input type="text" name="license" value="{{$driver->license}}" class="form-control"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">Can Drive*</label>
                                    <select class="multiple-select" multiple="multiple" name="truckType[]" required>
                                        @foreach ($types as $type)
                                            <option value="{{$type->id}}" {{ in_array($type->id, $driver->truckTypes->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label for="validat ionCustom01" class="form-label white">Profile Picture of
                                        Driver</label>
                                    <div class="upload-container w-100">
                                        <input type="file" class="file-input" name="image" accept="image/jpeg, image/jpg">
                                        <div class="upload-content">
                                            <div class="upload-icon">📁</div>
                                            <div class="upload-text">Choose driver picture to upload</div>
                                            <small>Select jpg or jpeg</small>
                                        </div>
                                        <img id="imagePreview" src="{{ $driver->image }}" alt="Preview">
                                    </div>
                                </div>
                                <div class="col-xl-12 mx-auto mb-4">
                                    <div class="d-flex align-items-center justify-content-end mt-2">
                                        <a href="{{ route('driver.index') }}">
                                            <div class="CreateJobCancelBtn">Cancel</div>
                                        </a>
                                        <button type="submit" class="btn CreateJobFinishBtn ms-2">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection