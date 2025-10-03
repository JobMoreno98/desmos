<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.head')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

</head>

<body>
    <div >
        @include('layouts.navbar')
        <main>
            @yield('content')
        </main>
    </div>
    
    
    @include('layouts.scripts')
    
    @yield('js')
</body>

</html>
