MostrarForoAjax();
function MostrarForoAjax() {

    rol = document.getElementById("rol").value;
    idForo = document.getElementById("idForo").value;
    var url = "index.php?c=Acciones&a=MostrarAjaxForoDetalle&idForo=" + idForo;
    var xmlh = new XMLHttpRequest();
    xmlh.open("GET", url, true);
    xmlh.send();

    xmlh.onreadystatechange = function () {
        if (xmlh.readyState === 4 && xmlh.status === 200) {
            var respuesta = xmlh.responseText;
            var usuarios = JSON.parse(respuesta);
            var resultados = " ";
            for (var i = 0; i < usuarios.length; i++) {
                users = usuarios[i];
                resultados += '<h5> <b>Titulo:</b> ' + users.titulo + '</h5>';
                resultados += '<p>' + decodeHTMLEntities(users.descripcion) + '</p>';
                resultados += '<div class="d-flex justify-content-end"><a data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"';
                resultados += 'aria-controls="collapseOne" href="#">Responder</a></div>';
            }
            if (rol == "docente") {
                MostrarRespuestaAjaxCalificar();
            } else {
                MostrarRespuestaAjax();
            }


            document.getElementById('datoForo').innerHTML = resultados;
        }
    }
}

function MostrarRespuestaAjax() {

    rol = document.getElementById("rol").value;
    idForo = document.getElementById("idForo").value;
    var url = "index.php?c=Acciones&a=MostrarRespuestaAjax&idForo=" + idForo;
    var xmlh = new XMLHttpRequest();
    xmlh.open("GET", url, true);
    xmlh.send();

    xmlh.onreadystatechange = function () {
        if (xmlh.readyState === 4 && xmlh.status === 200) {
            var respuesta = xmlh.responseText;
            var usuarios = JSON.parse(respuesta);
            var resultados = " ";
            resultados += '<hr><h5 style="color:green">Estudiantes</h5>';
            for (var i = 0; i < usuarios.length; i++) {
                users = usuarios[i];


                resultados += '<hr>';
                resultados += '<h6>' + users.primer_nombre + ' ' + users.primer_apellido + ' ' + users.segundo_apellido + '</h6>';
                resultados += '<p style="font-size:12px">Fecha: ' + users.fechaRespuesta + '</p>';
                resultados += '<p>' + decodeHTMLEntities(users.respuesta) + '</p>';

            }
            document.getElementById('datoRespuestasForo').innerHTML = resultados;
        }
    }
}



function MostrarRespuestaAjaxCalificar() {

    rol = document.getElementById("rol").value;
    idForo = document.getElementById("idForo").value;
    var url = "index.php?c=Acciones&a=MostrarRespuestaAjax&idForo=" + idForo;
    var xmlh = new XMLHttpRequest();
    xmlh.open("GET", url, true);
    xmlh.send();

    xmlh.onreadystatechange = function () {
        if (xmlh.readyState === 4 && xmlh.status === 200) {
            var respuesta = xmlh.responseText;
            var usuarios = JSON.parse(respuesta);
            var resultados = " ";
            resultados += '<hr><h5 style="color:green">Estudiantes</h5>';

            resultados += '<table class="table datatable">';
            resultados += ' <thead><tr> ';
            resultados += '<th scope="col">#</th>';
            resultados += '<th scope="col" class="d-none d-lg-table-cell">Nombre del Estudiante</th>';
            resultados += '<th scope="col" class="d-none d-lg-table-cell">Fecha de Respuesta</th>';
            resultados += '<th scope="col" class="d-none d-lg-table-cell">Respuesta</th>';
            resultados += '<th scope="col">Calificar</th>';
            resultados += '</tr ></thead >';
            resultados += '<tbody>';
            var contador = 0;

            for (var i = 0; i < usuarios.length; i++) {
                users = usuarios[i];
                contador++;
                var color = "#bfd3bf";
                if (users.calificacion == null) {
                    color = "#ea9c9c";
                }

                resultados += '  <tr style="background:'+color+'"> ';
                resultados += '<th style="width:20px;" scope="row">' + contador + '</th> ';
                resultados += '<td class="nombre d-none d-lg-table-cell">' + users.primer_nombre + ' ' + users.primer_apellido + ' ' + users.segundo_apellido + '</td>';
                resultados += '<td class="apellido d-none d-lg-table-cell">' + users.fechaRespuesta + '</td>';
                resultados += '<td class="estado d-none d-lg-table-cell">' + decodeHTMLEntities(users.respuesta) + '</td>';

                resultados += '<td class="botones"><button type="button" onclick="abrirModalCalificar(' + users.id_foro_respuestas + ',' + users.id_fk_estudiante + ',' + users.id_foro_calificar +',' + users.calificacion + ', \'' + users.respuesta + '\')" class="btn btn-dark mr-2 mb-2" data-bs-toggle="modal" data-bs-target="#verticalycentered"><i class="bi bi-eye-fill"></i></button> </td></tr >';

            }

            resultados += '</tbody></table>';

            document.getElementById('datoRespuestasForo').innerHTML = resultados;
        }
    }
}


