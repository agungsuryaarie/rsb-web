@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <x-breadcrumb menu="{{ $menu }}"></x-breadcrumb>
        <x-datatable link="{{ route('post.create') }}">
            <th class="text-center"></th>
            <th>Title</th>
            <th>Kategori</th>
            <th>Author</th>
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
            var myTable = DataTable("{{ route('post.index') }}", [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                },
                {
                    data: "title",
                    name: "title",
                },
                {
                    data: "category",
                    name: "category",
                },
                {
                    data: "author",
                    name: "author",
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                }
            ]);

            // Delete
            var fitur = "Post";
            var editUrl = "{{ route('post.index') }}";
            var deleteUrl = "{{ route('post.store') }}";
            Delete(fitur, editUrl, deleteUrl, myTable)
        });
    </script>
@endsection
