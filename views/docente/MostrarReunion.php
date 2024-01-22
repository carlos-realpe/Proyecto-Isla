<?php require_once 'views/partials/encabezado.php'; ?>
<?php


if (isset($_SESSION["validador"]) && $_SESSION["validador"] == true) {
    echo ('<script language="javascript">Swal.fire("Se actualizo con éxito los datos"); </script>');

}
if (isset($_SESSION["validador"]) && $_SESSION["validador"] == false) {
    echo ('<script language="javascript">Swal.fire("Error al al actualizar los datos"); </script>');
}
unset($_SESSION["validador"]);
?>
<style>
    ul {
        list-style: none;
    }

    a {
        text-decoration: none;
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Clases</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="index.php?c=Docente&a=mostrarClases&type=Clases">Clases</a></li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
<?php if ($_SESSION['rol']=="docente") { ?>
                        <a href="index.php?c=Docente&a=MostrarRegistroReunion&idAsignacion=<?php echo $idAsignacion; ?>"
                            class="btn btn-dark">Registra una Reunión</a>
<?php } ?>

                        <hr>
                        <ul>

                            <div id="datoReunion"></div>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
 <script>
        var rol = <?php echo json_encode($_SESSION['rol']); ?>;
</script>

        <!--------------MODAL -------------->
        <div class="modal fade" id="basicModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Datos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="index.php?c=Docente&a=EditarReunion" method="post" enctype="multipart/form-data">
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Nombre de Clase
                                    para la
                                    Reunión</label>
                                <input type="text" class="form-control" name="nombreReunion" id="nombreReunion"
                                    required>
                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Fecha de la
                                    Reunión</label>
                                <input type="date" class="form-control" name="fecha" id="fecha" required>

                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Hora de la
                                    Reunion</label>
                                <input type="time" class="form-control" name="hora" id="hora" required>
                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Enlace para
                                    conectarse</label>
                                <input type="text" class="form-control" name="enlace" id="enlace" required>
                            </div>
                            <input type="text" id="idAsignar" name="idAsignar" value="<?php echo $idAsignacion; ?>"
                                hidden>
                                 <input type="text" id="idReunion" name="idReunion" value="" hidden>
                    </div>
                    <div class="modal-footer"><button type="submit" class="btn btn-primary">Guardar
                            </button> <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Cerrar</button> </div>
                    </form>
                </div>
            </div>
        </div>
        </div>




    </section>







    <script src="assets/js/reunion/ReunionAjax.js"></script>
</main>





<?php require_once 'views/partials/footer.php'; ?>