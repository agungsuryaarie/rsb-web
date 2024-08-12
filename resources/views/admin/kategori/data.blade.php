@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <x-breadcrumb menu="{{ $menu }}"></x-breadcrumb>
        <x-datatable link="javascript:void(0)">
            <th class="text-center"></th>
            <th>Nama</th>
            <th class="text-center">Action</th>
        </x-datatable>
    </section>

    <x-ajaxModel size="">
        <x-input type="text" name="name" label="Nama"></x-input>
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
            var myTable = DataTable("{{ route('category.index') }}", [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                },
                {
                    data: "name",
                    name: "name",
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                }
            ]);

            // Create
            var createHeading = "Tambah Kategori";
            createModel(createHeading)

            // Edit
            var editUrl = "{{ route('category.index') }}";
            var editHeading = "Edit Kategori";
            var field = ['name']; // disesuaikan dengan data yang ingin di tampilkan
            editModel(editUrl, editHeading, field)

            // Save
            saveBtn("{{ route('category.store') }}", myTable);


            // Delete
            var fitur = "Kategori";
            var editUrl = "{{ route('category.index') }}";
            var deleteUrl = "{{ route('category.store') }}";
            Delete(fitur, editUrl, deleteUrl, myTable)
        });
    </script>
@endsection
