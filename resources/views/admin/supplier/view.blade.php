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

    .LocationAddressInput span {
        background: #fff;
        border-radius: 0px 7.76px 7.76px 0px;
        padding: 4px 10px;
    }

    .LocationAddressInput label {
        margin: 0;
        background: #2c54a3;
        color: #fff;
        border-radius: 7.76px 0 0px 7.76px;
        padding: 2px 10px;
    }

    .LocationAddressInput {
        display: flex;
        justify-content: center;
        align-content: center;
    }
</style>
@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Material Supplier</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:;">Material Suppliers</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">View Material Supplier</li>
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
                                <h6 class="mb-0 white">{{ $supplier->name }}</h6>
                            </div>
                            <div class="menuBtn">
                                <i class="fa-solid fa-bars"></i>
                            </div>
                            <ul class="dropdown-menu" style="right: 8px;top: 35px;">
                                <li><a class="dropdown-item" href="{{ route('supplier.edit', $supplier->id) }}">Edit
                                        Details</a></li>
                                <hr class="dropdown-divider m-0 white">
                                <li><a class="dropdown-item" href="#">Delete Driver</a></li>
                            </ul>
                        </div>

                        <hr />
                        <div class="p-4 border rounded">

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                                            <label for="">Supplier Name</label>
                                            <div class="detailField mt-1 w-100">
                                                <p class="m-0">{{ $supplier->name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                                            <label for="">Availability Time</label>
                                            <div class="detailField mt-1 w-100">
                                                <p class="m-0">{{ $supplier->time }}</p>
                                            </div>
                                        </div>

                                        <div class="col-12" id="location">
                                            @forelse($supplier->addresses as $address)
                                                <div class="row locationAddress border border-primary p-3 mt-2">
                                                    <div class="col-4">
                                                        <div class="LocationAddressInput">
                                                            <label for="validationCustom01" class="form-label white">
                                                                Location Name
                                                            </label>
                                                            <span>{{ $address->name }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <div class="LocationAddressInput">
                                                            <label for="validationCustom01" class="form-label white">
                                                                Address
                                                            </label>
                                                            <span>{{ $address->address }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <div class="LocationAddressInput">
                                                            <label for="" class="form-label">Address Type</label>
                                                            <span>{{ $address->type }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-12" id="location">
                                                        <div class="col-12 d-flex justify-content-center mt-4"
                                                            style="height: 300px;">
                                                            <div class="map-box"
                                                                style="height: 300px; width: 100%; border-radius: 10px; position: relative;"
                                                                data-lat="{{ $address->point->latitude }}"
                                                                data-lng="{{ $address->point->longitude }}"
                                                                data-title="{{ $address->name }}" data-polygon='@json(array_map(function ($coord) {
                                                                    return ['lat' => $coord[1], 'lng' => $coord[0]];
                                                                }, $address->area->getCoordinates()[0]))'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <h4>Address Not Found.</h4>
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

    </main>

    <script>
        function initMap() {
            $('.map-box').each(function (index, mapDiv) {
                let $mapDiv = $(mapDiv);
                let lat = parseFloat($mapDiv.data('lat'));
                let lng = parseFloat($mapDiv.data('lng'));
                let title = $mapDiv.data('title');
                let polygonCoords = JSON.parse($mapDiv.attr('data-polygon'));

                // Create map
                let map = new google.maps.Map(mapDiv, {
                    zoom: 12,
                    center: { lat: lat, lng: lng },
                    streetViewControl: false,
                });

                // Place marker
                new google.maps.Marker({
                    position: { lat: lat, lng: lng },
                    map: map,
                    title: title,
                });

                // Create polygon
                let polygon = new google.maps.Polygon({
                    paths: polygonCoords,
                    strokeColor: '#2c54a3',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#2c54a3',
                    fillOpacity: 0.35,
                });

                polygon.setMap(map);

                // Adjust bounds based on polygon
                let bounds = new google.maps.LatLngBounds();
                polygonCoords.forEach(coord => {
                    bounds.extend(new google.maps.LatLng(coord.lat, coord.lng));
                });

                // Set zoom and center
                map.fitBounds(bounds);
            });
        }
        window.onload = initMap;
    </script>
@endsection