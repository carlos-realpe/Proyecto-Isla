<?php require_once 'views/partials/head.php'; ?>
    <?php
 $_SESSION['idContrasena'] = $_GET['id'];
?>

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
                                <form id="miFormulario" class="row g-3" action="index.php?c=Login&a=cambiarContraseña" method="POST"  onsubmit="return validarFormulario()">
                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Nueva Contraseña</label> <input
                                            type="password" class="form-control" id="password" name="password" required>
                                            <label for="yourPassword" class="form-label">Confirmar Contraseña</label> <input
                                            type="password" class="form-control" id="password2" name="password2" required>
                                        
                                        <span class="lbl-titulo-of errorFormulario" id="lbl-password">La contreña no
                                            coincide </span>

                                    </div>

                                    <div class="col-12"> <button class="btn btn-dark w-100" type="submit">Enviar</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
    function validarFormulario() {
        var password = document.getElementById('password').value;
        var password2 = document.getElementById('password2').value;
        var errorMensaje = document.getElementById('lbl-password');

        if (password !== password2) {
            errorMensaje.style.display = 'block';
            return false; // Evita que el formulario se envíe
        } else {
            errorMensaje.style.display = 'none';
            return true; // Permite que el formulario se envíe
        }
    }
</script>
</main>

<?php require_once 'views/partials/footer.php'; ?>