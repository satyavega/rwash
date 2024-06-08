<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ config('app.name') }} - Admin</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/adminlte.min.css') }}">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <!-- Google Font: Nunito -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
        <!-- Select2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- Select2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

    @yield('css')
    @routes('admin')
    <style>
        .vertical-divider {
            border-right: 1px solid #ddd;
            height: 100%;
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .modal-header-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-header-right {
            text-align: right;
        }
        .modal-details-section {
            display: flex;
            justify-content: flex-end;
        }
        #items-container {
            display: none;
        }

</style>


</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        @include('admin.template.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link mt-2 d-flex justify-content-sm-start  ">
                <i class="fas fa-tshirt brand-image"
                style="margin-top: 5px"
                ></i>
                <h4 class="brand-text text-bold">{{ config('app.name') }}</h4>
            </a>

            <!-- Sidebar -->
            @include('admin.template.sidebar')
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            @yield('main-content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            Copyright &copy; 2023 {{ config('app.name') }} All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- Logout Modal -->
    <x-admin.modals.logout-modal />

    @yield('modals')

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('vendor/adminlte/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('js/myscript.js') }}"></script>
    <script type="module" src="{{ asset('js/firebase-init.js') }}"></script>

    @yield('scripts')

    @stack('js')
</body>

</html>
