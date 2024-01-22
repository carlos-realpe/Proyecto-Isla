<?php require_once 'views/partials/head.php'; ?>

<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4"> <a href="#"
                                class="logo d-flex align-items-center w-auto text-decoration-none"> <img
                                    src="assets/img/logo.png" alt="">
                                <span class="d-none d-lg-block">Recuperar Contraseña</span> </a></div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="assets/institucion/logo.png" alt="Profile" class="rounded-circle"
                                        width=100px; height=100px;>
                                    <h5 class="card-title text-center pb-0 fs-4">Isla Seymour</h5>
                                </div>
                                <p class="text-center small">Ingresa su correo electrónico para recuperar la cuenta </p>

                                <form id="miFormulario" class="row g-3" action="index.php?c=Login&a=recoveryUsuario"
                                    method="POST" >
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Correo Electrónico</label>
                                        <div class="input-group "><input type="email" class="form-control" id="email"
                                                name="email" required>
                                            <div class="invalid-feedback" id="lbl-emailNull">Porfavor ingrese su correo
                                                electrónico.</div>
                                            <span class="lbl-titulo-of errorFormulario" id="lbl-email">Este correo no se
                                                encuentra registrado </span>

                                        </div>
                                    </div>
                                    
                                    <div class="col-12"> <button class="btn btn-dark w-100" type="submit">Enviar</button>




                                    
                                    </div>


                                    
                            <?php
                            if (isset($_GET['msg'])) {

                                switch ($_GET['msg']) {
                                    case 'ok':
                                        ?>
                                        <div class="alert alert-success mt-2 alert-dismissible ">
                                            <button class="btn-close" data-bs-dismiss="alert"></button>
                                            se envió un mensaje a su correo, porfavor seguir las instrucciones
                                        </div>
                                        <?php
                                        break;
                                    case 'no_found':
                                        ?>
                                        <div class="alert alert-success mt-2 alert-dismissible ">
                                            <button class="btn-close" data-bs-dismiss="alert"></button>
                                          No se encontro ninguna cuenta registrada con ese correo
                                        </div>
                                        <?php
                                        break;

                                    case 'error':
                                        ?>

                                        <div class="alert alert-success mt-2 alert-dismissible ">
                                            <button class="btn-close" data-bs-dismiss="alert"></button>
                                            Gubo un error, intente de nuevo
                                        </div>
                                        <?php
                                        break;
                                }
                                ?>


                                <?php
                            } ?>






                                   </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php require_once 'views/partials/footer.php'; ?>