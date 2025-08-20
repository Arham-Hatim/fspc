@extends('admin.layouts.master')
@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">All Trucks</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:;">Trucks</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Trucks</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('vehicle.create') }}" type="button" class="btn btn-primary">Add Truck</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase">All Trucks</h6>
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
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Depot</th>
                                        <th>License</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($trucks as $truck)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="tableContent d-flex align-items-center">{{ $truck->name }}</div>
                                            </td>
                                            <td>
                                                <div class="tableContent d-flex align-items-center">
                                                    {{ $truck->truckType->name ?? 'Not Available' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="tableContent d-flex align-items-center">{{ $truck->depot->name }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="tableContent d-flex align-items-center">{{ $truck->license_plate }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="tableContent d-flex align-items-center">
                                                    <div class="btn-group">
                                                        <a href="{{ route('vehicle.show', $truck->id) }}" type="button"
                                                            class="btn btn-outline-dark"><i class="lni lni-eye"></i></a>
                                                        <a href="{{--{{ route('vehicle.destroy', $truck->id) }}--}}"
                                                            type="button" class="btn btn-outline-dark"><i
                                                                class="fadeIn animated bx bx-trash"></i></a>
                                                    </div>
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
    </main>
@endsection