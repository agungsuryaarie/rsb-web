@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <x-breadcrumb menu="{{ $menu }}"></x-breadcrumb>
        <x-errors></x-errors>
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Your Post</h4>
                </div>
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="hidden_id" value="{{ $posts->id }}">
                    <div class="card-body">
                        <x-inputValue type="text" name="title" label="Judul" value="{{ $posts->title }}">
                        </x-inputValue>
                        <x-dropdown name="category_id" label="Kategori">
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}" @selected(old('category_id', $posts->category_id) == $item->id)>
                                    {{ $item->name }}</option>
                            @endforeach
                        </x-dropdown>
                        <x-textarea name="content" label="Content">{{ old('content', $posts->content) }}</x-textarea>
                        <x-uploadPreview name="image" oldImage="{{ $posts->image }}" label="Picture" fitur="post">
                        </x-uploadPreview>
                        <x-dropdown name="status" label="Status">
                            <option value="1" @selected(old('status', $posts->status) == '1')>Publish</option>
                            <option value="2" @selected(old('status', $posts->status) == '2')>Draft</option>
                        </x-dropdown>
                        <div class="form-group row mb-4">
                            <div class="col-sm-12 col-md-12">
                                <button class="btn btn-primary">Update Post</button>
                                <a href="{{ route('post.index') }}" class="btn btn-danger float-right">
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
