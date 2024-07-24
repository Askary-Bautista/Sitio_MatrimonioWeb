@extends('layouts.header')

@section('title', 'Casamiento')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

@section('content')

    @include('layouts.navPersonas')

    <section class="section-casar-personas ">
        <div id="box-general-casar-personas" class="overflow-container">
            <div id="box-content-general-casar">
                <div class="box-casar-personas-1">
                    <!-- Formulario de búsqueda -->
                    <div id="box-button-persona1">
                        <div id="box-buscar-personas">
                            <form id="searchForm1" class="form-inline mb-3">
                                <input type="text" name="query" class="form-control mr-sm-2"
                                    placeholder="Buscar personas" required>
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </form>
                        </div>
                    </div>
                    <!-- Resultados de la búsqueda se mostrarán aquí -->
                    <div id="box-content-casar-datos-1"></div>
                </div>

                <div class="box-casar-personas-2">
                    <!-- Formulario de búsqueda -->
                    <div id="box-button-persona2">
                        <div id="box-buscar-personas">
                            <form id="searchForm2" class="form-inline mb-3">
                                <input type="text" name="query" class="form-control mr-sm-2"
                                    placeholder="Buscar personas" required>
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </form>
                        </div>
                    </div>

                    <!-- Resultados de la búsqueda se mostrarán aquí -->
                    <div id="box-content-casar-datos-2"></div>
                </div>
            </div>

            <div class="box-casar-personas-3">
                <form id="confirmarMatrimonioForm" action="{{ route('personas.confirmarMatrimonio') }}" method="POST">
                    @csrf <!-- Agrega el token CSRF -->
                    <div class="box-form-imputs-casamiento">
                        <div id="box-idPersona1">
                            <label for="id_persona1">ID 1ra Persona</label>
                            <input type="text" id="id_persona1" name="persona1_id" class="form-control" readonly>
                        </div>

                        <div id="box-idPersona2">
                            <label for="id_persona2">ID 2da Persona</label>
                            <input type="text" id="id_persona2" name="persona2_id" class="form-control" readonly>
                        </div>

                        <div id="box-fechaBoda">
                            <label for="fecha_matrimonio">Ingresa Fecha para La Boda</label>
                            <input type="date" id="fecha_matrimonio" name="fecha_matrimonio" class="form-control">
                        </div>
                    </div>

                    <div id="box-clausula">
                        <label for="clausula">Cláusula</label>
                        <textarea id="clausula" name="clausula" class="form-control" rows="1"></textarea>
                    </div>

                    <div id="box-confirmarBoda">
                        <button id="confirmarMatrimonioButton" type="submit" class="btn btn-primary">Confirmar
                            Matrimonio</button>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <!-- Contenedor de alertas -->
    <div id="alert-container" class="mt-3"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Incluir el CSS de SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Incluir el JS de SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            document.getElementById('searchForm1').addEventListener('submit', function(event) {
                event.preventDefault();
                const query = this.querySelector('input[name="query"]').value;

                fetch(`{{ route('personas.search') }}?query=${query}`)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('box-content-casar-datos-1').innerHTML = html;

                        // Asignar el ID de la persona seleccionada al campo correspondiente
                        const personaResultBox1 = document.querySelector(
                            '#box-content-casar-datos-1 .persona-result-box');
                        if (personaResultBox1) {
                            const persona1Id = personaResultBox1.dataset.id;
                            document.getElementById('id_persona1').value = persona1Id;
                        }
                    });
            });

            document.getElementById('searchForm2').addEventListener('submit', function(event) {
                event.preventDefault();
                const query = this.querySelector('input[name="query"]').value;

                fetch(`{{ route('personas.search') }}?query=${query}`)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('box-content-casar-datos-2').innerHTML = html;

                        // Asignar el ID de la persona seleccionada al campo correspondiente
                        const personaResultBox2 = document.querySelector(
                            '#box-content-casar-datos-2 .persona-result-box');
                        if (personaResultBox2) {
                            const persona2Id = personaResultBox2.dataset.id;
                            document.getElementById('id_persona2').value = persona2Id;
                        }
                    });
            });

            document.getElementById('confirmarMatrimonioButton').addEventListener('click', function(event) {
                event.preventDefault();

                const persona1Id = document.getElementById('id_persona1').value;
                const persona2Id = document.getElementById('id_persona2').value;
                const fechaMatrimonio = document.getElementById('fecha_matrimonio').value;
                const clausula = document.getElementById('clausula').value;

                if (!persona1Id || !persona2Id) {
                    showAlert('Ingrese los IDs de ambas personas.', 'error');
                    return;
                }

                fetch(`{{ route('personas.confirmarMatrimonio') }}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            persona1_id: persona1Id,
                            persona2_id: persona2Id,
                            fecha_matrimonio: fechaMatrimonio,
                            clausula: clausula
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showAlert(data.success, 'success');
                            setTimeout(function() {
                                window.location.href = "{{ url('/personas-matrimonio') }}";
                            }, 2500);
                        } else if (data.error) {
                            showAlert(data.error, 'error');
                        }
                    });
            });

            function showAlert(message, type) {
                Swal.fire({
                    icon: type,
                    title: message,
                    showConfirmButton: true,
                });
            }
        });
    </script>
@endsection
