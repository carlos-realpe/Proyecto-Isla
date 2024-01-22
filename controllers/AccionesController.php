<?php
require_once 'models/AccionesModel.php';
session_start();


class AccionesController
{
    private $model;
    /*Constructor*/
    public function __construct()
    {
        $this->model = new AccionesModel(); /*Crea al un objeto  */
    }


    public function MostrarForoDetalle()
    {
        $idAsignacion = $_GET['idAsignar'];
        $idForo = $_GET['foro'];
        $type = "Foros";
        require_once 'views/estudiante/foroDetalle.php';
    }
    public function MostrarAjaxForoDetalle()
    {

        $idForo = $_GET['idForo'];
        $resultado = $this->model->MostrarAjaxForoDetalle($idForo);
        echo json_encode($resultado);
    }
    public function MostrarRespuestaAjax()
    {
        $idForo = $_GET['idForo'];
        $resultado = $this->model->MostrarRespuestaAjax($idForo);
        echo json_encode($resultado);

    }

    public function GuardarRespuesta()
    {
        $idForo = htmlentities($_POST['idForo']);

        $respuesta = htmlentities($_POST['editorQuill']);
        $this->model->GuardarRespuesta($idForo, $respuesta);
    }


    //****TAREA */
    public function MostrarTarea()
    {
        $idAsignacion = $_GET['idAsignacion'];
        $idTarea = $_GET['idTarea'];
        $tipoArchivo = $_GET['typ'];
        if ($tipoArchivo == "doc") {
            $tipoArchivo = "docx";
        }
        $type = "Tareas";

        $validador = $this->model->validarTarea($idTarea);

        require_once 'views/estudiante/tareaSubir.php';
    }


    public function guardarTarea()
    {



        /* parametros*/
        $tipoArchivo = htmlentities($_POST['tipoArchivo']);
        $idAsignacion = htmlentities($_POST['idAsignacion']);
        /* BD*/
        //    $fileInput= htmlentities($_POST['fileInput']);    
        $detalle = htmlentities($_POST['editorQuill']);
        $idTarea = htmlentities($_POST['idTarea']);






        // no se encuentra por lo tanto se crea
        $url = "assets/institucion/Tareas/" . $_SESSION['id'] . "/";
        $file = "";
        // Verifica si el directorio existe, y si no, créalo
        if (!file_exists($url)) {
            mkdir($url, 0777, true); // El tercer parámetro `true` crea directorios anidados si es necesario
        }
        // Verifica si es archivo es null 
        //   if (basename($_FILES['fileInput']['name']) == null) {
        //        $file = "assets/institucion/perfil/perfil.jpg";
        //    } else {
        $file = $url . "Tarea." . $tipoArchivo;
        // Mueve el archivo al directorio destino
        if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $file)) {
            $msj = htmlspecialchars(basename($_FILES["fileInput"]["name"]));
        } else {
            // Mansaje el caso en que no se pueda mover el archivo
            $msj = "Error al subir el archivo.";
        }

        $_SESSION['validador'] = $this->model->guardarTarea($file, $detalle, $idTarea);
        header("Location: index.php?c=Acciones&a=MostrarTarea&idAsignacion=" . $idAsignacion . "&idTarea=" . $idTarea . "&typ=" . $tipoArchivo);





    }

    public function editarTarea()
    {
        /* parametros*/
        $tipoArchivo = htmlentities($_POST['tipoArchivo']);
        $idAsignacion = htmlentities($_POST['idAsignacion']);
        /* BD*/
        //    $fileInput= htmlentities($_POST['fileInput']);    
        $detalle = htmlentities($_POST['editorQuill']);
        $idTarea = htmlentities($_POST['idTarea']);
        $archivo = htmlentities($_POST['textArchivo']);

        // se encuentra por lo tanto se hace update
        $file = $archivo;
        if (!file_exists($file)) {
            $url = "assets/institucion/Tareas/" . $_SESSION['id'] . "/";
            if (!file_exists($url)) {
                mkdir($url, 0777, true); // El tercer parámetro `true` crea directorios anidados si es necesario
            }
            $file = $url . "Tarea." . $tipoArchivo;
            move_uploaded_file($_FILES['fileInput']['tmp_name'], $file);
        } else {
            move_uploaded_file($_FILES['fileInput']['tmp_name'], $file);
        }
        $_SESSION['validador'] = $this->model->editarTarea($file, $detalle, $idTarea);
        header("Location: index.php?c=Acciones&a=MostrarTarea&idAsignacion=" . $idAsignacion . "&idTarea=" . $idTarea . "&typ=" . $tipoArchivo);

    }

    /************EVALUACIONES */

    public function evaluacionEstudiante()
    {
        $idCurso = $_GET['Curso'];
        $idEvaluacion = $_GET['idEvaluacion'];

        $preguntas = $this->model->preguntasEvaluacion($idCurso, $idEvaluacion);
        $respuestas = $this->model->respuestasEvaluacion($idCurso, $idEvaluacion);


        require_once 'views/estudiante/evaluacionestudiante.php';
    }
    public function EvaluacionEnviar()
    {
        $idRespuesta = htmlentities($_POST['idRespuesta']);
        $idPregunta = htmlentities($_POST['idPregunta']);
        $idEvaluacion = htmlentities($_POST['idEvaluacion']);
        $idCurso = htmlentities($_POST['idCurso']);
        $this->model->EvaluacionEnviar($idRespuesta, $idPregunta, $idEvaluacion, $idCurso);

    }


    public function mostrarResultadoEvaluacion()
    {
        $idCurso = $_GET['Curso'];
        $idEvaluacion = $_GET['idEvaluacion'];
        $preguntas = $this->model->preguntasEvaluacion($idCurso, $idEvaluacion);
        $respuestas = $this->model->respuestasEvaluacion($idCurso, $idEvaluacion);
        $resultadoEstudiante = $this->model->resultadoEvaluacion($idCurso, $idEvaluacion);
        $resultadoFinal = $this->model->resultadoFinal($idCurso, $idEvaluacion);

        $this->model->insertarNota($idCurso,$idEvaluacion,$resultadoFinal['puntaje_final']);
        require_once 'views/estudiante/evaluacionResultado.php';
    }


    
}