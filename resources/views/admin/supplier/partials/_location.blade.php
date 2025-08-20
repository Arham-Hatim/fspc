<div class="row locationAddress border border-primary p-3 mt-2">
    <div class="col-4">
        <label for="validationCustom01" class="form-label white">Location Name*</label>
        <input type="text" class="form-control" value="{{ $address->name ?? '' }}" name="location[{{$index}}][name]"
            required>
    </div>

    <div class="col-4">
        <label for="validationCustom01" class="form-label white">Address*</label>
        <input type="text" class="form-control address" value="{{ $address->address ?? '' }}"
            name="location[{{$index}}][address]" readonly>
    </div>

    <div class="col-4">
        <label class="form-label white">Address Type*</label>
        <select class="form-select single-select" name="location[{{ $index }}][type]" required>
            <option value="" disabled {{ !$address ? 'selected' : '' }}>Select</option>
            <option value="pickup" {{ $address?->type === 'pickup' ? 'selected' : '' }}>Pickup</option>
            <option value="dropoff" {{ $address?->type === 'dropoff' ? 'selected' : '' }}>Dropoff</option>
        </select>
    </div>

    <div class="col-12 d-flex justify-content-center mt-4 mb-2" style="height: 300px;">
        <div class="map" style="height: 300px; width: 100%; border-radius: 10px; position: relative;"></div>

        <input type="hidden" name="location[{{$index}}][address_id]" value="{{ $address->id ?? '' }}">

        <input type="hidden" name="location[{{$index}}][point]"
            value='{{ $address ? json_encode(["lat" => $address->point->latitude, "lng" => $address->point->longitude]) : '' }}'
            class="locationPoint">

        <input type="hidden" name="location[{{$index}}][area]"
            value='{{ $address ? json_encode(array_map(fn($c) => ['lat' => $c[1], 'lng' => $c[0]], $address->area->getCoordinates()[0])) : '' }}'
            class="locationArea">
    </div>

    <div class="text-end">
        @if ($index != 0)
            <button type="button" class="btn btn-danger removeLocation">Remove</button>
        @endif
        <button type="button" class="btn btn-secondary resetLocation">Reset</button>
    </div>
</div>

<script>
    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
</script>