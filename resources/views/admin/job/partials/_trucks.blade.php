<div class="truckList">
    <div class="d-flex flex-wrap align-items-end justify-content-between">
        <div class="" style="width: 45%;">
            <label for="validationCustom01" class="form-label white">Select Truck</label>
            <select class="single-select truckSelect" name="truck[{{$index}}][id]" required>
                <option value="" disabled selected>Select</option>
                @forelse($trucks as $truck)
                    <option value="{{$truck->id}}">{{ $truck->name }} - {{ $truck->license_plate }} - {{ $truck->capacity }}
                    </option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="" style="width: 45%;">
            <label for="validationCustom01" class="form-label white">Rounds</label>
            <input type="number" class="form-control round" name="truck[{{$index}}][round]" min="1" step="1" required>
        </div>

        @if ($index != 0)
            <div class="PlusButton">
                <button class="btn btn-danger removeTruck"><i class="fa-solid fa-trash"></i></button>
            </div>
        @endif
    </div>
</div>

<script>
    $('.single-select').select2({
        theme: 'bootstrap4',
        width: '100%',
        placeholder: 'Select',
        allowClear: true
    });
</script>