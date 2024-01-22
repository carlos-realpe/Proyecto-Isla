<?php require_once 'views/partials/encabezado.php'; ?>
<style>
</style>
<?php
session_start();

if (isset($_SESSION["validador"]) && $_SESSION["validador"] == true) {
    echo ('<script language="javascript">Swal.fire("Se actualizo con éxito los datos"); </script>');

}
if (isset($_SESSION["validador"]) && $_SESSION["validador"] == false) {
    echo ('<script language="javascript">Swal.fire("Error al al actualizar los datos de la Asignacion"); </script>');
}
unset($_SESSION["validador"]);
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Asignar Curso</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="index.php?c=Admin&a=AsignarCursos">Asignar Curso</a></li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <form action="index.php?c=Admin&a=EditarAsignacion" class="form" id="form" method="post"
                            enctype="multipart/form-data">
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Seleccionar Materia</label>
                                <input type="text" value="<?php echo $resultado['id_asignar']; ?>" name="idcurso" id="idcurso" hidden>
                                <select id="inputState" class="form-select" name="materia" id="materia">
                                    <?php
                                    foreach ($materia as $valores):
                                        $checked = "";
                                        if ($valores["id_materia"] == $resultado['id_fk_materia']) {
                                            $checked = "selected";
                                        }
                                        echo '<option value="' . $valores["id_materia"] . '"' . $checked . '>' . $valores["nombre_materia"] . '</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Seleccionar Docente</label>
                                <select id="inputState" class="form-select" name="docente" id="docente">
                                    <?php
                                    foreach ($docente as $valores):
                                        $checked="";
                                        if ($valores["id_usuario"] == $resultado['id_fk_docente']){
                                            $checked = "selected";
                                        }
                                        echo '<option value="'.$valores["id_usuario"] . '" '.$checked.'>' . $valores["nombre_completo"] . '</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Seleccionar Estudiante</label>
                                <select id="inputState" class="form-select" name="estudiante" id="estudiante">
                                    <?php
                                    foreach ($estudiante as $valores):
                                        $checked = "";
                                        if ($valores["id_usuario"] == $resultado['id_fk_estudiante']) {
                                            $checked = "selected";
                                        }
                                        echo '<option value="' . $valores["id_usuario"] . '"' . $checked . '>' . $valores["nombre_completo"] . " (" . $valores["grado"] . ")" . '</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Seleccionar Curso</label>
                                <select id="inputState" class="form-select" name="curso" id="curso">
                                    <?php
                                    foreach ($curso as $valores):
                                        $checked = "";
                                        if ($valores["id_curso"] == $resultado['id_fk_curso']) {
                                            $checked = "selected";
                                        }
                                        echo '<option value="' . $valores["id_curso"] . '"' . $checked . '>' . $valores["nombre_curso"] . " (" . $valores["grado"] . ")(" . $valores["paralelo"] . ')</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>

                    </div>
                </div>
            </div>
            <div class="text-center"> <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="index.php?c=Admin&a=AsignarCursos" class="btn btn-secondary">Cancelar</a>
            </div>
            </form>
    </section>
</main>
<script src="assets/js/cursos/CursosValidacion.js"></script>
<?php require_once 'views/partials/footer.php'; ?>