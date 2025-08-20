@extends('admin.layouts.master')

<style>
    .materialInfoContainer {
        background: #fff;
        border-radius: 10px;
        padding: 10px;
        border: 1px solid #878787;
    }

    .cardTopCornerBtn {
        position: absolute;
        top: 3px;
        right: 7px;
    }
</style>

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
                        <li class="breadcrumb-item active" aria-current="page">All Materials</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('material.create') }}" type="button" class="btn btn-primary">Add Materials</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 text-uppercase">All Materials</h6>
                            <input type="search" placeholder="Search" class="form-control w-20"
                                style="background-color: #fff;">
                        </div>

                        <hr>
                        @if (session('success'))
                            <div class="alert alert-success mt-2">
                                <p>{{session('success')}}</p>
                            </div>
                        @endif
                        <!-- <div class="table-responsive"> -->
                        <div class="row">
                            @forelse($materials as $material)
                                <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                                    <a href="{{ route('material.show', $material->id) }}">
                                        <div class="materialOuterDiv position-relative">
                                            <div class="materialInfoContainer d-flex align-items-center">
                                                <div class="materialImage">
                                                    <img src="{{ $material->image}}" class="roundImg">
                                                </div>
                                                <div class="materialInfoDetail ms-2">
                                                    <div class="materialName">{{ $material->name }}</div>
                                                    <div class="fleetName">Triple C Oilfield Services</div>
                                                </div>
                                            </div>
                                            <div class="cardTopCornerBtn">
                                                <div class="d-flex align-items-center">
                                                    <a href="{{ route('material.edit', $material->id) }}" class=""><i
                                                            class="fa-solid fa-pen-to-square"></i></a>

                                                    <label class="switch ms-2 status-toggle" data-id="{{ $material->id }}">
                                                        <input type="checkbox" {{ $material->status ? 'checked' : '' }}>
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <div>
                                    <h4 class="text-center">No Material Found.</h4>
                                </div>
                            @endforelse
                        </div>
                        <!-- </div> -->
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                {{ $materials->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        <!-- Modal -->
        <div class="modal fade" id="MaterialsAdder" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Material</h5>
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
    </main>

    <script>
        $(document).ready(function () {

            $('.status-toggle').on('change', function () {
                var id = $(this).data('id');
                let url = "{{ route('materialToggleStatus', ['id' => '__id__']) }}".replace('__id__', id);
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