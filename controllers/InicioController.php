<?php
require_once 'models/InicioModel.php';

session_start();


class InicioController
{
    private $model;
    /*Constructor*/
    public function __construct()
    {
        $this->model = new InicioModel(); /*Crea al un objeto de IndexModel */
    }

    public function mostrarInicio()
    {

        if ($_SESSION['rol'] == "admin") {
            $mostrarMaterias = $this->model->mostrarMaterias();
            $mostrarCursos = $this->model->mostrarCursos();
            $mostrarPromedio = $this->model->mostrarPromedio();
            $mostrarTareas = $this->model->mostrarPromedioTareas();
            $mostrarForos = $this->model->mostrarPromedioForos();
            require_once 'views/Inicio/Inicio.php';
        }
        if ($_SESSION['rol'] == "estudiante") {

            $foro = $this->model->mostrarForo();

            $tareas = $this->model->mostrarTareas();
            $evaluaciones = $this->model->mostrarEvaluaciones();
            require_once 'views/Inicio/InicioEstudiante.php';
        }
        if ($_SESSION['rol'] == "docente") {
            $mostrarMaterias = $this->model->mostrarMaterias();
            $mostrarCursos = $this->model->mostrarCursos();
            $mostrarPromedio = $this->model->mostrarPromedio();
            $mostrarTareas = $this->model->mostrarPromedioTareas();
            $mostrarForos = $this->model->mostrarPromedioForos();

            require_once 'views/Inicio/InicioDocente.php';

        }


    }

}