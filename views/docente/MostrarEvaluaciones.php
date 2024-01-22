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
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Evaluaciones</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a
                        href="index.php?c=Docente&a=mostrarClases&type=Evaluaciones">Evaluaciones</a></li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php if ($_SESSION['rol'] == "docente") { ?>
                            <a href="index.php?c=Docente&a=MostrarRegistroEvaluaciones&idAsignacion=<?php echo $idAsignacion; ?>"
                                class="btn btn-dark">Registra una Evaluación</a>
                        <?php } ?>
                        <input type="text" id="rol" value="<?php echo $_SESSION['rol'] ?>" hidden>
                        <hr>

                        <ul>
                            <h3><b>Sección de Evaluaciones</b></h3>
                            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation"> <button class="nav-link active" id="home-tab"
                                        data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab"
                                        aria-controls="home" aria-selected="true">1er
                                        Parcial</button></li>
                                <li class="nav-item" role="presentation"> <button class="nav-link" id="profile-tab"
                                        data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab"
                                        aria-controls="profile" aria-selected="false">2do
                                        Parcial</button></li>
                            </ul>
                            <div class="tab-content pt-2" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div id="dato1erParcial"></div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div id="dato2doParcial"></div>
                                </div>
                              
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!--------------MODAL -------------->
        <div class="modal fade" id="basicModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Datos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="index.php?c=Docente&a=EditarEvaluacion" class="form" id="form" method="post"
                            enctype="multipart/form-data">
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Nombre de la Evaluación
                                </label>
                                <input type="text" class="form-control" name="tituloModal" id="tituloModal" required>
                            </div>



                            <div class="col-md-12"> <label for="inputName5" class="form-label">Fecha Inicio</label>
                                <input type="date" class="form-control" name="fechaLimiteModal" id="fechaLimiteModal"
                                    required>

                            </div>

                            
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Fecha Fin</label>
                                <input type="date" class="form-control" name="fechaFinModal" id="fechaFinModal"
                                    required>

                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Hora Inicio</label>
                                <input type="time" class="form-control" name="horaInicioModal" id="horaInicioModal"
                                    required>
                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Hora Limite</label>
                                <input type="time" class="form-control" name="horaLimiteModal" id="horaLimiteModal"
                                    required>
                            </div>

                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Seleccionar Parcial</label>
                                <select class="form-select" name="parcialModal" id="parcialModal">
                                    <option value="1er Parcial">1er Parcial</option>
                                    <option value="2do Parcial">2do Parcial</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Seleccionar el tipo de evaluación</label>
                                <select class="form-select" name="tipoModal" id="tipoModal">
                                    <option value="Examen">Examen</option>
                                    <option value="Leccion">Lección</option>
                                </select>
                            </div>
                            <input type="text" id="idEvaluacion" name="idEvaluacion" value="" hidden>
                            <input type="text" id="idAsignar" name="idAsignar" value="<?php echo $idAsignacion; ?>"
                                hidden>

                    </div>
                    <div class="text-center" style="margin:10px"> <button type="submit"
                            class="btn btn-primary">Guardar</button>
                        <a href="#" data-bs-dismiss="modal" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>

        </form>
        </div>
        </div>
        </div>
        </div>




    </section>

    <script src="assets/js/Evaluacion/EvaluacionesAjax.js"></script>
</main>


<?php require_once 'views/partials/footer.php'; ?>