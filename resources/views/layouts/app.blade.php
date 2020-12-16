<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MarketPlace</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light border-bottom col-12" style="z-index: 3; background: #FFFFFF;border-width: 2px!important;position: fixed;">
            <div class="container col-12 ml-0">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <div class="col-12 p-0 d-flex align-items-center">
                        <img src="{{ asset('images/logo2.png') }}" class="mr-2" width="30" />
                        <span>Dashboard</span>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item d-flex align-items-center mr-2">
                            <button class="btn btn-sm btn-light">Dashboard</button>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                            </li>
                        @else
                            <li class="nav-item d-flex align-items-center mr-2">
                                <button class="btn btn-sm btn-light"><i class="fas fa-cog"></i></button>
                            </li>
                            <li class="nav-item d-flex align-items-center mr-2">
                                <button class="btn btn-sm btn-light"><i class="far fa-bell"></i></button>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center text-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img class="rounded-circle mr-2" height="30" src="https://i3.sndcdn.com/avatars-000112050209-n7abwe-t500x500.jpg" />
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Salir
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                @if (Auth::check())
                    @include('menu.index')
                @endguest
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 p-0 mt-5">
                    <main class="mt-3">
                        @yield('content')
                    </main>
                </main>
            </div>
        </div>
    </body>
</html>
