<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Smart Kiosk - {{ $title ?? 'Kiosk' }}</title>
    <link rel="icon" href="{!! asset('favicon.ico') !!}" type="image/>
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" >
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">
    {{-- dark mode
    <link href="{{ asset('template/css/dark-mode.css') }}" rel="stylesheet">
    <link href="{{ asset('template/js/dark-mode-switch.js') }}" rel="stylesheet">
    <link href="{{ asset('template/jss/dark-mode-switch.min.js') }}" rel="stylesheet">--}}

</head>
<style>
    .bg-orange-sidebar {
        background-color: #FF9223 !important;
    }

    .text-orange-manual {
        color: #FF9223 !important;
    }

    .text-orange-tagar-manual {
        color: #FF9223 !important;
        font-size: 20px;
    }

    .btn-orange-manual {
        background-color: #FF9223 !important;
        color: white !important;
        font-size: 12px !important;

    }
</style>

<body id="page-top">
    <div id="wrapper">
        @if (session()->get('role') == 'superadmin')
            @include('component._sidebar_admin')
        @else
            @include('component._sidebar_admin_canteen')
        @endif
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <h3
                        class="d-none d-sm-inline-block font-weight-bold form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        Welcome,
                        {{ session()->get('namauser') }}
                        {{-- auth()->user()->canteen->name --}}
                    </h3>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        {{-- <li class="nav-item dropdown no-arrow mx-1">
                            <form class="nav-link dropdown-toggle">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <button class="btn btn-light" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search"
                                        aria-label="Search" aria-describedby="basic-addon2">
                                </div>
                            </form>
                        </li> --}}

                        <!-- Nav Item - Messages -->
                        {{-- <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">1</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Pusat Notifikasi
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="{{ asset('template/img/undraw_profile_1.svg') }}"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Halo Superadmin. </div>
                                        <div class="small text-gray-500">Selamat Menjalakan Aktivitas Harianmu</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Lihat Semua Pesan</a>
                            </div>
                        </li> --}}

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ session()->get('namauser') }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('template/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                @yield('content')
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; BISA AI 2022</span>
                        <div class="form-check form-switch">
                            {{--<input type="checkbox" class="form-check-input" id="darkSwitch">
                             <label class="custom-control-label" for="darkSwitch">Dark Mode</label> --}}
                          </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin logout dari Aplikasi?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih logout untuk mengakhiri session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-primary" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{-- Dark mode
    <script src="{{ asset('template/js/dark-mode-switch.js') }}"></script>
    <script src="{{ asset('template/js/dark-mode-switch.min.js') }}"></script>
     --}}
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('select2js')
</body>

</html>
<script>
    $(document).ready(function() {
        @if ($message = session('success'))
            Swal.fire(
                'Berhasil!',
                '{{ $message }}',
                'success'
            )
        @endif
        @if ($errors->any())
            Swal.fire(
                'Gagal!',
                '{{ $message }}',
                'error'
            )
        @endif

        @if ($message = session('alert'))
            Swal.fire(
                'Gagal!',
                '{{ $message }}',
                'error'
            )
        @endif
    })
</script>

</html>
