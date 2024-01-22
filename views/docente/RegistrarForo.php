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
        <h1>Foros</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="index.php?c=Docente&a=mostrarClases&type=Foros">Foros</a></li>
                <li class="breadcrumb-item"><a
                        href="index.php?c=Docente&a=MostrarForosDatos&idAsignacion=<?php echo $idAsignacion; ?>">Sección Foro</a>
                </li>

            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datos</h5>
                        <form action="index.php?c=Docente&a=RegistrarForo" class="form" id="form" method="post"
                            enctype="multipart/form-data">
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Título del Foro
                                </label>
                                <input type="text" class="form-control" name="titulo" id="titulo" required>
                            </div>

                               <div class="col-md-12">Descripción <div id="editor" oninput="QuillEditor()">
                                  
                                </div>
                            </div>
                            <input type="text" name="editorQuill" id="editorQuill" hidden>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Fecha Inicio</label>
                                <input type="date" class="form-control" name="fechaLimite" id="fechaLimite" required>

                            </div>
                              <div class="col-md-12"> <label for="inputName5" class="form-label">Fecha Fin</label>
                                <input type="date" class="form-control" name="fechaFin" id="fechaFin" required>

                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Hora Limite</label>
                                <input type="time" class="form-control" name="horaLimite" id="horaLimite" required>
                            </div>
                            
                       <div class="col-md-12">
                                <label for="inputState" class="form-label">Seleccionar Parcial</label>
                                <select id="inputState" class="form-select" name="parcial" id="parcial">
                              <option value="1er Parcial">1er Parcial</option>
                               <option value="2do Parcial">2do Parcial</option>
                                                                  </select>
                            </div>
                         
                            <input type="text" id="idAsignar" name="idAsignar" value="<?php echo $idAsignacion; ?>"
                                hidden>
                    </div>
                </div>
            </div>
            <div class="text-center"> <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="index.php?c=Docente&a=mostrarClases&type=Foros" class="btn btn-secondary">Cancelar</a>
            </div>
            </form>
    </section>
</main>
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


<?php require_once 'views/partials/footer.php'; ?>