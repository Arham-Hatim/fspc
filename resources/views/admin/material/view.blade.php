@extends('admin.layouts.master')
@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Material Detail</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:;">All Materials</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">View Material</li>
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
                                <h6 class="mb-0 white">Material Detail</h6>
                            </div>
                        </div>

                        <hr />
                        <div class="p-4 border rounded">

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                                            <div class="ViewedMaterialContainer d-flex align-items-center" width="50">
                                                <div class="ViewedMaterialImage">
                                                    <img src="{{ $material->image }}" class="roundImg" alt="">
                                                </div>
                                                <div class="ViewedMaterialName w-100 ms-3">
                                                    <div class="detailField mt-1 w-100">
                                                        <p class="m-0">{{ $material->name }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <h5>Truck Types</h5>
                                        </div>
                                        @forelse($material->truckTypes as $type)
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="detailField d-flex justify-content-between align-items-center mt-1 w-100">
                                                    <h6 class="m-0">Make: <span>{{ $type->make }}</span></h6>
                                                    <p class="m-0">Name: {{ $type->name }}</p>
                                                </div>
                                            </div>
                                        @empty
                                        @endforelse
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