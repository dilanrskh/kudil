<?php
     $kategori =  App\Models\Kategori::all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap -->
    <link href="{{ asset('laracamp/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custome MyCss -->
    <link rel="stylesheet" href="{{ asset('laracamp/mycss/style.css') }}">

</head>
<body>

    <!-- Navbar -->
    <section class="navbar-laracamp">
        <nav class="navbar navbar-expand-lg shadow-sm">

            <div class="container container-navbar">

                <a class="navbar-brand" href="/">
                    <img src="{{ asset('laracamp/images/logo.png') }}" alt="Brand Laracamp">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('front.bootcamps') }}">Bootcamps</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Kategori
                            </a>
                            <ul class="dropdown-menu">
                                @foreach($kategori as $row)
                                    <li><a class="dropdown-item" href="{{ route('front.kategori.bootcamp', $row->slug) }}">{{ $row->nama_kategori }}</a></li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('front.mentor.bootcamp') }}">Mentor</a>
                        </li>

                        <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                        </li>

                        <li class="nav-item">
                        <a class="nav-link" href="#">Business</a>
                        </li> -->
                    </ul>

                    @guest
                        <!-- Sebelum Login -->
                        <div class="d-flex">
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="btn btn-sign-in">Sign In</a>
                            @endif
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-success">Sign Up</a>
                            @endif
                        </div>
                        <!-- End Sebelum Login -->
                    @else
                        <!-- Setelah Login -->
                        <div class="welcome-user dropdown">
                            <div role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>Hello, {{ Auth::user()->name }}!</span>
                                <!-- <img class="img-user" src="{{ url('laracamp/images/photo.png') }}" alt="{{ Auth::user()->name }}"> -->
                                <img class="img-user rounded-circle" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="{{ Auth::user()->name }}">
                            </div>
                            <ul class="dropdown-menu" style="margin-top: 10px;">
                                @if(Auth::user()->role == 1)
                                    <li><a class="dropdown-item" href="{{ route('welcome.index') }}">My Dashboard</a></li>
                                @elseif(Auth::user()->role == 2)
                                    <li><a class="dropdown-item" href="{{ route('mentor.index') }}">My Dashboard</a></li>
                                @elseif(Auth::user()->role == 3)
                                    <li><a class="dropdown-item" href="{{ route('front.my.dashboard') }}">My Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{ route('peserta.index') }}">My Profile</a></li>
                                @endif                               
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <!-- End Setelah Login -->
                    @endguest                                       

                </div>
            </div>

        </nav>
    </section>
    <!-- End Navbar -->

   @yield('content')
    
    <script src="{{ asset('laracamp/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>