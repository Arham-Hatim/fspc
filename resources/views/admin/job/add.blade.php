@extends('admin.layouts.master')
<style>
    .hide {
        display: none;
    }

    .show {
        display: block;
    }

    .bg-gold {
        background: #2c54a3 !important;
    }

    /* serch-box */
    .custom-select-box {
        width: 400px;
        position: relative;
    }

    /* #customSearchInput {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        outline: none;
        margin-bottom: 10px;
    } */

    .custom-options {
        border: 1px solid #ccc;
        border-radius: 4px;
        max-height: 200px;
        overflow-y: auto;
        position: absolute;
        width: 100%;
        background-color: #fff;
        z-index: 1000;
    }

    .custom-option {
        padding: 10px;
        cursor: pointer;
        transition: background-color 0.2s;
        border-bottom: 1px solid #eee;
    }

    .custom-option:last-child {
        border-bottom: none;
    }

    .custom-option:hover {
        background-color: #f0f0f0;
    }

    /* serch-box */
</style>

@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Create A Job</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item">Job</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create A Job</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase white">Add a New Job</h6>
                        <hr />
                        <div class="p-4 border rounded">
                            <form class="row g-3 needs-validation" action="{{ route('job.store') }}" method="POST"
                                id="orderForm">
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

                                <div class="ms-auto">
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <h6>heading 1:</h6>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">What would you like to name
                                        this job? You can use a PO as the job name.*</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">External reference for
                                        reconciliation with another system (Optional)</label>
                                    <input type="text" class="form-control" name="external_reference">
                                </div>
                                <div class="col-md-6 d-flex algn-items-center">

                                </div>
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center">
                                            <input type="radio" name="supplierType" id="supplierTypeCustomerPick"
                                                value="customer" class="me-2" required>
                                            <label for="supplierTypeCustomerPick">Customer</label>
                                        </div>
                                        <div class="d-flex align-items-center ms-2">
                                            <input type="radio" name="supplierType" id="supplierTypeSupplierPick"
                                                value="supplier" class="me-2">
                                            <label for="supplierTypeSupplierPick">Supplier</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 renderSupplier"></div>
                                <div class="col-md-6 renderSupplierLocation"></div>
                                <div class="col-md-6 renderSupplierMap"></div>

                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">Site Operator Approval</label>
                                    <div class="d-flex">
                                        <div class="form-check">
                                            <input class="form-check-input" name="site_operator_approval" value="1"
                                                type="checkbox" id="CHECH1">
                                            <label class="form-check-label white" for="CHECH1">Yes</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">Fleet Approval</label>
                                    <div class="d-flex">
                                        <div class="form-check">
                                            <input class="form-check-input" name="fleet_approval" value="1" type="checkbox"
                                                id="CHECH2">
                                            <label class="form-check-label white" for="CHECH2">Yes</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">Ticket Number</label>
                                    <div class="d-flex">
                                        <div class="form-check">
                                            <input class="form-check-input" name="ticket_number" value="1" type="checkbox"
                                                id="CHECH3">
                                            <label class="form-check-label white" for="CHECH3">Yes</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">Pickup Note Requirement</label>
                                    <div class="d-flex">
                                        <div class="form-check">
                                            <input class="form-check-input" name="pickup_note" value="1" type="checkbox"
                                                id="CHECH4">
                                            <label class="form-check-label white" for="CHECH4">Yes</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">Pickup Driver Notes</label>
                                    <div class="d-flex">
                                        <div class="form-check">
                                            <input class="form-check-input" name="driver_pickup_note" value="1"
                                                type="checkbox" id="CHECH5">
                                            <label class="form-check-label white" for="CHECH5">Yes</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-12">
                                    <h6>Job Customer & Drop-off:</h6>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <input type="radio" name="customerType" id="customerTypeCustomerDrop"
                                            value="customer" class="me-2" required>
                                        <label for="customerTypeCustomerDrop">Customer</label>
                                    </div>
                                    <div class="d-flex align-items-center ms-2">
                                        <input type="radio" name="customerType" id="customerTypeSupplierDrop"
                                            value="supplier" class="me-2">
                                        <label for="customerTypeSupplierDrop">Supplier</label>
                                    </div>
                                </div>

                                <div class="col-md-6 renderCustomer"></div>
                                <div class="col-md-6 renderCustomerLocation"></div>
                                <div class="col-md-6 renderCustomerMap"></div>

                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">Is a note required required
                                        from the driver at drop-off?</label>
                                    <div class="d-flex">
                                        <div class="form-check">
                                            <input class="form-check-input" name="driver_dropoff_note" value="1"
                                                type="checkbox" id="CHECH6">
                                            <label class="form-check-label white" for="CHECH6">Yes</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">Is load autocompleted on
                                        drop-off departure?</label>
                                    <div class="d-flex">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="load_autocomplete" id="CHECH7">
                                            <label class="form-check-label white" for="CHECH7">Yes</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="validationCustom01" class="form-label white">What notes, if any, should the
                                        drivers see at Drop-off?</label>
                                    <textarea name="additional_dropoff_notes" class="form-control" id=""></textarea>
                                </div>
                                <hr>
                                <div class="col-12">
                                    <h6>Material Info:</h6>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">What material will be
                                        transported?</label>
                                    <select class="single-select transportMaterial" name="material_type_id" required>
                                        <option value="" disabled selected>Select</option>
                                        @forelse($materials as $material)
                                            <option value="{{ $material->id }}">{{ $material->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">Product Description</label>
                                    <input type="text" class="form-control" name="material_description" required>
                                </div>
                                <hr>
                                <div class="col-12">
                                    <h6>Material Load Info:</h6>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <label for="validationCustom01" class="form-label white">Unit of measure</label>
                                    <select class="single-select transportUnit" name="measure_unit" required>
                                        <option value="" disabled selected>Select</option>
                                        <option value="cy">CY</option>
                                        <option value="tn">TN</option>
                                    </select>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <label for="validationCustom01" class="form-label white">Quantity</label>
                                    <input type="number" class="form-control requiredQuantity" name="quantity" required>
                                </div>

                                <div class="col-12">
                                    <h6>Job Schedule</h6>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">Start Date and Time</label>
                                    <input type="date" class="form-control" name="start_date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label white">End Date and Time</label>
                                    <input type="date" class="form-control" name="end_date" required>
                                </div>
                                <hr>
                                <div class="col-12">
                                    <h6>Rounds & Load Distribution:</h6>
                                    <h6>Total Capacity: <span class="totalCapacity"></span></h6>
                                    <div class="PlusButton">
                                        <button type="button" class="btn btn-primary addTruck">Add +</button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="roundsDistribution"></div>
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

            // render the listing of users
            function renderJobUser(userType, label, location, jobId = null, dataFor, userId = null, container) {
                let type = userType.val();
                let url = "{{ route('renderJobUserLocation', ['type' => '__type__', 'label' => '__label__', 'location' => '__location__', 'jobId' => '__jobId__', 'dataFor' => '__dataFor__', 'userId' => '__userId__']) }}"
                    .replace('__type__', encodeURIComponent(type))
                    .replace('__label__', encodeURIComponent(label))
                    .replace('__location__', encodeURIComponent(location))
                    .replace('__jobId__', encodeURIComponent(jobId ?? ''))
                    .replace('__dataFor__', encodeURIComponent(dataFor))
                    .replace('__userId__', encodeURIComponent(userId ?? ''));

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (response) {
                        console.log(response);
                        $(`.${container}`).html(response);
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            }

            // Render user dropdowns
            $('input[name="supplierType"]').change(function () {
                renderJobUser($(this), 'Who-is-the-Material-Supplier', 'pickup', 'null', 'user', null, 'renderSupplier');
                $('.renderSupplierLocation').html('');
                $('.renderSupplierMap').html('');
                $('.renderSupplierMap').removeAttr('style');
            });

            $('input[name="customerType"]').change(function () {
                renderJobUser($(this), 'Who-is-the-job-customer', 'dropoff', 'null', 'user', null, 'renderCustomer');
                $('.renderCustomerLocation').html('');
                $('.renderCustomerMap').html('');
                $('.renderCustomerMap').removeAttr('style');
            });

            $(document).on('change', '.pickup', function () {
                let userId = $(this).val();
                let type = $('input[name="supplierType"]:checked').val();
                renderJobUser({ val: () => type }, 'What-is-the-Pick-up-location', 'pickup', 'null', 'location', userId, 'renderSupplierLocation');
                $('.renderSupplierMap').html('');
                $('.renderSupplierMap').removeAttr('style');
            });

            $(document).on('change', '.dropoff', function () {
                let userId = $(this).val();
                let type = $('input[name="customerType"]:checked').val();
                renderJobUser({ val: () => type }, 'What-is-the-Drop-off-location', 'dropoff', 'null', 'location', userId, 'renderCustomerLocation');
                $('.renderCustomerMap').html('');
                $('.renderCustomerMap').removeAttr('style');
            });


            // render map
            function initMap(data, container) {
                const lat = data.point.coordinates[1];
                const lng = data.point.coordinates[0];

                const polygonCoords = data.area.coordinates[0].map(coord => ({
                    lat: coord[1],
                    lng: coord[0]
                }));

                const mapContainer = $(`.${container}`)[0];

                let map = new google.maps.Map(mapContainer, {
                    zoom: 12,
                    center: { lat, lng },
                    streetViewControl: false,
                });

                new google.maps.Marker({
                    position: { lat, lng },
                    map,
                });

                const polygon = new google.maps.Polygon({
                    paths: polygonCoords,
                    strokeColor: '#2c54a3',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#2c54a3',
                    fillOpacity: 0.35,
                });

                polygon.setMap(map);

                const bounds = new google.maps.LatLngBounds();
                polygonCoords.forEach(coord => bounds.extend(coord));
                map.fitBounds(bounds);
            }

            function renderLocationMap(addressElement, container) {

                let mapId = addressElement.val();
                let url = "{{ route('renderLocationMap', ['address_id' => '__addressId__']) }}".replace('__addressId__', encodeURIComponent(mapId));

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        console.log(response);
                        if (!response.error) {
                            $(`.${container}`).css({
                                height: '300px',
                                width: '100%',
                                'border-radius': '10px',
                                position: 'relative'
                            });
                            initMap(response, container);
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }

            $(document).on('change', '.pickupMap', function () {
                renderLocationMap($(this), 'renderSupplierMap');
            });

            $(document).on('change', '.dropoffMap', function () {
                renderLocationMap($(this), 'renderCustomerMap');
            });

            // render trucks
            function renderTrucks(materialId, measureUnit = null, startDate = null, endDate = null, truckIds = null, append = false, sameSpot = false, target = null) {
                let index = 0;
                measureUnit = measureUnit || 'null';

                if (sameSpot && target) {
                    index = $('.roundsDistribution').find('.truckList').index($(target));
                } else if (append) {
                    index = $('.roundsDistribution').find('.truckList').length;
                }

                let truckIdsParam = truckIds && truckIds.length ? truckIds.join('-') : 'null';

                let url = "{{ route('renderTrucks', ['index' => '__index__', 'material_id' => '__materialId__', 'measure_unit' => '__measureUnit__', 'start_date' => '__startDate__', 'end_date' => '__endDate__', 'truck_ids' => '__truckIds__']) }}"
                    .replace('__index__', index)
                    .replace('__materialId__', materialId)
                    .replace('__measureUnit__', measureUnit)
                    .replace('__startDate__', startDate)
                    .replace('__endDate__', endDate)
                    .replace('__truckIds__', truckIdsParam);

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (response) {
                        console.log(response);

                        if (append) {
                            $('.roundsDistribution').append(response);
                        } else {
                            if (sameSpot && target) {
                                $(target).replaceWith(response);
                            } else {
                                $('.roundsDistribution').html(response);
                            }
                        }
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            }

            // get truck capacity
            function truckCapacity(truckIds) {
                truckIdsParam = truckIds && truckIds.length ? truckIds.join('-') : 'null';
                let url = "{{ route('trucksCapacity', ['truck_ids' => '__truckIds__']) }}"
                    .replace('__truckIds__', truckIdsParam);

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (response) {
                        console.log(response);
                        let total = calculateCapacity(truckIds, response)
                        $('.totalCapacity').text(total);
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            }

            // calculate total capacity
            function calculateCapacity(truckIds, capacities) {
                let totalCapacity = 0;

                $('.roundsDistribution').find('.truckList').each(function () {
                    const truckId = $(this).find('.truckSelect').val();
                    const capacity = capacities[truckId] || 0;
                    const roundInput = $(this).find('.round');
                    const roundValue = parseFloat(roundInput.val()) || 0;
                    const individualTotal = capacity * roundValue;
                    totalCapacity += individualTotal;
                });

                globalTotalCapacity = totalCapacity;
                return totalCapacity;
            }


            let truckIds = [];
            let materialId = null;
            let measureUnit = null;
            let startDate = null;
            let endDate = null;
            let globalTotalCapacity = 0;

            $('.transportMaterial').on('change', function () {
                materialId = $(this).val();
                if (materialId && measureUnit && startDate && endDate) {
                    truckIds = []
                    renderTrucks(materialId, measureUnit, startDate, endDate, truckIds, false);
                }
            });

            $('.transportUnit').on('change', function () {
                measureUnit = $(this).val();
                if (materialId && measureUnit && startDate && endDate) {
                    truckIds = []
                    renderTrucks(materialId, measureUnit, startDate, endDate, truckIds, false);
                }
            });

            $('input[name="start_date"]').on('change', function () {
                startDate = $(this).val();
                if (materialId && measureUnit && startDate && endDate) {
                    truckIds = []
                    renderTrucks(materialId, measureUnit, startDate, endDate, truckIds, false);
                }
            });

            $('input[name="end_date"]').on('change', function () {
                endDate = $(this).val();
                if (materialId && measureUnit && startDate && endDate) {
                    truckIds = []
                    renderTrucks(materialId, measureUnit, startDate, endDate, truckIds, false);
                }
            });

            $('.addTruck').on('click', function () {
                const requiredQty = parseFloat($('.requiredQuantity').val()) || 0;

                if (!materialId || !measureUnit || !requiredQty) {
                    alert('Please provide material type, measure unit, and quantity before adding trucks.');
                    return;
                }

                if (globalTotalCapacity >= requiredQty) {
                    alert('Required quantity has been fulfilled');
                    return;
                }

                let allValid = true;

                $('.roundsDistribution').find('.truckList').each(function () {
                    const truckSelected = $(this).find('.truckSelect').val();
                    console.log(truckSelected);

                    const roundValue = parseFloat($(this).find('.round').val());
                    console.log(roundValue);
                    if (!truckSelected || !roundValue) {
                        allValid = false;
                        return false;
                    }
                });

                if (!allValid) {
                    alert('Please select a truck and enter valid rounds in all existing entries before adding another.');
                    return;
                }

                if (materialId && measureUnit && startDate && endDate) {
                    renderTrucks(materialId, measureUnit, startDate, endDate, truckIds, true);
                }
            });


            $(document).on('change', '.truckSelect', function () {

                if ($('.requiredQuantity').val() == '') {
                    alert('Please define quantity to move first.');
                    $(this).val(null).trigger('change.select2');
                    return;
                }

                const current = $(this);
                const value = current.val();
                const targetsToUpdate = [];
                let truckIdsParam = null;

                $('.truckSelect').not(current).each(function () {
                    if ($(this).val() === value) {
                        $(this).val(null).trigger('change.select2');
                        targetsToUpdate.push($(this).closest('.truckList'));
                    }
                });

                truckIds = [];
                $('.truckSelect').each(function () {
                    const val = $(this).val();
                    if (val) {
                        truckIds.push(val);
                    }
                });

                targetsToUpdate.forEach(function (target) {
                    renderTrucks(materialId, measureUnit, startDate, endDate, truckIds, false, true, target);
                });

                truckCapacity(truckIds);

            });

            // each truck round input
            $(document).on('input', '.round', function () {
                truckCapacity(truckIds);
            });

            $('.requiredQuantity').on('input', function () {
                truckIds = []
                renderTrucks(materialId, measureUnit, startDate, endDate, truckIds, false);
            });


            $(document).on('click', '.removeTruck', function () {
                $(this).closest('.truckList').remove();

                $('.truckList').each(function (index) {
                    $(this).find('[name^="truck["]').each(function () {
                        const name = $(this).attr('name');
                        const newName = name.replace(/truck\[\d+\]/, `truck[${index}]`);
                        $(this).attr('name', newName);
                    });
                });

                truckIds = [];
                $('.truckSelect').each(function () {
                    const val = $(this).val();
                    if (val) {
                        truckIds.push(val);
                    }
                });

                truckCapacity(truckIds);
            });

            // validate start date and end date
            let today = new Date();
            today.setDate(today.getDate() + 1);
            let tomorrow = today.toISOString().split('T')[0];
            $('input[name="start_date"]').attr('min', tomorrow);

            $('input[name="start_date"]').on('change', function () {
                const startDate = new Date($(this).val());
                if (!isNaN(startDate)) {
                    startDate.setDate(startDate.getDate() + 1);
                    const minEndDate = startDate.toISOString().split('T')[0];
                    $('input[name="end_date"]').attr('min', minEndDate);
                }
            });

            $('#orderForm').on('submit', function (e) {
                const startDateVal = $('input[name="start_date"]').val();
                const endDateVal = $('input[name="end_date"]').val();

                if (!startDateVal || !endDateVal) {
                    alert('Please select both start and end dates.');
                    e.preventDefault();
                    return false;
                }

                const startDate = new Date(startDateVal);
                const endDate = new Date(endDateVal);

                let now = new Date();
                now.setHours(0, 0, 0, 0);

                if (startDate <= now) {
                    alert('Start date must be after today.');
                    e.preventDefault();
                    return false;
                }

                if (endDate <= startDate) {
                    alert('End date must be after the start date.');
                    e.preventDefault();
                    return false;
                }
            });

        });
    </script>

@endsection