function abrirModalCalificar(idForo, idEstudiante, idForoCalificar,calificacion, descripcion) {
    var formulario = document.getElementById("form");
    document.getElementById('foroEstudiantever').value = idForo;
    document.getElementById('idForoCalificar').value = idForoCalificar;

    document.getElementById('idEstudiante').value = idEstudiante;
    document.getElementById('descripcionMostrar').innerHTML = descripcion;
    document.getElementById('calificacionEstudiante').value = calificacion;

    document.getElementById('validadorC').value = calificacion;
}




document.getElementById('guardarRespuesta').addEventListener('click', function () {
    // Obtener datos del formulario

    var idForo = document.getElementById('idForo').value;

    var respuesta = document.getElementById('editorQuill').value;



    // Hacer una petición AJAX para actualizar la pregunta
    var url = 'index.php?c=Acciones&a=GuardarRespuesta';
    var data = new FormData();
    data.append('idForo', idForo);
    data.append('editorQuill', respuesta);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Manejar la respuesta si es necesario
            Swal.fire("Se respondió con éxito");

            document.getElementById('editorQuill').value = "";
            document.getElementById('editor').innerHTML = "";
            MostrarForoAjax();
        }
    };
    xhr.send(data);
});

function decodeHTMLEntities(text) {
    var textarea = document.createElement('textarea');
    textarea.innerHTML = text;
    return textarea.value;
}


/////INSERTAR CALIFICACION 

document.getElementById('guardarInsertar').addEventListener('click', function () {
    // Obtener datos del formulario
    var idForo = document.getElementById('foroEstudiantever').value;
    var idEstudiante = document.getElementById('idEstudiante').value;
    var calificacion = document.getElementById('calificacionEstudiante').value;
    var validador =        document.getElementById('validadorC').value;
   
if(validador==""){
    // Hacer una petición AJAX para actualizar la pregunta
    var url = 'index.php?c=Calificar&a=CalificarForo';
    var data = new FormData();
    data.append('foroEstudiantever', idForo);
    data.append('idEstudiante', idEstudiante);
    data.append('calificacionEstudiante', calificacion);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Manejar la respuesta si es necesario
            Swal.fire("Se califico con éxito");
            MostrarForoAjax();
            document.getElementById("cerrar").click();
        }
    };
    xhr.send(data);
}else{
    var idForoCalificar = document.getElementById('idForoCalificar').value;
    var calificacion = document.getElementById('calificacionEstudiante').value;
    var data = new FormData();
    data.append('calificacionEstudiante', calificacion);
    data.append('idForoCalificar', idForoCalificar);
    // Hacer una petición AJAX para actualizar la pregunta
    var url = 'index.php?c=Calificar&a=CalificarForoEditar';
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Manejar la respuesta si es necesario
            Swal.fire("Se actualizo con éxito");
            MostrarForoAjax();
            document.getElementById("cerrar").click();
        }
    };
    xhr.send(data);
}
});
