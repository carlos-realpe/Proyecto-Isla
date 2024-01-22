<?php require_once 'views/partials/encabezado.php'; ?>

<style>
    ul {
        list-style: none;
    }

    a {
        text-decoration: none;
    }

    h6 {
        font-weight: bold;
    }

    #editor {
        height: 200px;
        /* Establece la altura deseada */
    }

    #fileInputContainer {
        border: 2px dashed #ccc;
        padding: 20px;
        text-align: center;
    }
</style>
<?php
if (isset($_SESSION["validador"]) && $_SESSION["validador"] == true) {
    echo ('<script language="javascript">Swal.fire("Se envio la tarea con exitó"); </script>');

}
if (isset($_SESSION["validador"]) && $_SESSION["validador"] == false) {
    echo ('<script language="javascript">Swal.fire("Error al enviar la tarea"); </script>');
}
unset($_SESSION["validador"]);
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>
            <?php echo $type ?>
        </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="index.php?c=Docente&a=mostrarClases&type=<?php echo $type ?>">
                        <?php echo $type ?>
                    </a></li>
                <li class="breadcrumb-item"><a
                        href="index.php?c=Docente&a=Mostrar<?php echo $type ?>Datos&idAsignacion=<?php echo $idAsignacion ?>">Sección
                        de Tareas</a></li>

            </ol>
        </nav>
    </div>
    <?php  $est='editarTarea'; if (!isset($validador)) {
        $validador['detalleTarea'] = "";
        $validador['archivoTarea'] = "";
        $est = "guardarTarea";
    } ?>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h3><b>Subir la Tareas</b></h3>
                        <hr>
                        <ul>
                            <li>

                                               <form action="index.php?c=Acciones&a=<?php echo $est ?>" class="form" id="form" method="post"
                                        enctype="multipart/form-data">
                              
                                    
                                     
                                        <input type="text" id="rol" value="<?php echo $_SESSION['rol'] ?>" hidden>

                                        <input type="text" name="textArchivo"
                                            value="<?php echo $validador['archivoTarea'] ?>" hidden>



                                        <label for="fileInput" class="form-label">Seleccionar archivo</label>
                                        <?php if (isset($validador) && $validador['archivoTarea'] != "") { ?>
                                            <h5 style="color:green">El archivo de la tarea ya se encuentra subido <a
                                                    href="<?php echo $validador['archivoTarea'] ?>">Aqui</a></h5>
                                        <?php } else { ?>
                                            <h5 style="color:red">Aún no se ha subido el archivo de la tarea </h5>
                                        <?php } ?>

                                        <input type="file" class="form-control" id="fileInput" name="fileInput"
                                            accept=".<?php echo $tipoArchivo; ?>">


                                        <div class="col-md-12">Añadir Detalle: <div id="editor" oninput="QuillEditor()">
                                            </div>
                                        </div>
                                        <input type="text" id="idTarea" name="idTarea" value=<?php echo $idTarea ?>
                                            hidden>

                                        <input type="text" id="tipoArchivo" name="tipoArchivo" value=<?php echo $tipoArchivo ?> hidden>
                                        <input type="text" id="idAsignacion" name="idAsignacion" value=<?php echo $idAsignacion ?> hidden>
                                        <input type="text" name="editorQuill" id="editorQuill"
                                            value="<?php echo $validador['detalleTarea'] ?>" hidden>
                                        <div class="d-flex flex-column justify-content-center align-items-center m-1">
                                            <button class="btn btn-primary" type="submit"
                                                id="guardarRespuesta">Guardar</button>
                                        </div>

                                    </form>

                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>






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
    // Obtén el contenido desde PHP y decódifica las entidades HTML
    var contenidoDesdePHP = "<?php echo html_entity_decode($validador['detalleTarea']); ?>";

    // Parsea el contenido HTML a un objeto Delta
    var delta = quill.clipboard.convert(contenidoDesdePHP);

    // Actualiza el contenido del editor Quill con el Delta parseado
    quill.setContents(delta);

    // Función para actualizar el contenido del editor Quill cuando hay cambios
    function QuillEditor() {
        // Obtiene el contenido del editor Quill
        var editorContent = quill.root.innerHTML;

        // Actualiza el contenido del campo de texto oculto con el mismo valor
        document.getElementById('editorQuill').value = editorContent;
    }





</script>


<!--<script src="assets/js/Acciones/tareas/tareaAjax.js"></script>-->


<?php require_once 'views/partials/footer.php'; ?>