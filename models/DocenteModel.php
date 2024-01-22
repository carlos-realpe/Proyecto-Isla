<?php
require_once 'config/conexion.php';

class DocenteModel
{
    private $conexion;
    public function __construct()
    {
        $this->conexion = Conexion::getConexion(); /* establece conexion con la BD*/
    }


    /*********************************************************DOCENTE********************** */
    public function VistaDatosDocente()
    {
        $sql = "SELECT id_usuario,titulo ,email,primer_nombre,primer_apellido FROM `usuario` INNER JOIN `docente` ON `id_usuario`= `id_fk_usuario` where rol='docente'";

        $stmt = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $stmt->execute();
        // recupero resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;

    }

    public function RegistrarDocente($email, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $pass, $titulo, $materia, $telefono, $cedula, $rol, $foto)
    {
        $sql = "INSERT INTO `usuario` (`id_usuario`, `email`, `password`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `foto`, `cedula`, `rol`, `fecha_registro`) VALUES 
(null, :email, :pass, :primerNombre, :segundoNombre,:primerApellido,:segundoApellido, :foto, :cedula, :rol,CURRENT_TIMESTAMP)";

        $sentencia = $this->conexion->prepare($sql);
        $datas = [
            'email' => $email,
            'pass' => $pass,
            'primerNombre' => $primerNombre,
            'segundoNombre' => $segundoNombre,
            'primerApellido' => $primerApellido,
            'segundoApellido' => $segundoApellido,
            'foto' => $foto,
            'cedula' => $cedula,
            'rol' => $rol,


        ];
        //Ejecuta
        /* CAMPOS DE DOCENTE*/

        $sentencia->execute($datas);

        $nuevaIDUsuario = $this->conexion->lastInsertId();

        $sqlAdmin = "INSERT INTO `docente` (`id_docente`, `titulo`,`materia`,`telefono`, `id_fk_usuario`) VALUES (null, :titulo,:materia,:telefono, :nuevaIDUsuario)";
        $sentenciaAdmin = $this->conexion->prepare($sqlAdmin);

        $datasAdmin = [
            'nuevaIDUsuario' => $nuevaIDUsuario,
            'titulo' => $titulo,
            'materia' => $materia,
            'telefono' => $telefono,
        ];

        $sentenciaAdmin->execute($datasAdmin);




        if ($sentencia->rowCount() <= 0) {

            return false;
        }
        return true;

    }

