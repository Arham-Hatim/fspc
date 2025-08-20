<label for="validationCustom01" class="form-label white">{{ $label }}</label>
@if ($accepted)
    <select class="single-select {{ is_null($userId) ? $location : '' }} {{ $userId ? $location . 'Map' : '' }}" disabled>
        <option value="" disabled>Select</option>
        @forelse($items as $item)
            <option value="{{ $item->id }}" {{ $editLocation?->id == $item->id ? 'selected' : '' }}>
                {{ $item->name ?? $item->address }}
            </option>
        @empty
        @endforelse
    </select>
    <input type="hidden" name="{{ $userId ? $location . 'Location' : '' }}" value="{{ $editLocation?->id }}">
@else
    <select class="single-select {{ is_null($userId) ? $location : '' }} {{ $userId ? $location . 'Map' : '' }}" {!! $userId ? 'name="' . $location . 'Location"' : '' !!} required>
        <option value="" disabled selected>Select</option>
        @forelse($items as $item)
            <option value="{{ $item->id }}" {{ $editLocation?->id == $item->id ? 'selected' : '' }}>
                {{ $item->name ?? $item->address }}
            </option>
        @empty
        @endforelse
    </select>
@endif

<script>
    $('.single-select').select2({
        theme: 'bootstrap4',
        width: '100%',
        placeholder: 'Select',
        allowClear: true
    });
</script>