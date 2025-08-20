@extends('admin.layouts.master')
@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Materials</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:;">Trucks</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:;">All Trucks</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Trucks</li>
                    </ol>
                </nav>
            </div>
            <!-- <div class="ms-auto">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#MaterialsAdder">Add Materials</button>
                                                </div>
                                            </div> -->
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase white">Add Truck Type</h6>
                        <hr />
                        <div class="p-4 border rounded">
                            <form class="row g-3 needs-validation" action="{{ route('vehicle_type.store') }}" method="POST">
                                @csrf
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
                                    <label for="validationCustom01" class="form-label white">Type Name</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">Make</label>
                                    <input type="text" class="form-control" name="make" required>
                                </div>
                                <div class="col-xl-12 mx-auto mb-4">
                                    <div class="d-flex align-items-center justify-content-end mt-2">
                                        <a href="{{ route('vehicle_type.index') }}">
                                            <div class="CreateJobCancelBtn">Cancel</div>
                                        </a>
                                        <button type="submit" class="btn CreateJobFinishBtn ms-2">
                                            Add
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