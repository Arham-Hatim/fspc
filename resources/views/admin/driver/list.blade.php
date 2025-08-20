@extends('admin.layouts.master')
<style>
    .materialInfoContainer {
        background: #fff;
        border-radius: 10px;
        padding: 10px;
    }

    a {
        color: var(--bs-card-color);
    }

    .dropdown-toggle::after {
        display: none;
    }

    .dropdown-item {}


    .dropdown-item:focus,
    .dropdown-item:hover {
        color: #fff;
        background-color: #2c54a3;
    }

    html.dark-theme .dropdown-menu {
        color: #000;
        background-color: #fff;
        transform: translate(122px, 3px) !important;
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
            <div class="breadcrumb-title pe-3">Drivers</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Drivers</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('driver.create') }}" type="button" class="btn btn-primary">Add Driver</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase">Total Drivers</h6>
                        <hr>
                        <div class="row">
                            @forelse($drivers as $driver)
                                <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                                    <div class="materialOuterDiv position-relative">
                                        <div class="materialInfoContainer d-flex align-items-center">
                                            <div class="materialImage">
                                                <img src="{{ $driver->image }}" class="roundImg" alt="">
                                            </div>
                                            <div class="materialInfoDetail ms-2">
                                                <div class="DriverName">{{ $driver->name }}</div>
                                                <div class="Number">{{ $driver->phone }}</div>
                                                <div class="Email">{{ $driver->email }}</div>
                                                <div class="fleetName">Triple C Oilfield Services</div>
                                            </div>
                                        </div>
                                        <div class="cardTopCornerBtn">
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('driver.show', $driver->id) }}" class=""><i
                                                        class="fa-solid fa-eye"></i></a>
                                                <a href="{{ route('driver.edit', $driver->id) }}" class="ms-2"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                <a href="{{--{{ route('driver.destroy', $driver->id) }}--}}" class="ms-2"><i
                                                        class="fa-solid fa-trash"></i></a>

                                                <label class="switch ms-2 status-toggle" data-id="{{ $driver->id }}">
                                                    <input type="checkbox" {{ $driver->status ? 'checked' : '' }}>
                                                    <span class="slider"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div>
                                    <h4 class="text-center">No Material Found.</h4>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->

    </main>
    <script>
        $(document).ready(function () {

            $('.status-toggle').on('change', function () {
                var id = $(this).data('id');
                let url = "{{ route('driverToggleStatus', ['id' => '__id__']) }}".replace('__id__', id);
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