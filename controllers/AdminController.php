<?php
require_once 'models/AdminModel.php';
session_start();


class AdminController
{
    private $model;
    /*Constructor*/
    public function __construct()
    {
        $this->model = new AdminModel(); /*Crea al un objeto  */
    }
    public function VistaAdmin()
    {
        if (isset($_SESSION['login']) && $_SESSION["rol"] == "admin" && $_SESSION["login"] == true) {
            require_once 'views/Admin/Administradores.php'; /* introduce este codigo  */
        } else {
            require_once 'views/error403.php';
        }
    }
    public function VistaRegistrarAdmin()
    {
        if (isset($_SESSION['login']) && $_SESSION["rol"] == "admin" && $_SESSION["login"] == true) {
            require_once 'views/Admin/AdminsRegistrar.php';
        } else {
            require_once 'views/error403.php';
        }
    }
    public function RegistrarAdmin()
    {
        if (isset($_SESSION['login']) && $_SESSION["rol"] == "admin" && $_SESSION["login"] == true) {
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
                require_once 'views/Admin/AdminsRegistrar.php';
            } else {
                /* DATOS DEL ADMIn */
                $estado = htmlentities($_POST['estado']);
                $rol = "admin";
                /* IMAGEN */

                $url = "assets/institucion/Admin/ImagenPerfil/" . $emailValidar . "/";

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

                $validador = $this->model->RegistrarAdmin($emailValidar, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $pass, $estado, $cedula, $rol, $foto);
                if ($validador == true) {
                    $exito = true;
                    require_once 'views/Admin/AdminsRegistrar.php';
                } else {
                    $exito = false;
                    require_once 'views/Admin/AdminsRegistrar.php';
                }
                //  header("Location: index.php?c=Admin&a=VistaRegistrarAdmin"); /* introduce este codigo  */
            }
        } else {
            require_once 'views/error403.php';
        }
    }
    /* AJAX */
    public function consultarCorreo()
    {
        $email = $_GET['email'];
        $resultado = $this->model->consultarCorreo($email);
        echo json_encode($resultado);

    }

    public function mostrarDatosAjaxAdmin()
    {
        $resultado = $this->model->mostrarDatosAjaxAdmin();
        echo json_encode($resultado);
    }
    public function consultarDatosAjaxAdmin()
    {
        $buscar = $_GET['buscar'];
        $resultado = $this->model->consultarDatosAjaxAdmin($buscar);
        echo json_encode($resultado);
    }
    public function eliminarDatosAjaxAdmin()
    {
        $idUserAdmin = htmlentities($_GET['idUserAdmin']);

        $this->model->eliminarDatosAjaxAdmin($idUserAdmin);
    }

    /* EDITAR */
    public function editarMostrarDatosAdmin()
    {
        $idAdmin = $_GET["idAdmin"];
        $resultados = $this->model->editarMostrarDatosAdmin($idAdmin);
        require_once 'views/Admin/AdminsEditar.php';
    }
    public function editarGuardarMostrarDatosAdmin()
    {
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
            require_once 'views/Admin/editarMostrarDatosAdmin&idAdmin=' . $idAdmin;
        } else {
            /* DATOS DEL ADMIn */
            $estado = htmlentities($_POST['estado']);
            $rol = "admin";
            $foto = "";

            /************************************ ARCHIVO DE IMAGEN************************** */

            $url = "assets/institucion/Admin/ImagenPerfil/" . $_SESSION["correoTemp"] . "/";
            $foto = $url;
            // Verificar si el directorio actual existe.
            if (file_exists($url)) {
                $urlNuevo = "assets/institucion/Admin/ImagenPerfil/" . $emailValidar . "/";
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
            $validador = $this->model->editarGuardarMostrarDatosAdmin($idAdmin, $emailValidar, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $pass, $estado, $cedula, $rol, $foto);
            if ($validador == true) {
                $exito = true;

                header("Location: index.php?c=Admin&a=editarMostrarDatosAdmin&idAdmin=" . $_GET["idAdmin"] . "&mensaje=" . $exito);
            } else {
                $exito = false;
                header("Location: index.php?c=Admin&a=editarMostrarDatosAdmin&idAdmin=" . $_GET["idAdmin"] . "&mensaje=" . $exito);

            }
        }
    }





    /************************************************GENERACION DE CURSOS *************************/

    public function MostrarCursos()
    {


        if (isset($_SESSION['login']) && $_SESSION["rol"] == "admin" && $_SESSION["login"] == true) {
            require_once 'views/Admin/AdminCursosMostrar.php';

        } else {
            require_once 'views/error403.php';
        }

    }
    public function MostrarRegistroCursos()
    {
        if (isset($_SESSION['login']) && $_SESSION["rol"] == "admin" && $_SESSION["login"] == true) {
            require_once 'views/Admin/AdminCursosRegistrar.php';

        } else {
            require_once 'views/error403.php';
        }
    }


    public function RegistrarCurso()
    {
        $validador = false;
        $nombreCurso = htmlentities($_POST['nombreCurso']);
        $grado = htmlentities($_POST['grado']);
        $paralelo = htmlentities($_POST['paralelo']);
        /*Valida la insercion de correo */
        $validador = $this->model->RegistrarCurso($nombreCurso, $grado, $paralelo);
        if ($validador == true) {
            echo ('<script>variable=1;</script>');
            require_once 'views/Admin/AdminCursosRegistrar.php';
            //      $exito = true;
            //        header("Location: index.php?c=Admin&a=editarMostrarDatosAdmin&idAdmin=" . $_GET["idAdmin"] . "&mensaje=" . $exito);
        } else {
            echo ('<script> variable=0;  </script>');
            require_once 'views/Admin/AdminCursosRegistrar.php';
            //         $exito = false;
            //         header("Location: index.php?c=Admin&a=editarMostrarDatosAdmin&idAdmin=" . $_GET["idAdmin"] . "&mensaje=" . $exito);

        }

    }
    public function consultarDatosAjaxCurso()
    {

        $buscar = $_GET['buscar'];
        $grado = $_GET['indice'];
        $resultado = $this->model->consultarDatosAjaxCurso($buscar, $grado);
        echo json_encode($resultado);
    }
    public function mostrarDatosAjaxCursos()
    {
        $resultado = $this->model->mostrarDatosAjaxCursos();
        echo json_encode($resultado);
    }
    public function eliminarDatosAjaxCurso()
    {

        $idUserAdmin = htmlentities($_GET['idUserAdmin']);

        $this->model->eliminarDatosAjaxCurso($idUserAdmin);

    }
    public function editarMostrarDatosCurso()
    {
        $idCurso = htmlentities($_GET['idAdmin']);
        $resultados = $this->model->editarMostrarDatosCurso($idCurso);
        require_once 'views/Admin/AdminCursosEditar.php';
    }


    public function EditarCurso()
    {
        $idCurso = $_POST['idCurso'];
        $nombreCurso = $_POST['nombreCurso'];
        $grado = $_POST['grado'];
        $paralelo = $_POST['paralelo'];
        $_SESSION['validador'] = $this->model->EditarCurso($idCurso, $nombreCurso, $grado, $paralelo);

        header("Location: index.php?c=Admin&a=editarMostrarDatosCurso&idAdmin=" . $idCurso); /* introduce este codigo  */


    }

    /*******************************************ASIGNACION */
    public function AsignarCursos()
    {
        if (isset($_SESSION['login']) && $_SESSION["rol"] == "admin" && $_SESSION["login"] == true) {
            require_once 'views/Admin/AdminAsignarMostrar.php';
        } else {
            require_once 'views/error403.php';
        }
    }

    public function MostrarRegistroAsignar()
    {
        if (isset($_SESSION['login']) && $_SESSION["rol"] == "admin" && $_SESSION["login"] == true) {
            $docente = $this->model->MostrarDocentes();
            $materia = $this->model->MostrarMateria();
            $estudiante = $this->model->MostrarEstudiantes();
            $curso = $this->model->MostrarCurso();

            require_once 'views/Admin/AdminAsignarRegistrar.php';

        } else {
            require_once 'views/error403.php';
        }
    }

    public function RegistrarAsignacion()
    {
        $curso = $_POST['curso'];
        $docente = $_POST['docente'];
        $estudiante = $_POST['estudiante'];
        $materia = $_POST['materia'];
        $_SESSION['validador'] = $this->model->RegistrarAsignacion($curso, $docente, $estudiante, $materia);

        header("Location: index.php?c=Admin&a=MostrarRegistroAsignar");
        //            require_once 'views/Admin/AdminAsignarRegistrar.php';


    }

    public function mostrarDatosAjaxAsignados()
    {
        $resultado = $this->model->mostrarDatosAjaxAsignados();

        echo json_encode($resultado);
    }

    public function consultarDatosAjaxAsignados()
    {
        $buscar = $_GET['buscar'];
        $grado = $_GET['indice'];
        $resultado = $this->model->consultarDatosAjaxAsignados($buscar, $grado);
        echo json_encode($resultado);
    }

    public function editarMostrarDatosAsignados()
    {
        $id = $_GET['idAdmin'];
        $docente = $this->model->MostrarDocentes();
        $materia = $this->model->MostrarMateria();
        $estudiante = $this->model->MostrarEstudiantes();
        $curso = $this->model->MostrarCurso();
        $resultado = $this->model->editarMostrarDatosAsignados($id);
        require_once 'views/Admin/AdminAsignarEditar.php';



    }




    public function EditarAsignacion()
    {
        $idAsignar = $_POST['idcurso'];
        $curso = $_POST['curso'];
        $docente = $_POST['docente'];
        $estudiante = $_POST['estudiante'];
        $materia = $_POST['materia'];
        $_SESSION['validador'] = $this->model->EditarAsignacion($idAsignar, $curso, $docente, $estudiante, $materia);
        header("Location: index.php?c=Admin&a=editarMostrarDatosAsignados&idAdmin=" . $idAsignar); /* introduce este codigo  */

    }

    public function eliminarDatosAjaxAsignacion()
    {
        $idAsignacion = $_GET['idAsignar'];
        $this->model->eliminarDatosAjaxAsignacion($idAsignacion);
    }

    public function mostrarMaterias()
    {
        require_once 'views/Admin/AdminMateriasMostrar.php';
    }
    public function mostrarDatosAjaxMateria()
    {

        $resul = $this->model->mostrarDatosAjaxMateria();
        echo json_encode($resul);
    }

    public function guardarMateria()
    {
        $materia = htmlentities($_POST['materiaModal']);
        $this->model->guardarCalendario($materia);


    }
    public function materiaEditar()
    {
        $materia = htmlentities($_POST['materiaModal']);
        $id = htmlentities($_POST['idMateria']);

        $this->model->materiaEditar($materia, $id);


    }

    public function eliminarMateria()
    {
        $id = $_GET['idMateria'];

        $this->model->eliminarMateria($id);


    }

    public function consultarMateria()
    {
        $buscar = $_GET['buscar'];

        $resultado = $this->model->consultarMateria($buscar);
        echo json_encode($resultado);
    }
}