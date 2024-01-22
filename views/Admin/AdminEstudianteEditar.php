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
        <h1>Editar Estudiante</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="index.php?c=Estudiante&a=VistaEstudiante">Estudiante</a></li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <form action="index.php?c=Estudiante&a=editarGuardarMostrarDatosEstudiante&idAdmin=<?php echo $resultados["id_usuario"] ?>" class="form" id="form" method="post"
                            enctype="multipart/form-data"  onsubmit="return ValidarRegistroEstudianteEdit()">
<!-- onsubmit="return ValidarRegistroEstudianteEdit()" -->
                            <div class="col-md-12">
                                <h5 class="card-title">Datos del Representante</h5>
                                <label for="inputName5" class="form-label">Primer Nombre</label>
                                <input type="text" class="form-control" name="primerNombreR" id="primerNombreR"
                                    value="<?php echo $resultados['primer_nombreR'] ?>" required>
                                    <input type="text" name="idRepresentante" id="idRepresentante" value="<?php echo $resultados['id_representante'] ?>" hidden>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-primerNombreR">Primer Nombre debe
                                    contener máximo 20 caracteres</span>
                            </div>

                            <div class="col-md-12"> <label for="inputName5" class="form-label">Segundo Nombre</label>
                                <input type="text" class="form-control" name="segundoNombreR" id="segundoNombreR"
                                    value="<?php echo $resultados['segundo_nombreR'] ?>" required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-segundoNombreR">Segundo Nombre deeb
                                    contener máximo 20 caracteres</span>


                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Primer Apellido</label>
                                <input type="text" class="form-control" name="primerApellidoR" id="primerApellidoR"
                                    value="<?php echo $resultados['primer_apellidoR'] ?>" required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-primerApellidoR">Primer Apellido
                                    debe
                                    contener máximo 20 caracteres</span>

                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Segundo Apellido</label>
                                <input type="text" class="form-control" name="segundoApellidoR" id="segundoApellidoR"
                                    value="<?php echo $resultados['segundo_apellidoR'] ?>" required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-segundoApellidoR">Segundo Apellido
                                    debe contener máximo 20 caracteres</span>
                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Número de
                                    Teléfono</label>
                                <input type="text" class="form-control" name="telefonoR" id="telefonoR"
                                    value="<?php echo $resultados['telefono'] ?>" required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-telefonoR">El teléfono
                                    debe disponer de 10 dígitos</span>
                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Email</label>
                                <input type="email" class="form-control" name="emailR" id="emailR"
                                    value="<?php echo $resultados['emailR'] ?>" required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-emailR">Este correo ya se encuentra
                                    registrado </span>
                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Número de Teléfono en
                                    caso de un inconveniente</label>
                                <input type="text" class="form-control" name="telefonoOtroR" id="telefonoOtroR"
                                    value="<?php echo $resultados['otro_tef_contacto'] ?>" required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-telefonoOtroR">El teléfono
                                    debe disponer de 10 dígitos</span>
                            </div>
                            <div class="col-12">
                                <h5 class="card-title">Datos del Estudiante</h5>
                                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                    <img src="<?php echo $resultados['foto'] ?>" id="imagenPerfil" width=100px;
                                        height=100px; alt="Profile" class="rounded-circle">
                                    <div class="col-md-12"> <label for="inputNumber" class="form-label">Subir
                                            Imagen</label>
                                        <div class="col-sm-10"><input class="form-control" type="file" name="imagenFile"
                                                id="imagenFile" accept="image/png, .jpeg, .jpg"
                                                onchange="mostrarVistaPrevia(this)"></div>
                                    </div>
                                </div>
                            </div>







                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">

                            <div class="col-md-12">
                                <h5 class="card-title">Datos del Estudiante</h5>
                                <label for="inputName5" class="form-label">Primer Nombre</label>
                                <input type="text" class="form-control" name="primerNombre" id="primerNombre"
                                    value="<?php echo $resultados['primer_nombre'] ?>" required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-primerNombre">Primer Nombre debe
                                    contener máximo 20 caracteres</span>
                            </div>

                            <div class="col-md-12"> <label for="inputName5" class="form-label">Segundo Nombre</label>
                                <input type="text" class="form-control" name="segundoNombre" id="segundoNombre"
                                    value="<?php echo $resultados['segundo_nombre'] ?>" required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-segundoNombre">Segundo Nombre deeb
                                    contener máximo 20 caracteres</span>


                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Primer Apellido</label>
                                <input type="text" class="form-control" name="primerApellido" id="primerApellido"
                                    value="<?php echo $resultados['primer_apellido'] ?>" required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-primerApellido">Primer Apellido
                                    debe
                                    contener máximo 20 caracteres</span>

                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Segundo Apellido</label>
                                <input type="text" class="form-control" name="segundoApellido" id="segundoApellido"
                                    value="<?php echo $resultados['segundo_apellido'] ?>" required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-segundoApellido">Segundo Apellido
                                    debe contener máximo 20 caracteres</span>
                            </div>

                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    value="<?php echo $resultados['email'] ?>" onkeyup="emailExiste();" required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-email">Este correo ya se encuentra
                                    registrado </span>
                            </div>
                            <div class="col-12"> <label for="inputNanme4" class="form-label">Contraseña</label> <input
                                    type="password" class="form-control" name="password" id="password"
                                    value="<?php echo $resultados['password'] ?>" required></div>
                            <span class="lbl-titulo-of errorFormulario" id="lbl-password">La contraseña debe tener más
                                de 6 caracteres</span>

                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Confirmar Contraseña</label> <input
                                    type="password" class="form-control" id="passwordConfirmar"
                                    value="<?php echo $resultados['password'] ?>" required>
                            </div>
                            <span class="lbl-titulo-of errorFormulario" id="lbl-passwordConfirmar">La contraseña no
                                coinccide</span>
                        </div>

                        <div class="col-12"> <label for="inputNanme4" class="form-label">Número de cedula</label>
                            <input type="text" class="form-control" name="cedula" id="cedula"
                                value="<?php echo $resultados['cedula'] ?>" required>
                            <span class="lbl-titulo-of errorFormulario" id="lbl-cedula">La cédula debe disponer de 10
                                dígitos</span>

                        </div>

                        <div class="col-md-12">
                            <label for="inputState" class="form-label">Grado</label>
                            <select id="inputState" class="form-select" name="grado" id="grado">
                                <option
                                    value="1er Grado" <?php if ($resultados['grado'] == '1er Grado')
                                        echo 'selected'; ?>
                                    selected>1er Grado</option>
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
                                    echo 'selected' ?>>3er Bachillerato</option>
                            </select>
                        </div>


                        <div class="col-md-12"> <label for="inputName5" class="form-label">Teléfono móvil</label>
                            <input type="text" class="form-control" name="telefono" id="telefono"
                                value="<?php echo $resultados['telefono'] ?>" required>
                            <span class="lbl-titulo-of errorFormulario" id="lbl-telefono">El telefono
                                debe disponer de 10 dígitos</span>

                        </div>





                    </div>
                </div>
            </div>
            <div class="text-center"> <button type="submit" id="editarG" class="btn btn-primary">Guardar</button>
             <a href="index.php?c=Estudiante&a=VistaEstudiante" class="btn btn-secondary">Cancelar</a>
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
<script src="assets/js/AdminEstudianteValidacion.js"></script>
<?php require_once 'views/partials/footer.php'; ?>