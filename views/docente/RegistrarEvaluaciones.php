<?php require_once 'views/partials/encabezado.php'; ?>


<?php
if (isset($_SESSION["validador"]) && $_SESSION["validador"] == true) {
    echo ('<script language="javascript">Swal.fire("Se registro con éxito la reunión"); </script>');

}
if (isset($_SESSION["validador"]) && $_SESSION["validador"] == false) {
    echo ('<script language="javascript">Swal.fire("Error al registrar la reunión"); </script>');
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
                <li class="breadcrumb-item"><a
                        href="index.php?c=Docente&a=MostrarEvaluacionesDatos&idAsignacion=<?php echo $idAsignacion; ?>">Sección
                        Evaluación</a>
                </li>

            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datos</h5>
                        <form action="index.php?c=Docente&a=RegistrarEvaluaciones" class="form" id="form" method="post"
                            enctype="multipart/form-data">
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Nombre de la Evaluación
                                </label>
                                <input type="text" class="form-control" name="nombreTitulo" id="nombreTitulo" required>
                            </div>



                            <div class="col-md-12"> <label for="inputName5" class="form-label">Fecha Inicio</label>
                                <input type="date" class="form-control" name="fechaLimite" id="fechaLimite" required>
                            </div>
                             <div class="col-md-12"> <label for="inputName5" class="form-label">Fecha Fin</label>
                                <input type="date" class="form-control" name="fechaFin" id="fechaFin" required>
                            </div>

                            <div class="col-md-12"> <label for="inputName5" class="form-label">Hora de Inicio</label>
                                <input type="time" class="form-control" name="horaInicio" id="horaInicio" required>
                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Hora de Expiración</label>
                                <input type="time" class="form-control" name="horaLimite" id="horaLimite" required>
                            </div>

                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Seleccionar Parcial</label>
                                <select id="inputState" class="form-select" name="parcial" id="parcial">
                                    <option value="1er Parcial">1er Parcial</option>
                                    <option value="2do Parcial">2do Parcial</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Seleccionar el tipo de Evaluación</label>
                                <select id="inputState" class="form-select" name="tipo" id="tipo">
                                    <option value="Examen">Examen</option>
                                    <option value="Leccion">Lección</option>
                                </select>
                            </div>
                    </div>
                    <input type="text" id="idAsignar" name="idAsignar" value="<?php echo $idAsignacion; ?>" hidden>
                </div>
            </div>
        </div>
        <div class="text-center"> <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php?c=Docente&a=mostrarClases&type=Evaluaciones" class="btn btn-secondary">Cancelar</a>
        </div>
        </form>
    </section>
</main>
<?php require_once 'views/partials/footer.php'; ?>