@forelse($materials as $material)
    <div class="col-md-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="materials[]" value="{{ $material->id }}"
                id="material_{{ $material->id }}" {{ in_array($material->id, $vehicleMaterial) ? 'checked' : '' }}>
            <label class="form-check-label" for="material_{{ $material->id }}">
                {{ $material->name }}
            </label>
        </div>
    </div>
@empty
    <div class="col-md-12">
        <h2 class="text-center">No Materials Found.</h2>
    </div>
@endforelse