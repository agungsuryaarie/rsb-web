@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <x-breadcrumb menu="{{ $menu }}"></x-breadcrumb>
        <x-errors></x-errors>
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Write Your Program</h4>
                </div>
                <form action="{{ route('program.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <x-inputValue type="text" name="name" label="Judul Program" value="">
                        </x-inputValue>
                        <x-dropdown name="host" label="Penyiar">
                            @foreach ($host as $item)
                                <option value="{{ $item->id }}" @selected(old('host') == $item->id)>
                                    {{ $item->name }}</option>
                            @endforeach
                        </x-dropdown>
                        <x-textarea name="description" label="Deskripsi">{{ old('description') }}</x-textarea>
                        <x-uploadPreview name="cover" oldImage="" label="Cover" fitur="program"></x-uploadPreview>
                        <div class="form-group row mb-4">
                            <div class="col-sm-12 col-md-12">
                                <button class="btn btn-primary">Create Program</button>
                                <a href="{{ route('profile.index') }}" class="btn btn-danger float-right">
                                    <i class="fas fa-reply"></i> Back</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function(e) {
            $(window).scrollTop(0);
            setTimeout(function() {
                $(".alert").alert("close");
            }, 5000);
        })
    </script>
@endsection
