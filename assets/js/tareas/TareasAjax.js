

MostrarTareasAjax();


function MostrarTareasAjax() {
    var rol = document.getElementById("rol").value;
    var url = "index.php?c=Docente&a=mostrarTareasAjax";

    var xmlh = new XMLHttpRequest();
    xmlh.open("GET", url, true);
    xmlh.send();

    xmlh.onreadystatechange = function () {
        if (xmlh.readyState === 4 && xmlh.status === 200) {

            var respuesta = xmlh.responseText;
            var usuarios = JSON.parse(respuesta);

            var resultados = " ";
            var resultados2 = "";
            for (var i = 0; i < usuarios.length; i++) {
                users = usuarios[i];
                if (users.parcial_tarea == "1er Parcial") {
                    // Crear un elemento div como contenedor temporal
                    resultados += '<ul>';
                    resultados += '<div class="row">';
                    resultados += '<div class="col-lg-6">';
                    if (rol == "docente") {
                        resultados += '<li><i class="bi bi-file-earmark-fill"';
                        resultados += 'style="font-size:20px; margin-right:10px;"></i><a id="titulo" href="index.php?c=Calificar&a=MostrarTareasSubidas&idAsignacion=' + users.id_fk_asignar + '&idTarea=' + users.id_tarea_publicacion + '">' + users.titulo_tarea + '</a>';

                    }else{
                    resultados += '<li><i class="bi bi-file-earmark-fill"';
                    resultados += 'style="font-size:20px; margin-right:10px;"></i><a id="titulo" href="index.php?c=Acciones&a=MostrarTarea&idAsignacion='+ users.id_fk_asignar +'&idTarea='+users.id_tarea_publicacion+'&typ='+users.tipo_archivo+'">' + users.titulo_tarea +  '</a>';
                    }   
                    resultados += '<p id="descripcion">' + decodeHTMLEntities(users.descripcion) + ' </p>      </li>                     </div>';
                    resultados += '<div class="col-lg-6 d-flex align-items-center">';
                    if (rol == "docente") {
                        resultados += '<a style="margin:10px;" href="#" onclick="confirmarEliminar(\'' + users.id_tarea_publicacion + '\')" class="btn btn-danger mr-2 mb-2"><i class="bi bi-trash"></i></a>';
                        resultados += '<a onclick="abrirModalConDatos(\'' + users.titulo_tarea + '\',\'' + users.descripcion + '\',\'' + users.tipo_archivo + '\',\'' + users.parcial_tarea + '\',\'' + users.fechaTarea + '\',\'' + users.horaTarea + '\',\'' + users.id_tarea_publicacion + '\')" data-bs-toggle="modal"';
                        resultados += 'data-bs-target="#basicModal" style="margin:10px;" href="#"';
                        resultados += 'class="btn btn-dark mr-2 mb-2"><i class="bi bi-pencil"></i></a>';
                    }
                    resultados += '</div> </div> <hr>     </ul>';
                }
                if (users.parcial_tarea == "2do Parcial") {
                    resultados2 += '<ul>';
                    resultados2 += '<div class="row">';
                    resultados2 += '<div class="col-lg-6">';
                    if (rol == "docente") {
                    } else {
                    resultados2 += '<li><i class="bi bi-file-earmark-fill"';
                    resultados2 += 'style="font-size:20px; margin-right:10px;"></i><a id="titulo" href="index.php?c=Acciones&a=MostrarTarea&idAsignacion=' + users.id_fk_asignar + '&idTarea=' + users.id_tarea_publicacion + '&typ=' + users.tipo_archivo +'">' + users.titulo_tarea + '</a>';
                    }
                    resultados2 += '<p id="descripcion">' + decodeHTMLEntities(users.descripcion) + ' </p>      </li>                     </div>';
                    resultados2 += '<div class="col-lg-6 d-flex align-items-center">';
                    if (rol == "docente") {
                        resultados2 += '<a style="margin:10px;" href="#" onclick="confirmarEliminar(\'' + users.id_tarea_publicacion + '\')" class="btn btn-danger mr-2 mb-2"><i class="bi bi-trash"></i></a>';
                        resultados2 += '<a onclick="abrirModalConDatos(\'' + users.titulo_tarea + '\',\'' + users.descripcion + '\',\'' + users.tipo_archivo + '\',\'' + users.parcial_tarea + '\',\'' + users.fechaTarea + '\',\'' + users.horaTarea + '\',\'' + users.id_tarea_publicacion + '\')" data-bs-toggle="modal"';
                        resultados2 += 'data-bs-target="#basicModal" style="margin:10px;" href="#"';
                        resultados2 += 'class="btn btn-dark mr-2 mb-2"><i class="bi bi-pencil"></i></a>';
                    }
                    resultados2 += '</div> </div> <hr>     </ul>';
                }
            }
            if (resultados.trim() === "") {
                resultados += '<h5>No hay asignacion de tareas creadas</h5>';
                resultados2 += '<h5>No hay asignacion de tareas creadas</h5>';
            }

            document.getElementById('dato2doParcial').innerHTML = resultados2;
            document.getElementById('dato1erParcial').innerHTML = resultados;
        }
    }

}

function decodeHTMLEntities(text) {
    var textarea = document.createElement('textarea');
    textarea.innerHTML = text;
    return textarea.value;
}

function confirmarEliminar(id) {
    Swal.fire({
        title: "¿Está seguro de Eliminar la Tarea, se perderá todo?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#222222",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Aceptar"
    }).then((result) => {
        if (result.isConfirmed) {

            var url = "index.php?c=Docente&a=eliminarTareaAjax&idTarea=" + id;
            var xmlh = new XMLHttpRequest();
            xmlh.open("GET", url, true);
            xmlh.send();
            xmlh.onreadystatechange = function () {
                if (xmlh.readyState === 4 && xmlh.status === 200) {
                    MostrarTareasAjax();
                }
            }
            Swal.fire({
                title: "Reunión Eliminada",
                text: "",
                confirmButtonColor: "#222222",
                icon: "success"
            });
        }
    });



}

function abrirModalConDatos(titulo, descripcion, tipoArchivo, parcial, fecha, hora, idTarea) {

    document.getElementById('tituloModal').value = titulo;
    document.getElementById('fechaLimiteModal').value = fecha;
    document.getElementById('horaLimiteModal').value = hora;
    quill.clipboard.dangerouslyPasteHTML(descripcion);
    document.getElementById('editorQuill').value = descripcion;
    document.getElementById('idTarea').value = idTarea;

    document.getElementById('parcialModal').value = parcial;
    document.getElementById('archivoModal').value = tipoArchivo;


    $('#basicModal').modal('show');
}