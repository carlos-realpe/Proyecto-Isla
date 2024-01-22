<?php
require_once 'config/Conexion.php';

class InicioModel
{
    private $conexion;
    public function __construct()
    {
        $this->conexion = Conexion::getConexion(); /* establece conexion con la BD*/
    }


    public function mostrarMaterias()
    {

        if ($_SESSION['rol'] == "admin") {
            $sql = "select nombre_materia, count(*) as cantidad from materia inner join asignar_curso on id_fk_materia=id_materia GROUP by nombre_materia";
        }
        if ($_SESSION['rol'] == "docente") {
            $sql = "select nombre_materia, count(*) as cantidad from materia inner join asignar_curso on id_fk_materia=id_materia where id_fk_docente=" . $_SESSION['id'] . " GROUP by nombre_materia";
        }


        $stmt = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $stmt->execute();
        // recupero resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;


    }


    public function mostrarCursos()
    {
        $sql = "SELECT CONCAT(nombre_curso, ' (', grado,')') as nombre_curso_grado, COUNT(*) as cantidad
FROM curso
INNER JOIN asignar_curso ON id_fk_curso = id_curso
GROUP BY nombre_curso, grado";
        $stmt = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $stmt->execute();
        // recupero resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;

    }

    public function mostrarPromedio()
    {


        if ($_SESSION['rol'] == "admin") {
            $sql = "SELECT AVG(nota) as promedio,nombre_curso  FROM `evaluacion_resultado` inner join curso on id_fk_curso=id_curso GROUP by nombre_curso";
        }
        if ($_SESSION['rol'] == "docente") {
            $sql = "SELECT AVG(nota) as promedio,nombre_curso  FROM `evaluacion_resultado` inner join curso on id_fk_curso=id_curso inner join asignar_curso on id_curso=asignar_curso.id_fk_curso WHERE id_fk_docente=" . $_SESSION['id'] . " GROUP by nombre_curso";
        }

        $stmt = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $stmt->execute();
        // recupero resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;

    }

    public function mostrarPromedioTareas()
    {

        if ($_SESSION['rol'] == "admin") {
            $sql = "SELECT AVG(calificacion) as promedio,nombre_curso  FROM `tareas_calificacion` inner join tareas_respuestas on id_fk_tarea_respuesta=id_tarea_respuesta inner join tareas_publicacion on id_fk_tarea=id_tarea_publicacion inner join curso on id_fk_asignar=id_curso GROUP by nombre_curso";
        }
        if ($_SESSION['rol'] == "docente") {
            $sql = "SELECT AVG(calificacion) as promedio,nombre_curso  FROM `tareas_calificacion` inner join tareas_respuestas on id_fk_tarea_respuesta=id_tarea_respuesta inner join tareas_publicacion on id_fk_tarea=id_tarea_publicacion inner join curso on id_fk_asignar=id_curso inner join asignar_curso on id_curso=id_fk_curso where id_fk_docente=" . $_SESSION['id'] . " GROUP by nombre_curso";
        }
        $stmt = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $stmt->execute();
        // recupero resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;

    }

    public function mostrarPromedioForos()
    {


        if ($_SESSION['rol'] == "admin") {

            $sql = "SELECT AVG(calificacion) as promedio,nombre_curso  FROM `foro_calificar` inner join foro_respuestas on id_fk_foro_respuesta=id_foro_respuestas inner join foro_publicacion on id_fk_foro=id_foro_publicacion inner join curso on id_fk_asignar=id_curso GROUP by nombre_curso";
        }
        if ($_SESSION['rol'] == "docente") {
            $sql = "SELECT AVG(calificacion) as promedio,nombre_curso  FROM `foro_calificar` inner join foro_respuestas on id_fk_foro_respuesta=id_foro_respuestas inner join foro_publicacion on id_fk_foro=id_foro_publicacion inner join curso on id_fk_asignar=id_curso inner join asignar_curso on asignar_curso.id_fk_curso=id_curso where id_fk_docente=" . $_SESSION['id'] . " GROUP by nombre_curso";
        }



        $stmt = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $stmt->execute();
        // recupero resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;
    }



    public function mostrarForo()
    {
        // $sql = "SELECT * FROM `foro_calificar` inner join foro_respuestas on id_fk_foro_respuesta=id_foro_respuestas inner join foro_publicacion on id_fk_foro=id_foro_publicacion inner join curso on id_fk_asignar=id_curso GROUP by nombre_curso";

        $sql = "SELECT 
    forP.id_foro_publicacion,
    forP.id_fk_asignar,
    forP.fechaForo,
    forP.horaForo,
    forP.titulo,
    forP.fechaFin,
    curso.id_fk_curso as idCurso
FROM 
    asignar_curso as curso
LEFT JOIN 
    foro_publicacion as forP ON curso.id_fk_estudiante = " . $_SESSION['id'] . " AND forP.id_fk_asignar = curso.id_fk_curso
LEFT JOIN 
    foro_respuestas as forR ON forR.id_fk_foro = forP.id_foro_publicacion AND forR.id_fk_estudiante = " . $_SESSION['id'] . "
WHERE 
    forR.id_fk_foro IS NULL
GROUP BY 
    forP.id_foro_publicacion";

        $stmt = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $stmt->execute();
        // recupero resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;


    }


    public function mostrarTareas()
    {

        $sql = "SELECT 
    tarP.id_tarea_publicacion,
    tarP.id_fk_asignar,
    tarP.fechaFinTarea,
    tarP.fechaTarea,
    tarP.horaTarea,
    tarP.titulo_tarea,
    tarP.tipo_archivo,
    curso.id_fk_curso as idCurso
FROM 
    asignar_curso as curso
LEFT JOIN 
    tareas_publicacion as tarP ON curso.id_fk_estudiante = " . $_SESSION['id'] . " AND tarP.id_fk_asignar = curso.id_fk_curso
LEFT JOIN 
    tareas_respuestas as tarR ON tarR.id_fk_tarea = tarP.id_tarea_publicacion AND tarR.id_fk_estudiante = " . $_SESSION['id'] . "
WHERE 
    tarR.id_fk_tarea IS NULL
GROUP BY 
    tarP.id_tarea_publicacion";

        $stmt = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $stmt->execute();
        // recupero resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;


    }



    public function mostrarEvaluaciones()
    {


        $sql = "SELECT 
    tarP.id_evaluacion,
    tarP.id_fk_asignar,
    tarP.fechaLimite,
    tarP.fechaFinEva,
    tarP.horaInicio,
    tarP.nombreTitulo,
    curso.id_fk_curso as idCurso
FROM 
    asignar_curso as curso
LEFT JOIN 
    evaluacion_datos as tarP ON curso.id_fk_estudiante = " . $_SESSION['id'] . " AND tarP.id_fk_asignar = curso.id_fk_curso
LEFT JOIN 
    evaluacion_respuesta as tarR ON tarR.id_fk_evaluacion = tarP.id_evaluacion AND tarR.id_fk_usuario = " . $_SESSION['id'] . "
WHERE 
    tarR.id_fk_evaluacion IS NULL
GROUP BY 
    tarP.id_evaluacion;";

        $stmt = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $stmt->execute();
        // recupero resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;





    }
}