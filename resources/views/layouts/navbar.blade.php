<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid px-5">
        <a class="navbar-brand" href="{{ url('/') }}">CID - DESMOS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @if (Auth::check() && Auth::user()->role == 'admin')
                    <a class="navbar-brand" href="{{ url('/home') }}">Home</a>
                    <a class="navbar-brand" href="{{ route('investigadores.indexAdmin') }}">Investigadores</a>
                    <a class="navbar-brand" href="{{ route('eventos.indexAdmin') }}">Eventos</a>
                    <a class="navbar-brand" href="{{ route('divulgaciones.indexAdmin') }}">Divulgación</a>
                    <a class="navbar-brand" href="{{ route('libros.indexAdmin') }}">Libros y capítulos</a>
                    <a class="navbar-brand" href="{{ route('articulos.indexAdmin') }}">Artículos</a>
                    <a class="navbar-brand" href="{{ route('quienes-somos.indexAdmin') }}">Quiénes somos</a>
                    <a class="navbar-brand" href="{{ route('contactos.indexAdmin') }}">Contactos</a>
                    <a class="navbar-brand" href="{{ route('usuarios.indexAdmin') }}">Usuarios</a>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Salir') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
