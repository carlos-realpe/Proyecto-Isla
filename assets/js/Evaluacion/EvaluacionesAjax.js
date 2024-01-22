MostrarEvaluacionesAjax();


function MostrarEvaluacionesAjax() {
    var rol = document.getElementById("rol").value;
    var url = "index.php?c=Docente&a=mostrarEvaluacionAjax";
    var fechaHoraActual = new Date();
    // Obtener la fecha por separado
    var fechaActual = new Date();

    // Obtener la hora por separado
    var horaActual = fechaHoraActual.toLocaleTimeString();

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
                var fechaLimite = new Date(users.fechaLimite + 'T00:00:00');
                fechaActual.setHours(0, 0, 0, 0);

                if (users.parcial == "1er Parcial") {

                    // Crear un elemento div como contenedor temporal
                    resultados += '<ul>';
                    resultados += '<div class="row">';
                    resultados += '<div class="col-lg-6">';
                    resultados += '<i class="bi bi-file-earmark-fill"';
                    resultados += 'style="font-size:20px; margin-right:10px;"></i>';



                    var partesHoraActual = users.horaInicio.split(":");
                    var partesHoraLimite = users.horaLimite.split(":");
                    var fechaHoraActualSoloHora = new Date(0, 0, 0, partesHoraActual[0], partesHoraActual[1], partesHoraActual[2]);
                    var fechaHoraLimiteSoloHora = new Date(0, 0, 0, partesHoraLimite[0], partesHoraLimite[1], partesHoraLimite[2]);
                    var diferenciaEnMilisegundos = fechaHoraLimiteSoloHora - fechaHoraActualSoloHora;
                    var diferenciaEnMinutos = diferenciaEnMilisegundos / (1000 * 60);



                    if (rol == "estudiante") {
                        resultados += '<a id="titulo" href="#">' + users.nombreTitulo + '</a>';

                    } else {
                        resultados += '<a id="titulo" href="index.php?c=Docente&a=preguntasMostrar&idEvaluacion=' + users.id_evaluacion + '&idAsignacion=' + users.id_fk_asignar + '">' + users.nombreTitulo + '</a>';

                    }
                    resultados += '<p><b>Duracion: </b>' + diferenciaEnMinutos + ' minutos</p>  ';
                    resultados += '<p id="descripcion"><b>Fecha Inicio: </b>' + users.fechaLimite + ' <b>Hora Inicio:</b>' + users.horaInicio + ' </p>  ';
                    resultados += '<p id="descripcion"><b>Fecha Fin: </b>' + users.fechaFinEva + ' <b>Hora Fin:</b>' + users.horaLimite + ' </p>  ';

                    resultados += '<p><b> Tipo de Evaluacion: </b>' + users.tipo + '</p>    </li>   </div>';
                    resultados += '<div class="col-lg-6 d-flex align-items-center">';

                    if (rol == "estudiante") {
                        if (fechaActual <= fechaLimite && horaActual >= users.horaInicio) {
                            if (users.estado == 1) {
                                resultados += '<a class="btn btn-dark" href="index.php?c=Acciones&a=mostrarResultadoEvaluacion&Curso=' + users.id_fk_asignar + '&idEvaluacion=' + users.id_evaluacion + '">Ver Nota</a>';
                            } else {
                                resultados += '<a style="margin:10px;" href="index.php?c=Acciones&a=evaluacionEstudiante&Curso=' + users.id_fk_asignar + '&idEvaluacion=' + users.id_evaluacion + '" class="btn btn-dark mr-2 mb-2">Empezar</a>';

                            }
                        }
                    }

                    if (rol == "docente") {
                        resultados += '<a style="margin:10px;" href="#" onclick="confirmarEliminar(\'' + users.id_evaluacion + '\')" class="btn btn-danger mr-2 mb-2"><i class="bi bi-trash"></i></a>';
                        resultados += '<a onclick="abrirModalConDatos(\'' + users.nombreTitulo + '\',\'' + users.fechaLimite + '\',\'' + users.fechaFinEva+'\',\'' + users.horaInicio + '\',\'' + users.horaLimite + '\',\'' + users.parcial + '\',\'' + users.tipo + '\',\'' + users.id_evaluacion + '\')" data-bs-toggle="modal"';
                        resultados += 'data-bs-target="#basicModal" style="margin:10px;" href="#"';
                        resultados += 'class="btn btn-dark mr-2 mb-2"><i class="bi bi-pencil"></i></a>';
                    }

                    resultados += '</div> </div> <hr>     </ul>';
                }
                if (users.parcial == "2do Parcial") {
                    resultados2 += '<ul>';
                    resultados2 += '<div class="row">';
                    resultados2 += '<div class="col-lg-6">';
                    resultados2 += '<li><i class="bi bi-file-earmark-fill"';
                    resultados2 += 'style="font-size:20px; margin-right:10px;"></i>';
                    var partesHoraActual = users.horaInicio.split(":");
                    var partesHoraLimite = users.horaLimite.split(":");
                    var fechaHoraActualSoloHora = new Date(0, 0, 0, partesHoraActual[0], partesHoraActual[1], partesHoraActual[2]);
                    var fechaHoraLimiteSoloHora = new Date(0, 0, 0, partesHoraLimite[0], partesHoraLimite[1], partesHoraLimite[2]);
                    var diferenciaEnMilisegundos = fechaHoraLimiteSoloHora - fechaHoraActualSoloHora;
                    var diferenciaEnMinutos = diferenciaEnMilisegundos / (1000 * 60);


                    if (rol == "estudiante") {
                        resultados2 += '<a id="titulo" href="#">' + users.nombreTitulo + '</a>';
                    } else {
                        resultados2 += '<a id="titulo" href="index.php?c=Docente&a=preguntasMostrar&idEvaluacion=' + users.id_evaluacion + '&idAsignacion=' + users.id_fk_asignar + '">' + users.nombreTitulo + '</a>';
                    }


                    resultados2 += '<p><b>Duracion: </b>' + diferenciaEnMinutos + ' minutos</p>  ';

                    resultados2 += '<p id="descripcion"><b>Fecha Inicio: </b>' + users.fechaLimite + ' <b>Hora Inicio:</b>' + users.horaInicio + ' </p>';
                    resultados2 += '<p id="descripcion"><b>Fecha Fin: </b>' + users.fechaFinEva + ' <b>Hora Fin:</b>' + users.horaLimite + ' </p>  ';
                    resultados2 += '<p><b> Tipo de Evaluacion: </b>' + users.tipo + '</p>    </li>   </div>';
                    resultados2 += '<div class="col-lg-6 d-flex align-items-center">';
                    if (rol == "estudiante") {
                        if (fechaActual <= fechaLimite && horaActual >= users.horaInicio) {
                            if (users.estado == 1) {
                                resultados2 += '<a class="btn btn-dark" href="index.php?c=Acciones&a=mostrarResultadoEvaluacion&Curso=' + users.id_fk_asignar + '&idEvaluacion=' + users.id_evaluacion + '">Ver Nota</a>';
                            } else {
                                resultados2 += '<a style="margin:10px;" href="index.php?c=Acciones&a=evaluacionEstudiante&Curso=' + users.id_fk_asignar + '&idEvaluacion=' + users.id_evaluacion + '" class="btn btn-dark mr-2 mb-2">Empezar</a>';
                            }
                        }
                    }
                    if (rol == "docente") {
                        resultados2 += '<a style="margin:10px;" href="#" onclick="confirmarEliminar(\'' + users.id_evaluacion + '\')" class="btn btn-danger mr-2 mb-2"><i class="bi bi-trash"></i></a>';
                        resultados2 += '<a onclick="abrirModalConDatos(\'' + users.nombreTitulo + '\',\'' + users.fechaLimite + '\',\'' + users.fechaFinEva +'\',\'' + users.horaInicio + '\',\'' + users.horaLimite + '\',\'' + users.parcial + '\',\'' + users.tipo + '\',\'' + users.id_evaluacion + '\')" data-bs-toggle="modal"';
                        resultados2 += 'data-bs-target="#basicModal" style="margin:10px;" href="#"';
                        resultados2 += 'class="btn btn-dark mr-2 mb-2"><i class="bi bi-pencil"></i></a>';
                    }
                    resultados2 += '</div> </div> <hr>     </ul>';
                }
            }
            if (resultados.trim() === "") {
                resultados += '<h5>No hay asignacion de evaluaciones creadas</h5>';
                resultados2 += '<h5>No hay asignacion de evaluaciones creadas</h5>';
            }

            document.getElementById('dato2doParcial').innerHTML = resultados2;
            document.getElementById('dato1erParcial').innerHTML = resultados;
        }
    }


}


