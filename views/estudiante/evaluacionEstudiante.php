<?php require_once 'views/partials/encabezado.php'; ?>
<?php


if (isset($_SESSION["validador"]) && $_SESSION["validador"] == true) {
    echo ('<script language="javascript">Swal.fire("Se actualizo con éxito los datos"); </script>');

}
if (isset($_SESSION["validador"]) && $_SESSION["validador"] == false) {
    echo ('<script language="javascript">Swal.fire("Error al al actualizar los datos"); </script>');
}
unset($_SESSION["validador"]);
?>
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

    #pregunta,
    #preguntaModal,
    #respuestaModal {
        width: 100%;
        /* Ancho del 100% de la pantalla */
        height: 5vw;
        /* Altura del 20% del ancho de la vista */
        resize: none;
        /* Evita que el usuario pueda redimensionar el textarea */
    }

    @media (max-width: 996px) {

        #pregunta,
        #preguntaModal,
        #respuestaModal {
            width: 100%;
            /* Ancho del 100% de la pantalla */
            height: 20vw;
            /* Altura del 20% del ancho de la vista */
            resize: none;
            /* Evita que el usuario pueda redimensionar el textarea */
        }

        .respuestaText {
            width: 100%;
            /* Ancho del 100% de la pantalla */
            height: 20vw;
            /* Altura del 20% del ancho de la vista */
            resize: none;
            /* Evita que el usuario pueda redimensionar el textarea */
        }

    }
</style>

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
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <hr>
                        <h3><b>Sección de Evaluaciones</b></h3>
                        <input type="text" id="curso" name="curso" value="<?php echo $idCurso ?>" hidden>
                        <input type="text" id="evaluacion" name="evaluacion" value="<?php echo $idEvaluacion ?>" hidden>
                        <div class="container">
                            <div class="row justify-content-end">
                                <div class="col-md-2"><span><b>Duracion: </b>
                                        <div id="tiempo" style="color:red"></div>
                                    </span></div>
                            </div>
                        </div>
                        <?php foreach ($preguntas as $resultados) {
                            $id = $resultados['id_pregunta']; ?>

                            <div class="row">
                                <div class="col-md-auto">
                                    <div class="questions">
                                        <h6 id="titulo">
                                            <?php echo $resultados['pregunta'] ?>
                                        </h6>
                                        <p id="timer" style="display:none">
                                            <?php
                                            date_default_timezone_set('America/New_York');

                                            // Obtener la hora actual
                                            $horaInicio = new DateTime(); // Esto crea un objeto DateTime con la hora actual
                                        
                                            // Supongamos que $resultados['horaLimite'] es una cadena con el formato 'H:i'
                                            $horaLimite = new DateTime($resultados['horaLimite']);

                                            // Calcular la diferencia de tiempo
                                            $diferencia = $horaLimite->diff($horaInicio);

                                            // Imprimir la diferencia de tiempo
                                            echo $diferencia->format('%H:%i:%s');
                                            ?>
                                        </p>
                                        <?php foreach ($respuestas as $resultados) {
                                            if ($resultados['id_fk_pregunta'] == $id) {
                                                ?>
                                                <h6 id="titulo">

                                                </h6>

                                                <input type="radio" id="opcion<?php echo $resultados['id_respuesta'] ?>"
                                                    name="<?php echo $resultados['id_fk_pregunta'] ?>"
                                                    value="<?php echo $resultados['id_respuesta'] ?>">
                                                <label for="opcion1">
                                                    <?php echo $resultados['respuesta'] ?>
                                                </label>

                                            <?php }
                                        } ?>
                                    </div>
                                </div>

                            </div>
                            <hr>
                        <?php } ?>
                        <button type="button" id="finalizarButton" class="btn btn-dark">Finalizar Evaluacion</button>




                    </div>
                </div>
            </div>



    </section>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var allChecked = [];
        var evaluacion = document.getElementById("evaluacion").value;

        var curso = document.getElementById("curso").value;
        var contador = 0;
        document.getElementById("finalizarButton").addEventListener("click", function () {
            var checkedInputs = document.querySelectorAll('.questions input:checked');

            checkedInputs.forEach(function (input) {
                var obj = {};
                obj[input.name] = input.value;
                allChecked.push(obj);
            });
            // Itera sobre cada objeto en el array
            allChecked.forEach(function (obj) {
                // Itera sobre las propiedades del objeto
                for (var key in obj) {
                    if (obj.hasOwnProperty(key)) {
                        // Muestra la clave y el valor por separado
                        //   alert(key); //id_pregunta
                        //      alert(obj[key]); //id_respuesta
                        contador++;
                        var url = 'index.php?c=Acciones&a=EvaluacionEnviar';
                        var data = new FormData();
                        data.append('idRespuesta', obj[key]);
                        data.append('idPregunta', key);
                        data.append('idEvaluacion', evaluacion);
                        data.append('idCurso', curso);
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', url, true);
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                // Manejar la respuesta si es necesario

                            }
                        };
                        xhr.send(data);
                    }
                }
            });

            if (contador == allChecked.length) {
                window.location.href = "index.php?c=Acciones&a=mostrarResultadoEvaluacion&Curso=" + curso + "&idEvaluacion=" + evaluacion;
            }

            // Limpia el arreglo para la próxima vez
            allChecked = [];
        });
    });

    // Obtiene el elemento del temporizador
    var timerElement = document.getElementById('timer');
    var tiempo = document.getElementById("tiempo");
    // Convierte las horas a segundos
    var totalSeconds = <?php echo $diferencia->s + $diferencia->i * 60 + $diferencia->h * 3600; ?>;

    var evaluacion = document.getElementById("evaluacion").value;

    var curso = document.getElementById("curso").value;
    // Función que actualiza el temporizador
    function updateTimer() {
        // Calcula las horas, minutos y segundos restantes
        var hours = Math.floor(totalSeconds / 3600);
        var minutes = Math.floor((totalSeconds % 3600) / 60);
        var seconds = totalSeconds % 60;

        // Formatea el tiempo en el formato HH:MM:SS
        var formattedTime =
            (hours < 10 ? "0" : "") + hours + ":" +
            (minutes < 10 ? "0" : "") + minutes + ":" +
            (seconds < 10 ? "0" : "") + seconds;

        // Actualiza el contenido del elemento del temporizador
        //                timerElement.textContent = formattedTime;
        tiempo.textContent = formattedTime;
        // Disminuye el total de segundos
        totalSeconds--;

        // Verifica si el temporizador ha llegado a cero
        if (totalSeconds < 0) {
            clearInterval(timerInterval); // Detiene el temporizador
            document.getElementById("finalizarButton").click();
        }
    }

    // Llama a la función updateTimer cada segundo
    var timerInterval = setInterval(updateTimer, 1000);
</script>
<?php require_once 'views/partials/footer.php'; ?>