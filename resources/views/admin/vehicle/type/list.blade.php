@extends('admin.layouts.master')
@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Type Of Trucks</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:;">Trucks</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Truck Types</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('vehicle_type.create') }}" type="button" class="btn btn-primary">Add Truck Type</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase">Total Truck Types</h6>
                        <hr>
                        @if (session('success'))
                            <div class="alert alert-success mt-2">
                                <p>{{session('success')}}</p>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S'No</th>
                                        <th>Truck Type</th>
                                        <th>Make</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($types as $type)
                                        <tr>
                                            <td>
                                                <div class="tableContent d-flex align-items-center">{{ $loop->iteration }}</div>
                                            </td>
                                            <td>
                                                <div class="tableContent d-flex align-items-center">{{ $type->name }}</div>
                                            </td>
                                            <td>
                                                <div class="tableContent d-flex align-items-center">{{ $type->make }}</div>
                                            </td>
                                            <td>
                                                <div class="tableContent d-flex align-items-center status-toggle"
                                                    data-id="{{ $type->id }}">
                                                    <label class="switch">
                                                        <input type="checkbox" {{ $type->status ? 'checked' : '' }}>
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('vehicle_type.edit', $type->id) }}" type="button"
                                                        class="btn btn-outline-dark"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        <!-- Modal -->
        <div class="modal fade" id="TruckTypeAdder" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Truck Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="">Name:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="TruckTypeEdit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Truck Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="">Name:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Change</button>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script>
        $(document).ready(function () {

            $('.status-toggle').on('change', function () {
                var id = $(this).data('id');
                let url = "{{ route('vehicleTypeToggleStatus', ['id' => '__id__']) }}".replace('__id__', id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            });

        });
    </script>
@endsection