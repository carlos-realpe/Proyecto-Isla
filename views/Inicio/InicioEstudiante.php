<?php require_once 'views/partials/encabezado.php'; ?>
<style>
    ol {
        list-style: none;
    }

    a {
        text-decoration: none;
    }

    h5,
    h4 {
        font-weight: bold;
        text-align: center;
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>
            Inicio
        </h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <ol>
                            <li>
                                <h5>Actividades pendientes</h5>
                            </li>

                            <!-- FORO -->
                            <li>
                                <h4>Foros</h4>
                                <?php foreach ($foro as $foroPendiente) {
                                    if (
                                        $foroPendiente != null &&
                                        isset($foroPendiente['titulo'], $foroPendiente['horaForo'])
                                    ) {
                                        ?>

                                        <hr>
                                        <a
                                            href="index.php?c=Acciones&a=MostrarForoDetalle&idAsignar=<?php echo $foroPendiente['id_fk_asignar'] ?>&foro=<?php echo $foroPendiente['id_foro_publicacion'] ?>">
                                            <?php echo $foroPendiente['titulo'] ?>
                                        </a>

                                        <p><b>Hora Fin: </b>
                                            <?php echo $foroPendiente['horaForo'] ?>
                                        </p>
                                        <p><b>Fecha Inicio: </b>
                                            <?php echo $foroPendiente['fechaForo'] ?>
                                        </p>
                                        <p><b>Fecha Fin: </b>
                                            <?php echo $foroPendiente['fechaFin'] ?>
                                        </p>
                                    <?php }
                                } ?>
                            </li>


                            <!-- TAREA -->
                            <li>
                                <hr>
                                <h4>Tareas</h4>
                                <?php foreach ($tareas as $tareaPendiente) {
                                    if (
                                        $tareaPendiente != null &&
                                        isset($tareaPendiente['titulo_tarea'], $tareaPendiente['horaTarea'])
                                    ) {
                                        ?>

                                        <hr>
                                        <a
                                            href="index.php?c=Acciones&a=MostrarTarea&idAsignacion=<?php echo $tareaPendiente['id_fk_asignar'] ?>&idTarea=<?php echo $tareaPendiente['id_tarea_publicacion'] ?>&typ=<?php echo $tareaPendiente['tipo_archivo'] ?>">
                                            <?php echo $tareaPendiente['titulo_tarea'] ?>
                                        </a>

                                        <p><b>Hora Fin: </b>
                                            <?php echo $tareaPendiente['horaTarea'] ?>
                                        </p>
                                        <p><b>Fecha Inicio: </b>
                                            <?php echo $tareaPendiente['fechaTarea'] ?>
                                        </p>
                                        <p><b>Fecha Fin: </b>
                                            <?php echo $tareaPendiente['fechaFinTarea'] ?>
                                        </p>
                                    <?php }
                                } ?>
                            </li>



                            <!-- EVALUACIONES -->
                            <li>
                                <hr>
                                <h4>Evaluaciones</h4>
                                <?php foreach ($evaluaciones as $evaluacionPendiente) {
                                    if (
                                        $evaluacionPendiente != null &&
                                        isset($evaluacionPendiente['nombreTitulo'], $evaluacionPendiente['horaInicio'])
                                    ) {
                                        ?>

                                        <hr>
                                        <a
                                            href="index.php?c=Docente&a=MostrarEvaluacionesDatos&idAsignacion=<?php echo $evaluacionPendiente['id_fk_asignar']?>">
                                            <?php echo $evaluacionPendiente['nombreTitulo'] ?>
                                        </a>

                                        <p><b>Hora Fin: </b>
                                            <?php echo $evaluacionPendiente['horaInicio'] ?>
                                        </p>
                                        <p><b>Fecha Inicio: </b>
                                            <?php echo $evaluacionPendiente['fechaLimite'] ?>
                                        </p>
                                        <p><b>Fecha Fin: </b>
                                            <?php echo $evaluacionPendiente['fechaFinEva'] ?>
                                        </p>
                                    <?php }
                                } ?>
                            </li>



                        </ol>


                    </div>
                </div>
            </div>
        </div>


    </section>
</main>



<?php require_once 'views/partials/footer.php'; ?>