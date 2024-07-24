<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acta de Matrimonio</title>
    <style>
        .container-acta-nacimiento .header {
            padding: 5px;
        }


        .header {
            display: flex;
            flex-direction: column;
            /* Dos columnas de igual tamaño */
            align-items: center;

            /* Alinea los elementos verticalmente en el centro */
        }

        /* Resto de estilos para .header */
        #content-datos-nacion {

            width: 400px;
        }

        .header #box-title-actaNacimiento {

            width: 400px;
        }


        .header #box-content-nacion-acta {
            width: 400px;

        }

        .header #box-img-escudo {
            position: absolute;
            top: 5px;
            left: 420px;
        }



        #tabla-datos-contrayentes {
            width: 100%;
            border: none;

        }

        #container-table-contrayentes #td-contrayentes-acta {
            width: 10%;
        }

        #container-table-contrayentes #tabla-datos-contrayentes,
        #container-table-contrayentes #tabla-padres-contrayentes,
        #container-table-contrayentes td,
        #container-table-contrayentes th {
            border-bottom: 1px solid #383737;
            border-collapse: collapse;

        }

        #container-table-contrayentes td,
        #container-table-contrayentes th {
            padding: 3px;
            height: 25px;
        }



        #container-table-contrayentes .td-contrayentes-acta,
        #container-table-padres-cont .td-contrayentes-acta {
            background-color: #5cb36f;
            width: 0;

        }

        #container-table-contrayentes th {
            background: #f0e6cc;
        }

        #container-table-contrayentes .even {
            background: #fbf8f0;
        }

        #container-table-contrayentes .odd {
            background: #fefcf9;
        }

        .container-acta-nacimiento .header #box-title-actaNacimiento h3 {
            text-align: center;
        }

        #container-table-contrayentes .vertical-text {
            width: min-content;
            writing-mode: vertical-rl;
            text-orientation: mixed;
            white-space: nowrap;
            transform: rotate(270deg);
        }

        #container-table-contrayentes .text-td-tabla-cont {
            text-align: center;
        }

        #container-table-contrayentes #td-content-title div {
            text-align: center;
        }

        #container-table-contrayentes .td-letra-chica {
            font-size: 12px;
        }

        /* ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| */
        /* AQUI EMPIEZA LOS ESTILOS DE LA 2DA TABLA */


        #container-table-padres-cont #tabla-padres-contrayentes {
            width: max-content;
        }

        #container-table-padres-cont #tabla-padres-contrayentes,
        #container-table-padres-cont td,
        #container-table-padres-cont th {
            border-bottom: 1px solid #595959;
            border-collapse: collapse;
        }

        #container-table-padres-cont td,
        #container-table-padres-cont th {
            padding: 3px;


        }

        #container-table-padres-cont th {
            background: #f0e6cc;
        }



        #container-table-padres-cont .text-td-tabla-padres {
            text-align: center;
        }

        #container-table-padres-cont .td-contrayentes-acta {
            width: 0;
            height: 100px;
        }

        #container-table-padres-cont .vertical-text {
            background-color:
                writing-mode: vertical-rl;
            text-orientation: mixed;
            white-space: nowrap;
            transform: rotate(270deg);
        }

        /* Estilos Caja de Firmas */
        .signature-section .signature-esposo {
            position: relative;
            top: 50px;
            left: 50px;
        }

        .signature-section .signature-esposa {
            position: relative;

            left: 550px;
        }



        .container-acta-nacimiento .header {
            padding: 5px;
        }

        .header {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #content-datos-nacion {
            width: 400px;
        }

        .header #box-title-actaNacimiento {
            width: 400px;
        }

        .header #box-content-nacion-acta {
            width: 400px;
        }

        .header #box-img-escudo {
            position: absolute;
            top: 5px;
            left: 420px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 3px;
            height: 25px;
            text-align: center;
        }

        .vertical-text {
            writing-mode: vertical-rl;
            text-orientation: mixed;
            white-space: nowrap;
            transform: rotate(270deg);
        }

        .footer {
            position: relative;
            top: 50px;
            left: 210px;
        }
    </style>
</head>


