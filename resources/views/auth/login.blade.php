<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Smart Kiosk - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">

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

    .bg-secondary-manual {
        background-color: #e5e5e5;
    }
</style>

<body class="bg-secondary-manual">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-2">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5 mt-5">
                                    <h4 class="font-weight-bold">Login</h4>
                                    <hr>
                                    <form action="{{ route('login') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Password">
                                        </div>
                                        <button type="submit"
                                            class="btn btn-orange-manual btn-user btn-block">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
</body>

</html>
