@props(['name', 'oldImage', 'label', 'fitur'])
<div class="form-group">
    <div class="animated bounce">
        <label>{{ $label }} <span class="text-danger">*</span></label>
        <div class="text-center" id="pleasewait"></div>
        <div id='img_container'>
            @if ($oldImage)
                <img id="preview" src="{{ asset('storage/' . $fitur . '/' . $oldImage) }}" alt="your image" />
            @else
                <img id="preview" src="{{ asset('preview-img.jpg') }}" alt="your image" />
            @endif
        </div>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" name="{{ $name }}" id="inputGroupFile01"
                    aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
        </div>
    </div>
</div>
