MostrarPreguntasAjax();

function MostrarPreguntasAjax() {

    var url = "index.php?c=Docente&a=MostrarPreguntasAjax";
    var xmlh = new XMLHttpRequest();
    xmlh.open("GET", url, true);
    xmlh.send();

    xmlh.onreadystatechange = function () {
        if (xmlh.readyState === 4 && xmlh.status === 200) {

            var respuesta = xmlh.responseText;
            var usuarios = JSON.parse(respuesta);

            var resultados = " ";
            var contador = 0;

            for (var i = 0; i < usuarios.length; i++) {
              
                users = usuarios[i];
                contador++;
                resultados += '<div class="row">';
                resultados += '<div class="col-md-4">';
                resultados += '<h6 id="titulo">' + contador + '.-' + users.pregunta + '</h6></div> ';
                resultados += '<div class="col-md-2"><button type="button" class="btn btn-danger mr-2 mb-2" onclick = "confirmarEliminarPregunta(' + users.id_pregunta + ')" > <i class="bi bi-trash"></i> Eliminar</button></div>';
                resultados += '<div class="col-md-2"> ';
                resultados += '<a onclick="abrirModalPregunta(' + users.id_pregunta + ', \'' + users.pregunta + '\', '+users.puntaje+')" data-bs-toggle="modal"  data-bs-target="#basicModal"  href="#" class="btn btn-dark mr-2 mb-2" >  <i class="bi bi-pencil"></i> Editar </a></div>';
                resultados += '<div class="col-md-4"> ';
                resultados += '<a href="#" class="btn btn-dark mr-2 mb-2" data-bs-toggle="collapse" ';
                resultados += 'data-bs-target="#Respuesta' + users.id_pregunta + '" aria-expanded="true" aria-controls="collapseOne"> ';
                resultados += '<i class="bi bi-plus-lg"></i> Añadir Respuesta</a></div> ';
                ////RESPUESTAS
                resultados += ' <div id="Respuesta' + users.id_pregunta + '" class="accordion-collapse collapse" aria-labelledby="headingOne"  data-bs-parent="#accordionExample">';
                resultados += '<div class="accordion-body"> ';
                resultados += '<label for="respuesta"><b>Añadir Respuesta:</b></label> ';
                resultados += '<div><textarea class="respuestaText" name="respuestaP" id="respuestaP'+users.id_pregunta+'" cols="100" rows="5"></textarea> </div> ';
                resultados += ' <div><button onclick="guardarRespuesta(' + users.id_pregunta + ')" class="btn btn-primary">Guardar</button></div></div></div>';
                resultados += '</div><div class="preguntasE" id="respuestasAjax'+users.id_pregunta+'"></div><hr>';
               
                MostrarRespuestaAjax();
               
               
            }

        
            if (resultados.trim() === "") {
                resultados += '<h5>No hay Preguntas Asignadas</h5>';
            }
          
          
            document.getElementById('datosPreguntas').innerHTML = resultados;
         
        }
    }

}

function MostrarRespuestaAjax() {

    var url = "index.php?c=Docente&a=MostrarRespuestaAjax";
    var xmlh = new XMLHttpRequest();
    xmlh.open("GET", url, true);
    xmlh.send();

    xmlh.onreadystatechange = function () {
        if (xmlh.readyState === 4 && xmlh.status === 200) {

            var respuesta = xmlh.responseText;
            var usuarios = JSON.parse(respuesta);

            var contador = 0;

            resultados = " ";
            var respuestasPorPregunta = {};

            for (let i = 0; i < usuarios.length; i++) {
                let users = usuarios[i];

              
                
                // Verificar si ya existe una entrada para esta pregunta en el objeto
                if (!respuestasPorPregunta[users.id_fk_pregunta]) {
                    respuestasPorPregunta[users.id_fk_pregunta] = [];
                }

                // Agregar la respuesta al array correspondiente a esta pregunta
                respuestasPorPregunta[users.id_fk_pregunta].push({
                    respuesta: users.respuesta,
                    id_respuesta: users.id_respuesta,
                    correcta: users.correcta
                });
            }

            // Iterar sobre las respuestas almacenadas y actualizar el contenido HTML de cada elemento
            for (let preguntaId in respuestasPorPregunta) {
                let respuestas = respuestasPorPregunta[preguntaId];
                let resultados = " ";
                let contador = 0;
                // Construir la cadena de respuestas para esta pregunta
                for (let i = 0; i < respuestas.length; i++) {
                    contador++;
                    let resp = respuestas[i];
                    if (resp.correcta == 1) { estado = 'checked' } else { estado=' ' }
                    resultados += '<div class="row">';
                    resultados += '<div id="titulo"><input type="checkbox" id="cbox2'+resp.id_respuesta+'" value="1" onclick="respuestaCorrecta(' + resp.id_respuesta +')" '+ estado +'/><label for="cbox2">' + resp.respuesta +'</label>';
                    resultados += '<button style="margin:5px" type="button" class="btn btn-danger mr-2 mb-2" onclick="confirmarEliminar('+resp.id_respuesta+',event)"> <i class="bi bi-trash"></i> </button><a onclick="abrirModalRespuesta(' + resp.id_respuesta + ', \'' + resp.respuesta + '\')" data-bs-toggle="modal"  data-bs-target="#respuestaModalBasic"  href="#" class="btn btn-dark mr-2 mb-2" >  <i class="bi bi-pencil"></i></a></div></div> ';
                   
                }
                
                // Actualizar el contenido HTML del elemento correspondiente a esta pregunta
                document.getElementById("respuestasAjax" + preguntaId).innerHTML = resultados;
              
                    // VALIDACION
                    var preguntasElems = document.getElementsByClassName('preguntasE');

                    for (var i = 0; i < preguntasElems.length; i++) {
                        var preguntaElem = preguntasElems[i];

                        // Verificar si el contenido de la pregunta está vacío
                        if (preguntaElem.innerHTML.trim() === "") {
                            // Si está vacío, establecer un mensaje
                            preguntaElem.innerHTML = "<h5 style='color:red'>No hay respuestas generadas</h5>";
                        }
                    }
               
            }
            
        }
    }

}








