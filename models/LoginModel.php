<?php
require_once 'config/conexion.php';

class LoginModel
{
    private $conexion;
    public function __construct()
    {
        $this->conexion = Conexion::getConexion(); /* establece conexion con la BD*/
    }

    public function validarLogin($email, $pass)
    {

        $sql = "select * from usuario left join admin on id_usuario=id_fk_usuario where email=:email and password=:pass";

        $stmt = $this->conexion->prepare($sql);

        $data = ['email' => $email, 'pass' => $pass];

        $stmt->execute($data);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() <= 0) { /// esta cprrectactamente

            return $resultado = null;
        }


        return $resultado;

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


    function ingresartoken($tk, $mail)
    {


        $sql = "UPDATE `usuario` SET `token`=:tk  WHERE `email`=:mail";


        $sentencia = $this->conexion->prepare($sql);


        $data = [
            'tk' => $tk,
            'mail' => $mail,

        ];
        //execute
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {

            return false;
        }

        return true;


    }

    public function consultatoken($token)
    {
        $sql = "select token from usuario where token=:auth";


        $stmt = $this->conexion->prepare($sql);

        $data = ['auth' => $token];

        $stmt->execute($data);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() <= 0) {
            return $resultado = null;
        }


        return $resultado;


    }



    public function cerrarSesion()
    {
        unset($_SESSION['login']);

        setcookie("email", "", time() - (60 * 60), "/");
        setcookie("password", "", time() - (60 * 60), "/");
        session_destroy();
    }



    public function insertar_pwtoken($pw, $tokensession)
    {
        $auth = $tokensession;
        $sql = "UPDATE `usuario` SET `password`=:pasword  WHERE `token`=:auth";


        $sentencia = $this->conexion->prepare($sql);


        $data = [
            'pasword' => $pw,
            'auth' => $auth,         
        ];
        //execute
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {

            return false;
        }
        return true;

    }


    public function deletetkn($tokensession)
    {
        $auth = $tokensession;
        $sql = "UPDATE `usuario` SET `token`=''  WHERE `token`=:auth";


        $sentencia = $this->conexion->prepare($sql);


        $data = [

            'auth' => $auth,
            // 'nombre' =>$nombre,

        ];
        //execute
        $sentencia->execute($data);
        if ($sentencia->rowCount() <= 0) {

            return false;
        }
        return true;
    }


}