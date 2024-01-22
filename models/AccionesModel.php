<?php
require_once 'config/conexion.php';

class AccionesModel
{

    private $conexion;
    public function __construct()
    {
        $this->conexion = Conexion::getConexion(); /* establece conexion con la BD*/
    }

    public function MostrarAjaxForoDetalle($idForo)
    {

        $sql = "SELECT * from foro_publicacion where id_foro_publicacion=" . $idForo;
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    public function MostrarRespuestaAjax($idForo)
    {
if($_SESSION['rol']=="estudiante"){
        $sql = "SELECT id_foro_respuestas,respuesta,fechaRespuesta,primer_nombre,primer_apellido,segundo_apellido from foro_respuestas inner join usuario on id_usuario=id_fk_estudiante where id_fk_foro=" . $idForo;
    }else{
      $sql =  "SELECT DISTINCT foroC.calificacion,id_foro_calificar,foro_respuestas.id_fk_estudiante,id_foro_respuestas,respuesta,fechaRespuesta,primer_nombre,primer_apellido,segundo_apellido from foro_respuestas inner join usuario on id_usuario=id_fk_estudiante LEFT join foro_calificar as foroC on foroC.id_fk_foro_respuesta=id_foro_respuestas where id_fk_foro=" . $idForo;
    }
       
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;

    }

    public function GuardarRespuesta($idForo, $respuesta)
    {
        $idEstudiante = $_SESSION['id'];

        $sql = "INSERT INTO `foro_respuestas` (`id_foro_respuestas`, `respuesta`, `id_fk_foro`,`id_fk_estudiante`,`fechaRespuesta`) VALUES (null, :respuesta, :idForo,:idEstudiante,CURRENT_TIMESTAMP)";
        $sentencia = $this->conexion->prepare($sql);
        $datasAdmin = [
            'idForo' => $idForo,
            'respuesta' => $respuesta, // Ajusta esto según tus necesidades
            'idEstudiante' => $idEstudiante,
        ];
        $sentencia->execute($datasAdmin);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;


    }


    /*** TAREA */
    public function guardarTarea($archivo, $detalle, $idTarea)
    {
        $idEstudiante = $_SESSION['id'];

        $sql = "INSERT INTO `tareas_respuestas` (`id_tarea_respuesta`, `archivoTarea`, `detalleTarea`,`id_fk_tarea`,`id_fk_estudiante`,`fechaEntrega`) VALUES (null, :archivo,:detalle, :idTarea,:idEstudiante,CURRENT_TIMESTAMP)";
        $sentencia = $this->conexion->prepare($sql);
        $datasAdmin = [
            'idTarea' => $idTarea,
            'archivo' => $archivo, // Ajusta esto según tus necesidades
            'idEstudiante' => $idEstudiante,
            'detalle' => $detalle,
        ];
        $sentencia->execute($datasAdmin);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;
    }
    public function validarTarea($idTarea)
    {
        $idEstudiante = $_SESSION['id'];
        $sql = "SELECT * from tareas_respuestas where id_fk_estudiante=:idEstudiante and id_fk_tarea=:idTarea";

        $stmt = $this->conexion->prepare($sql);

        $data = ['idTarea' => $idTarea, 'idEstudiante' => $idEstudiante];

        $stmt->execute($data);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() <= 0) { /// esta cprrectactamente

            return $resultado = null;
        }
        return $resultado;
    }

    public function editarTarea($archivo, $detalle, $idTarea)
    {
        $fecha = date('Y-m-d H:i:s');
        $idEstudiante = $_SESSION['id'];
        $sql = "UPDATE `tareas_respuestas` SET `archivoTarea`=:archivo, `detalleTarea`=:detalle, `fechaEntrega`=:fecha where id_fk_tarea=:idTarea and id_fk_estudiante=:idEstudiante";
        $sentencia = $this->conexion->prepare($sql);
        $data = [
            'archivo' => $archivo,
            'detalle' => $detalle,
            'fecha' => $fecha,
            'idTarea' => $idTarea,
            'idEstudiante' => $idEstudiante
        ];
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;
    }


    /**********evaluacion */

    public function preguntasEvaluacion($idCurso, $idEvaluacion)
    {
        $sql = "SELECT pregunta,puntaje,id_pregunta,horaLimite,horaInicio from evaluacion_datos inner join pregunta_evaluacion on id_fk_evaluacion=id_evaluacion where id_fk_asignar=" . $idCurso . " and id_fk_evaluacion=" . $idEvaluacion;
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;

    }

