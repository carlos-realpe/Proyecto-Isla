


/* VALIDADOR DE FORMULARIO ADMIN */
const camposV = {
    primerNombre: false,
    segundoNombre: false,
    primerApellido: false,
    segundoApellido: false,
    password: false,
    passwordConfirmar: false,
    cedula: false,

    /* Variables de docente*/
    telefono: false,
    materia:false,
    titulo:false,


    /*Variables Curso */
 nombreCurso: false,

}
/* Validacion por Primer Nombre */
if (document.getElementById('primerNombre')) {
    var primerNombre = document.getElementById('primerNombre');   /** se obtiene el elemento id de primerNombre */
    primerNombre.addEventListener('keyup', (e) => {  /* se crea evento keyUp cada que presione y suelte una tecla*/
        if (primerNombre.value.length <= 20) {   /* valida la cantidad de caracteres*/
            camposV.primerNombre = true;
            mensajeOcultar("primerNombre", primerNombre);  /*llama a dicha funcion */
        } else {
            camposV.primerNombre = false;
            mensajeMostrar("primerNombre", primerNombre);
        }
    });
    primerNombre.addEventListener('keypress', (e) => {  /* cada se presione una tecla*/
        const key = e.key;
        const letra = /[^A-Za-z\s]$/.test(key);  /*valida solo caracteres*/
        if (letra) {
            e.preventDefault();
        }
    });
}
/* Validacion por Segundo Nombre */

var segundoNombre = document.getElementById('segundoNombre');
segundoNombre.addEventListener('keyup', (e) => {
    if (segundoNombre.value.length <= 20) {
        camposV.segundoNombre = true;
        mensajeOcultar("segundoNombre", segundoNombre);
    } else {
        camposV.segundoNombre = false;
        mensajeMostrar("segundoNombre", segundoNombre);
    }
});
segundoNombre.addEventListener('keypress', (e) => {
    const key = e.key;
    const letra = /[^A-Za-z\s]$/.test(key);
    if (letra) {
        e.preventDefault();
    }

});


/* Validacion por Primer Apellido */
var primerApellido = document.getElementById('primerApellido');
primerApellido.addEventListener('keyup', (e) => {
    if (primerApellido.value.length <= 20) {
        camposV.primerApellido = true;
        mensajeOcultar("primerApellido", primerApellido);
    } else {
        camposV.primerApellido = false;
        mensajeMostrar("primerApellido", primerApellido);
    }
});
primerApellido.addEventListener('keypress', (e) => {
    const key = e.key;
    const letra = /[^A-Za-z\s]$/.test(key);
    if (letra) {
        e.preventDefault();
    }
});
/* Validacion por Segundo Apellido */
var segundoApellido = document.getElementById('segundoApellido');
segundoApellido.addEventListener('keyup', (e) => {
    if (segundoApellido.value.length <= 20) {
        camposV.segundoApellido = true;
        mensajeOcultar("segundoApellido", segundoApellido);
    } else {
        camposV.segundoApellido = false;
        mensajeMostrar("segundoApellido", segundoApellido);
    }
});
segundoApellido.addEventListener('keypress', (e) => {
    const key = e.key;
    const letra = /[^A-Za-z\s]$/.test(key);
    if (letra) {
        e.preventDefault();
    }
});

/*Validacionde contraseña */


document.getElementById("password").addEventListener('keyup', (e) => {
    if (document.getElementById("password").value.length > 6) {
        camposV.password = true;
        mensajeOcultar("password", document.getElementById("password"));
    } else {
        camposV.password = false;
        mensajeMostrar("password", document.getElementById("password"));
    }

});

document.getElementById("passwordConfirmar").addEventListener('keyup', (e) => {
    contraseñacomparar();
});

function contraseñacomparar() {
    if (document.getElementById("passwordConfirmar").value == document.getElementById("password").value) {
        camposV.passwordConfirmar = true;
        mensajeOcultar("passwordConfirmar", document.getElementById("passwordConfirmar"));
    } else {
        camposV.passwordConfirmar = false;

        mensajeMostrar("passwordConfirmar", document.getElementById("passwordConfirmar"));
    }
}
/* Validacion de numero de cedula */

document.getElementById("cedula").addEventListener("keypress", (e) => {
    const key = e.key;
    const isDigit = /^\d$/.test(key);
    if (!isDigit) {
        e.preventDefault();
    }
    document.getElementById("cedula").addEventListener('keyup', (e) => {
        if (document.getElementById("cedula").value.length == 10) {
            camposV.cedula = true;
            mensajeOcultar("cedula", document.getElementById("cedula"));
        } else {
            camposV.cedula = false;
            mensajeMostrar("cedula", document.getElementById("cedula"));
        }


    });
});

/* Validar el correo */

