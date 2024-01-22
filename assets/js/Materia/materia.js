mostrarMateriasAjax();

function consultarDatosAjaxAsignados() {
    var buscar = document.getElementById("buscarEvento").value;
    var url = "index.php?c=Admin&a=consultarMateria&buscar=" + buscar;
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
                resultados += '   <td class="nombre d-none d-lg-table-cell">' + users.nombre_materia + '</td>';
                resultados += ' <td class="botones"><a href="#" onclick="eliminarDatosAjaxAdmin(' + users.id_materia + ')" class="btn btn-danger mr-2 mb-2"><i class="bi bi-trash"></i></a> ';
                resultados += ' <button type="button"  data-bs-toggle="modal" data-bs-target="#basicModalRegistrar" onclick="abrirModalConDatos(\'' + users.nombre_materia + '\',\'' + users.id_materia + '\')" class="btn btn-dark mr-2 mb-2"><i class="bi bi-pencil"></i></</button></td></tr >';
       }
            document.getElementById('datosMateria').innerHTML = resultados;
        }
    }

}

function mostrarMateriasAjax() {
    var url = "index.php?c=Admin&a=mostrarDatosAjaxMateria";
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
                resultados += '   <td class="nombre d-none d-lg-table-cell">' + users.nombre_materia + '</td>';
                resultados += ' <td class="botones"><a href="#" onclick="eliminarDatosAjaxAdmin(' + users.id_materia + ')" class="btn btn-danger mr-2 mb-2"><i class="bi bi-trash"></i></a> ';
                resultados += ' <button type="button"  data-bs-toggle="modal" data-bs-target="#basicModalRegistrar" onclick="abrirModalConDatos(\'' + users.nombre_materia+ '\',\'' + users.id_materia + '\')" class="btn btn-dark mr-2 mb-2"><i class="bi bi-pencil"></i></</button></td></tr >';
            }
            document.getElementById('datosMateria').innerHTML = resultados;
        }
    }
}


function abrirModalConDatos(mat, id) {
    document.getElementById('materiaModal').value = mat;
    document.getElementById('idMateria').value = id;
  
}

document.getElementById('cerrar').addEventListener('click', function () {


    document.getElementById('materiaModal').value = "";
    document.getElementById('idMateria').value = "";
});





function eliminarDatosAjaxAdmin(id) {
    Swal.fire({
        title: "¿Está seguro de Eliminar la materia?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#222222",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Aceptar"
    }).then((result) => {
        if (result.isConfirmed) {

            var url = "index.php?c=Admin&a=eliminarMateria&idMateria=" + id;
            var xmlh = new XMLHttpRequest();
            xmlh.open("GET", url, true);
            xmlh.send();
            xmlh.onreadystatechange = function () {
                if (xmlh.readyState === 4 && xmlh.status === 200) {
                    mostrarMateriasAjax();
                }
            }
            Swal.fire({
                title: "Materia Eliminada",
                text: "",
                confirmButtonColor: "#222222",
                icon: "success"
            });
        }
    });



}


document.getElementById('form').addEventListener('submit', function (e) {
    //e.preventDefault();    // Obtener datos del formulario
    var idCalendario = document.getElementById('idMateria').value;
    var eventoEditar = document.getElementById('materiaModal').value;
    
    if (!eventoEditar) {
        // Mostrar mensaje de error o realizar alguna acción
        Swal.fire("Por favor, complete todos los campos obligatorios.");
        return;
    }

    if (idCalendario == "") {
        var url = 'index.php?c=Admin&a=guardarMateria';
        var data = new FormData();
        data.append('idMateria', idCalendario);
        data.append('materiaModal', eventoEditar);
        
        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Manejar la respuesta si es necesario
                Swal.fire("Se Registro con éxito");
                mostrarMateriasAjax();
                document.getElementById("cerrar").click();
            }
        };
        xhr.send(data);

    } else {
        // Hacer una petición AJAX para actualizar la pregunta
        var url = 'index.php?c=Admin&a=materiaEditar';
        var data = new FormData();

        data.append('idMateria', idCalendario);
        data.append('materiaModal', eventoEditar);
      
        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Manejar la respuesta si es necesario

                Swal.fire("Se Actualizo con éxito");
                document.getElementById('idMateria').value = "";
                document.getElementById('materiaModal').value = "";
                mostrarMateriasAjax();
                document.getElementById("cerrar").click();
            }
        };
        xhr.send(data);
    }
});





