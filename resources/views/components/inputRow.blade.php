@props(['type', 'name', 'label', 'value'])
<div class="form-group col-md-6 col-12">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}"
        {{ $attributes->merge(['class' => 'form-control']) }}>
</div>
