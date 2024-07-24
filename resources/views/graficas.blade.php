@extends('layouts.header')

@section('title', 'Gráficas')
<style>
    /* ESTILOS VISTA GRAFICAS */

    body {
        overflow: hidden;
    }

    #section-graficas {

        height: 100%;
        background-image: url('{{ asset('assets/images/img-fondo-boda.png') }}');
        background-size: cover;

    }

    /* Estilos para el contenedor principal */
    .container-graficas {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        /* Columnas automáticas con un ancho mínimo de 300px */
        gap: 20px;
        /* Espacio entre columnas */
        padding: 20px;
        /* Espaciado interno */
        max-width: 1200px;
        /* Ancho máximo del contenedor */
        margin: 0 auto;
        /* Centra horizontalmente */
    }

    /* Estilos para la sección de información y botones */
    .graficas-info {
        padding: 20px;
    }

    /* Estilos para los botones de gráficas */
    .graficas-buttons {
        margin-bottom: 20px;
        display: flex;
        flex-wrap: wrap;
        /* Ajusta automáticamente los botones a varias líneas */
    }

    .graficas-button {
        margin-right: 10px;
        margin-bottom: 10px;
    }

    /* Estilos para los contenedores de gráficas */
    .graficas-container {
        display: flex;
        justify-content: center;
        /* Centra horizontalmente */
        align-items: center;
        /* Centra verticalmente */
        height: 450px;
        /* Altura de las gráficas */
        max-width: 600px;
        /* Ancho máximo del contenedor */
        width: 100%;
        /* Ajusta el ancho del contenedor */

    }

    /* Estilos para las gráficas */
    .graficas-chart {
        border-radius: 5px;
        width: 100%;
        /* Ajusta el ancho de la gráfica */
        height: 100%;
        /* Ajusta la altura de la gráfica */
        max-width: 450px;
        /* Ancho máximo de la gráfica */
        max-height: 450px;
        /* Altura máxima de la gráfica */
    }

    /* Estilos para el lienzo de la gráfica */
    .graficas-chart canvas {
        width: 100%;
        /* Hace que el lienzo de la gráfica ocupe todo el ancho del contenedor */
        height: 100%;
        /* Hace que el lienzo de la gráfica ocupe toda la altura del contenedor */
        border-radius: 5px;
        background-color: #ffffff;
        padding: 10px;
    }
</style>
@section('content')

    @include('layouts.navPersonas')

    <section id="section-graficas">
        <div class="container-graficas">
            <div class="graficas-info">
                <div>
                    <h1>Gráficas</h1>
                </div>

                <div>
                    <!-- Formulario para seleccionar año -->
                    <form method="GET" action="{{ route('graficas') }}" class="mb-4">
                        <div class="form-row">
                            <div class="form-group col-md-10">
                                <label for="year">Año</label>
                                <input type="number" class="form-control" id="year" name="year"
                                    value="{{ $year }}" min="1900" max="{{ date('Y') }}">
                            </div>
                            <div class="form-group col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </div>
                    </form>
                </div>


                <!-- Botones para alternar entre las gráficas -->
                <div class="btn-group mb-4 graficas-buttons" role="group" aria-label="Gráficas">
                    <button type="button" class="btn btn-primary graficas-button"
                        data-target="matrimoniosPorMesChart">Matrimonios por Mes</button>
                    <button type="button" class="btn btn-primary graficas-button" data-target="estadosCivilesChart">Estados
                        Civiles</button>
                    <button type="button" class="btn btn-primary graficas-button" data-target="generosChart">Comparación de
                        Géneros</button>
                </div>
            </div>

            <div>
                <!-- Gráficos -->
                <div id="chartsContainer" class="graficas-container">
                    <div class="chart graficas-chart" id="matrimoniosPorMesChartContainer">
                        <canvas id="matrimoniosPorMesChart"></canvas>
                    </div>
                    <div class="chart graficas-chart" id="estadosCivilesChartContainer" style="display:none;">
                        <canvas id="estadosCivilesChart"></canvas>
                    </div>
                    <div class="chart graficas-chart" id="generosChartContainer" style="display:none;">
                        <canvas id="generosChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('scripts')
    <!-- Incluir Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const graficasButtons = document.querySelectorAll('.graficas-button');
            const graficasCharts = document.querySelectorAll('.graficas-chart');

            graficasButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    showChart(targetId);
                });
            });

            function showChart(chartId) {
                // Ocultar todos los gráficos
                graficasCharts.forEach(chart => chart.style.display = 'none');
                // Mostrar el gráfico seleccionado
                document.getElementById(chartId + 'Container').style.display = 'block';
            }

            // Datos para el gráfico de matrimonios por mes
            const matrimoniosPorMesData = @json($matrimoniosPorMes);
            const matrimoniosPorMesLabels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
                'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ];
            const matrimoniosPorMesValues = matrimoniosPorMesLabels.map((label, index) => matrimoniosPorMesData[
                index + 1] || 0);

            // Datos para el gráfico de estados civiles
            const estadosCivilesData = @json($estadosCiviles);
            const estadosCivilesLabels = Object.keys(estadosCivilesData);
            const estadosCivilesValues = Object.values(estadosCivilesData);

            // Datos para el gráfico de géneros
            const generosData = @json($generos);
            const generosLabels = Object.keys(generosData);
            const generosValues = Object.values(generosData);

            // Configurar gráfico de matrimonios por mes
            const matrimoniosPorMesChart = new Chart(document.getElementById('matrimoniosPorMesChart'), {
                type: 'bar',
                data: {
                    labels: matrimoniosPorMesLabels,
                    datasets: [{
                        label: 'Matrimonios por Mes',
                        data: matrimoniosPorMesValues,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                }
            });

            // Configurar gráfico de estados civiles
            const estadosCivilesChart = new Chart(document.getElementById('estadosCivilesChart'), {
                type: 'pie',
                data: {
                    labels: estadosCivilesLabels,
                    datasets: [{
                        label: 'Estado Civil',
                        data: estadosCivilesValues,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                }
            });

            // Configurar gráfico de géneros
            const generosChart = new Chart(document.getElementById('generosChart'), {
                type: 'doughnut',
                data: {
                    labels: generosLabels,
                    datasets: [{
                        label: 'Género',
                        data: generosValues,
                        backgroundColor: [
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                }
            });
        });

        function showChart(chartId) {
            // Ocultar todos los gráficos
            document.querySelectorAll('.chart').forEach(chart => chart.style.display = 'none');
            // Mostrar el gráfico seleccionado
            document.getElementById(chartId + 'Container').style.display = 'block';
        }
    </script>
@endsection
