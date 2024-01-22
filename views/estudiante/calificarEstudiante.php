<?php require_once 'views/partials/encabezado.php'; ?>
<style>
    ul {
        list-style: none;
    }

    a {
        text-decoration: none;
    }

    h6 {
        font-weight: bold;
    }

    #editor {
        height: 200px;
        /* Establece la altura deseada */
    }

    @media (max-width: 990px) {

        th:nth-child(2),
        td:nth-child(2) {
            display: table-cell !important;
        }

        th:nth-child(5),
        td:nth-child(5) {
            display: table-cell !important;
        }

        th:not(:nth-child(1)):not(:nth-child(2)):not(:nth-child(5)),
        td:not(:nth-child(1)):not(:nth-child(2)):not(:nth-child(5)) {
            display: none !important;
        }
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>
            <?php echo $type ?>
        </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="index.php?c=Docente&a=mostrarClases&type=<?php echo $type ?>">
                        <?php echo $type ?>
                    </a></li>
                <li class="breadcrumb-item"><a
                        href="index.php?c=Docente&a=MostrarTareasDatos&idAsignacion=<?php echo $idAsignacion ?>">Sección
                        Tareas</a></li>

            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <h5><b>Título de la Tarea:</b>
                            <?php echo $resultado['titulo_tarea'] ?>
                        </h5>
                        <h5><b>Descripción</b></h5>
                        <div>
                            <?php echo htmlspecialchars_decode($resultado['descripcion']) ?>
                        </div>
                        </h5>
                        <hr>
                        <ul>
                            <li>
                                <input type="text" id="rol" value="<?php echo $_SESSION['rol'] ?>" hidden>
                                <input type="text" id="TareaID" value="<?php echo $idTarea ?>" hidden>
                                <div id="datoForo"></div>


                            </li>

                            <div id="datoRespuestasTarea"></div>

                            <li>


                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL -->

        <div class="modal fade" id="verticalycentered" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="#" class="form" id="form" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title">Calificar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5><b>Descripcion</b></h5>
                            <div id="descripcionMostrar"></div>
                            <input type="text" name="idTarea" id="idTarea" hidden>

                            <input type="text" name="idEstudiante" id="idEstudiante" hidden>
                            <input type="text" name="idTareaCalificar" id="idTareaCalificar" hidden>
                            <input type="text" name="validadorC" id="validadorC" hidden>
                            <h5><b>Archivo</b></h5>
                           <p>Click <a href="#" target="_blank" id="archivo">Aqui</a></p>
                            <h5><b>Calificar</b></h5>
                            <input type="number" name="calificacionEstudiante" id="calificacionEstudiante" step="0.00"
                                min="1" max="10" required>
                        </div>
                        <div class="modal-footer"> <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal" id="cerrar">Cancelar</button> <button type="button"
                                class="btn btn-primary" id="guardarInsertar">Guardar</button></div>
                    </form>
                </div>
            </div>
        </div>




    </section>
</main>

<script src="assets/quill/quill.js"></script> <!-- 1.3.6-->
<script>
</script>


<script src="assets/js/Acciones/tarea/tareaAjax.js"></script>


<?php require_once 'views/partials/footer.php'; ?>