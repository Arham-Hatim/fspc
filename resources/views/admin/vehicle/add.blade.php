@extends('admin.layouts.master')
@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Truck</div>
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
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase white">Add Truck Detail</h6>
                        <hr />
                        <div class="p-4 border rounded">
                            <form class="row g-3 needs-validation" action="{{ route('vehicle.store') }}" method="POST"
                                id="addTruck">
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

                                <div class="col-md-4">
                                    <label for="" class="form-label">Truck Type</label>
                                    <select class="single-select" name="truck_type_id" required>
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($types as $type)
                                            <option value="{{$type->id}}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">Truck Name / Unit #</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">License Plate</label>
                                    <input type="text" class="form-control" name="license_plate" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">VIN (required for Telematic devices)</label>
                                    <input type="text" class="form-control" name="vin" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">Year</label>
                                    <input type="text" class="yearpicker form-control" name="year" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">Make</label>
                                    <input type="text" class="form-control" name="make" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">Model</label>
                                    <input type="text" class="form-control" name="model" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">Truck Depot</label>
                                    <select class="single-select" name="depot_id" required>
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($depots as $depot)
                                            <option value="{{$depot->id}}">{{ $depot->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">Carrying Load</label>
                                    <select class="single-select" name="load" required>
                                        <option value="" selected disabled>Select</option>
                                        <option value="cy">CY</option>
                                        <option value="tn">TN</option>
                                    </select>
                                    <!-- <input type="text" class="form-control" value="" required> -->
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">Carrying Capacity</label>
                                    <input type="number" class="form-control" step="0.01" name="capacity" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">External Reference</label>
                                    <input type="text" class="form-control" name="reference" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="" class="form-label">Allowed Materials</label>
                                </div>

                                <div class="col-md-12">
                                    <div class="row" id="material">
                                        <h2 class="text-center">Select Truck Type to Render Materials.</h2>
                                    </div>
                                </div>

                                <div class="col-xl-12 mx-auto mb-4">
                                    <div class="d-flex align-items-center justify-content-end mt-2">
                                        <a href="{{ route('vehicle.index') }}">
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

    <script>
        $(document).ready(function () {
            $('.single-select').on('change', function () {
                var id = $(this).val();
                let url = "{{ route('materialListByTruckType', ['id' => '__id__']) }}".replace('__id__', id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (response) {
                        console.log(response);
                        $('#material').html(response);
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            });

            $(document).on('submit', '#addTruck', function (e) {
                const checked = $(this).find('input[name="materials[]"]:checked');
                if (checked.length === 0) {
                    e.preventDefault();
                    alert('Please select at least one material.');
                }
            });

            $('.yearpicker').yearpicker({
                autoHide: true,
                year: new Date().getFullYear(),
                startYear: 1900,
                endYear: new Date().getFullYear(),
                onChange: function (value) {
                    console.log('Selected year:', value);
                }
            });


        });
    </script>
@endsection