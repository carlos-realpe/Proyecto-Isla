<?php
class Conexion{
    public static function getConexion()
    {
        $database_username = 'root';  /*nombre de usuario de mysql*/
        $database_password = ''; /*contraseña de usuario de mysql*/
        $dbname = "isla_seymour"; /*nombre de la base de datos*/
        $dsn ='mysql:host=localhost;dbname='.$dbname; /* dbname nombre de la base de datos*/
        $conexion=null;
        try{
            $conexion = new PDO($dsn,$database_username,$database_password); /*accede a la bd*/
        } catch (Exception $error){
            die("error". $error->getMessage());  /* muestra mensaje en caso de error*/
        }
        return $conexion;
    }
}



