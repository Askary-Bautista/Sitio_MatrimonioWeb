@extends('layouts.header')

@section('title', 'Bienvenido')
<style>
    .nav-hor-index-p {
        background-color: #a88226;
        padding: 5px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .container-uni-reg {
        margin-left: 320px;
    }


    .nav-horizontal-index ul {
        margin: 0;
        padding: 0;
    }

    .nav-horizontal-index li {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .nav-horizontal-index li a:hover {
        color: #decf66;
    }

    .nav-horizontal-index li a {
        text-decoration: none;
    }

    .layout-nav-horizontal {
        display: grid;
        grid-template-rows: 1fr;
        grid-template-columns: 1fr 1fr;

    }


    .nav-a-index {
        color: #faf9ec;

    }

    .box-nav-2 li a {
        color: #faf9ec;
    }

    .box-nav-1 li a:hover,
    .box-nav-2 li a:hover {
        color: #f3c966;
    }

    .box-nav-1 li a:hover {
        text-decoration: none;
    }
</style>
@section('content')
    <header>
        <nav class="nav-hor-index-p">
            <ul class="layout-nav-horizontal">
                <div class="box-nav-1">
                    <li> <a class="nav-a-index" href="{{ route('index') }}">Home</a></li>
                </div>


                <div class="container-uni-reg text-center">
                    <div class="row">
                        <div class="box-nav-2 col">
                            <li> <a href="{{ route('login') }}"
                                    class="btn   text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Unirse</a>
                            </li>
                        </div>


                        <div class="col box-nav-2 ">
                            <li> <a href="{{ route('personasRegistrar') }}"
                                    class="btn text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Registrarse</a>
                            </li>
                        </div>
                    </div>
                </div>


            </ul>
        </nav>
    </header>

    <section>
        <div class="box-content-general-welcome">
            <div class="box-content-welcome">
                <div>
                    <h1 class="cotent-welcome"> Bienvenido a Tú Sitio Ideal</h1>
                    <h2 class="cotent-welcome"> Obten el mejor compromiso de tu vida</p>
                        <h3 class="cotent-welcome">¡Encuentra todo lo que necesitas para tu boda!
                    </h2>
                </div>
            </div>
        </div>
    </section>


@endsection
