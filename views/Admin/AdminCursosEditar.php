<?php require_once 'views/partials/encabezado.php'; ?>


<script>
    if(variable==0){
    Swal.fire({ icon: "error", title: "Error", text: "Error al actualizar datos", });
}if (variable==1){
    Swal.fire({ icon: "success", title: "Exitó", text: "Se actualizó los datos con exitó", }); 
}
    </script>
    <?php
    session_start();
    
if (isset($_SESSION["validador"]) && $_SESSION["validador"] == true) {
    echo ('<script language="javascript">Swal.fire("Se actualizo con exitó los datos"); </script>');

}
if (isset($_SESSION["validador"]) && $_SESSION["validador"] == false) {
    echo ('<script language="javascript">Swal.fire("Error al al actualizar los datos del Usuario"); </script>');
}
    unset($_SESSION["validador"]);
    ?>


<main id="main" class="main">
    <div class="pagetitle">
        <h1>Editar Curso</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="index.php?c=Admin&a=MostrarCursos">Cursos</a></li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <form action="index.php?c=Admin&a=EditarCurso" class="form" id="form" method="post"
                            enctype="multipart/form-data" >

                            <div class="col-md-12">
                                <h5 class="card-title">Datos del Curso</h5>
                                <label for="inputName5" class="form-label">Nombre del Curso</label>
                                <input type="text" class="form-control" name="nombreCurso" id="nombreCurso"
                                  value="<?php echo $resultados['nombre_curso'] ?>"  required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-nombreCurso"> El nombre del curso debe contener máximo 30 caracteres</span>
                            </div>

                            <input type="text" name="idCurso" id="idCurso" value="<?php echo $resultados['id_curso'] ?>" hidden>
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Grado</label>
                                <select id="inputState" class="form-select" name="grado" id="grado">
                                   <option
                                    value="1er Grado" <?php if ($resultados['grado'] == '1er Grado')
                                    echo 'selected'; ?> selected>1er Grado</option>
                                <option value="2do Grado" <?php if ($resultados['grado'] == '2do Grado')
                                    echo 'selected' ?>>2do Grado</option>
                                    <option value="3ero Grado" <?php if ($resultados['grado'] == '3ero Grado')
                                    echo 'selected' ?>>3ero Grado</option>
                                    <option value="4to Grado" <?php if ($resultados['grado'] == '4to Grado')
                                    echo 'selected' ?>>4to Grado</option>
                                    <option value="5to Grado" <?php if ($resultados['grado'] == '5to Grado')
                                    echo 'selected' ?>>5to Grado</option>
                                    <option value="6to Grado" <?php if ($resultados['grado'] == '6to Grado')
                                    echo 'selected' ?>>6to Grado</option>
                                    <option value="7mo Grado" <?php if ($resultados['grado'] == '7mo Grado')
                                    echo 'selected' ?>>7mo Grado</option>
                                    <option value="8vo Grado" <?php if ($resultados['grado'] == '8vo Grado')
                                    echo 'selected' ?>>8vo Grado</option>
                                    <option value="9no Grado" <?php if ($resultados['grado'] == '9no Grado')
                                    echo 'selected' ?>>9no Grado</option>
                                    <option value="10mo Grado" <?php if ($resultados['grado'] == '10mo Grado')
                                    echo 'selected' ?>>10mo Grado</option>
                                    <option value="1er Bachillerato" <?php if ($resultados['grado'] == '1er Bachillerato')
                                    echo 'selected' ?>>1er Bachillerato</option>
                                    <option value="2do Bachillerato" <?php if ($resultados['grado'] == '2do Bachillerato')
                                    echo 'selected' ?>>2do Bachillerato</option>
                                    <option value="3er Bachillerato" <?php if ($resultados['grado'] == '3er Bachillerato')
                                    echo 'selected' ?>>3er Bachillerato
                                    </option>
                                    </select></select>
                                </div>



                                <div class="col-md-12">
                                    <label for="inputState" class="form-label">Paralelo</label>
                                    <select id="inputState" class="form-select" name="paralelo" id="paralelo">
                                        <option value="A" <?php if($resultados['paralelo']=='A') echo 'selected' ?>>A</option>
                                        <option value="B" <?php if ($resultados['paralelo'] == 'B')
                                    echo 'selected' ?>>B</option>
                                        <option value="C" <?php if ($resultados['paralelo'] == 'C')
                                    echo 'selected' ?>>C</option>
                                        <option value="D" <?php if ($resultados['paralelo'] == 'D')
                                    echo 'selected' ?>>D</option>
                                        <option value="F" <?php if ($resultados['paralelo'] == 'F')
                                    echo 'selected' ?>>F</option>
                                    </select>
                                </div>








                        </div>
                    </div>
                </div>
                <div class="text-center"> <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="index.php?c=Admin&a=MostrarCursos" class="btn btn-secondary">Cancelar</a>
                </div>
                </form>
        </section>
    </main>
    <script src="assets/js/cursos/CursosValidacion.js"></script>
<?php require_once 'views/partials/footer.php'; ?>