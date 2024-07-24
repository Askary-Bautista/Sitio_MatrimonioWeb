@extends('layouts.header')

@section('title', 'Personas Casadas ')
<style>
    body {
        background-size: cover;
        background-image: url('{{ asset('assets/images/img-fondo-boda.png') }}');
    }
</style>
@section('content')

    @include('layouts.navPersonas')

    <section>
        <div class="container my-4">
            <div class="table-widget card">
                <div class="box-caption-container card-header">
                    <div class="caption-content d-flex justify-content-between align-items-center">
                        <h1 class="card-title mb-0">Personas Totales</h1>
                        <div class="table-row-count">
                            <h2 class="mb-0">{{ $personasCasadas->count() }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Fecha Nacimiento</th>
                                <th>Sexo</th>
                                <th>Estado Civil</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="team-member-rows">
                            @foreach ($personasCasadas as $persona)
                                <tr>
                                    <td>
                                        @if ($persona->image)
                                            <img class="img-tabla-personas img-fluid rounded-circle"
                                                src="{{ Storage::url($persona->image) }}"
                                                alt="Imagen de {{ $persona->name }}" width="50" height="50">
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
                                        <div id="box-general-form-personas" class="box-buttons-acciones">
                                            <a href="{{ route('personas.edit', $persona->id) }}"
                                                class="btn btn-primary mb-2">Modificar</a>
                                            <form action="{{ route('personas.destroy', $persona->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="tfoot-table">
                            <tr class="tr-tfoot-table">
                                <td class="team-member-profile" colspan="7">
                                    <nav>
                                        <ul class="pagination justify-content-center">
                                            <li>
                                                {{ $personasCasadas->links() }}
                                            </li>
                                        </ul>
                                    </nav>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <script></script>
@endsection
