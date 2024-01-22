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

    #anim {
        background-color: var(--color-negro-sid);
        transition: transform 0.3s;
        /* Agrega una transición suave al transformar */
    }
    
   

</style>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Foros</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="index.php?c=Docente&a=mostrarClases&type=Foros">Foros</a></li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
<!-- ESTUDIANTE-->
<?php if($_SESSION['rol']!= "estudiante"){ ?>
                        <a href="index.php?c=Docente&a=MostrarRegistroForo&idAsignacion=<?php echo $idAsignacion; ?>"
                            class="btn btn-dark">Registra un Foro</a>
<?php } ?>
                        <hr>

                        <h3><b>Sección de Foro</b></h3>
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
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <?php if (empty($foros)){ ?>
            <h4>No hay asignacion de foros creados</h4>
        <?php }else{ ?>
                               
                               
                               <?php foreach ($foros as $resultado):
                                    if ($resultado['parcial'] == "1er Parcial") { ?>
                                        <ul>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <li><i class="bi bi-chat-left-text-fill"
                                                            style="font-size:20px; margin-right:10px;"></i><a id="titulo" href="index.php?c=Acciones&a=MostrarForoDetalle&idAsignar=<?php echo $idAsignacion; ?>&foro=<?php echo $resultado['id_foro_publicacion']; ?>">
                                                            <?php echo $resultado['titulo'] ?>
                                                        </a>
                                                        <p id="descripcion">
                                                            <?php echo html_entity_decode($resultado['descripcion']); //funcion que lee el contenido html?>
                                                        </p>
                                                    </li>
                                                </div>

                                                <div class="col-lg-6 d-flex align-items-center">
<?php if ($_SESSION['rol'] != "estudiante") { ?>
                                                    <a style="margin:10px;" href="#"
                                                          onclick="confirmarEliminar('<?php echo $resultado['id_foro_publicacion']; ?>','<?php echo $idAsignacion; ?>')"  class="btn btn-danger mr-2 mb-2"><i
                                                                                    class="bi bi-trash"></i></a>
                                                                            <a onclick="abrirModalConDatos('<?php echo $resultado['titulo'] ?>','<?php echo $resultado['fechaForo'] ?>','<?php echo $resultado['fechaFin']?>','<?php echo $resultado['horaForo'] ?>','<?php echo $resultado['descripcion']?>','<?php echo $resultado['parcial'] ?>','<?php echo $resultado['id_foro_publicacion'] ?>')" data-bs-toggle="modal"
                                                                    data-bs-target="#basicModal" style="margin:10px;" href="#"
                                                                    class="btn btn-dark mr-2 mb-2"><i class="bi bi-pencil"></i></a>
                                                           
                    <?php } ?>
                                                                </div>
                                                        </div> 
                                                        <hr>
                                                    </ul>

                                    <?php }endforeach;
                                }?>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <?php if (empty($foros)){ ?>
            <h4>No hay asignacion de foros creados</h4>
        <?php }else{ ?>
                                <?php foreach ($foros as $resultado):
                                    if ($resultado['parcial'] == "2do Parcial") { ?>
                                        <ul>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <li><i class="bi bi-chat-left-text-fill"
                                                            style="font-size:20px; margin-right:10px;"></i><a href="index.php?c=Acciones&a=MostrarForoDetalle&idAsignar=<?php echo $idAsignacion; ?>&foro=<?php echo $resultado['id_foro_publicacion']; ?>">
                                                            <?php echo $resultado['titulo'] ?>
                                                        </a>
                                                        <p>
                                                            <?php echo html_entity_decode($resultado['descripcion']); //funcion que lee el contenido html?>
                                                        </p>
                                                    </li>
                                                </div>
     
                                                <div class="col-lg-6 d-flex align-items-center">
<?php if ($_SESSION['rol'] != "estudiante") { ?>
                                                    <a style="margin:10px;"
                                                        onclick="confirmarEliminar('<?php echo $resultado['id_foro_publicacion']; ?>', '<?php echo $idAsignacion; ?>')" class="btn btn-danger mr-2 mb-2"><i
                                                                                                class="bi bi-trash"></i></a>
                                                                                       <a onclick="abrirModalConDatos('<?php echo $resultado['titulo'] ?>','<?php echo $resultado['fechaForo'] ?>','<?php echo $resultado['horaForo'] ?>','<?php echo $resultado['descripcion'] ?>','<?php echo $resultado['parcial'] ?>','<?php echo $resultado['id_foro_publicacion'] ?>')"
                                                                data-bs-toggle="modal" data-bs-target="#basicModal" style="margin:10px;" href="#" class="btn btn-dark mr-2 mb-2"><i
                                                                    class="bi bi-pencil"></i></a>
    <?php } ?>
                                                                
                                                                </div>
                                                        </div>
                                                        <hr>
                                                    </ul>
    
                                    <?php } endforeach; }?>
                            </div>
                        </div>
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
                      
                    
                        <form action="index.php?c=Docente&a=EditarForo" class="form" id="form" method="post"
                            enctype="multipart/form-data">
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Título del Foro
                                </label>
                                <input type="text" class="form-control" name="tituloModal" id="tituloModal" required>
                            </div>

                               <div class="col-md-12">Descripción <div id="editor" oninput="QuillEditor()">
                                  
                                </div>
                            </div>
                            <input type="text" name="editorQuill" id="editorQuill" hidden>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Fecha Inicio</label>
                                <input type="date" class="form-control" name="fechaLimiteModal" id="fechaLimiteModal"  required>

                            </div>
                               <div class="col-md-12"> <label for="inputName5" class="form-label">Fecha Fin</label>
                                <input type="date" class="form-control" name="fechaFinModal" id="fechaFinModal"  required>

                            </div>
                            <div class="col-md-12"> <label for="inputName5" class="form-label">Hora Limite</label>
                                <input type="time" class="form-control" name="horaLimiteModal" id="horaLimiteModal" required>
                            </div>
                            
                       <div class="col-md-12">
                                <label for="inputState" class="form-label">Seleccionar Parcial</label>
                                <select class="form-select" name="parcialModal" id="parcialModal">
                              <option value="1er Parcial">1er Parcial</option>
                               <option value="2do Parcial">2do Parcial</option>
                                 </select>
                            </div>
          <input type="text" id="idForo" name="idForo" value="" hidden>
   <input type="text" id="idAsignar" name="idAsignar" value="<?php echo $idAsignacion; ?>" hidden>
   
                    </div>
                      <div class="text-center" style="margin:10px"> <button type="submit" class="btn btn-primary">Guardar</button>
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

<script>
 

function abrirModalConDatos(titulo,fecha,fechaFin,hora,descripcion,parcial,idPublicacion){
  document.getElementById('tituloModal').value = titulo;
document.getElementById('fechaLimiteModal').value = fecha;

document.getElementById('fechaFinModal').value = fechaFin;
    document.getElementById('horaLimiteModal').value = hora;
 // document.getElementById('editor').innerHTML = descripcion;

 quill.clipboard.dangerouslyPasteHTML(descripcion);

  
 document.getElementById('editorQuill').value = descripcion;
  document.getElementById('idForo').value = idPublicacion;
  
 document.getElementById('parcialModal').value=parcial;
  
 $('#basicModal').modal('show'); //Muestra el modal
}


function confirmarEliminar(idForo,idAsignar){

Swal.fire({
        title: "¿Está seguro de Eliminar el Foro?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#222222",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Aceptar"
    }).then((result) => {
        if (result.isConfirmed) {
       
           window.location.href = "index.php?c=Docente&a=EliminarForo&idForo="+idForo+"&idAsignar="+idAsignar;
         
            Swal.fire({
                title: "Foro Eliminado",
                text: "",
                confirmButtonColor: "#222222",
                icon: "success"
                
            });
          
        }
    });




}

</script>
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