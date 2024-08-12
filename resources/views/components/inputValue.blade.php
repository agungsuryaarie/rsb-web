@props(['type', 'name', 'label', 'value'])

<div class="form-group">
    <label for="{{ $name }}">{{ $label }} <span class="text-danger">*</span></label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"
        {{ $attributes->merge(['class' => 'form-control']) }}>
</div>
