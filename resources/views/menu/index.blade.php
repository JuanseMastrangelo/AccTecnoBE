<nav class="navbar px-0 col-md-2 d-block navbar-expand-lg navbar-light bg-white border-right mt-5 pt-3"
style="z-index: 2;position: fixed;min-height: 1000px;border-width: 2px!important;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav flex-column col-12 p-0">
            <div class="col-12 p-0 my-3">
                <li class="nav-item">
                    <a class="nav-link px-4 py-1 text-primary" href="{{ route('home') }}" style="font-size: 16px;">
                        <i class="fas fa-home mr-2"></i> Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4 py-1" href="{{ route('estadisticas') }}" style="font-size: 16px;">
                        <i class="far fa-user-circle mr-2"></i> Usuarios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4 py-1" href="{{ route('estadisticas') }}" style="font-size: 16px;">
                        <i class="fas fa-chart-pie mr-2"></i> Estadísticas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4 py-1" href="{{ route('getAllCompras') }}" style="font-size: 16px;">
                        <i class="fas fa-shopping-cart mr-2"></i> Transacciones
                    </a>
                </li>
            </div>
            <li class="border-bottom my-2 mx-4"></li>
            <div class="col-12 p-0 my-3">
                <h6 class="mx-4 text-secondary">Cargar</h6>
                <li class="nav-item">
                    <a class="nav-link px-4 py-1" href="{{ route('cargarProductos') }}" style="font-size: 16px;">
                        <i class="fas fa-vector-square mr-2"></i> Productos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4 py-1" href="{{ route('categorias') }}" style="font-size: 16px;">
                        <i class="fas fa-project-diagram mr-2"></i> Categoria
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4 py-1" href="{{ route('categorias') }}" style="font-size: 16px;">
                        <i class="fas fa-ticket-alt mr-2"></i> Cupones
                    </a>
                </li>
            </div>
        </ul>
    </div>
</nav>