mostrarCalendarioAjax();

function consultarDatosAjaxAsignados() {
    var buscar = document.getElementById("buscarEvento").value;
    var url = "index.php?c=Calendario&a=consultaCalendario&buscar=" + buscar;
    var xmlh = new XMLHttpRequest();
    xmlh.open("GET", url, true);
    xmlh.send();
    xmlh.onreadystatechange = function () {
        if (xmlh.readyState === 4 && xmlh.status === 200) {
            var respuesta = xmlh.responseText;
            var usuarios = JSON.parse(respuesta);
            var resultados = "";
            var contador = 0;
            for (var i = 0; i < usuarios.length; i++) {
                users = usuarios[i];
                contador++;
                resultados += '  <tr> ';
                resultados += '    <th style="width:20px;" scope="row">' + contador + '</th> ';
                resultados += '   <td class="nombre d-none d-lg-table-cell">' + users.evento + '</td>';
                resultados += '  <td class="apellido d-none d-lg-table-cell">' + users.fechaCalendario + '</td>';
                resultados += ' <td class="estado d-none d-lg-table-cell">' + users.fechaCalendarioFin + '</td>';
                resultados += ' <td class="botones"><a href="#" onclick="eliminarDatosAjaxAdmin(' + users.id_calendario + ')" class="btn btn-danger mr-2 mb-2"><i class="bi bi-trash"></i></a> ';
                resultados += ' <button type="button"  data-bs-toggle="modal" data-bs-target="#basicModalRegistrar" onclick="abrirModalConDatos(\'' + users.evento + '\',\'' + users.fechaCalendario + '\',\'' + users.fechaCalendarioFin + '\',\'' + users.id_calendario + '\')" class="btn btn-dark mr-2 mb-2"><i class="bi bi-pencil"></i></</button></td></tr >';
            }
            document.getElementById('datosCalendario').innerHTML = resultados;
        }
    }

}

function mostrarCalendarioAjax() {
    var url = "index.php?c=Calendario&a=mostrarDatosAjaxCalendario";
    var xmlh = new XMLHttpRequest();
    xmlh.open("GET", url, true);
    xmlh.send();
    xmlh.onreadystatechange = function () {
        if (xmlh.readyState === 4 && xmlh.status === 200) {
            var respuesta = xmlh.responseText;
            var usuarios = JSON.parse(respuesta);

            var resultados = "";
            var contador = 0;
            for (var i = 0; i < usuarios.length; i++) {
                users = usuarios[i];
                if (users.estado == 1) {
                    estado = "Habilitado";
                } else { estado = "Deshabilitado"; }
                contador++;
                resultados += '  <tr> ';
                resultados += '    <th style="width:20px;" scope="row">' + contador + '</th> ';
                resultados += '   <td class="nombre d-none d-lg-table-cell">' + users.evento + '</td>';
                resultados += '  <td class="apellido d-none d-lg-table-cell">' + users.fechaCalendario + '</td>';
                resultados += ' <td class="estado d-none d-lg-table-cell">' + users.fechaCalendarioFin + '</td>';
                resultados += ' <td class="botones"><a href="#" onclick="eliminarDatosAjaxAdmin(' + users.id_calendario + ')" class="btn btn-danger mr-2 mb-2"><i class="bi bi-trash"></i></a> ';
                resultados += ' <button type="button"  data-bs-toggle="modal" data-bs-target="#basicModalRegistrar" onclick="abrirModalConDatos(\'' + users.evento + '\',\'' + users.fechaCalendario + '\',\'' + users.fechaCalendarioFin + '\',\'' + users.id_calendario + '\')" class="btn btn-dark mr-2 mb-2"><i class="bi bi-pencil"></i></</button></td></tr >';
            }
            document.getElementById('datosCalendario').innerHTML = resultados;
        }
    }
}


function abrirModalConDatos(evento, fechaInicio, fechaFin, idCalendario) {
    document.getElementById('eventoModal').value = evento;
    document.getElementById('fechaInicioModal').value = fechaInicio;
    document.getElementById('fechaFinModal').value = fechaFin;
    document.getElementById('idCalendario').value = idCalendario;

}

document.getElementById('cerrar').addEventListener('click', function () {


    document.getElementById('eventoModal').value = "";
    document.getElementById('fechaInicioModal').value = "";
    document.getElementById('fechaFinModal').value = "";
    document.getElementById('idCalendario').value = "";
});





 function eliminarDatosAjaxAdmin(id){
     Swal.fire({
         title: "¿Está seguro de Eliminar el evento?",
         text: "",
         icon: "warning",
         showCancelButton: true,
         confirmButtonColor: "#222222",
         cancelButtonColor: "#d33",
         cancelButtonText: "Cancelar",
         confirmButtonText: "Aceptar"
     }).then((result) => {
         if (result.isConfirmed) {

             var url = "index.php?c=Calendario&a=eliminarDatosAjax&idCalendario=" + id;
             var xmlh = new XMLHttpRequest();
             xmlh.open("GET", url, true);
             xmlh.send();
             xmlh.onreadystatechange = function () {
                 if (xmlh.readyState === 4 && xmlh.status === 200) {
                     mostrarCalendarioAjax();
                 }
             }
             Swal.fire({
                 title: "Evento Eliminado",
                 text: "",
                 confirmButtonColor: "#222222",
                 icon: "success"
             });
         }
     });



 }


document.getElementById('form').addEventListener('submit', function (e) {
    //e.preventDefault();    // Obtener datos del formulario
    var idCalendario = document.getElementById('idCalendario').value;
    var eventoEditar = document.getElementById('eventoModal').value;
    var fechaInicioEditar = document.getElementById('fechaInicioModal').value;

    var fechaFinEditar = document.getElementById('fechaFinModal').value;

    if (!eventoEditar || !fechaInicioEditar || !fechaFinEditar) {
        // Mostrar mensaje de error o realizar alguna acción
        Swal.fire("Por favor, complete todos los campos obligatorios.");
        return;
    }

    if (idCalendario == "") {
        var url = 'index.php?c=Calendario&a=guardarCalendario';
        var data = new FormData();
        data.append('idCalendario', idCalendario);
        data.append('eventoModal', eventoEditar);
        data.append('fechaInicioModal', fechaInicioEditar);
        data.append('fechaFinModal', fechaFinEditar);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Manejar la respuesta si es necesario
                Swal.fire("Se Registro con éxito");
                mostrarCalendarioAjax();
                document.getElementById("cerrar").click();
            }
        };
        xhr.send(data);

    } else {
        // Hacer una petición AJAX para actualizar la pregunta
        var url = 'index.php?c=Calendario&a=calendarioEditar';
        var data = new FormData();

        data.append('idCalendario', idCalendario);
        data.append('eventoModal', eventoEditar);
        data.append('fechaInicioModal', fechaInicioEditar);
        data.append('fechaFinModal', fechaFinEditar);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Manejar la respuesta si es necesario

                Swal.fire("Se Actualizo con éxito");
                document.getElementById('eventoModal').value = "";
                document.getElementById('fechaInicioModal').value = "";
                document.getElementById('fechaFinModal').value = "";
                document.getElementById('idCalendario').value = "";
                mostrarCalendarioAjax();
                document.getElementById("cerrar").click();
            }
        };
        xhr.send(data);
    }
});





