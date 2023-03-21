<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    {{-- <link rel="stylesheet" href="assets/home.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <header class="bg-white">
        <nav class="navbar navbar-expand" >
            <div class="container-fluid">

                <div class>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="/">Home</a>
                    </li>
                    @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="/pengaduan">Pengaduan</a>
                    </li>
                    @if(Auth::check() && Auth::user()->role == 'admin')
                    <li class="nav-item active">
                        <a class="nav-link" href="/petugas">Petugas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/masyarakat">Masyarakat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">Data</a>
                    </li>
                    @endif
                    @endif
                    </ul>
                </div>
                <div class="d-flex flex-row-reverse">
                    @if(Auth::check())
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{Auth::user()->nama}}
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            @if(Auth::check() && Auth::user()->role == 'masyarakat')
                            <a class="dropdown-item" href="/pengaduanku">Pengaduan Ku</a>
                            <div class="dropdown-divider"></div>
                            @endif
                            <a class="dropdown-item" href="/logout">Logout</a>
                        </div>
                        </div>
                    @else
                    <a href="/login">
                        <button class="btn btn-outline-info ms-2">
                            Login
                        </button>
                    </a>
                    <a href="/register">
                        <button class="btn btn-outline-info ms-2">
                            Register
                        </button>
                    </a>
                    @endif

                </div>
            </div>

        </nav>
    </header>
    <div class="bg-light py-1 vh-100">
    <div class="container my-5 bg-light">
    <div class="card bg-light p-3">
        {{-- <div> 
            <h4>Selamat datang di Aplikasi Pengaduan Masyarakat Desa Cipayung</h4>
            <h6>Merupakan aplikasi berbasis website yang digunakan untuk melakukan pengaduan atau pelaporan mengenai masalah yang ditemukan oleh masyarakat Desa Cipayung</h6>
        </div>  --}}
        @yield('content')
    </div>
    </div>
    </div>   
</body>
</html>
