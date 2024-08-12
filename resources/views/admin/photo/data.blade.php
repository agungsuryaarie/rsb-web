@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <x-breadcrumb menu="{{ $menu }}"></x-breadcrumb>
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-4">
                <x-card header="{{ $album->name }}">
                    <div class="gallery gallery-fw" data-item-height="120">
                        <div class="gallery-item" data-image="{{ url('storage/album/', $album->cover) }}" data-title="Image 1">
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('album.index') }}" class="btn btn-primary btn-xs float-right">
                            <i class="fas fa-reply"></i> Kembali</a>
                    </div>
                </x-card>
            </div>
            <div class="col-12 col-sm-12 col-lg-8">
                <x-datatable link="javascript:void(0)">
                    <th class="text-center"></th>
                    <th>Nama</th>
                    <th class="text-center">Action</th>
                </x-datatable>
            </div>
        </div>
    </section>

    <x-ajaxModel size="">
        <input type="hidden" name="album_id" value="{{ $albumId }}">
        <x-ajaxUploadPreview name="image" oldImage="" label="Foto" fitur="album"></x-ajaxUploadPreview>
    </x-ajaxModel>

    <x-modalDelete></x-modalDelete>
@endsection

@section('script')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            // Datatable
            var myTable = DataTable("{{ route('photo.index', $albumId) }}", [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                },
                {
                    data: "image",
                    name: "image",
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                }
            ]);

            // Create
            var createHeading = "Tambah Foto";
            createModel(createHeading)

            // Edit
            var editUrl = "{{ route('photo.index', $albumId) }}";
            var editHeading = "Edit Foto";
            var field = ['image']; // disesuaikan dengan data yang ingin di tampilkan
            editModel(editUrl, editHeading, field)

            // Save
            saveImage("{{ route('photo.store', $albumId) }}", myTable);


            // Delete
            var fitur = "Foto";
            var editUrl = "{{ route('photo.index', $albumId) }}";
            var deleteUrl = "{{ route('photo.store', $albumId) }}";
            Delete(fitur, editUrl, deleteUrl, myTable)


            // Variabel global untuk menyimpan gambar lama
            var oldImage = '';

            // Fungsi untuk mendapatkan data album dan menampilkan gambar lama
            function getAlbumData(albumId) {
                $.ajax({
                    url: "{{ route('album.index') }}" + "/" + albumId + '/edit',
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            oldImage = data.cover; // Menyimpan gambar lama ke variabel global
                            showOldImage(); // Menampilkan gambar lama di komponen
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }

            // Fungsi untuk menampilkan gambar lama di komponen
            function showOldImage() {
                var preview = $("#preview");
                if (oldImage) {
                    preview.attr('src', "{{ asset('storage/album') }}" + "/" + oldImage);
                } else {
                    preview.attr('src', "{{ asset('preview-img.jpg') }}");
                }
            }

            $("body").on("click", ".edit", function() {
                var albumId = $(this).data("id");
                var field = ['name', 'cover']; // disesuaikan dengan data yang ingin di tampilkan
                getAlbumData(albumId);
                $.get("{{ route('album.index') }}/" + albumId + "/edit", function(data) {
                    $("#saveBtn").val("edit");
                    $("#ajaxModel").modal("show");
                    $("#hidden_id").val(data.id);
                    $("#modelHeading").html("Edit Album");
                    $.each(field, function(index, value) {
                        $("#" + value).val(data[value]);
                    });
                });
            });
        });
    </script>
@endsection
