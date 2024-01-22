<?php
if (!isset($_SESSION)) {
   session_start();   /* Inicia sesion en caso de que este*/
}

?>
<!DOCTYPE html>
<html lang="es">
<?php require_once 'views/partials/head.php'; ?>

<header id="header" class="header fixed-top d-flex align-items-center">
   <div class="d-flex align-items-center justify-content-between"> <a href="#"
         class="logo d-flex align-items-center text-decoration-none">
         <img class="rounded-circle" src="assets/institucion/logo.png" alt=""> <span style="font-size:20px;"
            class="d-none d-lg-block">U. E. P. Isla Seymour</span> </a>
      <i class="bi bi-list toggle-sidebar-btn "></i>
   </div>

   <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
         <li class="nav-item d-block d-lg-none"> <a class="nav-link nav-icon search-bar-toggle " href="#"> <i
                  class="bi bi-search"></i> </a></li>

         <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown"> <img
                  src="<?php echo $_SESSION['foto'] ?>" alt="Profile" class="rounded-circle" width=40px; height=50px;>
               <span class="d-none d-md-block dropdown-toggle ps-2">
                  <?php echo $_SESSION['nombreUsuario'] ?>
               </span> </a>

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
               <li class="dropdown-header">
                  <img src="<?php echo $_SESSION['foto'] ?>" alt="Profile" class="rounded-circle"
                     style="width:150px; height:150px;">
                  <h6>
                     <?php echo $_SESSION['nombreUsuario'] ?>
                  </h6>
                  <?php if ($_SESSION['rol'] == "admin") {
                     $tipo = "Administrador";
                  }
                  if ($_SESSION['rol'] == "docente") {
                     $tipo = "Docente";
                  }
                  if ($_SESSION['rol'] == "estudiante") {
                     $tipo = "Estudiante";
                  }



                  ?>
                  <span>
                     <?php echo $tipo ?>
                  </span>
               </li>
               <li>
                  <hr class="dropdown-divider">
               </li>
               <li> <a class="dropdown-item d-flex align-items-center" href="index.php?c=Perfil&a=PerfilMostrar"> <i
                        class="bi bi-person"></i> <span>Mi Perfil</span> </a></li>
               <li>
                  <hr class="dropdown-divider">
               </li>
               <hr class="dropdown-divider">
         </li>
         <li>
            <hr class="dropdown-divider">
         </li>
         <li> <a class="dropdown-item d-flex align-items-center" href="index.php?c=Login&a=cerrarSesion"> <i
                  class="bi bi-box-arrow-right"></i>
               <span>Cerrar Sesión</span> </a></li>
      </ul>
      </li>
      </ul>
   </nav>
