@extends('layouts.header')

@section('title', 'Invitacion')

@section('content')
    <div class="content-general-inv">

        <div id="box-col1-inv">
            <div>
                <h1>
                    Nuestra boda se acerca
                </h1>
            </div>

            <div>
                <h2>Fecha:</h2>
            </div>
            <div id="box-fechaInviatacion-inv">
                <h3>
                    {{ $matrimonio->fecha_matrimonio }}
                </h3>
            </div>
        </div>


        <div id="box-img-anillos-inv"></div>

        <div id="box-col2-inv">
            <div id="box-content-personas">
                <div id="box-name-persona1-inv">
                    <div>
                        {{ $matrimonio->persona1->name }}
                    </div>
                </div>

                <div id="box-and-inv">
                    &
                </div>
                <div id="box-name-persona1-inv">
                    <div>
                        {{ $matrimonio->persona2->name }}
                    </div>
                </div>
            </div>


            <div id="box-parrafo2-der-inv">
                <div>
                    Estamos encantados de invitarte a celebrar nuestro matrimonio
                </div>
            </div>

        </div>

    </div>

@endsection
