@props(['value' => null,'options' => []])

<select {{ $attributes->class('form-control') }} >
    @foreach($options as $key=>$val)
        <option value="{{ $key }}" {{ $key == $value ? 'selected' : null }}>{{ $val }}</option>
        @endforeach
</select>

