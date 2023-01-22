<nav class="navbar navbar-expand-lg navbar-dark bg-primary ps-2">
    <span class="navbar-brand">Ganga ░▒▓ Severa</span>
    <a class="navbar-brand" href="{{route('gangas.index')}}">Inici</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="navbar-brand" href="{{route('gangas.recents')}}">Nous</a>
            </li>
            <li class="nav-item">
                <a class="navbar-brand" href="{{route('gangas.bests')}}">Destacats</a>
            </li>
        </ul>
        @if(Auth::user() && Auth::user()->rol === "admin")
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="navbar-brand text-white" href="{{route('categories.index')}}">Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand text-white" href="{{route('categories.create')}}">Crear Categoria</a>
                </li>
            </ul>
        @endif
        @if(Auth::user())
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="navbar-brand text-white" href="{{route('gangas.create')}}">Crear</a>
            </li>
        </ul>
        @endif
        <div class="ms-auto nav-item dropdown me-3 pr-4">
            @if(Auth::user() && Auth::user()->name)
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="text-light">{{Auth::user()->name}}</span>
                </a>
                <div class="dropdown-menu m-0" aria-labelledby="navbarDropdown">
                    <x-dropdown-link :href="route('profile.edit')" class="dropdown-item">
                        {{ __('Profile') }}
                    </x-dropdown-link>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();" class="dropdown-item">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </div>
            @else
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Guest
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('register')}}">Register</a>
                    <a class="dropdown-item" href="{{route('login')}}">Login</a>
                </div>
            @endif
        </div>
        <div class="navbar-text text-white">
            <span></span>
        </div>
    </div>
</nav>
