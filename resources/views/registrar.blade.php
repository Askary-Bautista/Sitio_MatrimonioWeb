@extends('layouts.header')

@section('title', 'Registrarse')
<style>
    body {
        background-size: cover;
        background-image: url('{{ asset('assets/images/img-fondo-boda.png') }}');
    }

    #join-content-form {
        margin: 0 auto;
        background-image: linear-gradient(to bottom, rgba(253, 231, 180, 0.9), rgba(168, 130, 38, 0.2));
    }

    #btn-regresar {
        padding: 5px;
    }

    #btn-regresar a {
        text-decoration: none;
        color: aliceblue
    }
</style>
@section('content')

    <section id="register-section" class="container mt-5">
        <div id="box-content-formularios" class="row justify-content-center">
            <div id="join-content-form" class="col-md-8">
                <div id="btn-regresar">
                    <button class="btn btn-danger"><a href="{{ Route('index') }}">Regresar</a></button>
                </div>
                <div id="join-content-register" class="card">
                    <div class="card-header">{{ __('Registro') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('personas.Registrar') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input id="name" type="text" class="form-control" name="name"
                                    placeholder="Ingrese su nombre" required>
                                @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="primer_apellido">Primer Apellido</label>
                                <input id="primer_apellido" type="text" class="form-control" name="primer_apellido"
                                    placeholder="Ingrese su primer apellido" required>
                                @error('primer_apellido')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="segundo_apellido">Segundo Apellido</label>
                                <input id="segundo_apellido" type="text" class="form-control" name="segundo_apellido"
                                    placeholder="Ingrese su segundo apellido">
                                @error('segundo_apellido')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input id="email" type="email" class="form-control" name="email"
                                    placeholder="Ingrese su correo aquí" required>
                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                                @error('password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirmar Contraseña</label>
                                <input id="password_confirmation" type="password" class="form-control"
                                    name="password_confirmation" required>
                                @error('password_confirmation')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Imagen</label>
                                <input type="file" class="form-control-file" id="image" name="image"
                                    accept="image/*">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="estado_civil">Estado Civil</label>
                                <select id="estado_civil" class="form-select" name="estado_civil" required>
                                    <option value="" disabled selected>Selecciona tu estado civil</option>
                                    <option value="Soltero">Soltero</option>
                                    <option value="Casado">Casado</option>
                                    <option value="Divorciado">Divorciado</option>
                                    <option value="Viudo">Viudo</option>
                                    <option value="Otro">Otro</option>
                                </select>
                                @error('estado_civil')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sexo">Sexo</label>
                                <select id="sexo" class="form-select" name="sexo" required>
                                    <option value="" disabled selected>Selecciona tu sexo</option>
                                    <option value="Hombre">Hombre</option>
                                    <option value="Mujer">Mujer</option>
                                </select>
                                @error('sexo')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <input id="fecha_nacimiento" type="date" class="form-control" name="fecha_nacimiento"
                                    required>
                                @error('fecha_nacimiento')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="entidad_nacimiento">Entidad de Nacimiento</label>
                                <input id="entidad_nacimiento" type="text" class="form-control"
                                    name="entidad_nacimiento">
                                @error('entidad_nacimiento')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="municipio_nacimiento">Municipio de Nacimiento</label>
                                <input id="municipio_nacimiento" type="text" class="form-control"
                                    name="municipio_nacimiento">
                                @error('municipio_nacimiento')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nacionalidad">Nacionalidad</label>
                                <input id="nacionalidad" type="text" class="form-control" name="nacionalidad">
                                @error('nacionalidad')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nombre_madre">Nombre de la Madre</label>
                                <input id="nombre_madre" type="text" class="form-control" name="nombre_madre">
                                @error('nombre_madre')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nombre_padre">Nombre del Padre</label>
                                <input id="nombre_padre" type="text" class="form-control" name="nombre_padre">
                                @error('nombre_padre')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nacionalidad_madre">Nacionalidad de la Madre</label>
                                <input id="nacionalidad_madre" type="text" class="form-control"
                                    name="nacionalidad_madre">
                                @error('nacionalidad_madre')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nacionalidad_padre">Nacionalidad del Padre</label>
                                <input id="nacionalidad_padre" type="text" class="form-control"
                                    name="nacionalidad_padre">
                                @error('nacionalidad_padre')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <div class="container text-center">
                                <div class="row">
                                    <div class="form-group form-check col">
                                        <input type="checkbox" class="form-check-input" id="terms" name="terms"
                                            required>
                                        <label class="form-check-label" for="terms">Acepto los
                                            <a href="#" id="terms-link">términos y condiciones</a>
                                        </label>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Registrarse</button>
                                    </div>

                                    <div id="btn-regresar" class="col">
                                        <button class="btn btn-danger"><a
                                                href="{{ Route('index') }}">Cancelar</a></button>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
