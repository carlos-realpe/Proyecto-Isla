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
                        href="index.php?c=Docente&a=MostrarForosDatos&idAsignacion=<?php echo $idAsignacion ?>">Sección
                        Foros</a></li>

            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <hr>
                        <ul>
                            <li>
                                <input type="text" id="rol" value="<?php echo $_SESSION['rol'] ?>" hidden>
                                <div id="datoForo"></div>


                            </li>


                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div>
                                        <div class="col-md-12">Responder: <div id="editor" oninput="QuillEditor()">

                                            </div>
                                        </div>
                                        <input type="text" name="editorQuill" id="editorQuill" hidden>

                                        <input type="text" name="idForo" id="idForo" value="<?php echo $idForo ?>"
                                            hidden>
                                        <input type="text" name="idAsignacion" id="idAsignacion"
                                            value="<?php echo $idAsignacion ?>" hidden>
                                    </div>
                                    <div><button type="button" id="guardarRespuesta"
                                            class="btn btn-primary">Guardar</button></div>


                                </div>
                            </div>

                            <div id="datoRespuestasForo"></div>

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
                            <input type="text" name="foroEstudiantever" id="foroEstudiantever" hidden>
                            
                            <input type="text" name="idEstudiante" id="idEstudiante" hidden>
                            <input type="text" name="idForoCalificar" id="idForoCalificar" hidden>
                            <input type="text" id="validadorC" hidden>
                            
                            <h5><b>Calificar</b></h5>
                            <input type="number" name="calificacionEstudiante" id="calificacionEstudiante" step="0.00" min="1" max="10" required>
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
    var quill = new Quill('#editor', {
        theme: 'snow'
    });
    function QuillEditor() {
        var contenidoHTML = quill.root.innerHTML;
        document.getElementById('editorQuill').value = contenidoHTML;
    }



</script>


<script src="assets/js/Acciones/foro/foroAjax.js"></script>


<?php require_once 'views/partials/footer.php'; ?>