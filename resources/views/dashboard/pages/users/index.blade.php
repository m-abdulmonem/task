@extends("dashboard.layout.index")

@section("content")
    @push("css")
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ admin_assets("dataTables.bootstrap4.min.css") }}">
        <link rel="stylesheet" href="{{ admin_assets("responsive.dataTables.min.css") }}">
    @endpush
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title">Users</h5>
                    <div class="btn btn-success btn-add float-right" data-toggle="modal" data-target="#usersModal">Add User</div>
                </div>
                <div class="card-body">
                    <table id="usersTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                    </table>
                </div>
            </div><!-- /.card -->
        </div>
        <!-- /.col-md-12 -->
    </div>
    <!-- /.row -->
    @include("dashboard.pages.users.model")
    @push("js")
        <script src="{{admin_assets("jquery.dataTables.min.js")}}"></script>
        <script src="{{admin_assets("dataTables.bootstrap4.min.js")}} "></script>
        <script src="{{admin_assets("table.js")}}"></script>
        <script>
            $("#usersTable").table({
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'type', name: 'type'},
                    {data: 'status', name: 'status'},
                ],
                url: "{{ route("users.api.index") }}",
                actionColumnWidth: "250px",
            });
        </script>
    @endpush
@endsection
