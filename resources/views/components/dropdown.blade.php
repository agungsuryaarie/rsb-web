@props(['name', 'label'])
<div class="form-group">
    <label for="{{ $name }}">{{ $label }} <span class="text-danger">*</span></label>
    <select class="form-control" id="{{ $name }}" name="{{ $name }}">
        <option selected disabled>::Pilih {{ $label }}::</option>
        {{ $slot }}
    </select>
</div>