function guardarRespuesta(idPregunta) {
    respuesta = document.getElementById("respuestaP" + idPregunta).value;
    var url = "index.php?c=Docente&a=guardarRespuesta&idPregunta=" + idPregunta + '&respuesta=' + respuesta;
    var xmlh = new XMLHttpRequest();
    xmlh.open("GET", url, true);
    xmlh.send();

    xmlh.onreadystatechange = function () {
        if (xmlh.readyState == 4 && xmlh.status == 200) {

            document.getElementById("respuestaP" + idPregunta).value = "";
            MostrarRespuestaAjax();
        }
    };
}

function respuestaCorrecta(id_respuesta){
    estado=document.getElementById('cbox2'+id_respuesta).checked;
    var estadoInt = estado ? 1 : 0;
    var url = "index.php?c=Docente&a=respuestaCorrecta&idRespuesta=" + id_respuesta + '&estado=' + estadoInt;
 
    var xmlh = new XMLHttpRequest();
    xmlh.open("GET", url, true);
    xmlh.send();



}


/* Carga del Modal */
function abrirModalPregunta(idPregunta,pregunta,puntaje) {
   
    document.getElementById('preguntaModal').value = pregunta;
    document.getElementById('puntajeModal').value = puntaje;
    document.getElementById('idPregunta').value = idPregunta;
    
    $('#basicModal').modal('show'); //Muestra el modal
}
function abrirModalRespuesta(idRespuesta,respuesta){
    document.getElementById('respuestaModal').value = respuesta;
    document.getElementById('idRespuesta').value = idRespuesta;  

    $('#basicModal').modal('show'); //Muestra el modal
}

function confirmarEliminar(idRespuesta,event){
    
    var url = "index.php?c=Docente&a=eliminarRespuesta&idRespuesta=" + idRespuesta;
    var xmlh = new XMLHttpRequest();
    xmlh.open("GET", url, true);
    xmlh.send();

    xmlh.onreadystatechange = function () {
        if (xmlh.readyState == 4 && xmlh.status == 200) {
            MostrarPreguntasAjax();
        }
    };
}

function confirmarEliminarPregunta(idPregunta){
    Swal.fire({
        title: "¿Está seguro de Eliminar la Pregunta?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#222222",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Aceptar"
    }).then((result) => {
        if (result.isConfirmed) {

            var url = "index.php?c=Docente&a=confirmarEliminarPregunta&idPregunta=" + idPregunta;
            var xmlh = new XMLHttpRequest();
            xmlh.open("GET", url, true);
            xmlh.send();
            xmlh.onreadystatechange = function () {
                if (xmlh.readyState === 4 && xmlh.status === 200) {
                    MostrarPreguntasAjax();
                }
            }
            Swal.fire({
                title: "Pregunta Eliminada",
                text: "",
                confirmButtonColor: "#222222",
                icon: "success"
            });
        }
    });



}


document.getElementById('guardarBtn').addEventListener('click', function () {
    // Obtener datos del formulario
    var idPregunta = document.getElementById('idPregunta').value;
    var pregunta = document.getElementById('preguntaModal').value;
    var puntaje = document.getElementById('puntajeModal').value;

    // Hacer una petición AJAX para actualizar la pregunta
    var url = 'index.php?c=Docente&a=EditarPregunta';
    var data = new FormData();
    data.append('idPregunta', idPregunta);
    data.append('preguntaModal', pregunta);
    data.append('puntajeModal', puntaje);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Manejar la respuesta si es necesario
            Swal.fire("Se actualizo con éxito los datos");
            MostrarPreguntasAjax();
            document.getElementById("cerrar").click();
        }
    };
    xhr.send(data);
});

document.getElementById('guardarRespuestaBtn').addEventListener('click', function () {
    // Obtener datos del formulario
    var idRespuesta= document.getElementById('idRespuesta').value;
    var respuesta = document.getElementById('respuestaModal').value;  

    // Hacer una petición AJAX para actualizar la pregunta
    var url = 'index.php?c=Docente&a=EditarRespuesta';
    var data = new FormData();
    data.append('idRespuesta', idRespuesta);
    data.append('respuestaModal', respuesta);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Manejar la respuesta si es necesario
            Swal.fire("Se actualizo con éxito los datos");
            MostrarPreguntasAjax();
            document.getElementById("cerrarRespuesta").click();
        }
    };
    xhr.send(data);
});
