<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('layouts.head')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">


</head>

<body>
    <div id="preloader"></div>
    @if (Auth::check())
        @include('layouts.navbar')
    @endif
    <div class="m-auto">


        <main>
            @yield('content')
        </main>
    </div>


    @include('layouts.scripts')

    @yield('js')
</body>

</html>
