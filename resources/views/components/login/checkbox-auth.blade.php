<div class="form-check">
    <input class="form-check-input" type="checkbox" {{ $attributes->merge(['value' => '']) }}>

    <label class="form-check-label" for="remember" >
        {{ $slot }}
    </label>
</div>
