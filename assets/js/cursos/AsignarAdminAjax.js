
mostrarDatosAjaxAsignados(); 
function consultarDatosAjaxAsignados() {
    var buscar = document.getElementById("buscarCorreo").value;
    var selectBuscar = document.getElementById("grado").value;
    var url = "index.php?c=Admin&a=consultarDatosAjaxAsignados&buscar=" + buscar + "&indice=" + selectBuscar;
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
                resultados += '   <td class="nombre d-none d-lg-table-cell">' + users.nombre_completo + '</td>';
                resultados += '  <td class="apellido d-none d-lg-table-cell">' + users.nombre_curso + '</td>';
                resultados += ' <td class="email">' + users.nombre_materia + '</td>';
                resultados += ' <td class="email">' + users.grado + '(' + users.paralelo + ')</td>';
                resultados += ' <td class="botones"><a href="#" onclick="eliminarDatosAjaxAsignados(' + users.id_asignar + ')" class="btn btn-danger mr-2 mb-2"><i class="bi bi-trash"></i></a> <a href="index.php?c=Admin&a=editarMostrarDatosAsignados&idAdmin=' + users.id_asignar + '" class="btn btn-dark mr-2 mb-2"><i class="bi bi-pencil"></i></</a></td></tr >';
            }
            document.getElementById('datosCursos').innerHTML = resultados;
        }
    }
}

function mostrarDatosAjaxAsignados() {
    var url = "index.php?c=Admin&a=mostrarDatosAjaxAsignados";
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
                resultados += '<tr> ';
                resultados += '<th style="width:20px;" scope="row">' + contador + '</th> ';
                resultados += '   <td class="nombre d-none d-lg-table-cell">' + users.nombre_completo + '</td>';
                resultados += '  <td class="apellido d-none d-lg-table-cell">' + users.nombre_curso + '</td>';
                resultados += ' <td class="email">' + users.nombre_materia+'</td>';
                resultados += ' <td class="email">' + users.grado + '(' + users.paralelo + ')</td>';
                resultados += ' <td class="botones"><a href="#" onclick="eliminarDatosAjaxAsignados(' + users.id_asignar + ')" class="btn btn-danger mr-2 mb-2"><i class="bi bi-trash"></i></a> <a href="index.php?c=Admin&a=editarMostrarDatosAsignados&idAdmin=' + users.id_asignar + '" class="btn btn-dark mr-2 mb-2"><i class="bi bi-pencil"></i></</a></td></tr >';
            }
            document.getElementById('datosCursos').innerHTML = resultados;
        }
    }
}

function eliminarDatosAjaxAsignados(idAsignar){
    Swal.fire({
        title: "¿Está seguro de Eliminar la Asignacion?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#222222",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Aceptar"
    }).then((result) => {
        if (result.isConfirmed) {

            var url = "index.php?c=Admin&a=eliminarDatosAjaxAsignacion&idAsignar=" + idAsignar;
            var xmlh = new XMLHttpRequest();
            xmlh.open("GET", url, true);
            xmlh.send();
            xmlh.onreadystatechange = function () {
                if (xmlh.readyState === 4 && xmlh.status === 200) {
                    mostrarDatosAjaxAsignados();
                }
            }
            Swal.fire({
                title: "Asignacion Eliminada",
                text: "",
                confirmButtonColor: "#222222",
                icon: "success"
            });
        }
    });


}