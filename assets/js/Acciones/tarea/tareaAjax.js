
MostrarRespuestaAjaxCalificar();
function MostrarRespuestaAjaxCalificar() {

    rol = document.getElementById("rol").value;
    idTarea = document.getElementById("TareaID").value;
    var url = "index.php?c=Calificar&a=MostrarTareasRespuestaAjax&idTarea=" + idTarea;
    var xmlh = new XMLHttpRequest();
    xmlh.open("GET", url, true);
    xmlh.send();

    xmlh.onreadystatechange = function () {
        if (xmlh.readyState === 4 && xmlh.status === 200) {
            var respuesta = xmlh.responseText;
            var usuarios = JSON.parse(respuesta);
            var resultados = " ";
            resultados += '<h5 style="color:green">Estudiantes</h5>';

            resultados += '<table class="table datatable">';
            resultados += ' <thead><tr> ';
            resultados += '<th scope="col">#</th>';
            resultados += '<th scope="col" class="d-none d-lg-table-cell">Nombre del Estudiante</th>';
            resultados += '<th scope="col" class="d-none d-lg-table-cell">Archivo</th>';
            resultados += '<th scope="col" class="d-none d-lg-table-cell">Detalle</th>';
            resultados += '<th scope="col">Calificar</th>';
            resultados += '</tr ></thead >';
            resultados += '<tbody>';
            var contador = 0;
            
            for (var i = 0; i < usuarios.length; i++) {
                users = usuarios[i];
                contador++;
                var color = "#bfd3bf";
if (users.calificacion == null){
    color ="#ea9c9c";
}
                
                resultados += '<tr style="background:'+color+'"> ';
                resultados += '<th style="width:20px;" scope="row">' + contador + '</th> ';
                resultados += '<td class="nombre d-none d-lg-table-cell">' + users.primer_nombre + ' ' + users.primer_apellido + ' ' + users.segundo_apellido + '</td>';
                resultados += '<td class="apellido d-none d-lg-table-cell"><a href="' + users.archivoTarea + '" target="_Blank">Aqui</a></td>';
                resultados += '<td class="estado d-none d-lg-table-cell">' + decodeHTMLEntities(users.detalleTarea) + '</td>';

                resultados += '<td class="botones"><button type="button" onclick="abrirModalCalificar(' + users.id_tarea_respuesta + ',' + users.id_fk_estudiante + ',' + users.id_tarea_calificar + ',' + users.calificacion + ', \'' + users.archivoTarea + '\', \'' + users.detalleTarea + '\')" class="btn btn-dark mr-2 mb-2" data-bs-toggle="modal" data-bs-target="#verticalycentered"><i class="bi bi-eye-fill"></i></button> </td></tr >';

            }

            resultados += '</tbody></table>';

            document.getElementById('datoRespuestasTarea').innerHTML = resultados;
        }
    }
}

function decodeHTMLEntities(text) {
    var textarea = document.createElement('textarea');
    textarea.innerHTML = text;
    return textarea.value;
}


function abrirModalCalificar(idTarea, idEstudiante, idTareaCalificar, calificacion,archivo, detalle) {
    document.getElementById('idTarea').value = idTarea;
    document.getElementById('idTareaCalificar').value = idTareaCalificar;
    document.getElementById('idEstudiante').value = idEstudiante;
    document.getElementById('descripcionMostrar').innerHTML = detalle;
    document.getElementById('archivo').href = archivo;
    document.getElementById('calificacionEstudiante').value = calificacion;
    document.getElementById('validadorC').value = calificacion;
}


document.getElementById('guardarInsertar').addEventListener('click', function () {
    // Obtener datos del formulario
    var idForo = document.getElementById('idTarea').value;
    var idEstudiante = document.getElementById('idEstudiante').value;
    var calificacion = document.getElementById('calificacionEstudiante').value;
    var validador = document.getElementById('validadorC').value;

    if (validador == "") {
        // Hacer una petición AJAX para actualizar la pregunta
        var url = 'index.php?c=Calificar&a=CalificarTarea';
        var data = new FormData();
        data.append('idTarea', idForo);
        data.append('idEstudiante', idEstudiante);
        data.append('calificacionEstudiante', calificacion);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Manejar la respuesta si es necesario
                Swal.fire("Se califico con éxito");
                MostrarRespuestaAjaxCalificar();
                document.getElementById("cerrar").click();
            }
        };
        xhr.send(data);
    } else {
        var idTareaCalificar = document.getElementById('idTareaCalificar').value;
        var calificacion = document.getElementById('calificacionEstudiante').value;
        var data = new FormData();
        data.append('calificacionEstudiante', calificacion);
        data.append('idTareaCalificar', idTareaCalificar);
        // Hacer una petición AJAX para actualizar la pregunta
        var url = 'index.php?c=Calificar&a=CalificarTareaEditar';
        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Manejar la respuesta si es necesario
                Swal.fire("Se actualizo con éxito");
                MostrarRespuestaAjaxCalificar();
                document.getElementById("cerrar").click();
            }
        };
        xhr.send(data);
    }
});
