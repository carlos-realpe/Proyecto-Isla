

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
    /* Variables del Representante*/
    primerNombreR: false,
    segundoNombreR: false,
    primerApellidoR: false,
    segundoApellidoR: false,
    telefonoR: false,
    telefonoOtroR: false,
   

}
/********************************DATOS DEL ESTUDIANTE********************************** */
/* Validacion por Primer Nombre */

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



/*    VALIDACION PARA QUE COONFIRME EL FORMULARIO de ESTUDIANTE        */




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




/********************************DATOS DEL REPRESENTANTE********************************** */
/* Validacion por Primer Nombre */

var primerNombreR = document.getElementById('primerNombreR');   /** se obtiene el elemento id de primerNombre */
primerNombreR.addEventListener('keyup', (e) => {  /* se crea evento keyUp cada que presione y suelte una tecla*/
    if (primerNombreR.value.length <= 20) {   /* valida la cantidad de caracteres*/
        camposV.primerNombreR = true;
        mensajeOcultar("primerNombreR", primerNombreR);  /*llama a dicha funcion */
    } else {
        camposV.primerNombreR = false;
        mensajeMostrar("primerNombreR", primerNombreR);
    }
});
primerNombreR.addEventListener('keypress', (e) => {  /* cada se presione una tecla*/
    const key = e.key;
    const letra = /[^A-Za-z\s]$/.test(key);  /*valida solo caracteres*/
    if (letra) {
        e.preventDefault();
    }
});
/* Validacion por Segundo Nombre */

var segundoNombreR = document.getElementById('segundoNombreR');
segundoNombreR.addEventListener('keyup', (e) => {
    if (segundoNombreR.value.length <= 20) {
        camposV.segundoNombreR = true;
        mensajeOcultar("segundoNombreR", segundoNombreR);
    } else {
        camposV.segundoNombreR = false;
        mensajeMostrar("segundoNombreR", segundoNombreR);
    }
});
segundoNombreR.addEventListener('keypress', (e) => {
    const key = e.key;
    const letra = /[^A-Za-z\s]$/.test(key);
    if (letra) {
        e.preventDefault();
    }

});


/* Validacion por Primer Apellido */
var primerApellidoR = document.getElementById('primerApellidoR');
primerApellidoR.addEventListener('keyup', (e) => {
    if (primerApellidoR.value.length <= 20) {
        camposV.primerApellidoR = true;
        mensajeOcultar("primerApellidoR", primerApellidoR);
    } else {
        camposV.primerApellidoR = false;
        mensajeMostrar("primerApellidoR", primerApellidoR);
    }
});
primerApellidoR.addEventListener('keypress', (e) => {
    const key = e.key;
    const letra = /[^A-Za-z\s]$/.test(key);
    if (letra) {
        e.preventDefault();
    }
});
/* Validacion por Segundo Apellido */
var segundoApellidoR = document.getElementById('segundoApellidoR');
segundoApellidoR.addEventListener('keyup', (e) => {
    if (segundoApellidoR.value.length <= 20) {
        camposV.segundoApellidoR = true;
        mensajeOcultar("segundoApellidoR", segundoApellidoR);
    } else {
        camposV.segundoApellidoR = false;
        mensajeMostrar("segundoApellidoR", segundoApellidoR);
    }
});
segundoApellidoR.addEventListener('keypress', (e) => {
    const key = e.key;
    const letra = /[^A-Za-z\s]$/.test(key);
    if (letra) {
        e.preventDefault();
    }
});

document.getElementById("telefonoR").addEventListener("keypress", (e) => {
    const key = e.key;
    const isDigit = /^\d$/.test(key);
    if (!isDigit) {
        e.preventDefault();
    }
    document.getElementById("telefonoR").addEventListener('keyup', (e) => {
        if (document.getElementById("telefonoR").value.length == 10) {
            camposV.telefonoR = true;
            mensajeOcultar("telefonoR", document.getElementById("telefonoR"));
        } else {
            camposV.telefonoR = false;
            mensajeMostrar("telefonoR", document.getElementById("telefonoR"));
        }

    });
});

document.getElementById("telefonoOtroR").addEventListener("keypress", (e) => {
    const key = e.key;
    const isDigit = /^\d$/.test(key);
    if (!isDigit) {
        e.preventDefault();
    }
   
    document.getElementById("telefonoOtroR").addEventListener('keyup', (e) => {
              if (document.getElementById("telefonoOtroR").value.length == 10) {
           
            camposV.telefonoOtroR = true;
            mensajeOcultar("telefonoOtroR", document.getElementById("telefonoOtroR"));
        } else {
           
            camposV.telefonoOtroR = false;
            mensajeMostrar("telefonoOtroR", document.getElementById("telefonoOtroR"));
        }

    });
});


/*************************************** Validar el correo *******************/

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
                document.getElementById("editarG").disabled=true;

            } else {
                camposV.correo = true;
                mensajeOcultar("email", email);
                document.getElementById("editarG").disabled = false;

            }
        }
    }

}


function ValidarRegistroEstudianteEdit() {
    var resultado = true;
    if (camposV.telefonoOtroR && camposV.telefonoR && camposV.segundoApellidoR && camposV.primerApellido && camposV.segundoNombreR && camposV.primerNombreR && camposV.telefono && camposV.primerNombre && camposV.segundoNombre && camposV.primerApellido && camposV.segundoApellido && camposV.cedula && camposV.password && camposV.passwordConfirmar && camposV.cedula) {
         resultado = false;
    } else {
        resultado = true;
    }
    return resultado;
}

/*    VALIDACION PARA QUE COONFIRME EL FORMULARIO        */
function ValidarRegistroEstudiante() {
    var resultado = true;
    if (camposV.telefonoOtroR && camposV.telefonoR && camposV.segundoApellidoR && camposV.primerApellido && camposV.segundoNombreR && camposV.primerNombreR && camposV.telefono && camposV.primerNombre && camposV.segundoNombre && camposV.primerApellido && camposV.segundoApellido && camposV.cedula && camposV.password && camposV.passwordConfirmar && camposV.cedula) {
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














