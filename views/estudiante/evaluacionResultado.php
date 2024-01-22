<?php require_once 'views/partials/encabezado.php'; ?>
<style>
    ul {
        list-style: none;
    }

    a {
        text-decoration: none;
    }

    textarea {
        overflow: auto;
        resize: vertical;
    }
    

</style>
<div id="contenidoDinamico">
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Evaluaciones</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a
                        href="index.php?c=Docente&a=mostrarClases&type=Evaluaciones">Evaluaciones</a></li>
                <li class="breadcrumb-item"><a
                        href="index.php?c=Docente&a=MostrarEvaluacionesDatos&idAsignacion=<?php echo $idAsignacion; ?>">Sección
                        Evaluación</a>
            </ol>
        </nav>
    </div>



    <!--------------MODAL -------------->

    <section class="section">

        <div class="row" >
            <div class="col-lg-12" >
                <div class="card"  >
                    <div class="card-body" >
                       
                        <hr>
                        
                        <h3><b>Resultado de la Evaluaciones</b></h3>
                        <h6><b>Su calificaicon es de: <?php echo $resultadoFinal['puntaje_final'] ?>/10</b></h6>

                        <input type="text" id="curso" name="curso" value="<?php echo $idCurso ?>" hidden>
                        <input type="text" id="evaluacion" name="evaluacion" value="<?php echo $idEvaluacion ?>" hidden>
                        <?php foreach ($preguntas as $resultados) {
                            $id = $resultados['id_pregunta']; ?>

                            <div class="row">
                                <div class="col-md-auto">
                                    <div class="questions">
                                        <h6 id="titulo">
                                            <?php echo $resultados['pregunta']." (".$resultados['puntaje']." Pts)" ?>
                                        </h6>


                                        <?php foreach ($respuestas as $resultados): ?>
                                            <?php if ($resultados['id_fk_pregunta'] == $id): ?>
                                                <h6 id="titulo"></h6>

                                                <?php
                                                $estado = ""; // Inicializamos el estado fuera del bucle interno
                                                $mensaje = "";
                                             $puntaje="";
                                                foreach ($resultadoEstudiante as $resultados2) {
                                                    if ($resultados2['id_fk_respuesta'] == $resultados['id_respuesta']) {
                                                        $estado = "checked";
                                                        if ($resultados['correcta'] == 1) {
                                                          
                                                            $mensaje = "<span style='color:green;'>Respuesta Seleccionada Correcta <span>";
                                                        } else {
                                                            $mensaje = "<span style='color:red;'>Respuesta Seleccionada Incorrecta<span>";

                                                        }
                                                                         
                                                        break; // Salimos del bucle una vez que se encuentra una correspondencia
                                                    } else {
                                                        $estado = "";
                                                    }

                                                }
                                                        
                                                ?>

                                                <input type="radio" id="opcion<?php echo $resultados['id_respuesta'] ?>"
                                                    name="<?php echo $resultados['id_fk_pregunta'] ?>"
                                                    value="<?php echo $resultados['id_respuesta'] ?>" <?php echo $estado ?>
                                                    disabled>
                                                <label for="opcion<?php echo $resultados['id_respuesta'] ?>">
                                                    <?php echo $resultados['respuesta'] . " " . $mensaje; ?>
                                                </label>
                                            <?php endif; ?>
                                        <?php endforeach; ?>

                                    </div>
                                </div>

                            </div>
                            <hr>
                        <?php } ?>

                                           

                    </div>
                </div>
            </div>

                                            

    </section>
</main>
              </div>                              
        <script>
    document.addEventListener('DOMContentLoaded', function () {
        var datosCargados = false;

        // Función para cargar los datos de forma asíncrona
        function cargarDatos() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'index.php?c=Acciones&a=mostrarResultadoEvaluacion&Curso=<?php echo $idCurso ?>&idEvaluacion=<?php echo $idEvaluacion ?>', true);

                    xhr.onload = function () {
                        if (xhr.status >= 200 && xhr.status < 300) {
                            // Actualizar el contenido dinámico y la variable datosCargados
                            document.getElementById('contenidoDinamico').innerHTML = xhr.responseText;
                            datosCargados = true;
                        } else {
                            console.error('Error al cargar datos.');
                        }
                    };

                    xhr.onerror = function () {
                        console.error('Error de red al cargar datos.');
                    };

                    xhr.send();
                }

                // Llamar a la función de carga de datos al cargar la página
                cargarDatos();

                // Puedes llamar a cargarDatos() en respuesta a algún evento, como un botón
                // Por ejemplo:
                // document.getElementById('recargarDatosBtn').addEventListener('click', cargarDatos);
            });
        </script>

<!-- Después del contenido PHP -->
<?php require_once 'views/partials/footer.php'; ?>

