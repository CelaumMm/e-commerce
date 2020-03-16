<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <style>
        .front.row {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 40px;">
            <a class="navbar-brand" href="{{route('home')}}">Marketplace L6</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item @if(request()->is('/')) active @endif">
                        <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                </ul>

                @auth
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item @if(request()->is('admin/stores*')) active @endif">
                            <a class="nav-link" href="{{route('admin.stores.index')}}">Lojas <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item @if(request()->is('admin/products*')) active @endif">
                            <a class="nav-link" href="{{route('admin.products.index')}}">Produtos</a>
                        </li>
                        <li class="nav-item @if(request()->is('admin/categories*')) active @endif">
                            <a class="nav-link" href="{{route('admin.categories.index')}}">Categorias</a>
                        </li>
                    </ul>

                    <div class="my-2 my-lg-0">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="event.preventDefault();
                                                                    document.querySelector('form.logout').submit(); ">Sair</a>

                                <form action="{{route('logout')}}" class="logout" method="POST" style="display:none;">
                                    @csrf
                                </form>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link">{{auth()->user()->name}}</span>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @include('flash::message')
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
