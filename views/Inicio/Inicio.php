<?php require_once 'views/partials/encabezado.php'; ?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Inicio</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Estudiantes en Materias</h5>
                        <div id="barChart"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#barChart"), {
                                    series: [{
                                        data: [
                                            <?php foreach ($mostrarMaterias as $resultadoMateria) {
                                                echo "{ x: '" . $resultadoMateria['nombre_materia'] . "', y: " . $resultadoMateria['cantidad'] . " }, ";
                                            } ?>
                                        ]
                                    }],
                                    chart: {
                                        type: 'bar',
                                        height: 350
                                    },
                                    plotOptions: {
                                        bar: {
                                            borderRadius: 4,
                                            horizontal: true,
                                        }
                                    },
                                    dataLabels: {
                                        enabled: false
                                    },
                                    xaxis: {
                                        type: 'category',
                                    }
                                }).render();
                            });
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Promedio de Notas de Evaluaciones por Curso</h5>
                        <div id="donutChart"></div>
                        mostrarPromedio
                        <?php
                        $labels = [];
                        $series = [];

                        foreach ($mostrarPromedio as $resultadoPromedio) {
                            $labels[] = $resultadoPromedio['nombre_curso'];
                            $promedioFormateado = number_format((float) $resultadoPromedio['promedio'], 2, '.', '');

                            $series[] = (float) $promedioFormateado;
                        }
                        ?>
                        <script>document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#donutChart"), {
                                   series: <?php echo json_encode($series); ?>,
                                    chart: {
                                        height: 350,
                                        type: 'donut',
                                        toolbar: {
                                            show: true
                                        }
                                    },
                                    labels: <?php echo json_encode($labels); ?>
                                }).render();
                            });
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Promedio de Notas de Tareas por Curso</h5>
                        <div id="donutChart2"></div>
                        
                        <?php
                        $labels = [];
                        $series = [];

                        foreach ($mostrarTareas as $resultadoPromedioTarea) {
                            $labels[] = $resultadoPromedioTarea['nombre_curso'];
                            $promedioFormateado = number_format((float) $resultadoPromedioTarea['promedio'], 2, '.', '');

                            $series[] = (float) $promedioFormateado;}
                        ?>
                        <script>document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#donutChart2"), {
                                    series: <?php echo json_encode($series); ?>,
                                    chart: {
                                        height: 350,
                                        type: 'donut',
                                        toolbar: {
                                            show: true
                                        }
                                    },
                                    labels: <?php echo json_encode($labels); ?>
                                }).render();
                            });
                        </script>
                    </div>
                </div>
            </div>



            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Promedio de Notas de Foros por Curso</h5>
                        <div id="donutChart3"></div>
                        
                        <?php
                        $labels = [];
                        $series = [];

                        foreach ($mostrarForos as $resultadoPromedioForo) {
                            $labels[] = $resultadoPromedioForo['nombre_curso'];
                            $promedioFormateado = number_format((float) $resultadoPromedioForo['promedio'], 2, '.', '');

                            $series[] = (float) $promedioFormateado;
                        }
                        ?>
                        <script>document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#donutChart3"), {
                                    series: <?php echo json_encode($series); ?>,
                                    chart: {
                                        height: 350,
                                        type: 'donut',
                                        toolbar: {
                                            show: true
                                        }
                                    },
                                    labels: <?php echo json_encode($labels); ?>
                                }).render();
                            });
                        </script>
                    </div>
                </div>
            </div>


            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cursos</h5>


                        <div id="pieChart" style="width:100%"></div>
                        <?php
                        $labels = [];
                        $series = [];

                        foreach ($mostrarCursos as $resultadoCurso) {
                            $labels[] = $resultadoCurso['nombre_curso_grado'];
                            $series[] = (int) $resultadoCurso['cantidad'];
                        }
                        ?>
            
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#pieChart"), {
                                    series: <?php echo json_encode($series); ?>,
                                    chart: {
                                        height: 350,
                                        type: 'pie',
                                        toolbar: {
                                            show: true
                                        }
                                    },
                                    labels: <?php echo json_encode($labels); ?>
                                }).render();
                            });
                        </script>
            
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="assets/js/dashboard/apexcharts.min.js"></script>
<?php require_once 'views/partials/footer.php'; ?>