<!doctype html>
<html lang="en">


<!-- Mirrored from codervent.com/onedash/demo/ltr/authentication-signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 15 Jan 2025 14:52:16 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/LogoIcon.png')}}" type="image/png" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/icons.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css')}}" rel="stylesheet" />

    <title>Triple.C</title>
</head>

<style>
    .bg-login {
        background: #fff !important;
    }
</style>

<body>

    <!--start wrapper-->
    <div class="wrapper">

        <!--start content-->
        <main class="authentication-content" style="height: 100vh;">
            <!-- <div class="container-fluid"> -->
            <!-- <div class="authentication-card"> -->
            <!-- <div class="card shadow rounded-0 overflow-hidden"> -->
            <div class="row g-0" style="height: 100%; overflow: hidden;">
                <div class="col-lg-8 bg-login d-flex align-items-center justify-content-center">
                    <img src="{{asset('assets/images/error/LoginBG.jpg')}}" class="img-fluid w-100 h-100" alt="">
                </div>
                <div class="col-lg-4">
                    <div class="card-body p-4 p-sm-5 d-flex flex-column justify-content-center align-items-center "
                        style="height: 100%;background: #fff;">
                        <div class="LoginImg mb-5" style="width: 230px;">
                            <img src="{{asset('assets\images\CompleteLogo.png')}}" alt="logo" class="w-100">
                        </div>
                        <h2 class="card-title white">Login</h2>
                        <form class="form-body" action="{{ route('authCheck') }}" method="POST">
                            @csrf
                            <div class="login-separater text-center mb-4">
                                <hr>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger mt-2">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="inputEmailAddress" class="form-label white">Email Address</label>
                                    <div class="ms-auto position-relative">
                                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i
                                                class="fa-solid fa-envelope" style="color: #2c54a3;"></i></div>
                                        <input type="email" name="email" class="form-control radius-30 ps-3"
                                            id="inputEmailAddress" placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="inputChoosePassword" class="form-label white">Password</label>
                                    <div class="ms-auto position-relative">
                                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i
                                                class="fa-solid fa-lock" style="color: #2c54a3;"></i></div>
                                        <input type="password" name="password" class="form-control radius-30 ps-3"
                                            id="inputChoosePassword" placeholder="Enter Password">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                        <label class="form-check-label white" for="remember">Remember Me</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary radius-30 ">Sign in</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <!--end page main-->

    </div>
    <!--end wrapper-->


    <!--plugins-->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/pace.min.js')}}"></script>


</body>


<!-- Mirrored from codervent.com/onedash/demo/ltr/authentication-signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 15 Jan 2025 14:52:16 GMT -->

</html>