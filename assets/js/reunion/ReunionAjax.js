

MostrarReunionAjax();


function MostrarReunionAjax() {

    var url = "index.php?c=Docente&a=mostrarReunionAjax";

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
                resultados += '<div class="col-lg-6">';
                resultados += '<li>';
                resultados += ' <h4><b>Reunion:</b> ' + users.nombre_reunion + '</h4>';

                resultados += '<h4><b>Fecha:</b> ' + users.fecha + '</h4>';
                resultados += '<h4><b>Hora:</b> ' + users.hora + '</h4 >';
                resultados += '<h4><b>Link:</b> '
                resultados += '<a target="_BLANK" href="' + users.enlace + '">Enlace</a>';
                resultados += '</h4></li></div>';
                resultados += '<div class="col-lg-6 d-flex align-items-center">';
               if(rol=="docente"){
                resultados += '<a style="margin:10px;" onclick="eliminarReunionAjax(' + users.id_reunion + ')" href="#" class="btn btn-danger mr-2 mb-2"><i class="bi bi-trash"></i></a>';
                resultados += '<a onclick="abrirModalConDatos(\'' + users.nombre_reunion + '\',\'' + users.fecha + '\',\'' + users.hora + '\',\'' + users.enlace + '\',\'' + users.id_reunion + '\')" data-bs-toggle="modal"  data-bs-target="#basicModal" style="margin:10px;" href="#" class="btn btn-dark mr-2 mb-2"><i class="bi bi-pencil"></i></a>';
               } 
                resultados += ' </div></div><hr>';


            }
            if (resultados.trim() === "") {
                resultados += '<h5>No hay registros de una Reunión</h5>';
            }
            document.getElementById('datoReunion').innerHTML = resultados;
        }
    }

}


function eliminarReunionAjax(id) {
    Swal.fire({
        title: "¿Está seguro de Eliminar la Reunión?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#222222",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Aceptar"
    }).then((result) => {
        if (result.isConfirmed) {

            var url = "index.php?c=Docente&a=eliminarReunionAjax&idReunion=" + id;
            var xmlh = new XMLHttpRequest();
            xmlh.open("GET", url, true);
            xmlh.send();
            xmlh.onreadystatechange = function () {
                if (xmlh.readyState === 4 && xmlh.status === 200) {
                    MostrarReunionAjax();
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

/* Carga del Modal */

function abrirModalConDatos(nombreReunion, fecha, hora, enlace, idReunion) {
    document.getElementById('nombreReunion').value = nombreReunion;
    document.getElementById('fecha').value = fecha;
    document.getElementById('hora').value = hora;
    document.getElementById('enlace').value = enlace;
    document.getElementById('idReunion').value = idReunion;
    $('#basicModal').modal('show'); //Muestra el modal
}