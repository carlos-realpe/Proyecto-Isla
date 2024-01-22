<?php
require_once 'config/conexion.php';

class PerfilModel
{
    private $conexion;
    public function __construct()
    {
        $this->conexion = Conexion::getConexion(); /* establece conexion con la BD*/
    }
    public function PerfilMostrar()
    {
        if ($_SESSION['rol'] == "estudiante") {
            $sql = "SELECT * FROM `usuario` INNER JOIN estudiante on id_usuario=id_fk_usuario WHERE `id_usuario`= " . $_SESSION['id'] . "";
        }
        if ($_SESSION['rol'] == "admin") {
            $sql = "SELECT * FROM `usuario` WHERE `id_usuario`= " . $_SESSION['id'] . "";

        }
        if ($_SESSION['rol'] == "docente") {
            $sql = "SELECT * FROM `usuario` INNER JOIN docente on id_usuario=id_fk_usuario WHERE `id_usuario`= " . $_SESSION['id'] . "";
        }



        $stmt = $this->conexion->prepare($sql);

        $stmt->execute();

        $resultados = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultados;

    }

    public function EditarGuargarPerfil($idUser, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $pass, $foto, $cedula){
        $sql = "UPDATE `usuario` SET `primer_nombre` =:primerNombre, `segundo_nombre` =:segundoNombre, `primer_apellido` =:primerApellido, `segundo_apellido` =:segundoApellido, `password` =:pass, `cedula` =:cedula, `foto` =:foto WHERE `id_usuario` =:idUser";

        $sentencia = $this->conexion->prepare($sql);
        //bind parameters
        $datas = [
            'pass' => $pass,
            'primerNombre' => $primerNombre,
            'segundoNombre' => $segundoNombre,
            'primerApellido' => $primerApellido,
            'segundoApellido' => $segundoApellido,
            'foto' => $foto,
            'cedula' => $cedula,
            'idUser' => $idUser,


        ];

        //retornar resultados
        $sentencia->execute($datas);



    }
}