<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Ulaweng</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('template/landing/css/styles.css') }}" rel="stylesheet" />
    </head>
    <body id="page-top">
        
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="/">Ulaweng</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ route('login') }}">Masuk</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ route('register') }}">Daftar</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor: pointer;">Cara Pendaftaran</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <br>
        <br>
        <section class="page-section portfolio mt-2" id="portfolio">
            <div class="card">
                <div class="card-body p-4">
                  <div class="row justify-content-center">
                    <div class="col-lg-6 col-sm-12">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="text-center">
                            <h1 class="h5 text-gray-900 mb-3 mt-3">Daftarkan Team Anda</h1>
                        </div>
                        <hr>

                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            
                            <div class="form-group">
                                <label class="font-weight-bold text-uppercase">Nama Team</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" >
                                @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>    
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold text-uppercase">Nomor Telepon</label>
                                <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control @error('phone_number') is-invalid @enderror" >
                                @error('phone_number')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>    
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold text-uppercase">Username</label>
                                <input type="text" name="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" >
                                @error('username')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>    
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold text-uppercase">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" >
                                @error('password')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>    
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold text-uppercase">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" >
                                @error('password_confirmation')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>    
                                @enderror
                            </div>
                            <br>
                            <button type="submit" class="btn btn-block" style="background-color: #A832A2;color:white;">Daftar</button>
                            <hr>
            
                            <a href="/" style="color:#A832A2;">Kembali</a>
            
                        </form>
                            
                    </div>
                  </div>
                </div>
            </div>
        </section>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('template/landing/js/scripts.js') }}"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
