<?php
require_once 'config/conexion.php';

class AdminModel
{
    private $conexion;
    public function __construct()
    {
        $this->conexion = Conexion::getConexion(); /* establece conexion con la BD*/
    }

    public function RegistrarAdmin($email, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $pass, $estado, $cedula, $rol, $foto)
    {
        /*sentencia sql*/

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
        /* CAMPOS DE ADMIN*/

        $sentencia->execute($datas);

        $nuevaIDUsuario = $this->conexion->lastInsertId();

        $sqlAdmin = "INSERT INTO `admin` (`id_admin`, `estado`, `id_fk_usuario`) VALUES (null, :estado, :nuevaIDUsuario)";
        $sentenciaAdmin = $this->conexion->prepare($sqlAdmin);

        $datasAdmin = [
            'nuevaIDUsuario' => $nuevaIDUsuario,
            'estado' => $estado, // Ajusta esto según tus necesidades
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





    public function mostrarDatosAjaxAdmin()
    {

        $sql = "SELECT id_usuario,estado,email,primer_nombre,primer_apellido FROM `usuario` INNER JOIN `admin` ON `id_usuario`= `id_fk_usuario` where rol='admin'";

        $stmt = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $stmt->execute();
        // recupero resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;
    }
    public function consultarDatosAjaxAdmin($buscar)
    {

        $sql = "SELECT id_usuario,estado,email,primer_nombre,primer_apellido FROM `usuario` INNER JOIN `admin` ON `id_usuario`= `id_fk_usuario` where rol='admin' and email like :b1";
        $stmt = $this->conexion->prepare($sql);
        $conlike = '%' . $buscar . '%';
        $data = [
            'b1' => $conlike,
        ];
        $stmt->execute($data);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    public function eliminarDatosAjaxAdmin($idUserAdmin)
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

    public function editarMostrarDatosAdmin($id)
    {

        $sql = "SELECT * FROM `usuario`  INNER JOIN `admin` ON `id_usuario`=" . $id . " WHERE `id_fk_usuario`= " . $id . "";
        $stmt = $this->conexion->prepare($sql);

        $stmt->execute();

        $resultados = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultados;


    }



    public function editarGuardarMostrarDatosAdmin($idAdmin, $email, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $pass, $estado, $cedula, $rol, $foto)
    {
        /* DTOS DEL ADMIN*/
        $sqlAdmin = "UPDATE `admin` SET `estado` =:estado WHERE `id_fk_usuario` =:idAdmin";

        $sentenciaAdmin = $this->conexion->prepare($sqlAdmin);
        //bind parameters
        $datasAdmin = [
            'estado' => $estado,
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



    /************************************************GENERACION DE CURSOS *************************/
    public function mostrarDatosAjaxCursos()
    {

        $sql = "SELECT * FROM `curso`";

        $stmt = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $stmt->execute();
        // recupero resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;



    }
    public function RegistrarCurso($nombreCurso, $grado, $paralelo)
    {
        $sql = "INSERT INTO `curso` (`id_curso`, `nombre_curso`, `paralelo`, `grado`) VALUES 
(null, :nombreCurso, :paralelo, :grado)";

        $sentencia = $this->conexion->prepare($sql);
        $datas = [
            'nombreCurso' => $nombreCurso,
            'grado' => $grado,
            'paralelo' => $paralelo,
        ];
        //Ejecuta
        /* CAMPOS DE ADMIN*/
        $sentencia->execute($datas);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;
    }

    public function consultarDatosAjaxCurso($buscar, $grado)
    {

        $sql = "SELECT * FROM `curso` where nombre_curso like :b1 and grado like :b2";


        $stmt = $this->conexion->prepare($sql);
        $conlike = '%' . $buscar . '%';
        $gradoB = '%' . $grado . '%';
        $data = [
            'b2' => $gradoB,  //grado busqueda
            'b1' => $conlike, // nombre busqueda
        ];
        $stmt->execute($data);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    public function eliminarDatosAjaxCurso($idCursoAdmin)
    {
        $sql = "DELETE FROM curso where id_curso=:idCursoAdmin";

        $sentencia = $this->conexion->prepare($sql);

        //bind parameters
        $data = [
            'idCursoAdmin' => $idCursoAdmin,
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


    public function editarMostrarDatosCurso($idAdmin)
    {
        $sql = 'SELECT * from curso where id_curso=' . $idAdmin;
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();
        $resultados = $sentencia->fetch(PDO::FETCH_ASSOC);
        return $resultados;


    }

    public function EditarCurso($idCurso, $nombreCurso, $grado, $paralelo)
    {
        $sql = "UPDATE `curso` SET `nombre_curso`=:nombreCurso, `paralelo`=:paralelo, `grado`=:grado where id_curso=:idCurso";
        $sentencia = $this->conexion->prepare($sql);
        $data = [
            'nombreCurso' => $nombreCurso,
            'paralelo' => $paralelo,
            'grado' => $grado,
            'idCurso' => $idCurso,
        ];
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {
            return false;
        }
        return true;
    }


    public function MostrarDocentes()
    {
        $sql = "SELECT id_usuario,CONCAT(primer_nombre, ' ', primer_apellido, ' ',segundo_apellido) AS nombre_completo from docente INNER JOIN usuario on id_usuario=id_fk_usuario where rol='docente'";
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;

    }
    public function MostrarMateria()
    {
        $sql = "SELECT * from materia";
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }
    public function MostrarEstudiantes()
    {
        $sql = "SELECT id_usuario,CONCAT(primer_nombre, ' ', primer_apellido, ' ',segundo_apellido) AS nombre_completo, grado from estudiante INNER JOIN usuario on id_usuario=id_fk_usuario where rol='estudiante'";
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;

    }
    public function MostrarCurso()
    {
        $sql = "SELECT * from curso";
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;

    }

    public function RegistrarAsignacion($curso, $docente, $estudiante, $materia)
    {
        $sql = "INSERT `asignar_curso` (`id_asignar`,`id_fk_curso`,`id_fk_docente`,`id_fk_estudiante`,`id_fk_materia`)VALUES 
(null,:curso,:docente,:estudiante,:materia)";
        $sentencia = $this->conexion->prepare($sql);

        $data = [
            'curso' => $curso,
            'docente' => $docente,
            'estudiante' => $estudiante,
            'materia' => $materia,
        ];
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {

            return false;
        }
        return true;

    }
    public function mostrarDatosAjaxAsignados()
    {
        $sql = "SELECT CONCAT(primer_nombre, ' ', primer_apellido, ' ',segundo_apellido) AS nombre_completo,nombre_curso,nombre_materia,grado,paralelo,id_asignar from curso INNER JOIN asignar_curso on id_curso=id_fk_curso INNER JOIN materia on id_materia=id_fk_materia INNER JOIN usuario on id_fk_estudiante=id_usuario ORDER BY id_asignar DESC";
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    public function consultarDatosAjaxAsignados($buscar, $grado)
    {
        $sql = "SELECT CONCAT(primer_nombre, ' ', primer_apellido, ' ',segundo_apellido) AS nombre_completo,nombre_curso,nombre_materia,grado,paralelo,id_asignar FROM `curso` curso INNER JOIN asignar_curso on id_curso=id_fk_curso INNER JOIN materia on id_materia=id_fk_materia INNER JOIN usuario on id_fk_estudiante=id_usuario where primer_apellido like :b1 and grado like :b2";


        $stmt = $this->conexion->prepare($sql);
        $conlike = '%' . $buscar . '%';
        $gradoB = '%' . $grado . '%';
        $data = [
            'b2' => $gradoB,  //grado busqueda
            'b1' => $conlike, // nombre busqueda
        ];
        $stmt->execute($data);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    public function editarMostrarDatosAsignados($idAdmin)
    {

        $sql = 'SELECT * from asignar_curso where id_asignar=' . $idAdmin;
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();
        $resultados = $sentencia->fetch(PDO::FETCH_ASSOC);
        return $resultados;
    }

    public function EditarAsignacion($idAsignar, $curso, $docente, $estudiante, $materia)
    {
        $sqlAdmin = "UPDATE `asignar_curso` SET `id_fk_curso` =:curso,`id_fk_docente` =:docente,`id_fk_estudiante` =:estudiante,`id_fk_materia` =:materia  WHERE `id_asignar` =:idAsignar";

        $sentenciaAdmin = $this->conexion->prepare($sqlAdmin);
        //bind parameters
        $datasAdmin = [
            'curso' => $curso,
            'docente' => $docente,
            'estudiante' => $estudiante,
            'materia' => $materia,
            'idAsignar' => $idAsignar,
        ];
        //retornar resultados
        $sentenciaAdmin->execute($datasAdmin);
        if ($sentenciaAdmin->rowCount() <= 0) {

            return false;
        }
        return true;

    }

    public function eliminarDatosAjaxAsignacion($idAsignar)
    {
        $sql = "DELETE from asignar_curso where id_asignar=:idAsignar";
        $sentencia = $this->conexion->prepare($sql);
        $data = [
            'idAsignar' => $idAsignar,
        ];
        $sentencia->execute($data);

    }




    public function mostrarDatosAjaxMateria()
    {
        $sql = "SELECT * FROM materia";


        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;


    }
    public function guardarCalendario($materia)
    {

        $sql = "INSERT `materia` (`id_materia`,`nombre_materia`)VALUES 
(null,:materia)";
        $sentencia = $this->conexion->prepare($sql);

        $data = [
            'materia' => $materia,
        ];
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {

            return false;
        }
        return true;

    }

    public function materiaEditar($materia,$id){
        $sqlAdmin = "UPDATE `materia` SET `nombre_materia` =:materia  WHERE `id_materia` =:id";


        $sentenciaAdmin = $this->conexion->prepare($sqlAdmin);
        //bind parameters
        $datasAdmin = [
            'materia' => $materia,
            'id' => $id,
              ];

        //retornar resultados
        $sentenciaAdmin->execute($datasAdmin);
        if ($sentenciaAdmin->rowCount() <= 0) {

            return false;
        }
        return true;


    }

    public function eliminarMateria($id){
        $sql = "DELETE FROM `materia` WHERE `id_materia`=:id";
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


    public function consultarMateria($buscar){
        $sql = "SELECT * FROM `materia` where nombre_materia like :b1";
        $stmt = $this->conexion->prepare($sql);
        $conlike = '%' . $buscar . '%';
        $data = [
            'b1' => $conlike,
        ];
        $stmt->execute($data);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;

    }
}