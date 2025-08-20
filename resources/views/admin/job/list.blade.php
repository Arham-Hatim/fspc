@extends('admin.layouts.master')
<style>
    .table td,
    .table th {
        flex: 1;
        /* width: 100% !important; */
        min-width: 60px !important;
        word-wrap: break-word;
    }

    td {
        white-space: normal;
        word-wrap: break-word;
        max-width: 300px !important;
        overflow: hidden;
    }

    .JobDateSelector input[type="date"] {
        background: #676767;
        border: navajowhite;
        padding: 2px 25px;
        border-radius: 3px;
    }
</style>
@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">All Jobs</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:;">Job</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Jobs</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="#" type="button" class="btn btn-primary">Export</a>
                </div>
                <div class="btn-group ms-2">
                    <a href="{{ route('job.create') }}" type="button" class="btn btn-primary">Create A Job</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0 text-uppercase">All Jobs</h6>
                            <div class="JobDateSelector">
                                <input type="date">
                            </div>
                        </div>
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
                                        <th>Name / PO</th>
                                        <th>Customer</th>
                                        <th>Supplier</th>
                                        <th>Material</th>
                                        <th>Quantity</th>
                                        <th>Trucks</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($jobs as $job)
                                        <tr>
                                            <td>
                                                <div class="tableContent d-flex align-items-center">{{$job->name}}</div>
                                            </td>
                                            <td>
                                                <div class="tableContent d-flex align-items-center">
                                                    {{$job->dropoffAddress?->addressable->name ?? 'N/A'}}</div>
                                            </td>
                                            <td>
                                                <div class="tableContent d-flex align-items-center">
                                                    {{$job->pickupAddress?->addressable->name ?? 'N/A'}}</div>
                                            </td>
                                            <td>
                                                <div class="tableContent d-flex align-items-center">
                                                    {{ $job->material?->name ?? 'N/A'}}</div>
                                            </td>
                                            <td>
                                                <div class="tableContent d-flex align-items-center">{{$job->quantity}}</div>
                                            </td>
                                            <td>
                                                <div class="tableContent d-flex align-items-center">
                                                    {{ $job->job_trucks_count . '/' . $job->accepted_trucks_count }}</div>
                                            </td>
                                            <td>
                                                <div class="tableContent d-flex align-items-center">{{$job->start_date}}</div>
                                            </td>
                                            <td>
                                                <div class="tableContent d-flex align-items-center">{{$job->end_date}}</div>
                                            </td>
                                            <td>
                                                <div class="tableContent d-flex align-items-center"><span
                                                        class="badge rounded-pill bg-success" data-bs-toggle="modal"
                                                        data-bs-target="#editJobStatus">DISPATCHED</span></div>
                                            </td>
                                            <td class="">
                                                <div class="tableContent d-flex align-items-center">
                                                    <div class="btn-group">
                                                        <a href="{{ route('job.edit',$job->id) }}" type="button"
                                                            class="btn btn-outline-dark"><i class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href="ViewJobDetail.php" type="button"
                                                            class="btn btn-outline-dark"><i class="lni lni-eye"></i></a>
                                                        <button type="button" class="btn btn-outline-dark"><i
                                                                class="fadeIn animated bx bx-trash"></i></button>
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
        <div class="modal fade" id="editJobStatus" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="" class="mb-2">Status:</label>
                        <select name="" class="form-control" id="">
                            <option value="">End</option>
                            <option value="">DISPATCHED</option>
                            <option value="">ONGOING</option>
                            <option value="">UPCOMING</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection