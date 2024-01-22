<?php
require_once 'config/Conexion.php';

class CalendarioModel
{
    private $conexion;
    public function __construct()
    {
        $this->conexion = Conexion::getConexion(); /* establece conexion con la BD*/
    }
    public function mostrarCalendario()
    {
        $sql = " SELECT * from calendario";
        $stmt = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $stmt->execute();
        // recupero resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;



    }


    public function mostrarDatosAjaxCalendario()
    {

        $sql = "SELECT * FROM calendario";


        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }


    public function guardarCalendario($evento, $fechaInicio, $fechaFin)
    {

        $sql = "INSERT `calendario` (`id_calendario`,`evento`,`fechaCalendario`,`fechaCalendarioFin`)VALUES 
(null,:evento,:fechaInicio,:fechaFin)";
        $sentencia = $this->conexion->prepare($sql);

        $data = [
            'evento' => $evento,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
        ];
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {

            return false;
        }
        return true;
    }

    public function calendarioEditar($evento, $fechaInicio, $fechaFin, $idCalendario)
    {
        $sqlAdmin = "UPDATE `calendario` SET `evento` =:evento,`fechaCalendario` =:fechaInicio,`fechaCalendarioFin` =:fechaFin  WHERE `id_calendario` =:idCalendario";


        $sentenciaAdmin = $this->conexion->prepare($sqlAdmin);
        //bind parameters
        $datasAdmin = [
            'evento' => $evento,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
            'idCalendario' => $idCalendario,
        ];

        //retornar resultados
        $sentenciaAdmin->execute($datasAdmin);
        if ($sentenciaAdmin->rowCount() <= 0) {

            return false;
        }
        return true;

    }

    public function eliminarDatosAjax($id)
    {


        $sql = "DELETE FROM `calendario` WHERE `id_calendario`=:id";
        $sentencia = $this->conexion->prepare($sql);
        //bind parameters
        $data = [
            'id' => $id,
        ];
        //execute
        $sentencia->execute($data);
        //retornar resultados
        if ($sentencia->rowCount() <= 0) { // rowCount retorna el numero de filas afectadas
            // verificar si se inserto 
            return false;
        }
        return true;


    }

    public function consultaCalendario($buscar)
    {

        $sql = "SELECT * FROM `calendario` where evento like :b1";
        $stmt = $this->conexion->prepare($sql);
        $conlike = '%' . $buscar . '%';
        $data = [
            'b1' => $conlike,
        ];
        $stmt->execute($data);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }


    public function mostrarForoCalendario()
    {
        $id = $_SESSION['id'];

        $sql = "SELECT fechaFin,titulo FROM asignar_curso inner join foro_publicacion on id_fk_curso=id_fk_asignar where id_fk_estudiante=:id";
        $stmt = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $data = [
            'id' => $id,
        ];

        $stmt->execute($data);
        // recupero resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;
    }

    public function mostrarTareaCalendario()
    {
        $id = $_SESSION['id'];

        $sql = "SELECT fechaFinTarea,titulo_tarea FROM asignar_curso inner join tareas_publicacion on id_fk_curso=id_fk_asignar where id_fk_estudiante=:id";
        $stmt = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $data = [
            'id' => $id,
        ];

        $stmt->execute($data);
        // recupero resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;


    }

    public function mostrarEvaCalendario()
    {
        $id = $_SESSION['id'];

        $sql = "SELECT fechaFinEva,nombreTitulo FROM asignar_curso inner join evaluacion_datos on id_fk_curso=id_fk_asignar where id_fk_estudiante=:id";
        $stmt = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $data = [
            'id' => $id,
        ];

        $stmt->execute($data);
        // recupero resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;


    }
}