function emailExiste() {
    var email = document.getElementById("email");
    var url = "index.php?c=Admin&a=consultarCorreo&email=" + email.value;
    var xmlh = new XMLHttpRequest();
    xmlh.open("GET", url, true);
    xmlh.send();

    xmlh.onreadystatechange = function () {

        if (xmlh.readyState === 4 && xmlh.status === 200) {
            var respuesta = xmlh.responseText;
            var validador = JSON.parse(respuesta);
            if (validador != null) {
                camposV.correo = false;
                mensajeMostrar("email", email);
                document.getElementById("editarG").disabled = true;

            } else {
                camposV.correo = true;
                mensajeOcultar("email", email);
                document.getElementById("editarG").disabled = true;


            }
        }
    }

}


function ValidarRegistroAdminEdit() {
    var resultado = true;
    if (camposV.primerNombre && camposV.segundoNombre && camposV.primerApellido && camposV.segundoApellido && camposV.cedula && camposV.password && camposV.passwordConfirmar) {
        resultado = false;
    } else {
        resultado = true;
    }
    return resultado;
}

/*    VALIDACION PARA QUE COONFIRME EL FORMULARIO        */
function ValidarRegistroAdmin() {
    var resultado = true;
    if (camposV.primerNombre && camposV.segundoNombre && camposV.primerApellido && camposV.segundoApellido && camposV.cedula && camposV.password && camposV.passwordConfirmar && camposV.cedula) {
        resultado = true;

    } else {
        resultado = false;
    }
    return resultado;
}


/*    VALIDACION PARA QUE COONFIRME EL FORMULARIO de docente        */


/* Validacion de materia */
var materia = document.getElementById('materia');   /** se obtiene el elemento id de primerNombre */
materia.addEventListener('keyup', (e) => {  /* se crea evento keyUp cada que presione y suelte una tecla*/
    if (materia.value.length <= 30) {   /* valida la cantidad de caracteres*/
        camposV.materia = true;
        mensajeOcultar("materia", materia);  /*llama a dicha funcion */
    } else {
        camposV.materia = false;
        mensajeMostrar("materia", materia);
    }
});
materia.addEventListener('keypress', (e) => {  /* cada se presione una tecla*/
    const key = e.key;
    const letra = /[^A-Za-z\s]$/.test(key);  /*valida solo caracteres*/
    if (letra) {
        e.preventDefault();
    }
});

/* Validacion de titulo */
var titulo = document.getElementById('titulo');   /** se obtiene el elemento id de primerNombre */
titulo.addEventListener('keyup', (e) => {  /* se crea evento keyUp cada que presione y suelte una tecla*/
    if (titulo.value.length <= 30) {   /* valida la cantidad de caracteres*/
        camposV.titulo = true;
        mensajeOcultar("titulo", titulo);  /*llama a dicha funcion */
    } else {
        camposV.titulo = false;
        mensajeMostrar("titulo", titulo);
    }
});
titulo.addEventListener('keypress', (e) => {  /* cada se presione una tecla*/
    const key = e.key;
    const letra = /[^A-Za-z\s]$/.test(key);  /*valida solo caracteres*/
    if (letra) {
        e.preventDefault();
    }
});
/* Validacion de telefono movil */

document.getElementById("telefono").addEventListener("keypress", (e) => {
    const key = e.key;
    const isDigit = /^\d$/.test(key);
    if (!isDigit) {
        e.preventDefault();
    }
    document.getElementById("telefono").addEventListener('keyup', (e) => {
        if (document.getElementById("telefono").value.length == 10) {
            camposV.telefono = true;
            mensajeOcultar("telefono", document.getElementById("telefono"));
        } else {
            camposV.telefono = false;
            mensajeMostrar("telefono", document.getElementById("telefono"));
        }

    });
});








function ValidarRegistroDocente() {
    var resultado = true;
    if (camposV.telefono && camposV.titulo && camposV.materia && camposV.primerNombre && camposV.segundoNombre && camposV.primerApellido && camposV.segundoApellido && camposV.cedula && camposV.password && camposV.passwordConfirmar && camposV.cedula) {
        resultado = true;

    } else {
        resultado = false;
    }
    return resultado;
}
function ValidarEditarDocente (){
    var resultado = true;
    if (camposV.telefono && camposV.titulo && camposV.materia && camposV.primerNombre && camposV.segundoNombre && camposV.primerApellido && camposV.segundoApellido && camposV.cedula && camposV.password && camposV.passwordConfirmar && camposV.cedula) {
        resultado = false;
    } else {
        resultado = true;
    }
    return resultado;


}


/*PERFIL */

function ValidarUsuarioEdit() {
    var resultado = true;
    if (camposV.primerNombre && camposV.segundoNombre && camposV.primerApellido && camposV.segundoApellido && camposV.cedula && camposV.password && camposV.passwordConfirmar) {
        resultado = false;

    } else {
        resultado = true;
    }
    return resultado;

}
function ValidarRegistroCurso(){
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














