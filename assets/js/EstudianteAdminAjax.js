mostrarDatosAjaxEstudiante();

function eliminarDatosAjaxEstudiante(idUserAdmin) {

    Swal.fire({
        title: "¿Está seguro de Eliminar al Usuario?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#222222",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Aceptar"
    }).then((result) => {
        if (result.isConfirmed) {

            var url = "index.php?c=Estudiante&a=eliminarDatosAjaxEstudiante&idUserAdmin=" + idUserAdmin;
            var xmlh = new XMLHttpRequest();
            xmlh.open("GET", url, true);
            xmlh.send();
            xmlh.onreadystatechange = function () {
                if (xmlh.readyState === 4 && xmlh.status === 200) {
                    mostrarDatosAjaxEstudiante();
                }
            }
            Swal.fire({
                title: "Usuario Eliminado",
                text: "",
                confirmButtonColor: "#222222",
                icon: "success"
            });
        }
    });


}



function mostrarDatosAjaxEstudiante() {
    var url = "index.php?c=Estudiante&a=mostrarDatosAjaxEstudiante";
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
                resultados += '   <td class="nombre d-none d-lg-table-cell">' + users.primer_nombre + '</td>';
                resultados += '  <td class="apellido d-none d-lg-table-cell">' + users.primer_apellido + '</td>';
                resultados += ' <td class="estado d-none d-lg-table-cell">' + users.grado + '</td>';
                resultados += ' <td class="email">' + users.email + '</td>';
                resultados += ' <td class="botones"><a href="#" onclick="eliminarDatosAjaxEstudiante(' + users.id_usuario + ')" class="btn btn-danger mr-2 mb-2"><i class="bi bi-trash"></i></a> <a href="index.php?c=Estudiante&a=editarMostrarDatosEstudiante&idAdmin=' + users.id_usuario + '" class="btn btn-dark mr-2 mb-2"><i class="bi bi-pencil"></i></</a></td></tr >';
            }
            document.getElementById('datosEstudiante').innerHTML = resultados;
        }
    }    
}


function consultarDatosAjaxEstudiante() {
    buscarCorreo
    var buscar = document.getElementById("buscarCorreo").value;
    var url = "index.php?c=Estudiante&a=consultarDatosAjaxEstudiante&buscar=" + buscar;
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
                resultados += '   <td class="nombre d-none d-lg-table-cell">' + users.primer_nombre + '</td>';
                resultados += '  <td class="apellido d-none d-lg-table-cell">' + users.primer_apellido + '</td>';
                resultados += ' <td class="estado d-none d-lg-table-cell">' + users.grado + '</td>';
                resultados += ' <td class="email">' + users.email + '</td>';
                resultados += ' <td class="botones"><a href="#" onclick="eliminarDatosAjaxEstudiante(' + users.id_usuario + ')" class="btn btn-danger mr-2 mb-2"><i class="bi bi-trash"></i></a> <a href="index.php?c=Estudiante&a=editarMostrarDatosEstudiante&idAdmin=' + users.id_usuario + '" class="btn btn-dark mr-2 mb-2"><i class="bi bi-pencil"></i></</a></td></tr >';
            }
            document.getElementById('datosEstudiante').innerHTML = resultados;
        }
    }

}