<body>
    <div class="container-acta-nacimiento">
        <div class="header">
            <div id="content-datos-nacion">
                <div id="box-content-nacion-acta">
                    <h1>Estados Unidos Mexicanos</h1>
                </div>
                <div id="box-title-actaNacimiento">
                    <h2>Acta de Matrimonio</h2>
                </div>
            </div>
            <div id="box-img-escudo">
                <img src="{{ public_path('assets/images/escudo_de_mexico.jpg') }}" alt="" width="220px">
            </div>
        </div>

        <div id="container-table-contrayentes">
            <table id="tabla-datos-contrayentes">
                <tbody>
                    <tr>
                        <td colspan="7" id="td-content-title">
                            <div>Datos de los Contrayentes</div>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="4" class="td-contrayentes-acta">
                            <div class="vertical-text">Contrayentes</div>
                        </td>
                        <td colspan="2" class="text-td-tabla-cont">{{ $persona1->name }}</td>
                        <td colspan="2" class="text-td-tabla-cont">{{ $persona1->primer_apellido }}</td>
                        <td colspan="2" class="text-td-tabla-cont">{{ $persona1->segundo_apellido }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-td-tabla-cont td-letra-chica">Nombre(s)</td>
                        <td colspan="2" class="text-td-tabla-cont td-letra-chica">Primer Apellido</td>
                        <td colspan="2" class="text-td-tabla-cont td-letra-chica">Segundo Apellido</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-td-tabla-cont">{{ $persona1->entidad_nacimiento }}</td>
                        <td class="text-td-tabla-cont">{{ $persona1->municipio_nacimiento }}</td>
                        <td class="text-td-tabla-cont">{{ $persona1->nacionalidad }}</td>
                        <td class="text-td-tabla-cont">{{ $persona1->sexo }}</td>
                        <td class="text-td-tabla-cont">{{ $persona1->fecha_nacimiento }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-td-tabla-cont td-letra-chica">Entidad de Nacimiento</td>
                        <td class="text-td-tabla-cont td-letra-chica">Municipio de Nacimiento</td>
                        <td class="text-td-tabla-cont td-letra-chica">Nacionalidad</td>
                        <td class="text-td-tabla-cont td-letra-chica">Sexo</td>
                        <td class="text-td-tabla-cont td-letra-chica">Fecha de Nacimiento</td>
                    </tr>
                    <tr>
                        <td rowspan="4" class="td-contrayentes-acta">
                            <div class="vertical-text">Contrayentes</div>
                        </td>
                        <td colspan="2" class="text-td-tabla-cont">{{ $persona2->name }}</td>
                        <td colspan="2" class="text-td-tabla-cont">{{ $persona2->primer_apellido }}</td>
                        <td colspan="2" class="text-td-tabla-cont">{{ $persona2->segundo_apellido }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-td-tabla-cont td-letra-chica">Nombre(s)</td>
                        <td colspan="2" class="text-td-tabla-cont td-letra-chica">Primer Apellido</td>
                        <td colspan="2" class="text-td-tabla-cont td-letra-chica">Segundo Apellido</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-td-tabla-cont">{{ $persona2->entidad_nacimiento }}</td>
                        <td class="text-td-tabla-cont">{{ $persona2->municipio_nacimiento }}</td>
                        <td class="text-td-tabla-cont">{{ $persona2->nacionalidad }}</td>
                        <td class="text-td-tabla-cont">{{ $persona2->sexo }}</td>
                        <td class="text-td-tabla-cont">{{ $persona2->fecha_nacimiento }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-td-tabla-cont td-letra-chica">Entidad de Nacimiento</td>
                        <td class="text-td-tabla-cont td-letra-chica">Municipio de Nacimiento</td>
                        <td class="text-td-tabla-cont td-letra-chica">Nacionalidad</td>
                        <td class="text-td-tabla-cont td-letra-chica">Sexo</td>
                        <td class="text-td-tabla-cont td-letra-chica">Fecha de Nacimiento</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br><br>
        <div id="container-table-padres-cont">
            <table id="tabla-padres-contrayentes">
                <tbody>
                    <tr>
                        <td colspan="4" class="text-td-tabla-padres">
                            <div class="text-td-tabla-padres">Datos de los Padres de los Contrayentes</div>
                        </td>
                        <td colspan="3" class="text-td-tabla-padres">Nacionalidad</td>
                    </tr>
                    <tr>
                        <td rowspan="2" class="td-contrayentes-acta">
                            <div class="vertical-text">Contrayentes</div>
                        </td>
                        <td colspan="3" class="text-td-tabla-padres">{{ $persona1->nombre_padre }}</td>
                        <td colspan="3" class="text-td-tabla-padres">{{ $persona1->nacionalidad_padre }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-td-tabla-padres">{{ $persona1->nombre_madre }}</td>
                        <td colspan="3" class="text-td-tabla-padres">{{ $persona1->nacionalidad_madre }}</td>
                    </tr>
                    <tr>
                        <td rowspan="2" class="td-contrayentes-acta">
                            <div class="vertical-text">Contrayentes</div>
                        </td>
                        <td colspan="3" class="text-td-tabla-padres">{{ $persona2->nombre_padre }}</td>
                        <td colspan="3" class="text-td-tabla-padres">{{ $persona2->nacionalidad_padre }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-td-tabla-padres">{{ $persona2->nombre_madre }}</td>
                        <td colspan="3" class="text-td-tabla-padres">{{ $persona2->nacionalidad_madre }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="signature-section">
            <div class="signature-esposo">
                <p>Firma del Esposo</p>
            </div>
            <div class="signature-esposa">
                <p>Firma de la Esposa</p>
            </div>
        </div>

        <div class="footer">
            Este documento certifica la unión matrimonial.
        </div>
    </div>
</body>

</html>
