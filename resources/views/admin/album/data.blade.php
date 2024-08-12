@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <x-breadcrumb menu="{{ $menu }}"></x-breadcrumb>
        <x-datatable link="javascript:void(0)">
            <th class="text-center"></th>
            <th>Nama</th>
            <th>Cover</th>
            <th>Jumlah Foto</th>
            <th class="text-center">Action</th>
        </x-datatable>
    </section>

    <x-ajaxModel size="">
        <x-input type="text" name="name" label="Nama"></x-input>
        <x-ajaxUploadPreview name="cover" oldImage="" label="Cover" fitur="album"></x-ajaxUploadPreview>
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
            var myTable = DataTable("{{ route('album.index') }}", [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                },
                {
                    data: "name",
                    name: "name",
                },
                {
                    data: "cover_image",
                    name: "cover_image",
                },
                {
                    data: "photo_count",
                    name: "photo_count",
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                }
            ]);

            // Create
            var createHeading = "Tambah Album";
            createModel(createHeading)

            // Save
            saveImage("{{ route('album.store') }}", myTable);


            // Delete
            var fitur = "Album";
            var editUrl = "{{ route('album.index') }}";
            var deleteUrl = "{{ route('album.store') }}";
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
