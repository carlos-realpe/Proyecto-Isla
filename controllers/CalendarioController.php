<?php
require_once 'models/CalendarioModel.php';

session_start();


class CalendarioController
{
    private $model;
    /*Constructor*/
    public function __construct()
    {
        $this->model = new CalendarioModel(); /*Crea al un objeto de IndexModel */
    }

    public function mostrarCalendario()
    {
        $calendario = $this->model->mostrarCalendario();

        $fechaForo = $this->model->mostrarForoCalendario();
        $fechaTarea = $this->model->mostrarTareaCalendario();
        $fechaEva =$this->model->mostrarEvaCalendario();
        require_once 'views/Calendario/calendario.php';
    }


    public function mostrarCalendarioAdmin()
    {

        require_once 'views/Admin/AdminCalendarioMostrar.php';
    }

    public function mostrarDatosAjaxCalendario()
    {
        $resultado = $this->model->mostrarDatosAjaxCalendario();

        echo json_encode($resultado);
    }
    public function guardarCalendario()
    {
        $evento = htmlentities($_POST['eventoModal']);
        $fechaInicio = htmlentities($_POST['fechaInicioModal']);
        $fechaFin = htmlentities($_POST['fechaFinModal']);
        $this->model->guardarCalendario($evento, $fechaInicio, $fechaFin);
      //  require_once 'views/Admin/AdminCalendarioMostrar.php';

    }


    public function calendarioEditar()
    {


        $evento = htmlentities($_POST['eventoModal']);
        $fechaInicio = htmlentities($_POST['fechaInicioModal']);
        $fechaFin = htmlentities($_POST['fechaFinModal']);
        $idCalendario = htmlentities($_POST['idCalendario']);
        $this->model->calendarioEditar($evento, $fechaInicio, $fechaFin, $idCalendario);
    }

    public function eliminarDatosAjax(){
        $id = $_GET['idCalendario'];
        $this->model->eliminarDatosAjax($id);
    }


    public function consultaCalendario(){
        $buscar= $_GET['buscar'];

        $resultado = $this->model->consultaCalendario($buscar);



        echo json_encode($resultado);

    }
}