    public function consultarCorreo($email)
    {
        $sql = "select * from usuario where email=:email";
        $stmt = $this->conexion->prepare($sql);
        $data = ['email' => $email];
        $stmt->execute($data);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() <= 0) { /// esta cprrectactamente
            return $resultado = null;
        }
        return $resultado;
    }


    public function consultarDatosAjaxDocente($buscar)
    {
        $sql = "SELECT id_usuario,titulo,email,primer_nombre,primer_apellido FROM `usuario` INNER JOIN `docente` ON `id_usuario`= `id_fk_usuario` where rol='docente' and email like :b1";
        $stmt = $this->conexion->prepare($sql);
        $conlike = '%' . $buscar . '%';
        $data = [
            'b1' => $conlike,
        ];
        $stmt->execute($data);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;

    }

    public function eliminarDatosAjaxDocente($idUserAdmin)
    {
        $sql = "DELETE FROM `usuario` WHERE `id_usuario`=:idUserAdmin";
        $sentencia = $this->conexion->prepare($sql);
        //bind parameters
        $data = [
            'idUserAdmin' => $idUserAdmin,
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



    public function editarMostrarDatosDocente($id)
    {
        $sql = "SELECT * FROM `usuario`  INNER JOIN `docente` ON `id_usuario`=" . $id . " WHERE `id_fk_usuario`= " . $id . "";
        $stmt = $this->conexion->prepare($sql);

        $stmt->execute();


        $resultados = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultados;


    }

    public function editarGuardarMostrarDatosDocente($idAdmin, $email, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $pass, $titulo, $materia, $telefono, $cedula, $rol, $foto)
    {
        $sqlAdmin = "UPDATE `docente` SET `titulo` =:titulo, `materia` =:materia, `telefono` =:telefono   WHERE `id_fk_usuario` =:idAdmin";

        $sentenciaAdmin = $this->conexion->prepare($sqlAdmin);
        //bind parameters
        $datasAdmin = [
            'titulo' => $titulo,
            'materia' => $materia,
            'telefono' => $telefono,
            'idAdmin' => $idAdmin,

        ];
        //retornar resultados
        $sentenciaAdmin->execute($datasAdmin);

        /*DATOS DEL USUARIO  */
        $sql = "UPDATE `usuario` SET `email` =:email, `primer_nombre` =:primerNombre, `segundo_nombre` =:segundoNombre, `primer_apellido` =:primerApellido, `segundo_apellido` =:segundoApellido, `password` =:pass, `cedula` =:cedula, `rol` =:rol, `foto` =:foto WHERE `id_usuario` =:idAdmin";

        $sentencia = $this->conexion->prepare($sql);
        //bind parameters
        $datas = [
            'email' => $email,
            'pass' => $pass,
            'primerNombre' => $primerNombre,
            'segundoNombre' => $segundoNombre,
            'primerApellido' => $primerApellido,
            'segundoApellido' => $segundoApellido,
            'foto' => $foto,
            'cedula' => $cedula,
            'rol' => $rol,
            'idAdmin' => $idAdmin,


        ];

        //retornar resultados
        $sentencia->execute($datas);



        if ($sentencia->rowCount() <= 0 && $sentenciaAdmin->rowCount() <= 0) {

            return false;
        }
        return true;





    }


    /*****************************************DOCENTE*************************** */


    public function mostrarClases()
    {
        if ($_SESSION['rol'] == "docente") {
            $sql = "SELECT CONCAT(UCASE(SUBSTRING(nombre_materia, 1, 1)), LCASE(SUBSTRING(nombre_materia, 2))) AS nombre_materia,grado,nombre_curso,paralelo,id_fk_curso from asignar_curso inner join curso on id_fk_curso=id_curso inner join materia on id_fk_materia=id_materia WHERE id_fk_docente=" . $_SESSION['id'] . " GROUP BY nombre_materia, grado, nombre_curso, paralelo, id_fk_curso";
        }
        if ($_SESSION['rol'] == "estudiante") {
            $sql = "SELECT CONCAT(UCASE(SUBSTRING(nombre_materia, 1, 1)), LCASE(SUBSTRING(nombre_materia, 2))) AS nombre_materia,grado,nombre_curso,paralelo,id_asignar,id_fk_curso from asignar_curso inner join curso on id_fk_curso=id_curso inner join materia on id_fk_materia=id_materia WHERE id_fk_estudiante=" . $_SESSION['id'];
        }


        $sentencia = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $sentencia->execute();
        // recupero resultados
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;

    }

    public function RegistrarReunion($idAsignar, $nombreReunion, $fecha, $hora, $enlace)
    {

        $sql = "INSERT INTO `reunion` (`id_reunion`, `nombre_reunion`,`fecha`,`hora`, `enlace`,`id_fk_asignar`) VALUES (null, :nombreReunion,:fecha,:hora, :enlace,:idAsignar)";
        $sentencia = $this->conexion->prepare($sql);
        $data = [
            "idAsignar" => $idAsignar,
            "nombreReunion" => $nombreReunion,
            "fecha" => $fecha,
            "hora" => $hora,
            "enlace" => $enlace,
        ];
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;
    }

    public function MostrarReunion($idAsignacion)
    {
        $sql = "SELECT * from reunion WHERE id_fk_asignar=" . $idAsignacion . " ORDER BY id_reunion DESC";

        $sentencia = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $sentencia->execute();
        // recupero resultados
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;
    }

    public function EditarReunion($idReunion, $nombreReunion, $fecha, $hora, $enlace)
    {

        $sql = "UPDATE `reunion` SET `nombre_reunion` =:nombreReunion, `fecha` =:fecha, `hora` =:hora, `enlace` =:enlace   WHERE `id_reunion` =:idReunion";

        $sentencia = $this->conexion->prepare($sql);
        //bind parameters
        $datas = [
            'idReunion' => $idReunion,
            'nombreReunion' => $nombreReunion,
            'fecha' => $fecha,
            'hora' => $hora,
            'enlace' => $enlace,

        ];
        //retornar resultados
        $sentencia->execute($datas);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;

    }


    public function eliminarReunionAjax($idReunion)
    {
        $sql = "DELETE FROM `reunion` WHERE `id_reunion`=:idReunion";
        $sentencia = $this->conexion->prepare($sql);
        //bind parameters
        $data = [
            'idReunion' => $idReunion,
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

    public function mostrarForosDatos($idAsignacion)
    {
        if ($_SESSION['rol'] == "docente") {
            $sql = "SELECT * from foro_publicacion WHERE id_fk_asignar=" . $idAsignacion . " ORDER BY id_foro_publicacion DESC";
        }
        if ($_SESSION['rol'] == "estudiante") {
            $sql = "SELECT * from foro_publicacion where id_fk_asignar=" . $idAsignacion . " ORDER BY id_foro_publicacion DESC;";
        }

        $sentencia = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $sentencia->execute();
        // recupero resultados
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;

    }
    public function RegistrarForo($idAsignar, $titulo, $horaLimite, $fechaLimite, $editorQuill, $parcial, $fechaFin)
    {
        $sql = "INSERT INTO `foro_publicacion` (`id_foro_publicacion`, `titulo`,`fechaForo`,`fechaFin`,`horaForo`, `descripcion`, `parcial`,`id_fk_asignar`) VALUES (null, :titulo,:fechaLimite,:fechaFin,:horaLimite, :editorQuill,:parcial,:idAsignar)";
        $sentencia = $this->conexion->prepare($sql);
        $data = [
            "idAsignar" => $idAsignar,
            "titulo" => $titulo,
            "horaLimite" => $horaLimite,
            "fechaLimite" => $fechaLimite,

            "fechaFin" => $fechaFin,
            "parcial" => $parcial,
            "editorQuill" => $editorQuill,
        ];
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;
    }



    public function EditarForo($titulo, $horaLimite, $fechaLimite, $editorQuill, $parcial, $idForo, $fechaFin)
    {
        $sql = "UPDATE `foro_publicacion` SET `titulo` =:titulo, `fechaForo` =:fechaLimite,`fechaFin`=:fechaFin ,`horaForo` =:horaLimite, `descripcion` =:editorQuill,`parcial`=:parcial   WHERE `id_foro_publicacion` =:idForo";
        $sentencia = $this->conexion->prepare($sql);
        $data = [
            "titulo" => $titulo,
            "horaLimite" => $horaLimite,
            "fechaLimite" => $fechaLimite,
            "fechaFin" => $fechaFin,
            "parcial" => $parcial,
            "editorQuill" => $editorQuill,
            "idForo" => $idForo,

        ];
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;


    }

    public function EliminarForo($idForo)
    {
        $sql = "DELETE FROM `foro_publicacion` WHERE `id_foro_publicacion`=:idForo";
        $sentencia = $this->conexion->prepare($sql);
        //bind parameters
        $data = [
            'idForo' => $idForo,
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

    /****************TAREAS******************** */
    public function mostrarTareasAjax($idAsignacion)
    {
        $sql = "SELECT * from tareas_publicacion WHERE id_fk_asignar=" . $idAsignacion . " ORDER BY id_tarea_publicacion DESC";

        $sentencia = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $sentencia->execute();
        // recupero resultados
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;
    }


    public function RegistrarTarea($idAsignar, $titulo, $horaLimite, $fechaLimite, $editorQuill, $parcial, $tipoArchivo)
    {
        $sql = "INSERT INTO `tareas_publicacion` (`id_tarea_publicacion`, `titulo_tarea`,`fechaTarea`,`horaTarea`, `descripcion`, `parcial_tarea`,`tipo_archivo`,`id_fk_asignar`) VALUES (null, :titulo,:fechaLimite,:horaLimite, :editorQuill,:parcial,:tipoArchivo,:idAsignar)";
        $sentencia = $this->conexion->prepare($sql);
        $data = [
            "idAsignar" => $idAsignar,
            "titulo" => $titulo,
            "horaLimite" => $horaLimite,
            "fechaLimite" => $fechaLimite,
            "parcial" => $parcial,
            "editorQuill" => $editorQuill,
            "tipoArchivo" => $tipoArchivo,
        ];
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;
    }


    public function EditarTarea($idTarea, $titulo, $horaLimite, $fechaLimite, $editorQuill, $parcial, $tipoArchivo)
    {
        $sql = "UPDATE `tareas_publicacion` SET `titulo_tarea` =:titulo, `fechaTarea` =:fechaLimite, `horaTarea` =:horaLimite, `descripcion` =:editorQuill,`parcial_tarea`=:parcial,`tipo_archivo`=:tipoArchivo    WHERE `id_tarea_publicacion` =:idTarea";
        $sentencia = $this->conexion->prepare($sql);
        $data = [
            "titulo" => $titulo,
            "horaLimite" => $horaLimite,
            "fechaLimite" => $fechaLimite,
            "parcial" => $parcial,
            "editorQuill" => $editorQuill,
            "tipoArchivo" => $tipoArchivo,
            "idTarea" => $idTarea,
        ];
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;
    }
    public function eliminarTareaAjax($idTarea)
    {
        $sql = "DELETE FROM `tareas_publicacion` WHERE `id_tarea_publicacion`=:idTarea";
        $sentencia = $this->conexion->prepare($sql);
        //bind parameters
        $data = [
            'idTarea' => $idTarea,
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



    /*********************EVALUACIONES */
    public function RegistrarEvaluaciones($idAsignar, $nombreTitulo, $horaInicio, $horaLimite, $fechaLimite, $parcial, $tipo, $fechaFin)
    {
        $sql = "INSERT INTO `evaluacion_datos` (`id_evaluacion`, `nombreTitulo`,`fechaLimite`,`fechaFinEva`,`horaInicio`,`horaLimite`, `parcial`, `tipo`,`id_fk_asignar`) VALUES (null, :nombreTitulo,:fechaLimite,:fechaFin,:horaInicio,:horaLimite, :parcial,:tipo,:idAsignar)";
        $sentencia = $this->conexion->prepare($sql);
        $data = [
            "idAsignar" => $idAsignar,
            "nombreTitulo" => $nombreTitulo,
            "horaInicio" => $horaInicio,
            "horaLimite" => $horaLimite,
            "fechaLimite" => $fechaLimite,
            "fechaFin" => $fechaFin,
            "parcial" => $parcial,
            "tipo" => $tipo,
        ];
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;
    }


    public function mostrarEvaluacionAjax($idAsignacion)
    {
        if ($_SESSION['rol'] == "docente") {
            $sql = "SELECT * from evaluacion_datos WHERE id_fk_asignar=" . $idAsignacion . " ORDER BY id_evaluacion DESC";
        } else {
            $sql = "SELECT evDa.*, evRes.estado
FROM evaluacion_datos AS evDa
LEFT JOIN evaluacion_respuesta AS evRes ON evDa.id_evaluacion = evRes.id_fk_evaluacion AND evRes.id_fk_usuario = " . $_SESSION['id'] . "  Where evDa.id_fk_asignar = " . $idAsignacion . " GROUP by evDa.id_evaluacion ORDER BY evDa.id_evaluacion DESC";
        }
        $sentencia = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $sentencia->execute();
        // recupero resultados
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;
    }
    /*
        public function estado($idAsignacion){
            $sql = "SELECT * from evaluacion_datos WHERE id_fk_asignar=" . $idAsignacion . " ORDER BY id_evaluacion DESC";

            $sentencia = $this->conexion->prepare($sql);
            //ejecuto la sentencia
            $sentencia->execute();
            // recupero resultados
            $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            // retorno resultados
            return $resultados;
        }*/

    public function EditarEvaluacion($idEvaluacion, $titulo, $horaInicio, $horaLimite, $fechaLimite, $parcial, $tipo, $fechaFin)
    {

        $sql = "UPDATE `evaluacion_datos` SET `nombreTitulo` =:titulo, `fechaLimite` =:fechaLimite,`fechaFinEva`=:fechaFin , `horaInicio` =:horaInicio, `horaLimite` =:horaLimite,`parcial`=:parcial,`tipo`=:tipo WHERE `id_evaluacion` =:idEvaluacion";
        $sentencia = $this->conexion->prepare($sql);
        $data = [
            "titulo" => $titulo,
            "horaInicio" => $horaInicio,
            "horaLimite" => $horaLimite,
            "fechaLimite" => $fechaLimite,
            "fechaFin" => $fechaFin,
            "parcial" => $parcial,
            "tipo" => $tipo,
            "idEvaluacion" => $idEvaluacion,
        ];
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;

    }

    public function eliminarEvaluacionAjax($idEvaluacion)
    {
        $sql = "DELETE FROM `evaluacion_datos` WHERE `id_evaluacion`=:idEvaluacion";
        $sentencia = $this->conexion->prepare($sql);
        //bind parameters
        $data = [
            'idEvaluacion' => $idEvaluacion,
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

    public function RegistrarPregunta($idEvaluacion, $pregunta, $puntaje)
    {

        $sql = "INSERT INTO `pregunta_evaluacion` (`id_pregunta`, `pregunta`,`puntaje`,`id_fk_evaluacion`) VALUES (null, :pregunta,:puntaje,:idEvaluacion)";
        $sentencia = $this->conexion->prepare($sql);
        $data = [
            "pregunta" => $pregunta,
            "idEvaluacion" => $idEvaluacion,
            "puntaje" => $puntaje,
        ];
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;
    }

    public function MostrarPreguntasAjax($idEvaluacion)
    {
        $sql = "SELECT * from pregunta_evaluacion WHERE id_fk_evaluacion=" . $idEvaluacion . " ORDER BY id_pregunta ASC";
        $sentencia = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $sentencia->execute();
        // recupero resultados
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;
    }
    public function MostrarRespuestaAjax($idEvaluacion)
    {
        $sql = "SELECT * from pregunta_respuesta inner join pregunta_evaluacion on id_fk_pregunta=id_pregunta where id_fk_evaluacion=" . $idEvaluacion;

        $sentencia = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $sentencia->execute();
        // recupero resultados
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;
    }

    public function guardarRespuesta($idPregunta, $respuesta)
    {
        $sql = "INSERT INTO `pregunta_respuesta` (`id_respuesta`, `respuesta`,`id_fk_pregunta`) VALUES (null,:respuesta,:idPregunta)";
        $sentencia = $this->conexion->prepare($sql);
        $data = [
            "idPregunta" => $idPregunta,
            "respuesta" => $respuesta,
        ];
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;
    }

    public function respuestaCorrecta($idRespuesta, $estado)
    {
        $sql = "UPDATE `pregunta_respuesta` SET `correcta` =:estado WHERE `id_respuesta` =:idRespuesta";
        $sentencia = $this->conexion->prepare($sql);
        $data = [
            "estado" => $estado,
            "idRespuesta" => $idRespuesta,
        ];
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;


    }

    public function EditarPregunta($idPregunta, $pregunta, $puntaje)
    {
        $sql = "UPDATE `pregunta_evaluacion` SET `pregunta` =:pregunta, `puntaje` =:puntaje  WHERE `id_pregunta` =:idPregunta";
        $sentencia = $this->conexion->prepare($sql);
        $data = [
            "idPregunta" => $idPregunta,
            "pregunta" => $pregunta,
            "puntaje" => $puntaje,
        ];
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;
    }

    public function EditarRespuesta($idRespuesta, $respuesta)
    {
        $sql = "UPDATE `pregunta_respuesta` SET `respuesta` =:respuesta WHERE `id_respuesta` =:idRespuesta";
        $sentencia = $this->conexion->prepare($sql);
        $data = [
            "idRespuesta" => $idRespuesta,
            "respuesta" => $respuesta,
        ];
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;
    }

    public function eliminarRespuesta($idRespuesta)
    {
        $sql = "DELETE FROM `pregunta_respuesta` WHERE `id_respuesta`=:idRespuesta";
        $sentencia = $this->conexion->prepare($sql);
        //bind parameters
        $data = [
            'idRespuesta' => $idRespuesta,
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

    public function confirmarEliminarPregunta($idPregunta)
    {
        $sql = "DELETE FROM `pregunta_evaluacion` WHERE `id_pregunta`=:idPregunta";
        $sentencia = $this->conexion->prepare($sql);
        //bind parameters
        $data = [
            'idPregunta' => $idPregunta,
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









    /****************CALIFICACIONES */


    public function mostrarForoCalificacion($idCurso)
    {


        $sql = "SELECT foroCal.calificacion, foroP.titulo, foroP.parcial
FROM foro_calificar as foroCal
RIGHT JOIN foro_respuestas as foroRes ON foroCal.id_fk_foro_respuesta = foroRes.id_foro_respuestas
RIGHT JOIN foro_publicacion as foroP ON foroRes.id_fk_foro = foroP.id_foro_publicacion AND foroRes.id_fk_estudiante = " . $_SESSION['id'] . "
WHERE foroP.id_fk_asignar = " . $idCurso . "
GROUP BY foroP.id_foro_publicacion";
        $sentencia = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $sentencia->execute();
        // recupero resultados
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;


    }

    public function mostrarTareaCalificacion($idCurso)
    {



        $sql = "SELECT tareaCal.calificacion, tareaP.titulo_tarea, tareaP.parcial_tarea
FROM tareas_calificacion as tareaCal
RIGHT JOIN tareas_respuestas as tareaRes ON tareaCal.id_fk_tarea_respuesta = tareaRes.id_tarea_respuesta
RIGHT JOIN tareas_publicacion as tareaP ON tareaRes.id_fk_tarea = tareaP.id_tarea_publicacion AND tareaRes.id_fk_estudiante = " . $_SESSION['id'] . "
WHERE tareaP.id_fk_asignar = " . $idCurso . "
GROUP BY tareaP.id_tarea_publicacion";
        $sentencia = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $sentencia->execute();
        // recupero resultados
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;




    }



    public function mostrarEvaluacionCalificacion($idCurso)
    {


        $sql = "SELECT nota,nombreTitulo,parcial,tipo
FROM evaluacion_datos
LEFT JOIN evaluacion_resultado ON id_fk_evaluacion = id_evaluacion and id_fk_usuario =" . $_SESSION['id'] . "
WHERE id_fk_asignar = " . $idCurso . "
GROUP BY id_evaluacion";
        $sentencia = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $sentencia->execute();
        // recupero resultados
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;





    }



    public function mostrarCalificacionEstudiantesForo($idCurso)
    {
        $sql = "select concat(primer_nombre,' ',segundo_nombre,' ',primer_apellido,' ',segundo_apellido) as nombre, AVG(CASE WHEN parcial = '1er Parcial' THEN calificacion ELSE null END) AS primerParcial, AVG(CASE WHEN parcial = '2do Parcial' THEN calificacion ELSE null END) AS segundoParcial  from usuario LEFT join foro_calificar on id_fk_usuario=id_usuario LEFT join foro_respuestas on id_fk_foro_respuesta=id_foro_respuestas LEFT join foro_publicacion on id_fk_foro=id_foro_publicacion where id_fk_asignar = " . $idCurso . " GROUP by id_usuario";
        $sentencia = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $sentencia->execute();
        // recupero resultados
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;

    }

    public function mostrarCalificacionEstudiantesTarea($idCurso){
        $sql ="select concat(primer_nombre,' ',segundo_nombre,' ',primer_apellido,' ',segundo_apellido) as nombre, AVG(CASE WHEN parcial_tarea = '1er Parcial' THEN calificacion ELSE null END) AS primerParcial, AVG(CASE WHEN parcial_tarea = '2do Parcial' THEN calificacion ELSE null END) AS segundoParcial  from usuario LEFT join tareas_calificacion on id_fk_usuario=id_usuario LEFT join tareas_respuestas on id_fk_tarea_respuesta=id_tarea_respuesta LEFT join tareas_publicacion on id_fk_tarea=id_tarea_publicacion where id_fk_asignar = ".$idCurso." GROUP by id_usuario";
        
        
        $sentencia = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $sentencia->execute();
        // recupero resultados
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;
    }



    public function mostrarCalificacionEstudianteEva($idCurso){

        $sql ="SELECT
    CONCAT(primer_nombre, ' ', segundo_nombre, ' ', primer_apellido, ' ', segundo_apellido) AS nombre,
    asignar_curso.id_fk_curso,
    AVG(CASE WHEN parcial = '1er Parcial' THEN nota ELSE NULL END) AS primerParcial,
    AVG(CASE WHEN parcial = '2do Parcial' THEN nota ELSE NULL END) AS segundoParcial
FROM
    asignar_curso
LEFT JOIN
    usuario ON asignar_curso.id_fk_estudiante = usuario.id_usuario
LEFT JOIN
    evaluacion_resultado ON usuario.id_usuario = evaluacion_resultado.id_fk_usuario
LEFT JOIN
    evaluacion_datos ON evaluacion_resultado.id_fk_evaluacion = evaluacion_datos.id_evaluacion and evaluacion_resultado.id_fk_curso = " . $idCurso . "
WHERE
    asignar_curso.id_fk_curso = ".$idCurso."
GROUP BY
    usuario.id_usuario";

        $sentencia = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $sentencia->execute();
        // recupero resultados
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;
    }


}

