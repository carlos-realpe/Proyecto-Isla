<?php
require_once 'models/DocenteModel.php';
session_start();


class DocenteController
{
    private $model;
    /*Constructor*/
    public function __construct()
    {
        $this->model = new DocenteModel(); /*Crea al un objeto  */
    }

    /*************************************************DOCENTE************************************** */


    public function VistaDocente()
    {
        if (isset($_SESSION['login']) && $_SESSION["rol"] == "admin" && $_SESSION["login"] == true) {
            require_once 'views/Admin/AdminDocente.php';
        } else {
            require_once 'views/error403.php';
        }
    }
    public function VistaRegistrarDocente()
    {
        if (isset($_SESSION['login']) && $_SESSION["rol"] == "admin" && $_SESSION["login"] == true) {
            require_once 'views/Admin/AdminDocenteRegistrar.php';
        } else {
            require_once 'views/error403.php';
        }
    }
    public function VistaDatosDocente()
    {
        if (isset($_SESSION['login']) && $_SESSION["rol"] == "admin" && $_SESSION["login"] == true) {

            $resultado = $this->model->VistaDatosDocente();
            echo json_encode($resultado);
        } else {
            require_once 'views/error403.php';
        }

    }

    public function RegistrarDocente()
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
            require_once 'views/Admin/AdminsRegistrar.php';
        } else {
            /* DATOS DEL ADMIn */
            $titulo = htmlentities($_POST['titulo']);
            $materia = htmlentities($_POST['materia']);
            $telefono = htmlentities($_POST['telefono']);


            $rol = "docente";
            /* IMAGEN */

            $url = "assets/institucion/Docente/ImagenPerfil/" . $emailValidar . "/";

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

            $validador = $this->model->RegistrarDocente($emailValidar, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $pass, $titulo, $materia, $telefono, $cedula, $rol, $foto);
            if ($validador == true) {
                $exito = true;
                require_once 'views/Admin/AdminDocenteRegistrar.php';
            } else {
                $exito = false;
                require_once 'views/Admin/AdminDocenteRegistrar.php';
            }
            //  header("Location: index.php?c=Admin&a=VistaRegistrarAdmin"); /* introduce este codigo  */
        }

        require_once 'views/Admin/AdminDocenteRegistrar.php';

    }
    /* editr */
    public function editarMostrarDatosDocente()
    {
        $idAdmin = $_GET["idAdmin"];
        $resultados = $this->model->editarMostrarDatosDocente($idAdmin);
        require_once 'views/Admin/AdminDocenteEditar.php';

    }
    public function editarGuardarMostrarDatosDocente()
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
            require_once 'views/Docente/editarMostrarDatosDocente&idAdmin=' . $idAdmin;
        } else {
            /* DATOS DEL ADMIn */
            $rol = "docente";
            $titulo = htmlentities($_POST['titulo']);
            $materia = htmlentities($_POST['materia']);
            $telefono = htmlentities($_POST['telefono']);

            $foto = "";

            /************************************ ARCHIVO DE IMAGEN************************** */

            $url = "assets/institucion/Docente/ImagenPerfil/" . $_SESSION["correoTemp"] . "/";
            $foto = $url;
            // Verificar si el directorio actual existe.
            if (file_exists($url)) {
                $urlNuevo = "assets/institucion/Docente/ImagenPerfil/" . $emailValidar . "/";
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
            $validador = $this->model->editarGuardarMostrarDatosDocente($idAdmin, $emailValidar, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $pass, $titulo, $materia, $telefono, $cedula, $rol, $foto);
            if ($validador == true) {
                $exito = true;

                header("Location: index.php?c=Docente&a=editarMostrarDatosDocente&idAdmin=" . $_GET["idAdmin"] . "&mensaje=" . $exito);
            } else {
                $exito = false;
                header("Location: index.php?c=Docente&a=editarMostrarDatosDocente&idAdmin=" . $_GET["idAdmin"] . "&mensaje=" . $exito);

            }
        }


    }

    /*  AJAX DOCENTE  */
    public function consultarCorreo()
    {
        $email = $_GET['email'];
        $resultado = $this->model->consultarCorreo($email);
        echo json_encode($resultado);

    }


    public function consultarDatosAjaxDocente()
    {
        $buscar = $_GET['buscar'];
        $resultado = $this->model->consultarDatosAjaxDocente($buscar);
        echo json_encode($resultado);
    }
    public function eliminarDatosAjaxDocente()
    {
        $idUserAdmin = htmlentities($_GET['idUserAdmin']);

        $this->model->eliminarDatosAjaxDocente($idUserAdmin);


    }






    /***************************************CURSOS***********************************/


    public function mostrarClases()
    {
        $typeLink = $_GET['type'];
        $clases = $this->model->mostrarClases();
        require_once 'views/docente/MostrarClases.php';
    }
    public function MostrarRegistroReunion()
    {
        $idAsignacion = $_GET['idAsignacion'];
        require_once 'views/docente/RegistrarReunion.php';
    }


    public function MostrarClasesDatos()
    {
        $idAsignacion = $_GET['idAsignacion'];
        $_SESSION['idAsignacion'] = $idAsignacion;
        //  $reunion = $this->model->MostrarReunion($idAsignacion);
        //  echo json_encode($reunion);
        require_once 'views/docente/MostrarReunion.php';

    }
    public function RegistrarReunion()
    {

        $idAsignar = htmlentities($_POST['idAsignar']);
        $nombreReunion = htmlentities($_POST['nombreReunion']);
        $fecha = htmlentities($_POST['fecha']);
        $hora = htmlentities($_POST['hora']);
        $enlace = htmlentities($_POST['enlace']);
        $_SESSION['validador'] = $this->model->RegistrarReunion($idAsignar, $nombreReunion, $fecha, $hora, $enlace);
        header('Location: index.php?c=Docente&a=MostrarRegistroReunion&idAsignacion=' . $idAsignar);

    }

    public function mostrarReunionAjax()
    {
        //$idAsignacion = $_GET['idAsignacion'];
        $reunion = $this->model->MostrarReunion($_SESSION['idAsignacion']);
        echo json_encode($reunion);
    }

    public function EditarReunion()
    {
        $idAsignar = htmlentities($_POST['idAsignar']);
        $idReunion = htmlentities($_POST['idReunion']);
        $nombreReunion = htmlentities($_POST['nombreReunion']);
        $fecha = htmlentities($_POST['fecha']);
        $hora = htmlentities($_POST['hora']);
        $enlace = htmlentities($_POST['enlace']);
        $_SESSION['validador'] = $this->model->EditarReunion($idReunion, $nombreReunion, $fecha, $hora, $enlace);
        header('Location: index.php?c=Docente&a=MostrarClasesDatos&idAsignacion=' . $idAsignar);

    }


    public function eliminarReunionAjax()
    {
        $idReunion = htmlentities($_GET['idReunion']);
        $this->model->eliminarReunionAjax($idReunion);
    }







    /***************FOROS******** */
    public function mostrarForosDatos()
    {
        $idAsignacion = $_GET['idAsignacion'];
        $_SESSION['idAsignacion'] = $idAsignacion;
        $foros = $this->model->mostrarForosDatos($idAsignacion);
        //  echo json_encode($reunion);
        require_once 'views/docente/MostrarForos.php';
    }

    public function MostrarRegistroForo()
    {
        $idAsignacion = $_GET['idAsignacion'];
        require_once 'views/docente/RegistrarForo.php';

    }

    public function RegistrarForo()
    {
        $idAsignar = htmlentities($_POST['idAsignar']);
        $titulo = htmlentities($_POST['titulo']);
        $horaLimite = htmlentities($_POST['horaLimite']);
        $fechaLimite = htmlentities($_POST['fechaLimite']);
        $parcial = htmlentities($_POST['parcial']);
        $editorQuill = htmlentities($_POST['editorQuill']);
        $fechaFin = htmlentities($_POST['fechaFin']);
        $_SESSION['validador'] = $this->model->RegistrarForo($idAsignar, $titulo, $horaLimite, $fechaLimite, $editorQuill, $parcial, $fechaFin);
        header('Location: index.php?c=Docente&a=MostrarRegistroForo&idAsignacion=' . $idAsignar);




    }



    public function EditarForo()
    {
        $idAsignar = htmlentities($_POST['idAsignar']);
        $titulo = htmlentities($_POST['tituloModal']);
        $horaLimite = htmlentities($_POST['horaLimiteModal']);
        $fechaLimite = htmlentities($_POST['fechaLimiteModal']);
        $parcial = htmlentities($_POST['parcialModal']);
        $editorQuill = htmlentities($_POST['editorQuill']);
        $idForo = htmlentities($_POST['idForo']);
        $fechaFin = htmlentities($_POST['fechaFinModal']);
        $_SESSION['validador'] = $this->model->EditarForo($titulo, $horaLimite, $fechaLimite, $editorQuill, $parcial, $idForo, $fechaFin);
        header('Location: index.php?c=Docente&a=MostrarForosDatos&idAsignacion=' . $idAsignar);

    }

    public function EliminarForo()
    {
        $idForo = $_GET['idForo'];
        $idAsignar = htmlentities($_GET['idAsignar']);
        $this->model->EliminarForo($idForo);
        header('Location: index.php?c=Docente&a=MostrarForosDatos&idAsignacion=' . $idAsignar);
    }


    /**********FORO***********************/


    public function MostrarTareasDatos()
    {
        $idAsignacion = $_GET['idAsignacion'];
        $_SESSION['idAsignacion'] = $idAsignacion;
        //  $reunion = $this->model->MostrarReunion($idAsignacion);
        //  echo json_encode($reunion);
        require_once 'views/docente/MostrarTareas.php';
    }

    public function mostrarTareasAjax()
    {
        $tareas = $this->model->mostrarTareasAjax($_SESSION['idAsignacion']);
        echo json_encode($tareas);
    }


    public function MostrarRegistroTarea()
    {
        $idAsignacion = $_GET['idAsignacion'];
        require_once 'views/docente/RegistrarTarea.php';
    }

    public function RegistrarTarea()
    {
        $idAsignar = htmlentities($_POST['idAsignar']);
        $titulo = htmlentities($_POST['titulo']);
        $horaLimite = htmlentities($_POST['horaLimite']);
        $fechaLimite = htmlentities($_POST['fechaLimite']);
        $parcial = htmlentities($_POST['parcial']);
        $editorQuill = htmlentities($_POST['editorQuill']);
        $tipoArchivo = htmlentities($_POST['archivo']);

        $_SESSION['validador'] = $this->model->RegistrarTarea($idAsignar, $titulo, $horaLimite, $fechaLimite, $editorQuill, $parcial, $tipoArchivo);
        header('Location: index.php?c=Docente&a=MostrarRegistroTarea&idAsignacion=' . $idAsignar);



    }


    public function EditarTarea()
    {

        $idAsignar = htmlentities($_POST['idAsignar']);
        $titulo = htmlentities($_POST['tituloModal']);
        $horaLimite = htmlentities($_POST['horaLimiteModal']);
        $fechaLimite = htmlentities($_POST['fechaLimiteModal']);
        $parcial = htmlentities($_POST['parcialModal']);
        $editorQuill = htmlentities($_POST['editorQuill']);
        $idTarea = htmlentities($_POST['idTarea']);
        $tipoArchivo = htmlentities($_POST['archivoModal']);
        $_SESSION['validador'] = $this->model->EditarTarea($idTarea, $titulo, $horaLimite, $fechaLimite, $editorQuill, $parcial, $tipoArchivo);
        header('Location: index.php?c=Docente&a=MostrarTareasDatos&idAsignacion=' . $idAsignar);

    }

    public function eliminarTareaAjax()
    {
        $idTarea = $_GET['idTarea'];
        $this->model->eliminarTareaAjax($idTarea);
    }



    /****************************************EVALUACIONES***************/
    public function MostrarEvaluacionesDatos()
    {
        $idAsignacion = $_GET['idAsignacion'];
        $_SESSION['idAsignacion'] = $idAsignacion;
        require_once 'views/docente/MostrarEvaluaciones.php';
    }


    public function MostrarRegistroEvaluaciones()
    {
        $idAsignacion = $_GET['idAsignacion'];
        require_once 'views/docente/RegistrarEvaluaciones.php';
    }

    public function RegistrarEvaluaciones()
    {

        $idAsignar = htmlentities($_POST['idAsignar']);
        $nombreTitulo = htmlentities($_POST['nombreTitulo']);
        $horaInicio = htmlentities($_POST['horaInicio']);
        $horaLimite = htmlentities($_POST['horaLimite']);
        $fechaLimite = htmlentities($_POST['fechaLimite']);
        $parcial = htmlentities($_POST['parcial']);
        $tipo = htmlentities($_POST['tipo']);
        $fechaFin = htmlentities($_POST['fechaFin']);
        $_SESSION['validador'] = $this->model->RegistrarEvaluaciones($idAsignar, $nombreTitulo, $horaInicio, $horaLimite, $fechaLimite, $parcial, $tipo, $fechaFin);
        header('Location: index.php?c=Docente&a=MostrarRegistroEvaluaciones&idAsignacion=' . $idAsignar);
    }

    public function mostrarEvaluacionAjax()
    {
        $tareas = $this->model->mostrarEvaluacionAjax($_SESSION['idAsignacion']);
        echo json_encode($tareas);


    }


    public function EditarEvaluacion()
    {
        $idAsignar = htmlentities($_POST['idAsignar']);
        $titulo = htmlentities($_POST['tituloModal']);
        $horaInicio = htmlentities($_POST['horaInicioModal']);
        $horaLimite = htmlentities($_POST['horaLimiteModal']);
        $fechaLimite = htmlentities($_POST['fechaLimiteModal']);
        $parcial = htmlentities($_POST['parcialModal']);
        $fechaFin = htmlentities($_POST['fechaFinModal']);
        $idEvaluacion = htmlentities($_POST['idEvaluacion']);
        $tipo = htmlentities($_POST['tipoModal']);
        $_SESSION['validador'] = $this->model->EditarEvaluacion($idEvaluacion, $titulo, $horaInicio, $horaLimite, $fechaLimite, $parcial, $tipo, $fechaFin);
        header('Location: index.php?c=Docente&a=MostrarEvaluacionesDatos&idAsignacion=' . $idAsignar);

    }


    public function eliminarEvaluacionAjax()
    {
        $id = $_GET['idEvaluacion'];
        $this->model->eliminarEvaluacionAjax($id);
    }

    /*********************PREGUNTAS */
    public function preguntasMostrar()
    {
        $idAsignacion = $_GET['idAsignacion'];
        $idEvaluacion = $_GET['idEvaluacion'];
        $_SESSION['idEvaluacion'] = $idEvaluacion;
        require_once 'views/docente/MostrarPreguntas.php';
    }

    public function RegistrarPregunta()
    {


        $idAsignacion = htmlentities($_POST['idAsignacion']);
        $idEvaluacion = htmlentities($_POST['idEvaluacion']);
        $puntaje = htmlentities($_POST['puntaje']);
        $pregunta = htmlentities($_POST['pregunta']);
        $this->model->RegistrarPregunta($idEvaluacion, $pregunta, $puntaje);
        header('Location: index.php?c=Docente&a=preguntasMostrar&idEvaluacion=' . $idEvaluacion . '&idAsignacion=' . $idAsignacion);

    }



    public function EditarPregunta()
    {
        $puntaje = htmlentities($_POST['puntajeModal']);
        $pregunta = htmlentities($_POST['preguntaModal']);
        $idPregunta = htmlentities($_POST['idPregunta']);
        $this->model->EditarPregunta($idPregunta, $pregunta, $puntaje);



    }
    /***************RESPUESTAS */

    public function MostrarPreguntasAjax()
    {
        $respuesta = $this->model->MostrarPreguntasAjax($_SESSION['idEvaluacion']);
        echo json_encode($respuesta);
    }
    public function MostrarRespuestaAjax()
    {
        $respuesta = $this->model->MostrarRespuestaAjax($_SESSION['idEvaluacion']);
        echo json_encode($respuesta);
    }
    public function guardarRespuesta()
    {
        $idPregunta = $_GET['idPregunta'];
        $respuesta = $_GET['respuesta'];
        $this->model->guardarRespuesta($idPregunta, $respuesta);
    }



    public function respuestaCorrecta()
    {
        $estado = $_GET['estado'];
        $idRespuesta = $_GET['idRespuesta'];
        $this->model->respuestaCorrecta($idRespuesta, $estado);
    }


    public function EditarRespuesta()
    {
        $respuesta = htmlentities($_POST['respuestaModal']);
        $idRespuesta = htmlentities($_POST['idRespuesta']);
        $this->model->EditarRespuesta($idRespuesta, $respuesta);
    }

    public function eliminarRespuesta()
    {
        $idRespuesta = $_GET['idRespuesta'];
        $this->model->eliminarRespuesta($idRespuesta);

    }
    public function confirmarEliminarPregunta()
    {
        $idPregunta = $_GET['idPregunta'];
        $this->model->confirmarEliminarPregunta($idPregunta);

    }






    public function MostrarCalificaciónDatos()
    {
        $idCurso = $_GET['idAsignacion'];
        $type = "Calificación";
        if ($_SESSION['rol'] == "estudiante") {
            

            $foro = $this->model->mostrarForoCalificacion($idCurso);
            $tarea = $this->model->mostrarTareaCalificacion($idCurso);
            $evaluaciones = $this->model->mostrarEvaluacionCalificacion($idCurso);
            require_once 'views/estudiante/calificacionesParciales.php';
        } else if ($_SESSION['rol'] == "docente") {

            $mostrarForo = $this->model->mostrarCalificacionEstudiantesForo($idCurso);
            $mostrarTarea = $this->model->mostrarCalificacionEstudiantesTarea($idCurso);
$mostrarEva =$this->model->mostrarCalificacionEstudianteEva($idCurso);
            require_once 'views/docente/calificacionesEstudiantes.php';

        }

    }



}
