<?php
require_once 'models/LoginModel.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

session_start();


class LoginController
{
    private $model;
    /*Constructor*/
    public function __construct()
    {
        $this->model = new LoginModel(); /*Crea al un objeto  */
    }

    public function login()
    {

        require_once 'views/Login/Login.php';
    }

    public function validarLogin()
    {
        $email = htmlentities($_POST['email']);
        $pass = htmlentities($_POST['password']);
        $validador = $this->model->validarLogin($email,$pass);


         // if (isset($validador) && password_verify($pass, $validador['password'])) {
        if (isset($validador)) {
            if (!isset($validador["estado"]) || $validador["estado"]!=0){
            setcookie("user", $validador['email'], time() + (60 * 60), "/");
            setcookie("pass", $validador['password'], time() + (60 * 60), "/");
            $_SESSION['login'] = true;
            $_SESSION['nombreUsuario'] = $validador['primer_nombre'] . " " . $validador['primer_apellido'];
            $_SESSION['id'] = $validador['id_usuario'];
            $_SESSION['foto'] = $validador['foto'];
            $_SESSION['rol'] = $validador['rol'];

            switch ($validador["rol"]) {
                case "admin":
                    header('Location:index.php?c=Inicio&a=mostrarInicio');
                    break;

                case "docente":
                        header('Location:index.php?c=Inicio&a=mostrarInicio');
                    break;

                case "estudiante":
                        header('Location:index.php?c=Inicio&a=mostrarInicio');
                    break;

            }
            }else{
                $_SESSION['login'] = false;
                require_once 'views/Login/Login.php';
                echo ('<script>  Swal.fire({ icon: "error", title: "Error", text: "Su cuenta ha sido deshabilitada", }); </script>');

            }
        } else {
            $_SESSION['login'] = false;
            require_once 'views/Login/Login.php';
            echo ('<script>  Swal.fire({ icon: "error", title: "Error", text: "El correo ingresado o la contraseña son incorrectas", }); </script>');
     }

    }



    public function cerrarSesion(){
        $this->model->cerrarSesion();
        header('Location:index.php?c=Index&a=Index');

    }



    public function Recovery(){
        require_once 'views/Login/Recovery.php';
    }

    public function recoveryLogin(){

        ///consulta y validar
        if (isset($_GET['id']) && $_GET['id'] != "") {
            $valitoken = $this->model->consultatoken($_GET['id']);
        }
        if (isset($valitoken)) {
            require_once 'views/Login/RecoveryPass.php';
        } else {
            require_once 'views\error403.php';
        }

      

    }

    public function recoveryUsuario()
    {

        $email = htmlentities($_POST['email']);
        $validador = $this->model->consultarCorreo($email);

        if (isset($validador)) {

          
            $tk = openssl_random_pseudo_bytes(32);
            $token = bin2hex($tk);
            $logmodel = new LoginModel();
            $logmodel->ingresartoken($token, $email);
            $valitoken = $this->model->consultatoken($token);
            
                        try {
                            //Server settings

                            $mail = new PHPMailer(true);
                            $mail->IsSMTP();
                            $mail->Host = 'smtp-mail.outlook.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = 'islaSaymour@outlook.es'; //SMTP username
                            $mail->Password = 'isla2024'; //SMTP password                             
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                            $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`                                   

                            //Recipients
                            $mail->isHTML(true); //Set email format to HTML
                            $mail->setFrom('islaSaymour@outlook.es', 'IslaSaymour');
                            $mail->addAddress($validador['email'], 'Usuario'); //Add a recipient

                            // http://localhost/PROYECTO_TITULACION/recovery_pw.php?id=
                            $mail->CharSet = "UTF-8";
                            $mail->Subject = 'IslaSaymour: Recuperar contrasena';
                            $mail->Body = 'Buen día estimado/a ' . $validador['primer_nombre'].' '.$validador['primer_apellido'] . ', ha solicitado un cambio de contraseña
                    porfavor <p>de click <a href="http://localhost/Proyecto_Ligua/index.php?c=Login&a=recoveryLogin&id=' . $valitoken['token'] . '">Aqui</a>.</p>';

                            $mail->send();   
                            // echo 'Message has been sent';
                            header("Location:index.php?c=Login&a=Recovery&msg=ok");
                        } catch (Exception $e) {
                            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            header("Location:index.php?c=Login&a=Recovery&msg=error");
                        }
           
        } else {
            header("Location:index.php?c=Login&a=Recovery&msg=no_found");
        }


    }


    public function cambiarContraseña(){
        $tokensession = $_SESSION['idContrasena'];

        $pw = htmlentities($_POST['password']);


        $res = $this->model->insertar_pwtoken($pw, $tokensession);
        $this->model->deletetkn($tokensession);

        header("Location:index.php?c=Login&a=login");


    }

}