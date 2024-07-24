@extends('layouts.header')

@section('title', 'Personas Registradas')
<style>
    body {
        background-size: cover;
        background-image: url('{{ asset('assets/images/img-fondo-boda.png') }}');
    }
</style>
@section('content')

    @include('layouts.navPersonas')

    <section class="container my-5">
        <div class="">
            <div class="table-widget card">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="7" class="text-center">Personas General</th>
                                </tr>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Name</th>
                                    <th>E-MAIL</th>
                                    <th>FECHA NACIMIENTO</th>
                                    <th>SEXO</th>
                                    <th>ESTADO CIVIL</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="team-member-rows">
                                @foreach ($personas as $persona)
                                    <tr>
                                        <td>
                                            @if ($persona->image)
                                                <img class="img-tabla-personas img-fluid rounded-circle"
                                                    src="{{ Storage::url($persona->image) }}"
                                                    alt="Imagen de {{ $persona->name }}" width="50">
                                            @else
                                                No Image
                                            @endif
                                        </td>

                                        <td>{{ $persona->name }}</td>
                                        <td>{{ $persona->email }}</td>
                                        <td>{{ $persona->fecha_nacimiento }}</td>
                                        <td>{{ $persona->sexo }}</td>
                                        <td>{{ $persona->estado_civil }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('personas.edit', $persona->id) }}"
                                                    class="btn btn-primary btn-sm me-2">Modificar</a>
                                                <form id="formEliminarPersona{{ $persona->id }}"
                                                    action="{{ route('personas.destroy', $persona->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="eliminarPersona({{ $persona->id }})">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <div class="d-flex justify-content-center">
                                            {{ $personas->links() }}
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function eliminarPersona(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede revertir. ¿Quieres continuar?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si se confirma la eliminación, enviar la solicitud DELETE
                    axios.delete('/personas/' + id)
                        .then((response) => {
                            // Verificar si la eliminación fue exitosa
                            if (response.status === 200) {
                                // Eliminar la fila de la tabla correspondiente a la persona eliminada
                                document.getElementById('rowPersona' + id).remove();
                                // Mostrar mensaje de error si la eliminación falla
                                Swal.fire(
                                    '¡Error!',
                                    'Ocurrió un error al eliminar la persona.',
                                    'error'
                                );
                            } else {

                            }
                        })
                        .catch((error) => {
                            // Mostrar mensaje de éxito
                            Swal.fire(
                                '¡Eliminado!',
                                'La persona ha sido eliminada correctamente, recarga la pagina.',
                                'success'
                            );

                            console.error(error);
                        });
                }
            });
        }
    </script>


@endsection
