<?php require_once 'views/partials/encabezado.php'; ?>
<?php
if (isset($_GET["mensaje"]) && $_GET["mensaje"] == true) {
    echo ('<script language="javascript">Swal.fire("Se actualizo con exitó los datos"); </script>');

}
if (isset($_GET["mensaje"]) && $_GET["mensaje"] == false) {
    echo ('<script language="javascript">Swal.fire("Error al al actualizar los datos del Usuario"); </script>');

}
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Perfil</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?c=Inicio&a=mostrarInicio">Inicio</a></li>
                <li class="breadcrumb-item active">Perfil</li>
            </ol>
        </nav>
    </div>
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img src="<?php echo $resultados['foto'] ?>" width=100px; height=100px; alt="Profile"
                            class="rounded-circle">
                        <b>
                            <?php echo $nombre . " " . $apellido; ?>
                        </b>
                        <h3>
                            <?php echo $_SESSION['rol'] ?>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item"> <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Perfil</button></li>
                            <li class="nav-item"> <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-edit">Editar Perfil</button></li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <h5 class="card-title" style="color:var(--color-negro-sid)">Perfil Detalles</h5>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nombre</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo $nombre ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Apellido</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo $apellido ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo $resultados['email'] ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Cedula</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo $resultados['cedula'] ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php if ($_SESSION['rol'] == "estudiante") { ?>
                                        <div class="col-lg-3 col-md-4 label">Grado</div>
                                        <div class="col-lg-9 col-md-8">
                                            <?php echo $resultados['grado'] ?>
                                        </div>
                                    <?php }
                                    if ($_SESSION['rol'] == "docente") { ?>
                                        <div class="col-lg-3 col-md-4 label">Titulo</div>
                                        <div class="col-lg-9 col-md-8">
                                            <?php echo $resultados['titulo'] ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="row">
                                    <?php if ($_SESSION['rol'] == "estudiante") { ?>
                                        <div class="col-lg-3 col-md-4 label">Teléfono</div>
                                        <div class="col-lg-9 col-md-8">
                                            <?php echo $resultados['telefono_estudiante'] ?>
                                        </div>
                                    <?php }
                                    if ($_SESSION['rol'] == "docente") { ?>
                                        <div class="col-lg-3 col-md-4 label">Teléfono</div>
                                        <div class="col-lg-9 col-md-8">
                                            <?php echo $resultados['telefono'] ?>
                                        </div>
                                    <?php } ?>

                                </div>

                            </div>
                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                <form
                                    action="index.php?c=Perfil&a=EditarGuargarPerfil&idUser=<?php echo $resultados["id_usuario"] ?>"
                                    class="form" id="form" method="post" enctype="multipart/form-data"
                                    onsubmit="return ValidarUsuarioEdit()">
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Imagen de
                                            Perfil</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img id="imagenPerfil" src="<?php echo $resultados['foto'] ?>" width=100px;
                                                height="90px" alt="Profile">
                                            <div class="col-md-8 col-lg-9"><label for="inputNumber"
                                                    class="form-label">Subir Imagen</label>
                                                <div class="col-sm-10"><input class="form-control" type="file"
                                                        name="imagenFile" id="imagenFile"
                                                        accept="image/png, .jpeg, .jpg"
                                                        onchange="mostrarVistaPrevia(this)"></div>
                                            </div>
                                        </div>
                                        <div class="row mb-3" style="margin-top:10px;">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Primer
                                                Nombre</label>
                                            <div class="col-md-8 col-lg-9"> <input name="primerNombre" type="text"
                                                    class="form-control" id="primerNombre"
                                                    value="<?php echo $resultados['primer_nombre'] ?>"> <span
                                                    class="lbl-titulo-of errorFormulario" id="lbl-primerNombre">Primer
                                                    Nombre debe
                                                    contener máximo 20 caracteres</span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Segundo
                                                Nombre</label>
                                            <div class="col-md-8 col-lg-9"> <input name="segundoNombre" type="text"
                                                    class="form-control" id="segundoNombre"
                                                    value="<?php echo $resultados['segundo_nombre'] ?>">
                                                <span class="lbl-titulo-of errorFormulario"
                                                    id="lbl-segundoNombre">Segundo Nombre deeb
                                                    contener máximo 20 caracteres</span>

                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Primer
                                                Apellido</label>
                                            <div class="col-md-8 col-lg-9"> <input name="primerApellido" type="text"
                                                    class="form-control" id="primerApellido"
                                                    value="<?php echo $resultados['primer_apellido'] ?>"><span
                                                    class="lbl-titulo-of errorFormulario" id="lbl-primerApellido">Primer
                                                    Apellido
                                                    debe
                                                    contener máximo 20 caracteres</span>

                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Segundo
                                                Apellido</label>
                                            <div class="col-md-8 col-lg-9"> <input name="segundoApellido" type="text"
                                                    class="form-control" id="segundoApellido"
                                                    value="<?php echo $resultados['segundo_apellido'] ?>">
                                                <span class="lbl-titulo-of errorFormulario"
                                                    id="lbl-segundoApellido">Segundo Apellido
                                                    debe contener máximo 20 caracteres</span>

                                            </div>
                                            <input name="email" type="text" class="form-control" id="email"
                                                value="<?php echo $resultados['email'] ?>" hidden>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName"
                                                class="col-md-4 col-lg-3 col-form-label">Contraseña</label>
                                            <div class="col-md-8 col-lg-9"> <input name="password" type="password"
                                                    class="form-control" id="password"
                                                    value="<?php echo $resultados['password'] ?>"></div>
                                            <span class="lbl-titulo-of errorFormulario" id="lbl-password">La contraseña
                                                debe tener más
                                                de 6 caracteres</span>


                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Confirmar
                                                Contraseña</label>
                                            <div class="col-md-8 col-lg-9"> <input name="passwordConfirmar"
                                                    type="password" class="form-control" id="passwordConfirmar"
                                                    value="<?php echo $resultados['password'] ?>"></div>
                                            <span class="lbl-titulo-of errorFormulario" id="lbl-passwordConfirmar">La
                                                contraseña no
                                                coinccide</span>

                                        </div>
                                        <div class="row mb-3">
                                            <label for="company" class="col-md-4 col-lg-3 col-form-label">Cedula</label>
                                            <div class="col-md-8 col-lg-9"> <input name="cedula" type="text"
                                                    class="form-control" id="cedula"
                                                    value="<?php echo $resultados['cedula'] ?>"> <span
                                                    class="lbl-titulo-of errorFormulario" id="lbl-cedula">La cédula debe
                                                    disponer de 10
                                                    dígitos</span>


                                            </div>
                                        </div>
                                        <div class="text-center"> <button type="submit" class="btn btn-primary">Save
                                                Changes</button></div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
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