    public function respuestasEvaluacion($idCurso, $idEvaluacion)
    {
        $sql = "SELECT id_respuesta,respuesta,correcta,id_fk_pregunta from evaluacion_datos inner join pregunta_evaluacion on id_fk_evaluacion=id_evaluacion inner join pregunta_respuesta on id_fk_pregunta=id_pregunta where id_fk_asignar=" . $idCurso . " and id_fk_evaluacion=" . $idEvaluacion;
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    public function EvaluacionEnviar($idRespuesta, $idPregunta, $idEvaluacion, $idCurso)
    {
        $idEstudiante = $_SESSION['id'];

        $sql = "INSERT INTO `evaluacion_respuesta` (`id_evaluacion_respuesta`, `id_fk_pregunta`, `id_fk_respuesta`,`id_fk_evaluacion`,`id_fk_curso`,`id_fk_usuario`,`estado`) VALUES (null, :idPregunta,:idRespuesta, :idEvaluacion,:idCurso,:idEstudiante,1)";
        $sentencia = $this->conexion->prepare($sql);
        $datasAdmin = [
            'idRespuesta' => $idRespuesta,
            'idPregunta' => $idPregunta, // Ajusta esto según tus necesidades
            'idEvaluacion' => $idEvaluacion,
            'idCurso' => $idCurso,
            'idEstudiante' => $idEstudiante,
        ];
        $sentencia->execute($datasAdmin);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;
    }

    public function resultadoEvaluacion($idCurso, $idEvaluacion)
    {
        //   $sql = "SELECT * from evaluacion_respuesta where id_fk_curso=" . $idCurso . " and id_fk_evaluacion=" . $idEvaluacion." and id_fk_usuario=".$_SESSION['id'];

        $sql = "SELECT
    er.id_evaluacion_respuesta,
    er.id_fk_respuesta,
    er.id_fk_usuario,
    SUM(CASE WHEN pr.correcta = 1 THEN pe.puntaje ELSE 0 END) OVER (ORDER BY er.id_evaluacion_respuesta) AS puntaje_acumulado
FROM
    evaluacion_respuesta er
JOIN pregunta_respuesta pr ON er.id_fk_respuesta = pr.id_respuesta  
JOIN pregunta_evaluacion pe ON pr.id_fk_pregunta = pe.id_pregunta
WHERE
    er.id_fk_usuario = " . $_SESSION['id'] . " AND
    er.id_fk_curso = " . $idCurso . " AND
    er.id_fk_evaluacion = " . $idEvaluacion;
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    public function resultadoFinal($idCurso,$idEvaluacion){

        $sql = "SELECT MAX(puntaje_acumulado) AS puntaje_final
FROM (
    SELECT
        SUM(CASE WHEN pr.correcta = 1 THEN pe.puntaje ELSE 0 END) OVER (ORDER BY er.id_evaluacion_respuesta) AS puntaje_acumulado
    FROM
        evaluacion_respuesta er
    JOIN pregunta_respuesta pr ON er.id_fk_respuesta = pr.id_respuesta  
    JOIN pregunta_evaluacion pe ON pr.id_fk_pregunta = pe.id_pregunta
    WHERE
        er.id_fk_usuario = ". $_SESSION['id'] . " AND
        er.id_fk_curso = " . $idCurso . "  AND
        er.id_fk_evaluacion = " . $idEvaluacion."
) AS subquery";
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();
        $resultados = $sentencia->fetch(PDO::FETCH_ASSOC);
        return $resultados;

    }

    public function insertarNota($idCurso,$idEvaluacion,$puntaje){

        $idEstudiante = $_SESSION['id'];


        
       // $sql = "INSERT INTO `evaluacion_resultado` (`id_resultado`, `id_fk_usuario`, `id_fk_evaluacion`,`id_fk_curso`,`nota`,`estado`) VALUES (null, :idEstudiante,:idEvaluacion, :idCurso,:puntaje,1)";
        $sql = "INSERT INTO `evaluacion_resultado` 
        (`id_resultado`, `id_fk_usuario`, `id_fk_evaluacion`, `id_fk_curso`, `nota`, `estado`) 
        SELECT 
            null, 
            :idEstudiante, 
            :idEvaluacion, 
            :idCurso, 
            :puntaje, 
            1 
        FROM dual
        WHERE NOT EXISTS (
            SELECT 1
            FROM `evaluacion_resultado`
            WHERE 
                `id_fk_usuario` = :idEstudiante AND
                `id_fk_evaluacion` = :idEvaluacion AND
                `id_fk_curso` = :idCurso
        )";


        $sentencia = $this->conexion->prepare($sql);
        $datasAdmin = [
            'puntaje' => $puntaje, // Ajusta esto según tus necesidades
            'idEvaluacion' => $idEvaluacion,
            'idCurso' => $idCurso,
            'idEstudiante' => $idEstudiante,
        ];
        $sentencia->execute($datasAdmin);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;
    }




}