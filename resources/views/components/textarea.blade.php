@props(['name', 'label'])

<div class="form-group">
    <label for="{{ $name }}">{{ $label }} <span class="text-danger">*</span></label>
    <textarea name="{{ $name }}" id="{{ $name }}"
        {{ $attributes->merge(['class' => 'form-control summernote']) }} rows="3">{{ $slot }}</textarea>
</div>
