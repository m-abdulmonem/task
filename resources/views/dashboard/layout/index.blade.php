<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ title($title) }} AdminLTE 3</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ admin_assets("all.min.css") }}">

    @stack("css")
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ admin_assets("adminlte.css") }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-left: 0!important;">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route("users.index") }}" class="nav-link">
                    <img src="{{ admin_assets("AdminLTELogo.png") }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                         style="opacity: .8;    width: 29px;">
                    <span class="brand-text font-weight-light">AdminLTE 3</span>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route("users.index") }}" class="nav-link">Home</a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper -->
    <div class="content-wrapper" style="margin-left: 0!important;">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Users Management</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @yield("content")
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer" style="margin-left: 0!important;">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            task
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ admin_assets("jquery.min.js") }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ admin_assets("bootstrap.bundle.min.js") }}"></script>
<!-- sweetalert2 -->
<script src="{{ admin_assets("sweetalert2.all.min.js") }}"></script>
@stack("js")
<!-- AdminLTE App -->
<script src="{{ admin_assets("adminlte.min.js") }}"></script>
</body>
</html>
