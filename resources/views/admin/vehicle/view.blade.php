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
        display: none;
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

    .StatusDiv {
        border: 1px solid #18FF18;
        padding: 2px 6px;
        font-size: 8px;
        border-radius: 4.05px;
    }

    .Icon-BG {
        background: #151516;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 70px;
        width: 70px;
        border-radius: 20px;
    }

    .detailField {
        background: #323232;
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
            <div class="breadcrumb-title pe-3">Truck Detail</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:;">All Trucks</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">View Truck</li>
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
                                <h6 class="mb-0 white">Truck Detail</h6>
                            </div>
                            <div class="menuBtn">
                                <i class="fa-solid fa-bars"></i>
                            </div>
                            <ul class="dropdown-menu" style="right: 8px;top: 35px;">
                                <li><a class="dropdown-item" href="{{ route('vehicle.edit', $vehicle->id) }}">Edit
                                        Details</a></li>
                                <hr class="dropdown-divider m-0 white">
                            </ul>
                        </div>

                        <hr />
                        <div class="p-4 border rounded">

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                                            <label for="">Truck Type</label>
                                            <div class="detailField mt-1 w-100">
                                                <p class="m-0">{{ $vehicle->truckType->name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                                            <label for="">Truck Name / Unit # *</label>
                                            <div class="detailField mt-1 w-100">
                                                <p class="m-0">{{ $vehicle->name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                                            <label for="">License Plate</label>
                                            <div class="detailField mt-1 w-100">
                                                <p class="m-0">{{ $vehicle->license_plate }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                                            <label for="">VIN (required for Telematic devices)</label>
                                            <div class="detailField mt-1 w-100">
                                                <p class="m-0">{{ $vehicle->vin }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                                            <label for="">Year</label>
                                            <div class="detailField mt-1 w-100">
                                                <p class="m-0">{{ $vehicle->year }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                                            <label for="">Make</label>
                                            <div class="detailField mt-1 w-100">
                                                <p class="m-0">{{ $vehicle->make }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                                            <label for="">Model</label>
                                            <div class="detailField mt-1 w-100">
                                                <p class="m-0">{{ $vehicle->model }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                                            <label for="">Truck Depot</label>
                                            <div class="detailField mt-1 w-100">
                                                <p class="m-0">{{ $vehicle->depot->name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                                            <label for="">Load</label>
                                            <div class="detailField mt-1 w-100">
                                                <p class="m-0">{{ $vehicle->load }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                                            <label for="">Carrying Capacity</label>
                                            <div class="detailField mt-1 w-100">
                                                <p class="m-0">{{ $vehicle->capacity }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                                            <label for="">External Reference</label>
                                            <div class="detailField mt-1 w-100">
                                                <p class="m-0">{{ $vehicle->reference }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="" class="form-label">Allowed Materials</label>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row" id="material">
                                                @forelse($vehicle->materials as $material)
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" checked disabled>
                                                            <label class="form-check-label">{{ $material->name }}</label>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="col-md-12">
                                                        <h2 class="text-center">No Materials Found.</h2>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection