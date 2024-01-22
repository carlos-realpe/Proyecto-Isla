<?php
require_once 'models/EstudianteModel.php';
session_start();


class EstudianteController
{
    private $model;
    /*Constructor*/
    public function __construct()
    {
        $this->model = new EstudianteModel(); /*Crea al un objeto  */
    }
    public function VistaEstudiante()
    {
        if (isset($_SESSION['login']) && $_SESSION["rol"] == "admin" && $_SESSION["login"] == true) {
            require_once 'Views/Admin/AdminEstudiante.php';
        } else {
            require_once 'views/error403.php';
        }
    }


    public function VistaRegistrarEstudiante()
    {
        if (isset($_SESSION['login']) && $_SESSION["rol"] == "admin" && $_SESSION["login"] == true) {
            require_once 'views/Admin/AdminEstudianteRegistrar.php';
        } else {
            require_once 'views/error403.php';
        }

    }


    public function RegistrarEstudiante()
    {

        $validador = false;
        $emailValidar = htmlentities($_POST['email']);
        $primerNombre = htmlentities($_POST['primerNombre']); ////////////********
        $segundoNombre = htmlentities($_POST['segundoNombre']);
        $primerApellido = htmlentities($_POST['primerApellido']);
        $segundoApellido = htmlentities($_POST['segundoApellido']);
        $pass = htmlentities($_POST['password']);
        $cedula = htmlentities($_POST['cedula']);
        /*Valida la insercion de correo */
        $email = $this->model->consultarCorreo($emailValidar);
        if (isset($email)) {
            $validador = true;
            require_once 'views/Admin/AdminEstudianteRegistrar.php';
        } else {
            /* DATOS DEL Estduiante */
            $grado = htmlentities($_POST['grado']);
            $telefono = htmlentities($_POST['telefono']);
            /* Datos del Representante */
            $primerNombreR = htmlentities($_POST['primerNombreR']); ////////////********
            $segundoNombreR = htmlentities($_POST['segundoNombreR']);
            $primerApellidoR = htmlentities($_POST['primerApellidoR']);
            $segundoApellidoR = htmlentities($_POST['segundoApellidoR']);
            $telefonoR = htmlentities($_POST['telefonoR']);
            $emailR = htmlentities($_POST['emailR']);
            $telefonoOtroR = htmlentities($_POST['telefonoOtroR']);

            $rol = "estudiante";
            /* IMAGEN */

            $url = "assets/institucion/Estudiante/ImagenPerfil/" . $emailValidar . "/";

            // Verifica si el directorio existe, y si no, créalo
            if (!file_exists($url)) {
                mkdir($url, 0777, true); // El tercer parámetro `true` crea directorios anidados si es necesario
            }

            $foto = "";

            // Verifica si es archivo es null 
            if (basename($_FILES['imagenFile']['name']) == null) {
                $foto = "assets/institucion/perfil/perfil.jpg";

            } else {
                $foto = $url . "perfil.jpg";
                // Mueve el archivo al directorio destino
                if (move_uploaded_file($_FILES['imagenFile']['tmp_name'], $foto)) {
                    $msj = htmlspecialchars(basename($_FILES["imagenFile"]["name"]));
                } else {
                    // Mansaje el caso en que no se pueda mover el archivo
                    $msj = "Error al subir el archivo.";
                }

            }

            $validador = $this->model->RegistrarEstudiante($emailValidar, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $pass, $cedula, $rol, $foto, $grado, $telefono, $primerNombreR, $segundoNombreR, $primerApellidoR, $segundoApellidoR, $telefonoR, $emailR, $telefonoOtroR);
            if ($validador == true) {
                $exito = true;
                require_once 'views/Admin/AdminEstudianteRegistrar.php';
            } else {
                $exito = false;
                require_once 'views/Admin/AdminEstudianteRegistrar.php';
            }
            //  header("Location: index.php?c=Admin&a=VistaRegistrarAdmin"); /* introduce este codigo  */
        }
















    }
    /* AJAX*/
    public function consultarCorreo()
    {
        $email = $_GET['email'];
        $resultado = $this->model->consultarCorreo($email);
        echo json_encode($resultado);

    }
    public function mostrarDatosAjaxEstudiante()
    {
        $resultado = $this->model->mostrarDatosAjaxEstudiante();
        echo json_encode($resultado);
    }
    public function consultarDatosAjaxEstudiante()
    {
        $buscar = $_GET['buscar'];
        $resultado = $this->model->consultarDatosAjaxEstudiante($buscar);
        echo json_encode($resultado);
    }

