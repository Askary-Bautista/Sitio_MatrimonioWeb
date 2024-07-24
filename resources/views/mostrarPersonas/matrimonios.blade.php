@extends('layouts.header')

@section('title', 'Matrimonios')
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
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1 class="card-title mb-0">Matrimonios Totales</h1>
                    <h2 class="table-row-count mb-0">{{ $totalMatrimonios }}</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Matrimonio</th>
                                <th>Fecha de Boda</th>
                                <th>Cláusula</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matrimonios as $matrimonio)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="box-img-matrimonios mr-3">
                                                @if ($matrimonio->persona1->image)
                                                    <img class="img-tabla-personas img-fluid rounded-circle"
                                                        src="{{ Storage::url($matrimonio->persona1->image) }}"
                                                        alt="Imagen de {{ $matrimonio->persona1->name }}" width="50"
                                                        height="50">
                                                @else
                                                    <img class="img-tabla-personas img-fluid rounded-circle"
                                                        src="default-image.png" alt="No Image" width="50"
                                                        height="50">
                                                @endif
                                            </div>
                                            <div>{{ $matrimonio->persona1->name }}</div>
                                            <div class="ml-3 box-img-matrimonios">
                                                @if ($matrimonio->persona2->image)
                                                    <img class="img-tabla-personas img-fluid rounded-circle"
                                                        src="{{ Storage::url($matrimonio->persona2->image) }}"
                                                        alt="Imagen de {{ $matrimonio->persona2->name }}" width="50"
                                                        height="50">
                                                @else
                                                    <img class="img-tabla-personas img-fluid rounded-circle"
                                                        src="default-image.png" alt="No Image" width="50"
                                                        height="50">
                                                @endif
                                            </div>
                                            <div>{{ $matrimonio->persona2->name }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <button class="btn btn-info mb-2 open-modal" data-id="{{ $matrimonio->id }}">Ver
                                                Invitación</button>
                                            <button class="btn btn-primary mb-2 btn-enviar-correo"
                                                data-id="{{ $matrimonio->id }}">Enviar Correo</button>
                                            <button class="btn btn-success mb-2 btn-descargar-acta"
                                                data-id="{{ $matrimonio->id }}">Abrir Acta de Matrimonio</button>
                                            <button class="btn btn-danger mb-2 btn-divorciar"
                                                data-id="{{ $matrimonio->id }}">Divorciar</button>
                                        </div>
                                    </td>
                                    <td>{{ $matrimonio->clausula }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <nav>
                                        <ul class="pagination justify-content-center">
                                            <!-- Paginación, si la tienes -->
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


    <!-- Modal HTML -->
    <div id="invitacionModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modal-body">
                <!-- Aquí se cargará el contenido de la vista invitacion -->
            </div>
        </div>
    </div>

    <script>
        const csrfToken = "{{ csrf_token() }}";
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var modal = document.getElementById("invitacionModal");
            var span = document.getElementsByClassName("close")[0];

            span.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            document.querySelectorAll('.open-modal').forEach(button => {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    fetch(`/invitacion/${id}`)
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('modal-body').innerHTML = html;
                            modal.style.display = "block";
                        })
                        .catch(error => console.log('Error:', error));
                });
            });
            document.querySelectorAll('.btn-enviar-correo').forEach(button => {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    fetch(`/enviar-correo/${id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Mostrar el mensaje de éxito usando SweetAlert
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Éxito',
                                    text: data.success
                                });
                            } else {
                                // Mostrar el mensaje de error usando SweetAlert
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Hubo un error al enviar el correo.'
                                });
                            }
                        })
                        .catch(error => console.log('Error:', error));
                });
            });


            document.querySelectorAll('.btn-descargar-acta').forEach(button => {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    window.location.href = `/acta-matrimonio/${id}`;
                });
            });

            // Divorce with SweetAlert confirmation
            document.querySelectorAll('.btn-divorciar').forEach(button => {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¿Estás seguro de que deseas divorciar a estas personas?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, divorciar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/divorciar-persona/${id}`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            title: 'Divorciado',
                                            text: data.success,
                                            icon: 'success',
                                            confirmButtonText: 'Ok'
                                        }).then(() => {
                                            window.location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Error',
                                            text: 'Hubo un error al divorciar a la persona.',
                                            icon: 'error',
                                            confirmButtonText: 'Ok'
                                        });
                                    }
                                })
                                .catch(error => console.log('Error:', error));
                        }
                    });
                });
            });
        });
    </script>
@endsection
