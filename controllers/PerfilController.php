<?php
require_once 'models/PerfilModel.php';
session_start();


class PerfilController
{
    private $model;
    /*Constructor*/
    public function __construct()
    {
        $this->model = new PerfilModel(); /*Crea al un objeto  */
    }
    public function PerfilMostrar(){
        $resultados = $this->model->PerfilMostrar();
        $nombre = $resultados['primer_nombre']." ".$resultados['segundo_nombre'];
        $apellido = $resultados['primer_apellido'] . " " . $resultados['segundo_apellido'];
        require_once 'views/Perfil/Perfil.php';
    }


    public function EditarGuargarPerfil(){
        $validador = false;
        $idUser = $_GET["idUser"];
        $emailValidar = htmlentities($_POST['email']);
        $primerNombre = htmlentities($_POST['primerNombre']); ////////////********
        $segundoNombre = htmlentities($_POST['segundoNombre']);
        $primerApellido = htmlentities($_POST['primerApellido']);
        $segundoApellido = htmlentities($_POST['segundoApellido']);
        $pass = htmlentities($_POST['password']);
        $cedula = htmlentities($_POST['cedula']);
        /*Valida la insercion de correo */
            /* DATOS DEL ADMIn */
                     $foto = "";

            /************************************ ARCHIVO DE IMAGEN************************** */
 if($_SESSION['rol']=='docente'){
$rol ="Docente";
 }if($_SESSION['rol']=='estudiante'){
            $rol = "Estudiante";
 }if($_SESSION['rol']=='admin'){
            $rol = "Admin";
 }


            $url = "assets/institucion/$rol/ImagenPerfil/".$emailValidar."/";
            $foto = $url;
            // Verificar si el directorio actual existe.
            if (file_exists($url)) {
                $urlNuevo = "assets/institucion/$rol/ImagenPerfil/" . $emailValidar . "/";
                rename($url, $urlNuevo);  // renombra el direcotrio
                if (!file_exists($urlNuevo)) {
                    $foto = "assets/institucion/perfil/perfil.jpg";
                } else {
                    $foto = $urlNuevo . "perfil.jpg";
                    // Mueve el archivo al directorio destino
                    if (move_uploaded_file($_FILES['imagenFile']['tmp_name'], $foto)) {
                        $msj = htmlspecialchars(basename($_FILES["imagenFile"]["name"]));
                    } else {
                        // Mansaje el caso en que no se pueda mover el archivo
                        $msj = "Error al subir el archivo.";
                    }
                }
            } else {
                // El directorio actual no existe, manejar según sea necesario      
                if (basename($_FILES['imagenFile']['name']) == null) {
                    $foto = "assets/institucion/perfil/perfil.jpg";

                } else {
                    mkdir($url, 0777, true);
                    $foto = $url . "perfil.jpg";
                    move_uploaded_file($_FILES['imagenFile']['tmp_name'], $foto);

                }
            }




            /************************************ FIN DE ARCHIVO DE IMAGEN************************** */

            // Verifica si es archivo es null 
            $validador = $this->model->EditarGuargarPerfil($idUser, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $pass,$foto,$cedula);
            if ($validador == true) {
                              header("Location: index.php?c=Perfil&a=PerfilMostrar&mensaje=true");
            } else {
                header("Location: index.php?c=Perfil&a=PerfilMostrar&mensaje=false");

            }
        
    }
}