    public function eliminarDatosAjaxEstudiante()
    {
        $idUserAdmin = htmlentities($_GET['idUserAdmin']);

        $this->model->eliminarDatosAjaxEstudiante($idUserAdmin);
    }

    /*Editar*/
    public function editarMostrarDatosEstudiante()
    {
        $idAdmin = $_GET["idAdmin"];
       $resultados = $this->model->editarMostrarDatosEstudiante($idAdmin);
        require_once 'views/Admin/AdminEstudianteEditar.php';
    }

    public function editarGuardarMostrarDatosEstudiante(){
        $validador = false;
        $idAdmin = $_GET["idAdmin"];
        $emailValidar = htmlentities($_POST['email']);
        $primerNombre = htmlentities($_POST['primerNombre']); ////////////********
        $segundoNombre = htmlentities($_POST['segundoNombre']);
        $primerApellido = htmlentities($_POST['primerApellido']);
        $segundoApellido = htmlentities($_POST['segundoApellido']);
        $pass = htmlentities($_POST['password']);
        $cedula = htmlentities($_POST['cedula']);
        /*Valida la insercion de correo */
        if ($_SESSION["correoTemp"] != $emailValidar) {
           $email = $this->model->consultarCorreo($emailValidar);
      }

        if (isset($email)) {
            $validador = true;
            require_once 'views/Admin/AdminEstudianteEditar.php&idAdmin=' . $idAdmin;
        } else {
            /* DATOS DEL Estduiante */
            $grado = htmlentities($_POST['grado']);
            $telefono = htmlentities($_POST['telefono']);
            /* DATOS DEL REPRESENTANTE */
            $primerNombreR = htmlentities($_POST['primerNombreR']); ////////////********
            $segundoNombreR = htmlentities($_POST['segundoNombreR']);
            $primerApellidoR = htmlentities($_POST['primerApellidoR']);
            $segundoApellidoR = htmlentities($_POST['segundoApellidoR']);
            $telefonoR = htmlentities($_POST['telefonoR']);
            $emailR = htmlentities($_POST['emailR']);
            $telefonoOtroR = htmlentities($_POST['telefonoOtroR']);
            $idRepresentante = htmlentities($_POST['idRepresentante']);


            $rol = "estudiante";
            $foto = "";

            /************************************ ARCHIVO DE IMAGEN************************** */

            $url = "assets/institucion/Estudiante/ImagenPerfil/" . $_SESSION["correoTemp"] . "/";
            $foto = $url;
            // Verificar si el directorio actual existe.
            if (file_exists($url)) {
                $urlNuevo = "assets/institucion/Estudiante/ImagenPerfil/" . $emailValidar . "/";
                rename($url, $urlNuevo);  // renombra el direcotrio
                if (!file_exists($urlNuevo)) {
                    $foto = "assets/institucion/perfil/perfil.jpg";
                } else {
                    $foto = $urlNuevo . "perfil.jpg";
                    // Mueve el archivo al directorio destino
                    if (move_uploaded_file($_FILES['imagenFile']['tmp_name'], $foto)) {
                        $msj = htmlspecialchars(basename($_FILES["imagenFile"]["name"]));
                    } else {
                        // Mansaje el caso en que no se pueda mover el archivo
                        $msj = "Error al subir el archivo.";
                    }
                }
            } else {
                // El directorio actual no existe, manejar según sea necesario      
                if (basename($_FILES['imagenFile']['name']) == null) {
                    $foto = "assets/institucion/perfil/perfil.jpg";

                } else {
                    mkdir($url, 0777, true);
                    $foto = $url . "perfil.jpg";
                    move_uploaded_file($_FILES['imagenFile']['tmp_name'], $foto);

                }
            }
            /************************************ FIN DE ARCHIVO DE IMAGEN************************** */

            // Verifica si es archivo es null 
            $validador = $this->model->editarGuardarMostrarDatosEstudiante($idRepresentante,$idAdmin, $emailValidar, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $pass, $cedula, $rol, $foto, $grado, $telefono, $primerNombreR, $segundoNombreR, $primerApellidoR, $segundoApellidoR, $telefonoR, $emailR, $telefonoOtroR);
           
            if ($validador == true) {
                $exito = true;

                header("Location: index.php?c=Estudiante&a=editarMostrarDatosEstudiante&idAdmin=" . $_GET["idAdmin"] . "&mensaje=" . $exito );
            } else {
                $exito = false;
                header("Location: index.php?c=Estudiante&a=editarMostrarDatosEstudiante&idAdmin=" . $_GET["idAdmin"] . "&mensaje=" . $exito);

            }
        }



    }




}