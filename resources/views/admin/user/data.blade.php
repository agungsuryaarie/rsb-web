@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <x-breadcrumb menu="{{ $menu }}"></x-breadcrumb>
        <x-datatable link="javascript:void(0)">
            <th class="text-center"></th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Penyiar</th>
            <th class="text-center">Action</th>
        </x-datatable>
    </section>

    <x-ajaxModel size="modal-lg">
        <x-input type="text" name="name" label="Nama"></x-input>
        <x-input type="email" name="email" label="Email"></x-input>
        <x-dropdown name="role" label="Role">
            <option value="1">Admin</option>
            <option value="2">User</option>
        </x-dropdown>
        <x-dropdown name="host" label="Penyiar">
            <option value="1">Ya</option>
            <option value="0">Tidak</option>
        </x-dropdown>
        <x-input type="password" name="password" label="Password"></x-input>
        <x-input type="password" name="password_confirmation" label="Password Confirmation"></x-input>
        <x-input type="file" name="picture" label="Foto Profile"></x-input>
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
            var myTable = DataTable("{{ route('user.index') }}", [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                },
                {
                    data: "foto",
                    name: "foto",
                },
                {
                    data: "name",
                    name: "name",
                },
                {
                    data: "email",
                    name: "email",
                },
                {
                    data: "role",
                    name: "role",
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

            // Create
            var createHeading = "Tambah User";
            createModel(createHeading)

            // Edit
            var editUrl = "{{ route('user.index') }}";
            var editHeading = "Edit User";
            var field = ['name', 'email', 'role', 'host']; // disesuaikan dengan data yang ingin di tampilkan
            editModel(editUrl, editHeading, field)

            // Save
            saveImage("{{ route('user.store') }}", myTable);

            // Delete
            var fitur = "User";
            var editUrl = "{{ route('user.index') }}";
            var deleteUrl = "{{ route('user.store') }}";
            Delete(fitur, editUrl, deleteUrl, myTable)
        });
    </script>
@endsection
