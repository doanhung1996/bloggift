<div class="form-group row">
    @if($label ?? null)
        <label class="col-lg-3 col-form-label text-lg-right" for="{{ $name }}">
            @isset($required)
                <span class="text-danger">*</span>
            @endisset
            {{ $label }} :
        </label>
    @endif
    <div class="col-lg-9">
        <div class="form-check">
            <input type="hidden" name="{{ $name }}" value="0">
            <label class="form-check-label">
                <input class="form-check-input-styled"  {{ old($name, $value ?? null) == 1 ? "checked" : '' }}
                       data-fouc
                       type="checkbox"
                       name="{{ $name }}"
                       id="{{ $name }}"
                       value="1"
                >
                {{ __('Kích hoạt') }}
            </label>
        </div>
        @error($name)
        <span class="form-text text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
