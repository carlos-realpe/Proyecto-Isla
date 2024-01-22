<?php require_once 'views/partials/encabezado.php'; ?>
<?php


if (isset($_SESSION["validador"]) && $_SESSION["validador"] == true) {
    echo ('<script language="javascript">Swal.fire("Se actualizo con éxito los datos"); </script>');

}
if (isset($_SESSION["validador"]) && $_SESSION["validador"] == false) {
    echo ('<script language="javascript">Swal.fire("Error al al actualizar los datos"); </script>');
}
unset($_SESSION["validador"]);
?>
<style>
    ul {
        list-style: none;
    }

    a {
        text-decoration: none;
    }

    textarea {
        overflow: auto;
        resize: vertical;
    }

    #pregunta,
    #preguntaModal,#respuestaModal {
        width: 100%;
        /* Ancho del 100% de la pantalla */
        height: 5vw;
        /* Altura del 20% del ancho de la vista */
        resize: none;
        /* Evita que el usuario pueda redimensionar el textarea */
    }

    @media (max-width: 996px) {

        #pregunta,
        #preguntaModal,#respuestaModal {
            width: 100%;
            /* Ancho del 100% de la pantalla */
            height: 20vw;
            /* Altura del 20% del ancho de la vista */
            resize: none;
            /* Evita que el usuario pueda redimensionar el textarea */
        }

        .respuestaText {
            width: 100%;
            /* Ancho del 100% de la pantalla */
            height: 20vw;
            /* Altura del 20% del ancho de la vista */
            resize: none;
            /* Evita que el usuario pueda redimensionar el textarea */
        }

    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Evaluaciones</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a
                        href="index.php?c=Docente&a=mostrarClases&type=Evaluaciones">Evaluaciones</a></li>
                <li class="breadcrumb-item"><a
                        href="index.php?c=Docente&a=MostrarEvaluacionesDatos&idAsignacion=<?php echo $idAsignacion; ?>">Sección
                        Evaluación</a>
            </ol>
        </nav>
    </div>
    <!--------------MODAL -------------->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a href="#" class="btn btn-dark" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">Añadir Pregunta </a>
                        <hr>
                        <h3><b>Sección de Evaluaciones</b></h3>
                        <h5 style="color:green">No se olvide de marcar la respuesta correcta</h5>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <form action="index.php?c=Docente&a=RegistrarPregunta" class="form" id="form"
                                    method="post" enctype="multipart/form-data">
                                    <div>
                                        <label for="pregunta"><b>Pregunta:</b></label>
                                        <textarea name="pregunta" id="pregunta" cols="100" rows="5"></textarea>
                                        <label for="puntaje"><b>Puntaje de la Pregunta:</b></label>
                                        <input type="puntaje" id="puntaje" name="puntaje" min="0" required>

                                        <input type="text" name="idEvaluacion" value="<?php echo $idEvaluacion ?>"
                                            hidden>
                                        <input type="text" name="idAsignacion" value="<?php echo $idAsignacion ?>"
                                            hidden>
                                    </div>
                                    <div><button type="submit" class="btn btn-primary">Guardar</button></div>
                                    <hr>
                                </form>
                            </div>


                        </div>
                    </div>

                    <div class="container mt-4">
                        <div id="datosPreguntas"></div>
                    </div>

                </div>
            </div>

            <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Datos</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" id="cerrar"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="form" id="form" method="post" enctype="multipart/form-data">
                                <div>
                                    <label for="pregunta"><b>Pregunta:</b></label>
                                    <textarea name="preguntaModal" id="preguntaModal" cols="100" rows="5"></textarea>
                                    <label for="puntajeModal"><b>Puntaje de la Pregunta:</b></label>
                                    <input type="puntajeModal" id="puntajeModal" name="puntajeModal" min="0" required>

                                    <input type="text" name="idPregunta" id="idPregunta" value="" hidden>
                                </div>
                                <div><button type="button" id="guardarBtn" class="btn btn-primary">Guardar</button>
                                </div>
                                <hr>
                            </form>
                        </div>


                    </div>
                </div>
            </div>


            <div class="modal fade" id="respuestaModalBasic" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Datos</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" id="cerrarRespuesta"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="form" id="form" method="post" enctype="multipart/form-data">
                                
                            <div>
                                    <label for="pregunta"><b>Editar Respuesta:</b></label>
                                    <textarea name="respuestaModal" id="respuestaModal" cols="100" rows="5"></textarea>
                                    <input type="text" name="idRespuesta" id="idRespuesta" value="" hidden>
                                </div>

                                <div><button type="button" id="guardarRespuestaBtn" class="btn btn-primary">Guardar</button>
                                </div>
                                <hr>
                            </form>
                        </div>


                    </div>
                </div>
            </div>








    </section>


</main>
<script src="assets/js/preguntas/PreguntasAjax.js"></script>


<?php require_once 'views/partials/footer.php'; ?>