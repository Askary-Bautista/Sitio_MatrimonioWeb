<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<style>

</style>
<header>
    <nav class="nav-hor-index">
        <ul class="layout-nav-hor">
            <div class="box-nav-1">
                <li> <a class="nav-a-index" href="{{ url('/') }}">Home</a></li>
                <li> <a class="nav-a-index" href="{{ url('/registrar-persona') }}">Registrar</a></li>
                <li> <a class="nav-a-index" href="{{ url('/personas-matrimonio') }}">Matrimonios</a></li>

                <li> <a class="nav-a-index" href="{{ url('/lista-personas') }}">Todos</a></li>
                <li class="nav-item dropdown">
                    <a class=" nav-a-index dropdown-toggle btn " data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">Mostrar Personas</a>
                    <ul class="dropdown-menu" id="ul-dropdown">
                        <li> <a class="nav-a-index dropdown-item" href="{{ url('/personas-casadas') }}">Casados</a></li>
                        <li> <a class="nav-a-index dropdown-item" href="{{ url('/personas-solteras') }}">Solteros</a>
                        </li>
                        <li> <a class="nav-a-index dropdown-item"
                                href="{{ url('/personas-divorciadas') }}">Divorciados</a>
                        </li>
                        <li> <a class="nav-a-index dropdown-item" href="{{ url('/personas-viudas') }}">Viudos</a></li>
                    </ul>

                </li>


                <li> <a class="nav-a-index" href="{{ url('/graficas') }}">Graficas</a></li>

                </li>

            </div>
            <div class="box-nav-2">
                <li> <a class="nav-a-index" href="{{ url('/casamiento') }}">Casar</a></li>
                <li>
                    <a class="nav-a-index" href="#" onclick="confirmLogout()">
                        Salir
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </div>
        </ul>
    </nav>
</header>


<script>
    function confirmLogout() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres cerrar sesión?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, cerrar sesión',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>
