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
</style>
@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">MCQS</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">MCQS</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('mcqImportFrom') }}" type="button" class="btn btn-primary">Import MCQS</a>
                </div>
                <div class="btn-group">
                    <a href="#" type="button" class="btn btn-primary">Add MCQ</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase">All MCQS</h6>
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
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Summary</th>
                                        <th>Mcqs</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($mcqs as $mcq)
                                        <tr>
                                            <td class="">
                                                <div class="tableContent d-flex align-items-center">{{ $loop->iteration }}</div>
                                            </td>
                                            <td class="">
                                                <div class="tableContent d-flex align-items-center"></div>
                                            </td>
                                            <td class="">
                                                <div class="tableContent d-flex align-items-center">
                                                    
                                                </div>
                                            </td>
                                            <td class="">
                                                <div class="tableContent d-flex align-items-center">
                                                    
                                                </div>
                                            </td>
                                            <td class="">
                                                <div class="tableContent d-flex align-items-center">
                                                   
                                                </div>
                                            </td>
                                            <td class="">
                                                <div class="tableContent d-flex align-items-center">
                                                   
                                                </div>
                                            </td>
                                            <td class="">
                                                <div class="tableContent d-flex align-items-center">
                                                    <label class="switch">
                                                        <input type="checkbox" >
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="">
                                                <div class="tableContent d-flex align-items-center">
                                                    <div class="btn-group">
                                                        <a href="#" type="button" class="btn btn-outline-dark"><i
                                                                class="lni lni-eye"></i></a>
                                                        <button type="button" class="btn btn-outline-dark"><i
                                                                class="lni lni-pencil"></i></button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->

    </main>
@endsection