<?php
require_once 'config/conexion.php';

class EstudianteModel
{

    private $conexion;
    public function __construct()
    {
        $this->conexion = Conexion::getConexion(); /* establece conexion con la BD*/
    }



    public function mostrarDatosAjaxEstudiante()
    {
        $sql = "SELECT id_usuario,grado,email,primer_nombre,primer_apellido FROM `usuario` INNER JOIN `estudiante` ON `id_usuario`= `id_fk_usuario` where rol='estudiante'";

        $stmt = $this->conexion->prepare($sql);
        //ejecuto la sentencia
        $stmt->execute();
        // recupero resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // retorno resultados
        return $resultados;

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


    public function RegistrarEstudiante($email, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $pass, $cedula, $rol, $foto, $grado, $telefono, $primerNombreR, $segundoNombreR, $primerApellidoR, $segundoApellidoR, $telefonoR, $emailR, $telefonoOtroR)
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



        $sentencia->execute($datas);
        $nuevaIDUsuario = $this->conexion->lastInsertId();
        /**********Representate Datos insert */
        $sqlEstudiante = "INSERT INTO `representante` (`id_representante`, `primer_nombreR`,`segundo_nombreR`, `primer_apellidoR`,`segundo_apellidoR`, `telefono`,`emailR`,`otro_tef_contacto`) VALUES (null, :primerNombreR,:segundoNombreR,:primerApellidoR,:segundoApellidoR, :telefonoR,:emailR,:telefonoOtroR)";
        $sentenciaEstudiante = $this->conexion->prepare($sqlEstudiante);
        $datasEstudiante = [
            'primerNombreR' => $primerNombreR,
            'segundoNombreR' => $segundoNombreR, // Ajusta esto según tus necesidades
            'primerApellidoR' => $primerApellidoR,
            'segundoApellidoR' => $segundoApellidoR,
            'telefonoR' => $telefonoR, // Ajusta esto según tus necesidades
            'emailR' => $emailR,
            'telefonoOtroR' => $telefonoOtroR,
        ];

        $sentenciaEstudiante->execute($datasEstudiante);
        $nuevaIDRepresentante = $this->conexion->lastInsertId();
        /*********************************ESTUDIANTE ****************************/


        $sqlAdmin = "INSERT INTO `estudiante` (`id_estudiante`, `grado`,`telefono_estudiante`,`id_fk_representante` ,`id_fk_usuario`) VALUES (null, :grado, :telefono,:nuevaIDRepresentante,:nuevaIDUsuario)";
        $sentenciaAdmin = $this->conexion->prepare($sqlAdmin);

        $datasAdmin = [
            'nuevaIDUsuario' => $nuevaIDUsuario,
            'grado' => $grado, // Ajusta esto según tus necesidades
            'nuevaIDRepresentante' => $nuevaIDRepresentante,
            'telefono' => $telefono,
        ];

        $sentenciaAdmin->execute($datasAdmin);


        /****************** ID para estudiante************* */
        /*
                $nuevaIDRepresentante = $this->conexion->lastInsertId();
                $sqlRepresentante = "UPDATE `estudiante` SET `id_fk_representante` =:nuevaIDRepresentante WHERE `id_fk_usuario` =:nuevaIDUsuario";

                $sentenciaRepresentante = $this->conexion->prepare($sqlRepresentante);
                //bind parameters
                $datasRepresentante = [
                    'nuevaIDUsuario' => $nuevaIDUsuario,       
                ];

                //retornar resultados
                $sentenciaRepresentante->execute($datasRepresentante);

        */
        if ($sentencia->rowCount() <= 0) {

            return false;
        }
        return true;
    }

    public function consultarDatosAjaxEstudiante($buscar)
    {
        $sql = "SELECT id_usuario,grado,email,primer_nombre,primer_apellido FROM `usuario` INNER JOIN `estudiante` ON `id_usuario`= `id_fk_usuario` where rol='estudiante' and email like :b1";
        $stmt = $this->conexion->prepare($sql);
        $conlike = '%' . $buscar . '%';
        $data = [
            'b1' => $conlike,
        ];
        $stmt->execute($data);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    public function eliminarDatosAjaxEstudiante($idUserAdmin)
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

    public function editarMostrarDatosEstudiante($id)
    {
        $sql = "SELECT * FROM `usuario`  INNER JOIN `estudiante` ON `id_usuario`=" . $id . " INNER JOIN `representante` ON id_fk_representante=id_representante WHERE `id_fk_usuario`= " . $id . "";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultados;
    }

    public function editarGuardarMostrarDatosEstudiante($idRepresentante, $idAdmin, $email, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $pass, $cedula, $rol, $foto, $grado, $telefono, $primerNombreR, $segundoNombreR, $primerApellidoR, $segundoApellidoR, $telefonoR, $emailR, $telefonoOtroR)
    {

     
        /* DTOS DEL REPRESENTANTE*/
        $sqlRepresentante = "UPDATE `representante` SET `primer_nombreR` =:primerNombreR,`segundo_nombreR`=:segundoNombreR,`primer_apellidoR` =:primerApellidoR, `segundo_apellidoR` =:segundoApellidoR,`telefono` =:telefonoR,`emailR` =:emailR,`otro_tef_contacto` =:telefonoOtroR WHERE `id_representante` =:idRepresentante";

        $sentenciaRepresentante = $this->conexion->prepare($sqlRepresentante);
        //bind parameters
        $dataRepresentante = [
            'primerNombreR' => $primerNombreR,
            'segundoNombreR' => $segundoNombreR,
            'primerApellidoR' => $primerApellidoR,
            'segundoApellidoR' => $segundoApellidoR,

            'telefonoR' => $telefonoR,
            'emailR' => $emailR,
            'telefonoOtroR' => $telefonoOtroR,

            'idRepresentante' => $idRepresentante,
        ];
        //retornar resultados
        $sentenciaRepresentante->execute($dataRepresentante);


        /* DTOS DEL ESTUDIANTE*/
        $sqlEstudiante = "UPDATE `estudiante` SET `grado` =:grado,`telefono_estudiante`=:telefono WHERE `id_fk_usuario` =:idAdmin";

        $sentenciaEstudiante = $this->conexion->prepare($sqlEstudiante);
        //bind parameters
        $dataEstudiante = [
            'grado' => $grado,
            'telefono' => $telefono,
            'idAdmin' => $idAdmin,
        ];
        //retornar resultados
        $sentenciaEstudiante->execute($dataEstudiante);

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

      

        if ($sentencia->rowCount() <= 0 && $sentenciaEstudiante->rowCount() <= 0) {
            return false;
        }
        return true;





    }

}