function confirmarEliminar(id) {
    Swal.fire({
        title: "¿Está seguro de Eliminar la Evaluación?",
        text: "Se perderá todo la información",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#222222",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Aceptar"
    }).then((result) => {
        if (result.isConfirmed) {

            var url = "index.php?c=Docente&a=eliminarEvaluacionAjax&idEvaluacion=" + id;
            var xmlh = new XMLHttpRequest();
            xmlh.open("GET", url, true);
            xmlh.send();
            xmlh.onreadystatechange = function () {
                if (xmlh.readyState === 4 && xmlh.status === 200) {
                    MostrarEvaluacionesAjax();
                }
            }
            Swal.fire({
                title: "Evaluación Eliminada",
                text: "",
                confirmButtonColor: "#222222",
                icon: "success"
            });
        }
    });



}

function abrirModalConDatos(nombreTitulo, fechaLimite,fechaFin, horaInicio, horaLimite, parcial, tipo, idEvaluacion) {

    document.getElementById('tituloModal').value = nombreTitulo;

    document.getElementById('fechaLimiteModal').value = fechaLimite;
    document.getElementById('fechaFinModal').value = fechaFin;

    document.getElementById('horaInicioModal').value = horaInicio;
    document.getElementById('horaLimiteModal').value = horaLimite;


    document.getElementById('idEvaluacion').value = idEvaluacion;

    document.getElementById('parcialModal').value = parcial;
    document.getElementById('tipoModal').value = tipo;


    $('#basicModal').modal('show');
}