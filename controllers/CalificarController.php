<?php
require_once 'models/CalificarModel.php';
session_start();


class CalificarController
{
    private $model;
    /*Constructor*/
    public function __construct()
    {
        $this->model = new CalificarModel(); /*Crea al un objeto  */
    }


    public function CalificarForo()
    {
        $calificar = htmlentities($_POST['calificacionEstudiante']);
        $idForo = htmlentities($_POST['foroEstudiantever']);
        $idEstudiante = htmlentities($_POST['idEstudiante']);


        $this->model->CalificarForo($calificar, $idForo, $idEstudiante);
    }

    public function CalificarForoEditar()
    {
        $calificar = htmlentities($_POST['calificacionEstudiante']);
        $idForoCalificar = htmlentities($_POST['idForoCalificar']);

        $this->model->CalificarForoEditar($calificar, $idForoCalificar);

    }
    /***TAREAS */
    public function MostrarTareasSubidas()
    {
        $idAsignacion = $_GET['idAsignacion'];
        $idTarea = $_GET['idTarea'];
        $type = "Tareas";
        $resultado = $this->model->MostrarTareasSubidas($idTarea);
        require_once 'views/estudiante/calificarEstudiante.php';
    }


    public function MostrarTareasRespuestaAjax()
    {
        $idTarea = $_GET['idTarea'];
        $resultado = $this->model->MostrarTareasRespuestaAjax($idTarea);
        echo json_encode($resultado);
    }


    public function CalificarTarea()
    {

        $calificar = htmlentities($_POST['calificacionEstudiante']);
        $idTarea = htmlentities($_POST['idTarea']);
        $idEstudiante = htmlentities($_POST['idEstudiante']);


        $this->model->CalificarTarea($calificar, $idTarea, $idEstudiante);
    }


    public function CalificarTareaEditar()
    {

        $calificar = htmlentities($_POST['calificacionEstudiante']);
        $idTareaCalificar = htmlentities($_POST['idTareaCalificar']);

        $this->model->CalificarTareaEditar($calificar, $idTareaCalificar);


    }


    /*///////////**** Mostrar */
    public function mostrarCalificacionTotal()
    {

        $type = "Calificacion Total";

        $calificacionEvaluacion = $this->model->promedioEvaluacion();

        $calificacionForo = $this->model->promedioForo();

        $calificacionTarea = $this->model->promedioTarea();

        $usuario = $this->model->usuarioDatos();
        require_once 'views/estudiante/calificacionesTotales.php';
    }




}