<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid px-5">
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Laravel') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                @if (Auth::check() && Auth::user()->rol == 'admin')
                    <a class="navbar-brand  " href="{{ url('/home') }}">Home</a>
                    <a class="navbar-brand " href="{{ route('investigadores.indexAdmin') }}">Investigadores</a>
                    <a class="navbar-brand " href="{{ route('eventos.indexAdmin') }}">Eventos</a>
                    <a class="navbar-brand" href="{{ route('divulgaciones.indexAdmin') }}">Divulgación</a>
                    <a class="navbar-brand" href="{{ route('libros.indexAdmin') }}">Libros y capítulos</a>
                    <a class="navbar-brand" href="{{ route('articulos.indexAdmin') }}">Artículos</a>
                    <a class="navbar-brand" href="{{ route('quienes-somos.indexAdmin') }}">Quiénes somos</a>
                    <a class="navbar-brand" href="{{ route('contactos.indexAdmin') }}">Contactos</a>
                    <a class="navbar-brand" href="{{ route('usuarios.indexAdmin') }}">Usuarios</a>
                @endif
            </ul>
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::currentRouteName() == 'register')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Acceder') }}</a>
                        </li>
                    @endif

                    @if (Route::currentRouteName() == 'login')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                        </li>
                    @endif
                @endguest

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    {{ __('Salir') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
