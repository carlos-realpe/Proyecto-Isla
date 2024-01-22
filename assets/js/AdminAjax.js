
/***********************************TRABAJO CON AJAX********************************************************* */
mostrarDatosAjaxAdmin();
function eliminarDatosAjaxAdmin(idUserAdmin) {

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

              var url = "index.php?c=Admin&a=eliminarDatosAjaxAdmin&idUserAdmin=" + idUserAdmin;
              var xmlh = new XMLHttpRequest();
              xmlh.open("GET", url, true);
              xmlh.send();
              xmlh.onreadystatechange = function () {
                  if (xmlh.readyState === 4 && xmlh.status === 200) {
                      mostrarDatosAjaxAdmin();
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




function mostrarDatosAjaxAdmin() {
    var url = "index.php?c=Admin&a=mostrarDatosAjaxAdmin";
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
                resultados += '   <td class="nombre d-none d-lg-table-cell">' + users.primer_nombre + '</td>';
                resultados += '  <td class="apellido d-none d-lg-table-cell">' + users.primer_apellido + '</td>';
                resultados += ' <td class="estado d-none d-lg-table-cell">' + estado + '</td>';
                resultados += ' <td class="email">' + users.email + '</td>';
                resultados += ' <td class="botones"><a href="#" onclick="eliminarDatosAjaxAdmin(' + users.id_usuario + ')" class="btn btn-danger mr-2 mb-2"><i class="bi bi-trash"></i></a> <a href="index.php?c=Admin&a=editarMostrarDatosAdmin&idAdmin=' + users.id_usuario +'" class="btn btn-dark mr-2 mb-2"><i class="bi bi-pencil"></i></</a></td></tr >';
            }
            document.getElementById('datosAdmins').innerHTML = resultados;
        }
    }
}

function consultarDatosAjaxAdmin() {
    buscarCorreo
    var buscar= document.getElementById("buscarCorreo").value;
    var url = "index.php?c=Admin&a=consultarDatosAjaxAdmin&buscar="+buscar;
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
                resultados += '   <td class="nombre d-none d-lg-table-cell">' + users.primer_nombre + '</td>';
                resultados += '  <td class="apellido d-none d-lg-table-cell">' + users.primer_apellido + '</td>';
                resultados += ' <td class="estado d-none d-lg-table-cell">' + estado + '</td>';
                resultados += ' <td class="email">' + users.email + '</td>';
                resultados += ' <td class="botones"><a href="#" onclick="eliminarDatosAjaxAdmin(' + users.id_usuario +')" class="btn btn-danger mr-2 mb-2"><i class="bi bi-trash"></i></a> <a href="index.php?c=Admin&a=editarMostrarDatosAdmin&idAdmin='+users.id_usuario+'" class="btn btn-dark mr-2 mb-2"><i class="bi bi-pencil"></i></</a></td></tr >';
            }
            document.getElementById('datosAdmins').innerHTML = resultados;
        }
    }




    



}