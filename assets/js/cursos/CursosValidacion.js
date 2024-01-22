
const camposV = {
    /*Variables Curso */
    nombreCurso: false,

}

/* Validacion Nombre del Curso */
var nombreCurso = document.getElementById('nombreCurso');
nombreCurso.addEventListener('keyup', (e) => {
    if (nombreCurso.value.length <= 30) {
        camposV.nombreCurso = true;
        mensajeOcultar("nombreCurso", nombreCurso);
    } else {
        camposV.segundoNombre = false;
        mensajeMostrar("nombreCurso", nombreCurso);
    }
});
nombreCurso.addEventListener('keypress', (e) => {
    const key = e.key;
    const letra = /[^A-Za-z\s]$/.test(key);
    if (letra) {
        e.preventDefault();
    }
});


function ValidarRegistroCurso() {
    var resultado = true;
    if (camposV.nombreCurso) {
        resultado = true;

    } else {
        resultado = false;
    }
    return resultado;
}


/* MUESTRA Y OCULTA EL MENSAJE DE LOS ERRORES*/

function mensajeOcultar(cadenaM, elemento) {
    document.getElementById("lbl-" + cadenaM).style.display = "none";
}
function mensajeMostrar(cadenaM, elemento) {
    document.getElementById("lbl-" + cadenaM).style.display = "block";
}
