<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        .front.row {
            margin-bottom: 40px;
        }
    </style>
    
    @yield('stylesheets')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <a class="navbar-brand" href="{{route('home')}}">Marketplace L6</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item @if(request()->is('/')) active @endif">
                        <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                    </li>

                    @foreach ($categories as $category)
                        <li class="nav-item @if(request()->is('category/' . $category->slug)) active @endif">
                            <a class="nav-link" href="{{ route('category.single', ['slug' => $category->slug]) }}">{{$category->name}}</a>
                        </li>
                    @endforeach
                </ul>

                <div class="my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto">
                        @auth
                            <li class="nav-item @if(request()->is('my-orders')) active @endif">
                                <a href="{{ route('user.orders') }}" class="nav-link">
                                    Meus pedidos
                                </a>
                            </li>
                        @endauth

                        <li class="nav-item @if(request()->is('cart')) active @endif">
                            <a href="{{ route('cart.index') }}" class="nav-link">
                                @if(session()->has('cart'))
                                    <span class="badge badge-danger">{{ count(session()->get('cart')) }}</span>

                                    {{-- <span class="badge badge-danger">
                                        {{ array_sum( array_column( session()->get('cart'), 'amount') ) }}
                                    </span> --}}
                                @endif
                                <i class="fas fa-shopping-cart fa-2x"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @include('flash::message')
                @yield('content')
            </div>
        </main>
    </div>

    <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>

    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')
</body>
</html>
