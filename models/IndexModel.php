<?php
require_once 'config/Conexion.php';

class IndexModel
{
    private $conexion;
    public function __construct()
    {
        $this->conexion = Conexion::getConexion(); /* establece conexion con la BD*/
    }
   

    
}