<?php require_once 'views/partials/encabezado.php'; ?>
<style>

</style>

<script>
  /*  if (variable == 0) {
        Swal.fire({ icon: "error", title: "Error", text: "Hubo un error al registrar los datos del curso", });
    } if (variable == 1) {
        Swal.fire({ icon: "success", title: "Exitó", text: "Se ha registrado con éxito", });
    }*/
</script>
<?php
session_start();

if (isset($_SESSION["validador"]) && $_SESSION["validador"] == true) {
    echo ('<script language="javascript">Swal.fire("Se Registro la Asignacion con éxito"); </script>');

}
if (isset($_SESSION["validador"]) && $_SESSION["validador"] == false) {
    echo ('<script language="javascript">Swal.fire("Error al Registrar los Datos de la Asignacion"); </script>');
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

                        <form action="index.php?c=Admin&a=RegistrarAsignacion" class="form" id="form" method="post"
                            enctype="multipart/form-data">

                       <div class="col-md-12">
                                <label for="inputState" class="form-label">Seleccionar Materia</label>
                                <select id="inputState" class="form-select" name="materia" id="materia">
                                    <?php
                                    foreach ($materia as $valores):
                                        echo '<option value="' . $valores["id_materia"] . '">' . $valores["nombre_materia"] . '</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>      
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Seleccionar Docente</label>
                                <select id="inputState" class="form-select" name="docente" id="docente">
                                    <?php
                                    foreach ($docente as $valores):
                                        echo '<option value="' . $valores["id_usuario"] . '">' . $valores["nombre_completo"] . '</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Seleccionar Estudiante</label>
                                <select id="inputState" class="form-select" name="estudiante" id="estudiante">
                            <?php
                            foreach ($estudiante as $valores):
                                echo '<option value="' . $valores["id_usuario"] . '">' . $valores["nombre_completo"] ." (". $valores["grado"].")".'</option>';
                            endforeach;
                            ?> 
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Seleccionar Curso</label>
                                <select id="inputState" class="form-select" name="curso" id="curso">
                            <?php
                                    foreach ($curso as $valores):
                                        echo '<option value="' . $valores["id_curso"] . '">' . $valores["nombre_curso"] . " (" . $valores["grado"] . ")(" .$valores["paralelo"] .')</option>';
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