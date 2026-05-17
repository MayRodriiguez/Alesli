<nav class="navbar navbar-expand-lg" style="background: linear-gradient(135deg, #c2185b, #6a1b9a);">
    <div class="container">
        <a class="navbar-brand text-white" href="{{ url('/') }}">
            <i class="fas fa-flower"></i> Alesli - Florería
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                    @if(auth()->user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.inventario') }}">
                                <i class="fas fa-boxes"></i> Inventario
                            </a>
                        </li>
                    @elseif(auth()->user()->role == 'personal')
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('personal.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('personal.inventario') }}">
                                <i class="fas fa-boxes"></i> Inventario
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('cliente.dashboard') }}">
                                <i class="fas fa-home"></i> Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('cliente.catalogo') }}">
                                <i class="fas fa-store"></i> Catálogo
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('cliente.carrito') }}">
                                <i class="fas fa-shopping-cart"></i> Carrito
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('cliente.cursos') }}">
                                <i class="fas fa-graduation-cap"></i> Cursos
                            </a>
                        </li>
                    @endif
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('perfil') }}"><i class="fas fa-user"></i> Mi Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Registrarse</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>