</header>
<aside id="sidebar" class="sidebar">
   <ul class="sidebar-nav" id="sidebar-nav">

      <!------------------------------------- ADMIN----------------------------------->

      <?php if ($_SESSION['rol'] == "admin") { ?>
      <!--- Inicio-->
         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Inicio&a=mostrarInicio"> <i class="bi bi-house"></i>

               <span>Inicios</span> </a></li>
         <!--- Configuracion de Cuenta -->
         <li class="nav-heading">Configuración de Cuenta</li>
         <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#"> <i
                  class="bi bi-layout-text-window-reverse"></i><span>Registros</span><i
                  class="bi bi-chevron-down ms-auto"></i> </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
               <li> <a class="text-decoration-none" href="#"> <i style="font-size:20px;"
                        class="bi bi-people-fill"></i><span>Usuarios</span> </a></li>
               <li> <a class="text-decoration-none" href="index.php?c=Docente&a=VistaDocente"> <i style="font-size:20px;"
                        class="bi bi-person-fill"></i><span>Docentes</span> </a></li>
               <li> <a class="text-decoration-none" href="index.php?c=Admin&a=VistaAdmin"> <i style="font-size:20px;"
                        class="bi bi-person-fill"></i><span>Administradores</span> </a></li>
               <li> <a class="text-decoration-none" href="index.php?c=Estudiante&a=VistaEstudiante"> <i
                        style="font-size:20px;" class="bi bi-mortarboard-fill"></i><span>Estudiantes</span> </a></li>

            </ul>
         </li>
         <li class="nav-heading">Servicios</li>


         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Admin&a=MostrarCursos"> <i
                  class="bi bi-laptop"></i>
               <span>Cursos</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Admin&a=AsignarCursos"> <i
                  class="bi bi-laptop"></i>
               <span>Asignar</span> </a></li>
               
         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Calendario&a=mostrarCalendarioAdmin"> <i
                  class="bi bi-calendar-date"></i>
               <span>Calendario</span> </a></li>
               
         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Admin&a=mostrarMaterias"> <i
                  class="bi bi-book"></i>
               <span>Materias</span> </a></li>
                   <li class="nav-heading">Configuraciones</li>

         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Perfil&a=PerfilMostrar"> <i
                  class="bi bi-file-person"></i>
               <span>Actualizar Datos</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Login&a=cerrarSesion"> <i class="bi bi-box-arrow-left"></i>
               <span>Salir</span> </a></li>
         <!------------------------------------- DOCENTE----------------------------------->
      <?php }
      if ($_SESSION['rol'] == "docente") { ?>
      <!--- Inicio-->
         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Inicio&a=mostrarInicio"> <i class="bi bi-house"></i>

               <span>Inicio</span> </a></li>
         <!--- Configuracion de Cuenta -->
         <li class="nav-heading">Servicios</li>
         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Docente&a=mostrarClases&type=Clases"> <i
                  class="bi bi-laptop"></i>
               <span>Clases</span> </a></li>


         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Docente&a=mostrarClases&type=Foros"> <i
                  class="bi bi-people"></i>
               <span>Foros</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Docente&a=mostrarClases&type=Tareas"> <i
                  class="bi bi-journal-bookmark"></i>
               <span>Tareas</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Docente&a=mostrarClases&type=Evaluaciones">
               <i class="bi bi-bookmark-check"></i>
               <span>Evaluaciones</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Calendario&a=mostrarCalendario"> <i
                  class="bi bi-calendar-date"></i>
               <span>Calendario</span> </a></li>

         <li class="nav-heading">Actas</li>

         
         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Docente&a=mostrarClases&type=Calificación"> <i class="bi bi-journal-text"></i>
               <span>Calificaciones Parciales</span> </a></li>


         <li class="nav-heading">Configuraciones</li>
         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Perfil&a=PerfilMostrar"> <i
                  class="bi bi-file-person"></i>
               <span>Actualizar Datos</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Login&a=cerrarSesion"> <i class="bi bi-box-arrow-left"></i>
               <span>Salir</span> </a></li>
      <?php } ?>







      <!---  ////////////////////////////////////ESTUDIANTE/////////////////////////-->


      <?php if ($_SESSION['rol'] == "estudiante") { ?>
<!--- Inicio-->
         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Inicio&a=mostrarInicio"> <i class="bi bi-house"></i>

               <span>Inicio</span> </a></li>
         
         <li class="nav-heading">Servicios</li>
         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Docente&a=mostrarClases&type=Clases"> <i
                  class="bi bi-laptop"></i>
               <span>Clases</span> </a></li>


         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Docente&a=mostrarClases&type=Foros"> <i
                  class="bi bi-people"></i>
               <span>Foros</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Docente&a=mostrarClases&type=Tareas"> <i
                  class="bi bi-journal-bookmark"></i>
               <span>Tareas</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Docente&a=mostrarClases&type=Evaluaciones">
               <i class="bi bi-bookmark-check"></i>
               <span>Evaluaciones</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Calendario&a=mostrarCalendario"> <i
                  class="bi bi-calendar-date"></i>
               <span>Calendario</span> </a></li>

         <li class="nav-heading">Actas</li>

         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Docente&a=mostrarClases&type=Calificación"> <i class="bi bi-journal-text"></i>
               <span>Calificaciones Parciales</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Calificar&a=mostrarCalificacionTotal"> <i class="bi bi-box"></i>
               <span>Calificaciones Totales</span> </a></li>
                   <li class="nav-heading">Configuraciones</li>

         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Perfil&a=PerfilMostrar"> <i
                  class="bi bi-file-person"></i>
               <span>Actualizar Datos</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="index.php?c=Login&a=cerrarSesion"> <i class="bi bi-box-arrow-left"></i>
               <span>Salir</span> </a></li>


      <?php } ?>

      <!-- <li class="nav-item"> <a class="nav-link collapsed" href="users-profile.html"> <i class="bi bi-laptop"></i>
            <span>Clases</span> </a></li> -->
      <!-- 
      <li class="nav-item"> <a class="nav-link collapsed" href="pages-faq.html"> <i class="bi bi-people"></i>
            <span>Foros</span> </a></li>
      <li class="nav-item"> <a class="nav-link collapsed" href="pages-contact.html"> <i
               class="bi bi-journal-bookmark"></i>
            <span>Tareas</span> </a></li>
      <li class="nav-item"> <a class="nav-link collapsed" href="pages-register.html"> <i
               class="bi bi-bookmark-check"></i>
            <span>Evaluaciones</span> </a></li>
      <li class="nav-item"> <a class="nav-link collapsed" href="pages-error-404.html"> <i
               class="bi bi-calendar-date"></i>
            <span>Calendario</span> </a></li>

      <li class="nav-heading">Actas</li>

      <li class="nav-item"> <a class="nav-link collapsed" href="users-profile.html"> <i class="bi bi-journal-text"></i>
            <span>Calificaciones Parciales</span> </a></li>
      <li class="nav-item"> <a class="nav-link collapsed" href="pages-faq.html"> <i class="bi bi-box"></i>
            <span>Calificaciones Totales</span> </a></li>
      <li class="nav-heading">Solicializar</li>

      <li class="nav-item"> <a class="nav-link collapsed" href="users-profile.html"> <i
               class="bi bi-arrow-down-circle"></i>
            <span>Auditoria</span> </a></li>
      <li class="nav-item"> <a class="nav-link collapsed" href="pages-faq.html"> <i class="bi bi-archive"></i>
            <span>Reportes</span> </a></li>
      <li class="nav-item"> <a class="nav-link collapsed" href="pages-faq.html"> <i class="bi bi-gear"></i>
            <span>Configraciones</span> </a></li> -->


   </ul>



</aside>

<body>