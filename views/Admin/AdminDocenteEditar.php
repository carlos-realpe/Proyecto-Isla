<?php require_once 'views/partials/encabezado.php'; ?>
<style>

</style>

<?php if (isset($email)) {
    echo ('<script language="javascript">Swal.fire("correo ya registrado"); </script>');

}

if (isset($_GET["mensaje"]) && $_GET["mensaje"] == true) {
    echo ('<script language="javascript">Swal.fire("Se actualizo con exitó los datos"); </script>');

}
if (isset($_GET["mensaje"]) && $_GET["mensaje"] == false) {
    echo ('<script language="javascript">Swal.fire("Error al al actualizar los datos del Usuario"); </script>');

}
$_SESSION["correoTemp"] = $resultados["email"];

?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Editar Docente</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="index.php?c=Docente&a=VistaDocente">Docente</a></li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datos</h5>
                        <form action="index.php?c=Docente&a=editarGuardarMostrarDatosDocente&idAdmin=<?php echo $resultados["id_usuario"] ?>" class="form" id="form" method="post"
                            enctype="multipart/form-data" onsubmit="return ValidarEditarDocente()">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <img src="<?php echo $resultados["foto"] ?>" id="imagenPerfil" width=100px;
                                    height=100px; alt="Profile" class="rounded-circle">
                                <div class="col-md-12"> <label for="inputNumber" class="form-label">Subir Imagen</label>
                                    <div class="col-sm-10"><input class="form-control" type="file" name="imagenFile"
                                            id="imagenFile" accept="image/png, .jpeg, .jpg"
                                            onchange="mostrarVistaPrevia(this)"></div>
                                </div>
                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Primer Nombre</label>
                                <input type="text" class="form-control" name="primerNombre" id="primerNombre" value="<?php echo $resultados["primer_nombre"] ?>" required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-primerNombre">Primer Nombre debe
                                    contener máximo 20 caracteres</span>
                            </div>

                            <div class="col-md-12"> <label for="inputName5" class="form-label">Segundo Nombre</label>
                                <input type="text" class="form-control" name="segundoNombre" id="segundoNombre" value="<?php echo $resultados["segundo_nombre"] ?>"
                                    required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-segundoNombre">Segundo Nombre debe
                                    contener máximo 20 caracteres</span>


                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Primer Apellido</label>
                                <input type="text" class="form-control" name="primerApellido" id="primerApellido" value="<?php echo $resultados["primer_apellido"] ?>"
                                    required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-primerApellido">Primer Apellido debe
                                    contener máximo 20 caracteres</span>

                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Segundo Apellido</label>
                                <input type="text" class="form-control" name="segundoApellido" id="segundoApellido" value="<?php echo $resultados["segundo_apellido"] ?>"
                                    required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-segundoApellido">Segundo Apellido
                                    debe contener máximo 20 caracteres</span>


                            </div>







                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <div class="row g-3">
                            <div class="col-12"> <label for="inputNanme4" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo $resultados["email"] ?>"
                                     required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-email">Este correo ya se encuentra
                                    registrado </span>
                            </div>
                            <div class="col-12"> <label for="inputNanme4" class="form-label">Contraseña</label> <input
                                    type="password" class="form-control" name="password" id="password" value="<?php echo $resultados["password"] ?>" required></div>
                            <span class="lbl-titulo-of errorFormulario" id="lbl-password">La contraseña debe tener más
                                de 6 caracteres</span>

                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Confirmar Contraseña</label> <input
                                    type="password" class="form-control" id="passwordConfirmar" value="<?php echo $resultados["password"] ?>" required>
                            </div>
                            <span class="lbl-titulo-of errorFormulario" id="lbl-passwordConfirmar">La contraseña no
                                coinccide</span>
                        </div>

                        <div class="col-12"> <label for="inputNanme4" class="form-label">Número de cedula</label>
                            <input type="text" class="form-control" name="cedula" id="cedula" value="<?php echo $resultados["cedula"] ?>" required>
                            <span class="lbl-titulo-of errorFormulario" id="lbl-cedula">La cédula debe disponer de 10
                                dígitos</span>

                        </div>
                        <div class="col-md-12"> <label for="inputName5" class="form-label">Título</label>
                            <input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo $resultados["titulo"] ?>" required>
                            <span class="lbl-titulo-of errorFormulario" id="lbl-titulo">El título
                                    debe contener máximo 30 caracteres</span>

                        </div>
                          <div class="col-md-12"> <label for="inputName5" class="form-label">Materia</label>
                            <input type="text" class="form-control" name="materia" id="materia" value="<?php echo $resultados["materia"] ?>"
                                required>
                            <span class="lbl-titulo-of errorFormulario" id="lbl-materia">La materia
                                    debe contener máximo 30 caracteres</span>

                       </div>
                      
                        <div class="col-md-12"> <label for="inputName5" class="form-label">Teléfono móvil</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $resultados["telefono"] ?>" required>
                            <span class="lbl-titulo-of errorFormulario" id="lbl-telefono">El telefono
                                    debe disponer de 10 dígitos</span>

                        </div>





                    </div>
                </div>
            </div>
            <div class="text-center"> <button type="submit" id="editarG" class="btn btn-primary">Guardar</button>
                <a href="index.php?c=Docente&a=VistaDocente" class="btn btn-secondary">Cancelar</a>
            </div>
            </form>
    </section>
</main>
<script>
    function mostrarVistaPrevia(input) {
        var vistaPrevia = document.getElementById('imagenPerfil');

        // Verificar si se seleccionó un archivo
        if (input.files && input.files[0]) {
            var lector = new FileReader();

            lector.onload = function (e) {
                vistaPrevia.src = e.target.result; // Mostrar la vista previa de la imagen
            };

            lector.readAsDataURL(input.files[0]); // Convertir la imagen a base64
        } else {
            vistaPrevia.src = ""; // Limpiar la vista previa si no se selecciona ningún archivo
        }
    }
</script>
<script src="assets/js/AdminValidacion.js"></script>
<?php require_once 'views/partials/footer.php'; ?>