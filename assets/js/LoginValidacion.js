/* VALIDADOR DE FORMULARIO LOGIN */
const camposV = {
    correo: false,
    password: false,
}

/* email y password null */
document.getElementById('miFormulario').addEventListener('submit', function (event) {
    // Evita que se realice la acción predeterminada de enviar el formulario
  

    // Tu lógica aquí
    if (document.getElementById('email').value !== '') {
        camposV.correo = true;
        mensajeOcultar("emailNull", document.getElementById("emailNull"));
     // Puedes agregar más código aquí para manejar la condición deseada.
    } else {
        event.preventDefault();
        camposV.correo = false;
        mensajeMostrar("emailNull", document.getElementById("emailNull"));
    // Puedes agregar más código aquí para manejar la condición deseada.
    }
    if (document.getElementById('password').value !== '') {
        camposV.password = true;
        mensajeOcultar("passwordNull", document.getElementById("password"));
        // Puedes agregar más código aquí para manejar la condición deseada.
    } else {
        event.preventDefault();
        camposV.password = false;
        mensajeMostrar("passwordNull", document.getElementById("password"));
        // Puedes agregar más código aquí para manejar la condición deseada.
    }
   



    // Puedes agregar más código aquí para realizar acciones después de validar el formulario.
});

/* Correo */
function usuarioExiste() {
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var url = "index.php?c=Login&a=consultarCorreo&email=" + email.value;
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

            } else {
                camposV.correo = true;
                mensajeOcultar("email", email);

            }
        }
    }

}


/* mensajes */

function mensajeOcultar(cadenaM, elemento) {
    document.getElementById("lbl-" + cadenaM).style.display = "none";
}
function mensajeMostrar(cadenaM, elemento) {
    document.getElementById("lbl-" + cadenaM).style.display = "block";
}


/* Funcion */
function ValidarLogin() {
  //  console.log("correo-->" + camposV.correo + ";:sss-_>" + document.getElementById('email').value );
 //  console.log("pass-->"+camposV.password);
    var resultado = true;
    if (camposV.correo && camposV.password) {
        console.log("Exito");
        formulario.submit();
        resultado = false;
    } else {
        console.log("fracaso");
        resultado = true;
    }
    console.log(resultado);
    return true;
}
