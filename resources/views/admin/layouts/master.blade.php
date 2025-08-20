<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{  asset('assets/images/LogoIcon.png')}}" type="image/png" />
    <!--plugins-->
    <link href="{{  asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
    <link href="{{  asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{  asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{  asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <link href="{{  asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
    <link href="{{  asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{  asset('assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="{{  asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{  asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet" />
    <link href="{{  asset('assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{  asset('assets/css/icons.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- loader-->
    <link href="{{  asset('assets/css/pace.min.css')}}" rel="stylesheet" />

    <!--Theme Styles-->
    <link href="{{  asset('assets/css/dark-theme.css')}}" rel="stylesheet" />
    <link href="{{  asset('assets/css/light-theme.css')}}" rel="stylesheet" />
    <link href="{{  asset('assets/css/semi-dark.css')}}" rel="stylesheet" />
    <link href="{{  asset('assets/css/header-colors.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/plugins/yearpicker/css/yearpicker.css')}}">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    @stack('style')

    <title>Triple.C</title>
</head>

<body>
    <!--start wrapper-->
    <div class="wrapper">
        <!--start top header-->
        @include('admin.layouts.partials._header')
        <!--end top header-->

        <!--start sidebar -->
        @include('admin.layouts.partials._sidebar')
        <!--end sidebar -->

        @yield('content')

        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->

        <!--start footer-->
        @include('admin.layouts.partials._footer')
        <!--end footer-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

    </div>
    <!--end wrapper-->
</body>

<!-- Bootstrap bundle JS -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{ asset('assets/plugins/chartjs/js/Chart.min.js')}}"></script>
<script src="{{ asset('assets/plugins/chartjs/js/Chart.extension.js')}}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{ asset('assets/js/table-datatable.js')}}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{ asset('assets/js/form-select2.js')}}"></script>

<!--app-->
<script src="{{ asset('assets/js/app.js')}}"></script>
<script src="{{ asset('assets/js/pace.min.js')}}"></script>
<script src="{{ asset('assets/js/index.js')}}"></script>
<script src="{{ asset('assets/plugins/yearpicker/js/yearpicker.js')}}"></script>

@stack('js')

<script>
    // new PerfectScrollbar(".best-product")
</script>

<script>
    $(document).ready(function () {
        $(".menuBtn").click(function (e) {
            e.stopPropagation();

            let dropdownMenu = $(this).siblings(".dropdown-menu");
            $(".dropdown-menu").not(dropdownMenu).hide();
            dropdownMenu.toggle();
        });
        $(document).click(function (e) {
            if (!$(e.target).closest(".menuBtn, .dropdown-menu").length) {
                $(".dropdown-menu").hide();
            }
        });
        $(".dropdown-menu .dropdown-item").click(function () {
            $(this).closest(".dropdown-menu").hide();
        });
    });
</script>

<script>
    $(document).ready(function () {
        $(".file-input").change(function (event) {
            var file = event.target.files[0];

            if (file) {
                var fileType = file.type;
                if (fileType === "image/jpeg" || fileType === "image/jpg") {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("#imagePreview").attr("src", e.target.result).show();
                    }
                    reader.readAsDataURL(file);
                } else {
                    alert("Only JPG or JPEG files are allowed!");
                    $(this).val(""); // Reset file input
                }
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $(".custom-file-input").change(function (event) {
            const files = event.target.files;
            const previewContainer = $("#customImagePreviewContainer");
            previewContainer.empty(); // Clear previous previews

            if (files.length) {
                Array.from(files).forEach(file => {
                    const fileType = file.type;
                    if (fileType === "image/jpeg" || fileType === "image/jpg") {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const img = $("<img>").attr("src", e.target.result);
                            previewContainer.append(img);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        alert("Only JPG or JPEG files are allowed!");
                    }
                });
            }
        });
    });
</script>

</html>