@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <x-breadcrumb menu="{{ $menu }}"></x-breadcrumb>
        <x-datatable link="javascript:void(0)">
            <th style="width: 5%" class="text-center"></th>
            <th>Judul</th>
            <th style="width: 20%">Thumbnail</th>
            <th style="width: 10%" class="text-center">Action</th>
        </x-datatable>
    </section>

    <x-ajaxModel size="">
        <x-input type="text" name="title" label="Judul"></x-input>
        <div class="form-group">
            <label for="Deskripsi">Deskripsi <span class="text-danger">*</span></label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <x-input type="text" name="link" label="Link"></x-input>
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
            var myTable = DataTable("{{ route('video.index') }}", [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                },
                {
                    data: "title",
                    name: "title",
                },
                {
                    data: "thumbnail",
                    name: "thumbnail",
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                }
            ]);

            // Create
            var createHeading = "Tambah Video";
            createModel(createHeading)

            // Save
            saveBtn("{{ route('video.store') }}", myTable);

            // Delete
            var fitur = "Video";
            var editUrl = "{{ route('video.index') }}";
            var deleteUrl = "{{ route('video.store') }}";
            Delete(fitur, editUrl, deleteUrl, myTable)

            $("body").on("click", ".edit", function() {
                var videoId = $(this).data("id");
                var field = ['title', 'description',
                    'link'
                ];
                $.get("{{ route('video.index') }}/" + videoId + "/edit", function(data) {
                    $("#saveBtn").val("edit");
                    $("#ajaxModel").modal("show");
                    $("#hidden_id").val(data.id);
                    $("#modelHeading").html("Edit Video");
                    $.each(field, function(index, value) {
                        $("#" + value).val(data[value]);
                    });
                });
            });
        });
    </script>
@endsection
