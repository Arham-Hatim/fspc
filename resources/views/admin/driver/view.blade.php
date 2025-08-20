@extends('admin.layouts.master')
<style>
    .materialInfoContainer {
        background: #fff;
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
        display: none;
        margin-top: 10px;
    }

    .upload-icon {
        font-size: 50px;
        color: orange;
    }

    .upload-text {
        margin-top: 10px;
        color: #fff;
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

    .StatusDiv {
        border: 1px solid #18FF18;
        padding: 2px 6px;
        font-size: 8px;
        border-radius: 4.05px;
    }

    .Icon-BG {
        background: #2c54a3;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 70px;
        width: 70px;
        border-radius: 20px;
    }

    .detailField {
        background: #fff;
        border-radius: 5px;
        padding: 8px;
    }

    .DriveerImage {
        width: 320px;
        height: 210px;
    }

    .upload-container {
        padding: 0px 10px 10px 10px;
        border: none;
        background: #2c54a3;
        width: 200px !important;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 500;
    }
</style>
@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Driver Details</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:;">Drivers</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Driver Details</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <h6 class="mb-0 white">{{ $driver->name }}</h6>
                                <div class="StatusDiv ms-3">ON-CALL</div>
                            </div>
                            <div class="menuBtn">
                                <i class="fa-solid fa-bars"></i>
                            </div>
                            <ul class="dropdown-menu" style="right: 8px;top: 35px;">
                                <li><a class="dropdown-item" href="assignJob.php">Assign a Job</a></li>
                                <hr class="dropdown-divider m-0 white">
                                <li><a class="dropdown-item" href="#">Delete Driver</a></li>
                            </ul>
                        </div>

                        <hr />
                        <div class="p-4 border rounded">
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-6 col-sm-12 h-100">
                                    <div class="card overflow-hidden radius-10" style="background-color: #fff;">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between overflow-hidden align-items-center">
                                                <div class="w-70">
                                                    <p>Total Jobs Completed</p>
                                                    <h4 class="">250</h4>
                                                </div>
                                                <div class="w-30 d-flex justify-content-end">
                                                    <div class="Icon-BG">
                                                        <i class="fa-solid fa-suitcase"
                                                            style="color: #fff; font-size: 20px;"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 h-100">
                                    <div class="card overflow-hidden radius-10" style="background-color: #fff;">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between overflow-hidden align-items-center">
                                                <div class="w-70">
                                                    <p>Working Hours</p>
                                                    <h4 class="">10hr</h4>
                                                </div>
                                                <div class="w-30 d-flex justify-content-end">
                                                    <div class="Icon-BG">
                                                        <i class="fa-solid fa-clock"
                                                            style="color: #fff; font-size: 20px;"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 h-100">
                                    <div class="card overflow-hidden radius-10" style="background-color: #fff;">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between overflow-hidden align-items-center">
                                                <div class="w-70">
                                                    <p>Total Trips Completed</p>
                                                    <h4 class="">3000</h4>
                                                </div>
                                                <div class="w-30 d-flex justify-content-end">
                                                    <div class="Icon-BG">
                                                        <i class="fa-solid fa-truck"
                                                            style="color: #fff; font-size: 20px;"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 h-100">
                                    <div class="card overflow-hidden radius-10" style="background-color: #fff;">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between overflow-hidden align-items-center">
                                                <div class="w-70">
                                                    <p>Overtime</p>
                                                    <h4 class="">11hr</h4>
                                                </div>
                                                <div class="w-30 d-flex justify-content-end">
                                                    <div class="Icon-BG">
                                                        <i class="fa-solid fa-hourglass-half"
                                                            style="color: #fff; font-size: 20px;"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end row-->

                            <div class="row">
                                <div class="col-lg-8 col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                                            <label for="">Driver Name</label>
                                            <div class="detailField mt-1 w-100">
                                                <p class="m-0">{{ $driver->name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                                            <label for="">Driver Email</label>
                                            <div class="detailField mt-1 w-100">
                                                <p class="m-0">{{ $driver->email }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                                            <label for="">Driver Phone</label>
                                            <div class="detailField mt-1 w-100">
                                                <p class="m-0">{{ $driver->phone }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                                            <label for="">Driver’s License</label>
                                            <div class="detailField mt-1 w-100">
                                                <p class="m-0">{{ $driver->license }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                                            <label for="">Can Drive</label>
                                            <div class="detailField mt-1 w-100">
                                                <p class="m-0">{{ $driver->truckTypes->pluck('name') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col-lg-4 col-md-12 col-sm-12 d-flex flex-column justify-content-center align-items-center">
                                    <form action="{{ route('driverUpdateImage', $driver->id) }}" method="POST"
                                        enctype="multipart/form-data">
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
                                        <div class="DriveerImage mb-4">
                                            <img id="imagePreview" src="{{ $driver->image }}" class="w-100 h-100"
                                                alt="Preview" style="border-radius: 10px;">
                                        </div>

                                        <h4>Profile Picture</h4>

                                        <div class="upload-container w-100 mt-3">
                                            <input type="file" class="file-input" name="image" id="imageInput"
                                                accept="image/jpeg, image/jpg" onchange="previewImage(event)">
                                            <div class="upload-content">
                                                <div class="upload-text">Change Profile Picture</div>
                                                <!-- <small>Select jpg or jpeg</small> -->
                                            </div>
                                        </div>

                                        <div class="col-xl-12 mx-auto mb-4">
                                            <div class="d-flex align-items-center justify-content-end mt-2">
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
            </div>
        </div>

    </main>
@endsection