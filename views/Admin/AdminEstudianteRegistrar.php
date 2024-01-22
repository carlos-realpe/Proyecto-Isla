<?php require_once 'views/partials/encabezado.php'; ?>
<style>

</style>

<?php if (isset($email)) {
    echo ('<script language="javascript">Swal.fire("correo ya registrado"); </script>');

}
if (isset($exito) && $exito == true) {
    echo ('<script language="javascript">Swal.fire("Exitó al Registrar Usuario"); </script>');

}
if (isset($exito) && $exito == false) {
    echo ('<script language="javascript">Swal.fire("Error al Registrar Usuario"); </script>');

}


?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Registrar Estudiante</h1>
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

                        <form action="index.php?c=Estudiante&a=RegistrarEstudiante" class="form" id="form" method="post"
                            enctype="multipart/form-data" onsubmit="return ValidarRegistroEstudiante()">

                            <div class="col-md-12">
                                <h5 class="card-title">Datos del Representante</h5>
                                <label for="inputName5" class="form-label">Primer Nombre</label>
                                <input type="text" class="form-control" name="primerNombreR" id="primerNombreR"
                                    required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-primerNombreR">Primer Nombre debe
                                    contener máximo 20 caracteres</span>
                            </div>

                            <div class="col-md-12"> <label for="inputName5" class="form-label">Segundo Nombre</label>
                                <input type="text" class="form-control" name="segundoNombreR" id="segundoNombreR"
                                    required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-segundoNombreR">Segundo Nombre deeb
                                    contener máximo 20 caracteres</span>


                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Primer Apellido</label>
                                <input type="text" class="form-control" name="primerApellidoR" id="primerApellidoR"
                                    required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-primerApellidoR">Primer Apellido
                                    debe
                                    contener máximo 20 caracteres</span>

                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Segundo Apellido</label>
                                <input type="text" class="form-control" name="segundoApellidoR" id="segundoApellidoR"
                                    required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-segundoApellidoR">Segundo Apellido
                                    debe contener máximo 20 caracteres</span>
                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Número de
                                    Teléfono</label>
                                <input type="text" class="form-control" name="telefonoR" id="telefonoR" required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-telefonoR">El teléfono
                                    debe disponer de 10 dígitos</span>
                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Email</label>
                                <input type="email" class="form-control" name="emailR" id="emailR" required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-emailR">Este correo ya se encuentra
                                    registrado </span>
                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Número de Teléfono en
                                    caso de un inconveniente</label>
                                <input type="text" class="form-control" name="telefonoOtroR" id="telefonoOtroR"
                                    required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-telefonoOtroR">El teléfono
                                    debe disponer de 10 dígitos</span>
                            </div>
                            <div class="col-12">
                                <h5 class="card-title">Datos del Estudiante</h5>
                                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                    <img src="assets/institucion/perfil/perfil.jpg" id="imagenPerfil" width=100px;
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
                                <input type="text" class="form-control" name="primerNombre" id="primerNombre" required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-primerNombre">Primer Nombre debe
                                    contener máximo 20 caracteres</span>
                            </div>

                            <div class="col-md-12"> <label for="inputName5" class="form-label">Segundo Nombre</label>
                                <input type="text" class="form-control" name="segundoNombre" id="segundoNombre"
                                    required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-segundoNombre">Segundo Nombre deeb
                                    contener máximo 20 caracteres</span>


                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Primer Apellido</label>
                                <input type="text" class="form-control" name="primerApellido" id="primerApellido"
                                    required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-primerApellido">Primer Apellido
                                    debe
                                    contener máximo 20 caracteres</span>

                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Segundo Apellido</label>
                                <input type="text" class="form-control" name="segundoApellido" id="segundoApellido"
                                    required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-segundoApellido">Segundo Apellido
                                    debe contener máximo 20 caracteres</span>
                            </div>

                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    onkeyup="emailExiste();" required>
                                <span class="lbl-titulo-of errorFormulario" id="lbl-email">Este correo ya se encuentra
                                    registrado </span>
                            </div>
                            <div class="col-12"> <label for="inputNanme4" class="form-label">Contraseña</label> <input
                                    type="password" class="form-control" name="password" id="password" required></div>
                            <span class="lbl-titulo-of errorFormulario" id="lbl-password">La contraseña debe tener más
                                de 6 caracteres</span>

                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Confirmar Contraseña</label> <input
                                    type="password" class="form-control" id="passwordConfirmar" required>
                            </div>
                            <span class="lbl-titulo-of errorFormulario" id="lbl-passwordConfirmar">La contraseña no
                                coinccide</span>
                        </div>

                        <div class="col-12"> <label for="inputNanme4" class="form-label">Número de cedula</label>
                            <input type="text" class="form-control" name="cedula" id="cedula" required>
                            <span class="lbl-titulo-of errorFormulario" id="lbl-cedula">La cédula debe disponer de 10
                                dígitos</span>

                        </div>

                        <div class="col-md-12">
                            <label for="inputState" class="form-label" >Grado</label>
                            <select id="inputState" class="form-select" name="grado" id="grado">
                                <option value="1er Grado" selected>1er Grado</option>
                                <option value="2do Grado">2do Grado</option>
                                <option value="3ero Grado">3ero Grado</option>
                                <option value="4to Grado">4to Grado</option>
                                <option value="5to Grado">5to Grado</option>
                                <option value="6to Grado">6to Grado</option>
                                <option value="7mo Grado">7mo Grado</option>
                                <option value="8vo Grado">8vo Grado</option>
                                <option value="9no Grado">9no Grado</option>
                                <option value="10mo Grado">10mo Grado</option>
                                <option value="1er Bachillerato">1er Bachillerato</option>
                                <option value="2do Bachillerato">2do Bachillerato</option>
                                <option value="3er Bachillerato">3er Bachillerato</option>
                            </select>
                        </div>


                        <div class="col-md-12"> <label for="inputName5" class="form-label">Teléfono móvil</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" required>
                            <span class="lbl-titulo-of errorFormulario" id="lbl-telefono">El telefono
                                debe disponer de 10 dígitos</span>

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