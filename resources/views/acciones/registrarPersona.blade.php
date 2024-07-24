@extends('layouts.header')

@section('title', 'Registrarse')
<!-- SweetAlert CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
@section('content')
    @include('layouts.navPersonas')
    <section id="section-registratPersona">
        <div id="join-content-register" class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Registrarse') }}</div>

                        <div class="card-body" style="max-height: 75vh; overflow-y: auto;">
                            <form method="POST" action="{{ route('personas.agregarRegistro') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        placeholder="Ingrese su nombre" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="primer_apellido" class="form-label">Primer Apellido</label>
                                    <input id="primer_apellido" type="text"
                                        class="form-control @error('primer_apellido') is-invalid @enderror"
                                        name="primer_apellido" placeholder="Ingrese su primer apellido" required>
                                    @error('primer_apellido')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
                                    <input id="segundo_apellido" type="text"
                                        class="form-control @error('segundo_apellido') is-invalid @enderror"
                                        name="segundo_apellido" placeholder="Ingrese su segundo apellido">
                                    @error('segundo_apellido')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Correo Electrónico</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        placeholder="Ingrese su correo aquí" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                    <input id="password_confirmation" type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" required>
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Imagen</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image" accept="image/*">
                                    @error('image')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="estado_civil" class="form-label">Estado Civil</label>
                                    <select id="estado_civil"
                                        class="form-select @error('estado_civil') is-invalid @enderror" name="estado_civil"
                                        required>
                                        <option value="" disabled selected>Selecciona tu estado civil</option>
                                        <option value="Soltero">Soltero</option>
                                        <option value="Casado">Casado</option>
                                        <option value="Divorciado">Divorciado</option>
                                        <option value="Viudo">Viudo</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                    @error('estado_civil')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="sexo" class="form-label">Sexo</label>
                                    <select id="sexo" class="form-select @error('sexo') is-invalid @enderror"
                                        name="sexo" required>
                                        <option value="" disabled selected>Selecciona tu sexo</option>
                                        <option value="Hombre">Hombre</option>
                                        <option value="Mujer">Mujer</option>
                                    </select>
                                    @error('sexo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                    <input id="fecha_nacimiento" type="date"
                                        class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                                        name="fecha_nacimiento" required>
                                    @error('fecha_nacimiento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="entidad_nacimiento" class="form-label">Entidad de Nacimiento</label>
                                    <input id="entidad_nacimiento" type="text"
                                        class="form-control @error('entidad_nacimiento') is-invalid @enderror"
                                        name="entidad_nacimiento">
                                    @error('entidad_nacimiento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="municipio_nacimiento" class="form-label">Municipio de Nacimiento</label>
                                    <input id="municipio_nacimiento" type="text"
                                        class="form-control @error('municipio_nacimiento') is-invalid @enderror"
                                        name="municipio_nacimiento">
                                    @error('municipio_nacimiento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nacionalidad" class="form-label">Nacionalidad</label>
                                    <input id="nacionalidad" type="text"
                                        class="form-control @error('nacionalidad') is-invalid @enderror"
                                        name="nacionalidad">
                                    @error('nacionalidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nombre_madre" class="form-label">Nombre de la Madre</label>
                                    <input id="nombre_madre" type="text"
                                        class="form-control @error('nombre_madre') is-invalid @enderror"
                                        name="nombre_madre">
                                    @error('nombre_madre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nombre_padre" class="form-label">Nombre del Padre</label>
                                    <input id="nombre_padre" type="text"
                                        class="form-control @error('nombre_padre') is-invalid @enderror"
                                        name="nombre_padre">
                                    @error('nombre_padre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nacionalidad_madre" class="form-label">Nacionalidad de la Madre</label>
                                    <input id="nacionalidad_madre" type="text"
                                        class="form-control @error('nacionalidad_madre') is-invalid @enderror"
                                        name="nacionalidad_madre">
                                    @error('nacionalidad_madre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nacionalidad_padre" class="form-label">Nacionalidad del Padre</label>
                                    <input id="nacionalidad_padre" type="text"
                                        class="form-control @error('nacionalidad_padre') is-invalid @enderror"
                                        name="nacionalidad_padre">
                                    @error('nacionalidad_padre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox"
                                        name="terms" id="terms" required>
                                    <label class="form-check-label" for="terms">
                                        Acepto los <a href="#" id="terms-link">términos y condiciones</a>
                                    </label>
                                    @error('terms')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        Registrarse
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        </script>
    @endif

@endsection
