<?php
require_once 'config/conexion.php';

class CalificarModel
{
    private $conexion;
    public function __construct()
    {
        $this->conexion = Conexion::getConexion(); /* establece conexion con la BD*/
    }

    public function CalificarForo($calificar, $idForo,$idEstudiante){
        $sql = "INSERT INTO `foro_calificar` (`id_foro_calificar`, `calificacion`, `id_fk_foro_respuesta`,`id_fk_usuario`) VALUES (null, :calificar, :idForo,:idEstudiante)";
        $sentencia = $this->conexion->prepare($sql);
        $datasAdmin = [
            'idForo' => $idForo,
            'calificar' => $calificar, // Ajusta esto según tus necesidades
            'idEstudiante' => $idEstudiante,
        ];
        $sentencia->execute($datasAdmin);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;

    }

    public function CalificarForoEditar($calificar,$idForoCalificar){

        $sql = "UPDATE `foro_calificar` SET `calificacion`=:calificar where id_foro_calificar=:idForoCalificar";
        $sentencia = $this->conexion->prepare($sql);
        $data = [
            'calificar' => $calificar,
            'idForoCalificar' => $idForoCalificar,
   
        ];
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;


    }


    public function MostrarTareasSubidas($idTarea)
    {
        $sql = "SELECT id_tarea_publicacion, titulo_tarea, descripcion FROM `tareas_publicacion` WHERE id_tarea_publicacion = :idTarea";

        $stmt = $this->conexion->prepare($sql);

        $data = ['idTarea' => $idTarea];

        $stmt->execute($data);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() <= 0) {
            return null;
        }

        return $resultado;
    }
/***********************TAREAS */
    public function MostrarTareasRespuestaAjax($idTarea){
       // $sql = "SELECT * FROM `tareas_respuestas` INNER JOIN `usuario` ON `id_usuario`= `id_fk_estudiante` where id_fk_tarea=".$idTarea;

$sql ="SELECT DISTINCT * from tareas_respuestas inner join usuario on id_usuario=id_fk_estudiante LEFT join tareas_calificacion as tareaC on tareaC.id_fk_tarea_respuesta=tareas_respuestas.id_tarea_respuesta where id_fk_tarea=" . $idTarea;

        $stmt = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $stmt->execute();
        // recupero resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;
    }



    public function CalificarTarea($calificar, $idTarea, $idEstudiante)
    {
        $sql = "INSERT INTO `tareas_calificacion` (`id_tarea_calificar`, `calificacion`, `id_fk_tarea_respuesta`,`id_fk_usuario`) VALUES (null, :calificar, :idTarea,:idEstudiante)";
        $sentencia = $this->conexion->prepare($sql);
        $datasAdmin = [
            'idTarea' => $idTarea,
            'calificar' => $calificar, // Ajusta esto según tus necesidades
            'idEstudiante' => $idEstudiante,
        ];
        $sentencia->execute($datasAdmin);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;

    }
public function CalificarTareaEditar($calificar, $idTareaCalificar){
        $sql = "UPDATE `tareas_calificacion` SET `calificacion`=:calificar where id_tarea_calificar=:idTareaCalificar";
        $sentencia = $this->conexion->prepare($sql);
        $data = [
            'calificar' => $calificar,
            'idTareaCalificar' => $idTareaCalificar,

        ];
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;
    }



    public function promedioEvaluacion(){


      $sql ="SELECT 
  materia.nombre_materia,
  AVG(CASE WHEN parcial = '1er Parcial' THEN nota ELSE null END) AS primerParcial,
  AVG(CASE WHEN parcial = '2do Parcial' THEN nota ELSE null END) AS segundoParcial
FROM 
  materia
LEFT JOIN asignar_curso ON materia.id_materia = asignar_curso.id_fk_materia
LEFT JOIN evaluacion_datos ON asignar_curso.id_fk_curso = evaluacion_datos.id_fk_asignar
LEFT JOIN evaluacion_resultado ON evaluacion_datos.id_evaluacion = evaluacion_resultado.id_fk_evaluacion and evaluacion_resultado.id_fk_usuario =  ".$_SESSION['id']."
WHERE 
  (asignar_curso.id_fk_estudiante = ".$_SESSION['id'].") 
GROUP BY  materia.nombre_materia;";
        $stmt = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $stmt->execute();
        // recupero resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;
    }


    public function promedioForo(){
        $sql ="SELECT 
  materia.nombre_materia,
  AVG(CASE WHEN parcial = '1er Parcial' THEN calificacion ELSE null END) AS primerParcial,
  AVG(CASE WHEN parcial = '2do Parcial' THEN calificacion ELSE null END) AS segundoParcial
FROM 
  materia
LEFT JOIN asignar_curso ON materia.id_materia = asignar_curso.id_fk_materia
LEFT JOIN foro_publicacion ON asignar_curso.id_fk_curso = foro_publicacion.id_fk_asignar
LEFT JOIN foro_respuestas ON foro_publicacion.id_foro_publicacion = foro_respuestas.id_fk_foro
LEFT JOIN foro_calificar ON foro_respuestas.id_foro_respuestas = foro_calificar.id_fk_foro_respuesta and foro_calificar.id_fk_usuario =  " . $_SESSION['id'] . "
WHERE 
  (asignar_curso.id_fk_estudiante =  ".$_SESSION['id']." ) 
GROUP BY  materia.nombre_materia";

  $stmt = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $stmt->execute();
        // recupero resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;

    }


    public function promedioTarea(){
        $sql = "SELECT 
  materia.nombre_materia,
  AVG(CASE WHEN parcial_tarea = '1er Parcial' THEN calificacion ELSE null END) AS primerParcial,
  AVG(CASE WHEN parcial_tarea = '2do Parcial' THEN calificacion ELSE null END) AS segundoParcial
FROM 
  materia
LEFT JOIN asignar_curso ON materia.id_materia = asignar_curso.id_fk_materia
LEFT JOIN tareas_publicacion ON asignar_curso.id_fk_curso = tareas_publicacion.id_fk_asignar
LEFT JOIN tareas_respuestas ON tareas_publicacion.id_tarea_publicacion = tareas_respuestas.id_fk_tarea
LEFT JOIN tareas_calificacion ON tareas_respuestas.id_tarea_respuesta = tareas_calificacion.id_fk_tarea_respuesta and tareas_calificacion.id_fk_usuario =  " . $_SESSION['id'] . "
WHERE 
  (asignar_curso.id_fk_estudiante =  " . $_SESSION['id'] . " ) 
GROUP BY  materia.nombre_materia";

        $stmt = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $stmt->execute();
        // recupero resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;
    }

public function usuarioDatos(){
    $id =$_SESSION['id'];
        $sql = "SELECT CONCAT(primer_nombre,' ',segundo_nombre,' ',primer_apellido,' ',segundo_apellido) as nombre,grado,paralelo from usuario inner join asignar_curso on id_usuario=id_fk_estudiante inner join curso on id_fk_curso=id_curso where id_usuario=:id GROUP by id_usuario";


        $stmt = $this->conexion->prepare($sql);

        $data = ['id' => $id];

        $stmt->execute($data);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() <= 0) {
            return $resultado = null;
        }


        return $resultado;



    }
}