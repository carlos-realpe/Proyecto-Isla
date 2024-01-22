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
        <h1>Tareas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="index.php?c=Docente&a=mostrarClases&type=Tareas">Tareas</a></li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php if ($_SESSION['rol'] == "docente") { ?>
                            <a href="index.php?c=Docente&a=MostrarRegistroTarea&idAsignacion=<?php echo $idAsignacion; ?>"
                                class="btn btn-dark">Registra una Tarea</a>
                        <?php } ?>
                        <input type="text" id="rol" value="<?php echo $_SESSION['rol'] ?>" hidden>
                        
                        <hr>
                        <ul>
                            <h3><b>Sección de Tareas</b></h3>
                            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation"> <button class="nav-link active" id="home-tab"
                                        data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab"
                                        aria-controls="home" aria-selected="true">1er
                                        Parcial</button></li>
                                <li class="nav-item" role="presentation"> <button class="nav-link" id="profile-tab"
                                        data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab"
                                        aria-controls="profile" aria-selected="false">2do
                                        Parcial</button></li>
                            </ul>
                            <div class="tab-content pt-2" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div id="dato1erParcial"></div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div id="dato2doParcial"></div>
                                </div>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!--------------MODAL -------------->
        <div class="modal fade" id="basicModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Datos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="index.php?c=Docente&a=EditarTarea" class="form" id="form" method="post"
                            enctype="multipart/form-data">
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Título del Foro
                                </label>
                                <input type="text" class="form-control" name="tituloModal" id="tituloModal" required>
                            </div>

                            <div class="col-md-12">Descripción <div id="editor" oninput="QuillEditor()">

                                </div>
                            </div>
                            <input type="text" name="editorQuill" id="editorQuill" hidden>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Fecha Limite</label>
                                <input type="date" class="form-control" name="fechaLimiteModal" id="fechaLimiteModal"
                                    required>

                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Hora Limite</label>
                                <input type="time" class="form-control" name="horaLimiteModal" id="horaLimiteModal"
                                    required>
                            </div>

                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Seleccionar Parcial</label>
                                <select class="form-select" name="parcialModal" id="parcialModal">
                                    <option value="1er Parcial">1er Parcial</option>
                                    <option value="2do Parcial">2do Parcial</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Seleccionar el tipo de archivo</label>
                                <select class="form-select" name="archivoModal" id="archivoModal">
                                    <option value="pdf">PDF</option>
                                    <option value="doc">WORD</option>
                                </select>
                            </div>
                            <input type="text" id="idTarea" name="idTarea" value="" hidden>
                            <input type="text" id="idAsignar" name="idAsignar" value="<?php echo $idAsignacion; ?>"
                                hidden>

                    </div>
                    <div class="text-center" style="margin:10px"> <button type="submit"
                            class="btn btn-primary">Guardar</button>
                        <a href="#" data-bs-dismiss="modal" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>

            </div>

            </form>
        </div>
        </div>
        </div>
        </div>




    </section>

    <script src="assets/js/tareas/TareasAjax.js"></script>
    <script src="assets/quill/quill.js"></script> <!-- 1.3.6-->
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });
        function QuillEditor() {
            var contenidoHTML = quill.root.innerHTML;
            document.getElementById('editorQuill').value = contenidoHTML;
        }
    </script>
</main>





<?php require_once 'views/partials/footer.php'; ?>