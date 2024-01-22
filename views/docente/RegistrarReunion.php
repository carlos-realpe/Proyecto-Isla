<?php require_once 'views/partials/encabezado.php'; ?>


<?php


if (isset($_SESSION["validador"]) && $_SESSION["validador"] == true) {
    echo ('<script language="javascript">Swal.fire("Se registro con éxito la reunión"); </script>');

}
if (isset($_SESSION["validador"]) && $_SESSION["validador"] == false) {
    echo ('<script language="javascript">Swal.fire("Error al registrar la reunión"); </script>');
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
             <li class="breadcrumb-item"><a href="index.php?c=Docente&a=MostrarClasesDatos&idAsignacion=<?php echo $idAsignacion; ?>">Reunion</a></li>
        
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card" >
                    <div class="card-body">
                        <h5 class="card-title">Datos</h5>
                        <form action="index.php?c=Docente&a=RegistrarReunion" class="form" id="form" method="post"
                            enctype="multipart/form-data">
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Nombre de Clase para la
                                    Reunión</label>
                                <input type="text" class="form-control" name="nombreReunion" id="nombreReunion" required>
                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Fecha de la
                                    Reunión</label>
                                <input type="date" class="form-control" name="fecha" id="fecha"
                                    required>
                              
                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Hora de la
                                    Reunion</label>
                                <input type="time" class="form-control" name="hora" id="hora"
                                    required>                                
                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Enlace para
                                    conectarse</label>
                                <input type="text" class="form-control" name="enlace" id="enlace"
                                    required>                             
                            </div>
                            <input type="text" id="idAsignar" name="idAsignar" value="<?php echo $idAsignacion; ?>" hidden>
                   </div>
                </div>
            </div>
            <div class="text-center"> <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="index.php?c=Docente&a=mostrarClases" class="btn btn-secondary">Cancelar</a>
            </div>
            </form>
    </section>
</main>




<?php require_once 'views/partials/footer.php'; ?>