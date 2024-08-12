@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <x-breadcrumb menu="{{ $menu }}"></x-breadcrumb>
        <x-datatable link="{{ route('program.create') }}">
            <th class="text-center"></th>
            <th>Nama Program</th>
            <th>Cover</th>
            <th>Penyiar</th>
            <th class="text-center">Action</th>
        </x-datatable>
    </section>

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
            var myTable = DataTable("{{ route('program.index') }}", [{
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
                    data: "host",
                    name: "host",
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                }
            ]);

            // Delete
            var fitur = "Program";
            var editUrl = "{{ route('program.index') }}";
            var deleteUrl = "{{ route('program.store') }}";
            Delete(fitur, editUrl, deleteUrl, myTable)
        });
    </script>
@endsection
