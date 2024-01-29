<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Stok Barang | CV POLONIUM METALINDO</title>
    <link rel="icon" type="image/jpg" href="{{ asset('img/logo.jpg') }}">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">

    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <style>
        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('dashboard') }}" class="nav-link">Home</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('img/logo.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        {{-- Pembatas aja kok #1 --}}
                        <li class="nav-header">Input Data</li>
                        <li class="nav-item">
                            <a href="/jenis_barangs" class="nav-link">
                                <i class="nav-icon fa fa-file-alt"></i>
                                <p>
                                    Jenis Barang
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/barangs" class="nav-link">
                                <i class="nav-icon fa fa-paperclip"></i>
                                <p>
                                    Data Barang
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/barang_masuks" class="nav-link">
                                <i class="nav-icon fa fa-business-time"></i>
                                <p>
                                    Barang Masuk
                                </p>
                            </a>
                        </li>

                        {{-- Pembatas aja kok #2 --}}
                        <li class="nav-header">Data</li>
                        @if (Auth::user()->role == 'owner')
                            <li class="nav-item">
                                <a href="/users" class="nav-link">
                                    <i class="nav-icon fa fa-user-plus"></i>
                                    <p>
                                        Data User
                                    </p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="/suppliers" class="nav-link">
                                <i class="nav-icon fa fa-user-plus"></i>
                                <p>
                                    Data Supplier
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/customers" class="nav-link">
                                <i class="nav-icon fa fa-user-plus"></i>
                                <p>
                                    Data Customer
                                </p>
                            </a>
                        </li>

                        {{-- Pembatas aja kok #3 --}}
                        <li class="nav-header">Cetak</li>


                        <li class="nav-item">
                            <a href="/barang_keluars" class="nav-link">
                                <i class="nav-icon fa fa-handshake"></i>
                                <p>
                                    Barang Keluar
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                        this.closest('form').submit();"
                                    class="dropdown-item">
                                    <i class="mdi mdi-logout text-primary  fa fa-right-from-bracket"></i>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </li>


                    </ul>
                </nav>

            </div>

        </aside>

        @yield('main_content')



        <aside class="control-sidebar control-sidebar-dark">

        </aside>

    </div>


    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('dist/js/adminlte.min.js?v=3.2.0') }}"></script>

    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

</body>

</html>
