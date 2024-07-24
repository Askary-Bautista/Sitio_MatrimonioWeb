@extends('layouts.header')

@section('title', 'Registrarse')

@include('layouts.navIndexHorizontal')


@section('content')
    <section class="section-vista-join">
        <div class="box-content-general-join">
            <div class="box-content-sub-join">
                <div id="box-content-imagen-boda" class="img-boda">
                    {{-- En este sitio se muestra la imagen --}}

                    <div>
                        <img src="{{ asset('assets/images/img-boda.jpeg') }}" class="img-thumbnail" alt="..."
                            width="250px" height="150px">
                    </div>

                    <div id="join-content-type-form" class="">

                        <div class="box-content-opc">
                            <button id="join-box-iniciar" class="join-box">Iniciar Sesion</button>
                        </div>

                        <div class="box-content-opc">
                            <button id="join-box-registrarse" class="join-box">Registrarse</button>
                        </div>
                    </div>
                </div>
                <div id="box-content-formularios">

                    <div id="join-content-form" class="">
                        <div id="join-content-register" class="" style="display: none;">
                            <div class="container-first-form-register">

                                <div class="content-form">
                                    <form method="POST" action="{{ route('personas.store') }}" class="form-register"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="box-general-campos-form">
                                            <div class="box-form-opc-register">
                                                <label for="name">Nombre</label>
                                                <input id="name" type="text" class="form-control" name="name"
                                                    placeholder="Ingrese su nombre" required>
                                                @error('name')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="box-form-opc-register">
                                                <label for="primer_apellido">Primer Apellido</label>
                                                <input id="primer_apellido" type="text" class="form-control"
                                                    name="primer_apellido" placeholder="Ingrese su primer apellido"
                                                    required>
                                                @error('primer_apellido')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="box-form-opc-register">
                                                <label for="segundo_apellido">Segundo Apellido</label>
                                                <input id="segundo_apellido" type="text" class="form-control"
                                                    name="segundo_apellido" placeholder="Ingrese su segundo apellido">
                                                @error('segundo_apellido')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="box-form-opc-register">
                                                <label for="email">Correo Electrónico</label>
                                                <input id="email" type="email" class="form-control" name="email"
                                                    placeholder="Ingrese su correo aquí" required>
                                                @error('email')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="box-form-opc-register">
                                                <label for="password">Contraseña</label>
                                                <input id="password" type="password" class="form-control" name="password"
                                                    required>
                                                @error('password')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="box-form-opc-register" class="form-floating mb-3">
                                                <label for="password_confirmation">Confirmar Contraseña</label>
                                                <input id="password_confirmation" type="password" class="form-control"
                                                    name="password_confirmation" required>
                                                @error('password_confirmation')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="box-form-opc-register">
                                                <label for="image">Imagen</label>
                                                <input type="file" class="form-control-file" id="image"
                                                    name="image" accept="image/*">
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="box-general-campos-form">

                                            <div class="box-general-campos-form">
                                                <div class="box-form-opc-register">
                                                    <label for="estado_civil">Estado Civil</label>
                                                    <select id="estado_civil" class="form-select" name="estado_civil"
                                                        required>
                                                        <option value="" disabled selected>Selecciona tu estado civil
                                                        </option>
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
                                            </div>
                                            <div class="box-form-opc-register">
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
                                            <div class="box-form-opc-register">
                                                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                                <input id="fecha_nacimiento" type="date" class="form-control"
                                                    name="fecha_nacimiento" required>
                                                @error('fecha_nacimiento')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>


                                        </div>

                                        <div class="box-general-campos-form">
                                            <div class="box-form-opc-register">
                                                <label for="entidad_nacimiento">Entidad de Nacimiento</label>
                                                <input id="entidad_nacimiento" type="text" class="form-control"
                                                    name="entidad_nacimiento">
                                                @error('entidad_nacimiento')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="box-form-opc-register">
                                                <label for="municipio_nacimiento">Municipio de Nacimiento</label>
                                                <input id="municipio_nacimiento" type="text" class="form-control"
                                                    name="municipio_nacimiento">
                                                @error('municipio_nacimiento')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="box-form-opc-register">
                                                <label for="nacionalidad">Nacionalidad</label>
                                                <input id="nacionalidad" type="text" class="form-control"
                                                    name="nacionalidad">
                                                @error('nacionalidad')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="box-general-campos-form">
                                            <div class="box-form-opc-register">
                                                <label for="nombre_madre">Nombre de la Madre</label>
                                                <input id="nombre_madre" type="text" class="form-control"
                                                    name="nombre_madre">
                                                @error('nombre_madre')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="box-form-opc-register">
                                                <label for="nombre_padre">Nombre del Padre</label>
                                                <input id="nombre_padre" type="text" class="form-control"
                                                    name="nombre_padre">
                                                @error('nombre_padre')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="box-general-campos-form">
                                            <div class="box-form-opc-register">
                                                <label for="nacionalidad_madre">Nacionalidad de la Madre</label>
                                                <input id="nacionalidad_madre" type="text" class="form-control"
                                                    name="nacionalidad_madre">
                                                @error('nacionalidad_madre')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="box-form-opc-register">
                                                <label for="nacionalidad_padre">Nacionalidad del Padre</label>
                                                <input id="nacionalidad_padre" type="text" class="form-control"
                                                    name="nacionalidad_padre">
                                                @error('nacionalidad_padre')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>




                                        <div class="box-general-campos-form">
                                            <div class="box-form-opc-register">
                                                <div class="terms-general">
                                                    <div id="terms-input">
                                                        <input type="checkbox" name="terms" required>
                                                    </div>
                                                    <div id="terms-label">
                                                        <label for="terms">Acepto los
                                                            <a href="#" id="terms-link">términos y condiciones</a>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-form-opc-register">
                                                <div class="box-btn-submit-signUp">
                                                    <button type="submit" class="btn-submit-signUp">Registrarse</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <div id="join-content-login" class="join-content" style="display: block;">
                            <div class="container-first-form-login">
                                <div class="box-title-form">
                                    <h3>Login</h3>
                                </div>
                                <div class="content-form">
                                    <form method="POST" action="{{ route('login.submit') }}" class="form-login">
                                        @csrf
                                        <div class="box-form-opc-login">
                                            <label for="login-email" class="">CORREO ELECTRONICO</label>
                                            <div class="">
                                                <input id="login-email" type="email" class="form-control"
                                                    name="login_email" placeholder="Your e-mail goes here" required
                                                    autocomplete="email" autofocus>
                                                @error('login_email')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="box-form-opc-login">
                                            <label for="login-password">CONTRASEÑA</label>
                                            <div class="">
                                                <input id="login-password" type="password" class="form-control"
                                                    name="login_password" required autocomplete="current-password"
                                                    autofocus>
                                                @error('login_password')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="box-form-opc-login">
                                            <div class="box-btn-submit-signIn">
                                                <button type="submit" class="btn-submit-signIn">INICIAR</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Obtener referencias a los elementos del DOM
            var btnIniciarSesion = document.getElementById("join-box-iniciar");
            var btnRegistrarse = document.getElementById("join-box-registrarse");
            var formLogin = document.getElementById("join-content-login");
            var formRegister = document.getElementById("join-content-register");

            // Agregar event listeners para los botones
            btnIniciarSesion.addEventListener("click", function() {
                document.title = 'Iniciar Sesion';
                formLogin.style.display = "block"; // Mostrar formulario de inicio de sesión
                formRegister.style.display = "none"; // Ocultar formulario de registro
            });

            btnRegistrarse.addEventListener("click", function() {
                document.title = 'Registrarse';
                formLogin.style.display = "none"; // Ocultar formulario de inicio de sesión
                formRegister.style.display = "block"; // Mostrar formulario de registro
            });
        });
    </script>

@endsection
