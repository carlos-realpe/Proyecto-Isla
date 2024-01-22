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
                                <span class="d-none d-lg-block">Login</span> </a></div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="assets/institucion/logo.png" alt="Profile" class="rounded-circle"
                                        width=100px; height=100px;>
                                    <h5 class="card-title text-center pb-0 fs-4">Isla Seymour</h5>
                                </div>
                                <p class="text-center small">Ingresa tu correo electrónico y su contraseña</p>

                                <form id="miFormulario" class="row g-3" action="index.php?c=Login&a=validarLogin"
                                    method="POST" onsubmit="return ValidarLogin()" novalidate>
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
                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Contraseña</label> <input
                                            type="password" class="form-control" id="password" name="password" required>
                                        <div class="invalid-feedback" id="lbl-passwordNull">Porfavor ingrese su
                                            contraseña</div>
                                        <span class="lbl-titulo-of errorFormulario" id="lbl-password">La contreña no
                                            coincide </span>

                                    </div>

                                    <div class="col-12"> <button class="btn btn-dark w-100" type="submit">Login</button>
                                       
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">¿Olvidaste tu contraseña? <a href="index.php?c=login&a=Recovery">Click Aqui</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<script src="assets/js/LoginValidacion.js"></script>
<?php require_once 'views/partials/footer.php'; ?>