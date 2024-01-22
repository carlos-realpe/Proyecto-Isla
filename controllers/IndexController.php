<?php
require_once 'models/IndexModel.php';


class IndexController
{
  private $model;
  /*Constructor*/
    public function __construct() 
    {
        $this->model = new IndexModel(); /*Crea al un objeto de IndexModel */
    }

    public function Index()
    {
      // require_once 'views/Inicio.php'; /* llama a la seccion viesw/inicio */
    //require_once 'views/Login/Login.php';
    header('Location:index.php?c=Login&a=login');


  }
}
