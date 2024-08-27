<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.head')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

</head>

<body>
    <div id="app">
        @include('layouts.navbar')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @stack('js')
    @include('layouts.scripts')
    @yield('css')
    @yield('js')
</body>

</html>
