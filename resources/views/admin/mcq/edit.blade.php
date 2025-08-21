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

    .map {
        position: relative;
    }
</style>
@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Update Customer</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:;">Job Customers</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Update Job Customer</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase white">Update Job Customer</h6>
                        <hr />
                        <div class="p-4 border rounded">
                            <form class="row g-3 needs-validation" action="{{ route('customer.update', $customer->id) }}"
                                method="POST" enctype="multipart/form-data" id="customerForm">
                                @csrf
                                @method('PUT')
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
                                    <label for="validationCustom01" class="form-label white">Customer Name*</label>
                                    <input type="text" value="{{ $customer->name }}" class="form-control" name="name"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">Availability Time*</label>
                                    <input type="time" value="{{ \Carbon\Carbon::parse($customer->time)->format('H:i') }}"
                                        class="form-control" name="time" required>
                                </div>

                                <div class="col-2">
                                    <button type="button" class="btn addLocation CreateJobFinishBtn ms-2">
                                        Add Location +
                                    </button>
                                </div>

                                <div class="col-12" id="location"></div>

                                <div class="col-xl-12 mx-auto mb-4">
                                    <div class="d-flex align-items-center justify-content-end mt-2">
                                        <a href="{{ route('customer.index') }}">
                                            <div class="CreateJobCancelBtn">Cancel</div>
                                        </a>
                                        <button type="submit" class="btn CreateJobFinishBtn ms-2">
                                            Update
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
        function initMap($container) {
            const defaultCenter = { lat: 39.8283, lng: -98.5795 };
            const $mapElement = $container.find('.map');

            if (!$mapElement.length) {
                console.error('Map element not found.');
                return;
            }

            const map = new google.maps.Map($mapElement[0], {
                center: defaultCenter,
                zoom: 5,
                streetViewControl: false,
            });

            const geocoder = new google.maps.Geocoder();
            let marker = null;
            let currentPolygon = null;
            let isPolygonMode = false;
            let originalPoint = null;
            let originalArea = null;

            // Append Search Bar
            let $searchInput = $('<input type="text" class="mapSearchInput" placeholder="Search location..." style="position:absolute; top:10px; left:50%; transform: translateX(-50%); width: 300px; z-index: 5; padding: 5px; border-radius: 4px; border: 1px solid #ccc;">');
            $mapElement.append($searchInput);

            // Append Mode Toggle Buttons
            let $modeButtons = $(`<div style="position:absolute; top:50px; left:50%; transform: translateX(-50%); z-index:5;">
                                    <button type="button" class="btn btn-sm btn-primary mr-2 marker-mode" style="padding: 0px 5px;">Marker Mode</button>
                                    <button type="button" class="btn btn-sm btn-success polygon-mode" style="padding: 0px 5px;">Polygon Mode</button>
                                </div>`);
            $mapElement.append($modeButtons);

            // Google Places Autocomplete
            const autocomplete = new google.maps.places.Autocomplete($searchInput[0]);
            autocomplete.bindTo('bounds', map);

            autocomplete.addListener('place_changed', function () {
                const place = autocomplete.getPlace();
                if (!place.geometry || !place.geometry.location) return;

                if (marker) marker.setMap(null);
                if (currentPolygon) {
                    currentPolygon.setMap(null);
                    currentPolygon = null;
                    $container.find('.locationArea').val('');
                }

                map.setCenter(place.geometry.location);
                map.setZoom(14);

                marker = new google.maps.Marker({
                    map: map,
                    position: place.geometry.location,
                    draggable: true,
                });

                $container.find('.locationPoint').val(JSON.stringify({
                    lat: place.geometry.location.lat(),
                    lng: place.geometry.location.lng(),
                }));

                $container.find('.address').val(place.formatted_address || place.name);

                marker.addListener('dragend', onMarkerMoved);
            });

            // Drawing Manager Setup
            const drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: null,
                drawingControl: false,
                polygonOptions: {
                    fillColor: '#2c54a3',
                    fillOpacity: 0.35,
                    strokeWeight: 2,
                    clickable: true,
                    editable: true,
                    zIndex: 1
                }
            });
            drawingManager.setMap(map);

            function updatePolygonCoordinates(polygon) {
                const coordinates = polygon.getPath().getArray().map(latlng => ({
                    lat: latlng.lat(),
                    lng: latlng.lng()
                }));
                $container.find('.locationArea').val(JSON.stringify(coordinates));
            }

            // Polygon complete event
            google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
                if (!marker) {
                    alert('Please create a marker first before drawing a polygon.');
                    polygon.setMap(null);
                    drawingManager.setDrawingMode(null);
                    return;
                }

                if (currentPolygon) {
                    currentPolygon.setMap(null);
                }

                // Check if marker is inside the new polygon
                const markerPos = marker.getPosition();
                if (!google.maps.geometry.poly.containsLocation(markerPos, polygon)) {

                    alert('Marker is outside the drawn polygon. Polygon will be removed.');
                    polygon.setMap(null);
                    drawingManager.setDrawingMode(null);
                    return;
                }

                // Marker inside polygon keep polygon
                currentPolygon = polygon;
                polygon.setEditable(true);

                updatePolygonCoordinates(polygon);

                google.maps.event.addListener(polygon.getPath(), 'set_at', () => updatePolygonCoordinates(polygon));
                google.maps.event.addListener(polygon.getPath(), 'insert_at', () => updatePolygonCoordinates(polygon));

                drawingManager.setDrawingMode(null);
            });

            // Marker drag handler
            function onMarkerMoved() {
                if (currentPolygon) {
                    const pos = marker.getPosition();
                    if (!google.maps.geometry.poly.containsLocation(pos, currentPolygon)) {

                        currentPolygon.setMap(null);
                        currentPolygon = null;
                        $container.find('.locationArea').val('');
                    }
                }

                const pos = marker.getPosition();
                $container.find('.locationPoint').val(JSON.stringify({
                    lat: pos.lat(),
                    lng: pos.lng(),
                }));

                // Reverse geocode for address update
                geocoder.geocode({ location: pos }, function (results, status) {
                    if (status === "OK" && results[0]) {
                        $container.find('.address').val(results[0].formatted_address);
                        $searchInput.val(results[0].formatted_address);
                    }
                });
            }

            // Map click handler (only in marker mode)
            map.addListener("click", function (event) {
                if (isPolygonMode) return;

                if (marker) {
                    marker.setMap(null);
                    marker = null;
                }
                if (currentPolygon) {
                    currentPolygon.setMap(null);
                    currentPolygon = null;
                    $container.find('.locationArea').val('');
                }

                const latLng = event.latLng;

                marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    draggable: true,
                });

                $container.find('.locationPoint').val(JSON.stringify({
                    lat: latLng.lat(),
                    lng: latLng.lng(),
                }));

                geocoder.geocode({ location: latLng }, function (results, status) {
                    if (status === "OK" && results[0]) {
                        $container.find('.address').val(results[0].formatted_address);
                        $searchInput.val(results[0].formatted_address);
                    }
                });

                marker.addListener('dragend', onMarkerMoved);
            });

            // Toggle Mode Buttons
            $modeButtons.find('.marker-mode').on('click', function () {
                isPolygonMode = false;
                drawingManager.setDrawingMode(null);
                alert('Marker mode enabled. Click on the map to drop a marker.');
            });

            $modeButtons.find('.polygon-mode').on('click', function () {
                if (!marker) {
                    alert('Please create a marker first before switching to polygon mode.');
                    return;
                }
                isPolygonMode = true;
                drawingManager.setDrawingMode(google.maps.drawing.OverlayType.POLYGON);
                alert('Polygon mode enabled. Click on the map to draw area.');
            });

            // reset map
            $container.find('.resetLocation').on('click', function () {
                if (marker) {
                    marker.setMap(null);
                    marker = null;
                }

                if (currentPolygon) {
                    currentPolygon.setMap(null);
                    currentPolygon = null;
                }

                $container.find('.locationPoint').val('');
                $container.find('.locationArea').val('');
                $container.find('.address').val('');
                $container.find('.mapSearchInput').val('');

                // reset to original point if available
                if (originalPoint) {
                    const position = new google.maps.LatLng(originalPoint.lat, originalPoint.lng);

                    marker = new google.maps.Marker({
                        position,
                        map,
                        draggable: true,
                    });

                    map.setCenter(position);
                    map.setZoom(14);

                    $container.find('.locationPoint').val(JSON.stringify(originalPoint));

                    geocoder.geocode({ location: position }, function (results, status) {
                        if (status === "OK" && results[0]) {
                            $container.find('.address').val(results[0].formatted_address);
                            $searchInput.val(results[0].formatted_address);
                        }
                    });

                    marker.addListener('dragend', onMarkerMoved);
                }

                // reset to original area if available
                if (originalArea) {
                    const path = originalArea.map(coord => new google.maps.LatLng(coord.lat, coord.lng));

                    currentPolygon = new google.maps.Polygon({
                        paths: path,
                        map: map,
                        fillColor: '#2c54a3',
                        fillOpacity: 0.35,
                        strokeWeight: 2,
                        clickable: true,
                        editable: true,
                        zIndex: 1
                    });

                    google.maps.event.addListener(currentPolygon.getPath(), 'set_at', () => updatePolygonCoordinates(currentPolygon));
                    google.maps.event.addListener(currentPolygon.getPath(), 'insert_at', () => updatePolygonCoordinates(currentPolygon));

                    $container.find('.locationArea').val(JSON.stringify(originalArea));

                    const bounds = new google.maps.LatLngBounds();
                    path.forEach(p => bounds.extend(p));
                    map.fitBounds(bounds);
                }

                if (!originalPoint && !originalArea) {
                    map.setCenter(defaultCenter);
                    map.setZoom(5);
                }
            });

            const pointVal = $container.find('.locationPoint').val();
            const areaVal = $container.find('.locationArea').val();

            // for predefined point set on map
            if (pointVal) {
                try {
                    const point = JSON.parse(pointVal);
                    originalPoint = point;
                    const position = new google.maps.LatLng(point.lat, point.lng);

                    marker = new google.maps.Marker({
                        position,
                        map,
                        draggable: true,
                    });

                    map.setCenter(position);
                    map.setZoom(14);

                    marker.addListener('dragend', onMarkerMoved);
                } catch (e) {
                    console.error('Invalid locationPoint value:', e);
                }
            }

            // for predefined area set on map
            if (areaVal) {
                try {
                    const area = JSON.parse(areaVal);
                    originalArea = area;
                    const path = area.map(coord => new google.maps.LatLng(coord.lat, coord.lng));

                    currentPolygon = new google.maps.Polygon({
                        paths: path,
                        map: map,
                        fillColor: '#2c54a3',
                        fillOpacity: 0.35,
                        strokeWeight: 2,
                        clickable: true,
                        editable: true,
                        zIndex: 1
                    });

                    google.maps.event.addListener(currentPolygon.getPath(), 'set_at', () => updatePolygonCoordinates(currentPolygon));
                    google.maps.event.addListener(currentPolygon.getPath(), 'insert_at', () => updatePolygonCoordinates(currentPolygon));

                    const bounds = new google.maps.LatLngBounds();
                    path.forEach(p => bounds.extend(p));
                    map.fitBounds(bounds);
                } catch (e) {
                    console.error('Invalid locationArea value:', e);
                }
            }
        }
    </script>

    <script>
        $(document).ready(function () {
            // render location html
            const customerLocations = @json($customer->addresses ?? []);

            function renderLocationHtml(address = null, index = null) {
                index = index ?? $('#location').find('.locationAddress').length;
                let url = "{{ route('renderCustomerLocation', ['index' => '__index__']) }}".replace('__index__', index);

                if (address && address.id) {
                    url += '/' + address.id;
                }

                $.ajax({
                    url,
                    method: 'GET',
                    success: function (response) {
                        const $newBlock = $(response);
                        $('#location').append($newBlock);
                        setTimeout(() => initMap($newBlock), 100);
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            }

            if (customerLocations.length) {
                customerLocations.forEach((addr, i) => {
                    renderLocationHtml(addr, i);
                });
            } else {
                renderLocationHtml();
            }

            // add new location 
            $('.addLocation').on('click', function () {
                renderLocationHtml();
            });

            // remove specific location
            $(document).on('click', '.removeLocation', function () {
                $(this).closest('.locationAddress').remove();

                $('.locationAddress').each(function (index) {
                    $(this).find('[name^="location["]').each(function () {
                        const name = $(this).attr('name');
                        const newName = name.replace(/location\[\d+\]/, `location[${index}]`);
                        $(this).attr('name', newName);
                    });
                });
            });

            // point and area is not empty validation
            $('#customerForm').on('submit', function (e) {
                let valid = true;

                $('.locationAddress').each(function () {
                    const $point = $(this).find('.locationPoint').val();
                    const $area = $(this).find('.locationArea').val();

                    if ($point === '') {
                        valid = false;
                        alert('Please mark marker for each map point');
                        return false;
                    }

                    if ($area === '') {
                        valid = false;
                        alert('Please mark area for each location.');
                        return false;
                    }
                });

                if (!valid) {
                    e.preventDefault();
                }
            });

        });
    </script>

@endsection