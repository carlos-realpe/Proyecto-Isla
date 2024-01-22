
mostrarDatosAjaxCursos();



function consultarDatosAjaxCurso() {
    var buscar = document.getElementById("buscarCorreo").value;
    var selectBuscar = document.getElementById("grado").value;
    var url = "index.php?c=Admin&a=consultarDatosAjaxCurso&buscar=" + buscar +"&indice="+selectBuscar;
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
                resultados += '   <td class="nombre d-none d-lg-table-cell">' + users.nombre_curso + '</td>';
                resultados += '  <td class="apellido d-none d-lg-table-cell">' + users.paralelo + '</td>';
                resultados += ' <td class="email">' + users.grado + '</td>';
                resultados += ' <td class="botones"><a href="#" onclick="eliminarDatosAjaxCurso(' + users.id_curso + ')" class="btn btn-danger mr-2 mb-2"><i class="bi bi-trash"></i></a> <a href="index.php?c=Admin&a=editarMostrarDatosCurso&idAdmin=' + users.id_curso + '" class="btn btn-dark mr-2 mb-2"><i class="bi bi-pencil"></i></</a></td></tr >';
            }
            document.getElementById('datosCursos').innerHTML = resultados;
        }
    }
}

function mostrarDatosAjaxCursos() {
    var url = "index.php?c=Admin&a=mostrarDatosAjaxCursos";
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
                resultados += '   <td class="nombre d-none d-lg-table-cell">' + users.nombre_curso + '</td>';
                resultados += '  <td class="apellido d-none d-lg-table-cell">' + users.paralelo + '</td>';
                resultados += ' <td class="email">' + users.grado + '</td>';
                resultados += ' <td class="botones"><a href="#" onclick="eliminarDatosAjaxCurso(' + users.id_curso + ')" class="btn btn-danger mr-2 mb-2"><i class="bi bi-trash"></i></a> <a href="index.php?c=Admin&a=editarMostrarDatosCurso&idAdmin=' + users.id_curso + '" class="btn btn-dark mr-2 mb-2"><i class="bi bi-pencil"></i></</a></td></tr >';
            }
            document.getElementById('datosCursos').innerHTML = resultados;
        }
    }
}


function eliminarDatosAjaxCurso(idUser) {

    Swal.fire({
        title: "¿Está seguro de Eliminar el Curso?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#222222",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Aceptar"
    }).then((result) => {
        if (result.isConfirmed) {

            var url = "index.php?c=Admin&a=eliminarDatosAjaxCurso&idUserAdmin=" + idUser;
            var xmlh = new XMLHttpRequest();
            xmlh.open("GET", url, true);
            xmlh.send();
            xmlh.onreadystatechange = function () {
                if (xmlh.readyState === 4 && xmlh.status === 200) {
                    mostrarDatosAjaxCursos();
                }
            }
            Swal.fire({
                title: "Curso Eliminado",
                text: "",
                confirmButtonColor: "#222222",
                icon: "success"
            });
        }
    });


}

