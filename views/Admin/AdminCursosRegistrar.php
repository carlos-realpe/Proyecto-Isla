<?php require_once 'views/partials/encabezado.php'; ?>
<style>

</style>

<script>
    if(variable==0){
    Swal.fire({ icon: "error", title: "Error", text: "Su cuenta hubo un error al registrar los datos del curso", });
}if (variable==1){
    Swal.fire({ icon: "success", title: "Exitó", text: "Se ha registrado con exito", }); 
}
    </script>


<main id="main" class="main">
    <div class="pagetitle">
        <h1>Registrar Curso</h1>
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

                        <form action="index.php?c=Admin&a=RegistrarCurso" class="form" id="form" method="post"
                            enctype="multipart/form-data" onsubmit="return ValidarRegistroCurso()">

                            <div class="col-md-12">
                                <h5 class="card-title">Datos del Curso</h5>
                                <label for="inputName5" class="form-label">Nombre del Curso</label>
                                <input type="text" class="form-control" name="nombreCurso" id="nombreCurso"
                                    required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-nombreCurso"> El nombre del curso debe contener máximo 30 caracteres</span>
                            </div>
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Grado</label>
                                <select id="inputState" class="form-select" name="grado" id="grado">
                                    <option value="1er Grado" selected>1er Grado</option>
                                    <option value="2do Grado">2do Grado</option>
                                    <option value="3ero Grado">3ero Grado</option>
                                    <option value="4to Grado">4to Grado</option>
                                    <option value="5to Grado">5to Grado</option>
                                    <option value="6to Grado">6to Grado</option>
                                    <option value="7mo Grado">7mo Grado</option>
                                    <option value="8vo Grado">8vo Grado</option>
                                    <option value="9no Grado">9no Grado</option>                                    <option value="10mo Grado">10mo Grado</option>
                                    <option value="1er Bachillerato">1er Bachillerato</option>
                                    <option value="2do Bachillerato">2do Bachillerato</option>
                                    <option value="3er Bachillerato">3er Bachillerato</option>
                                </select>
                            </div>



                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Paralelo</label>
                                <select id="inputState" class="form-select" name="paralelo" id="paralelo">
                                    <option value="A" selected>A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="F">F</option>
                                </select>
                            </div>








                    </div>
                </div>
            </div>
            <div class="text-center"> <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="index.php?c=Estudiante&a=VistaEstudiante" class="btn btn-secondary">Cancelar</a>
            </div>
            </form>
    </section>
</main>
<script src="assets/js/cursos/CursosValidacion.js"></script>
<?php require_once 'views/partials/footer.php'; ?>