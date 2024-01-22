<?php require_once 'views/partials/encabezado.php'; ?>

<link rel="stylesheet" href="assets/calendario/fullcalendar.min.css">

<script src="assets/calendario/jquery-3.6.4.min.js"></script>

<script src="assets/calendario/moment.min.js"></script>
<script src="assets/calendario/es.js"></script>

<script src="assets/calendario/fullcalendar.min.js"></script>
<style>
    li{
text-align: center;
text-decoration: none;
list-style: none;
display:flex
    }
      li ul::before {
        content: ''; 
        display: inline-block;
        width: 10px; 
        height: 10px; 
        margin-right: 10px; 
    }

    li ul:nth-child(1)::before {
        background-color: #0445dc ; /* EVENTO*/
    }

    li ul:nth-child(2)::before {
        background-color: #f54343; /*Tarea*/
    }

    li ul:nth-child(3)::before {
        background-color: #bf6c23; /* Foro*/
    }

    li ul:nth-child(4)::before {
        background-color: #df2eec ; /* evaluaciones */
    }
</style>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Calendario</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">

<li>
    <ul>Eventos </ul>
    
    <ul>Tareas </ul>
    
    <ul>Foros </ul>
    
    <ul>Evaluaciones</ul>
</li>

                        <!-- Contenedor del calendario -->
                        <div id="calendar"></div>

                        <!-- Script para inicializar FullCalendar -->
                        <script>
                            var fechaActual = moment().format('YYYY-MM-DD');

                            $(document).ready(function () {
                                // Inicializar FullCalendar con configuración en español
                                $('#calendar').fullCalendar({
                                    header: {
                                        left: 'prev,next today',
                                        center: 'title',
                                        right: 'month'
                                    },
                                    buttonText: {
                                        month: 'Mes',
                                        today: 'Fecha Actual'
                                    },
                                    events: [

  // Agregar eventos al calendario
                  
                                        <?php foreach ($calendario as $mostrarC) {


                                            echo "{
                                            title: '" . $mostrarC['evento'] . "',
                                            start: '" . $mostrarC['fechaCalendario'] . "',
                                            end: '" . $mostrarC['fechaCalendarioFin'] . "',
                                            color: '#0445dc'
                                        },";
                                        } ?>

                                         <?php foreach ($fechaForo as $mostrarF) {
                                             echo "{
                                            title: '" . $mostrarF['titulo'] . "',
                                            start: '" . $mostrarF['fechaFin'] . "',
                                            end: '" . $mostrarF['fechaFin'] . "',
                                             color: '#bf6c23'
                                        },";
                                         } ?>

                                          <?php foreach ($fechaTarea as $mostrarT) {
                                              echo "{
                                            title: '" . $mostrarT['titulo_tarea'] . "',
                                            start: '" . $mostrarT['fechaFinTarea'] . "',
                                            end: '" . $mostrarT['fechaFinTarea'] . "',
                                             color: '#df2eec'
                                        },";
                                          } ?>

                                          
                                             <?php foreach ($fechaEva as $mostrarE) {
                                                 echo "{
                                            title: '" . $mostrarE['nombreTitulo'] . "',
                                            start: '" . $mostrarE['fechaFinEva'] . "',
                                            end: '" . $mostrarE['fechaFinEva'] . "',
                                             color: '#f54343'
                                        },";
                                             } ?>


                    // Puedes agregar más eventos según tu necesidad
                                    ],
                                    locale: 'es', // Establecer el idioma en español
                                    // Puedes personalizar la configuración según tus necesidades
                                    // PONER FECHA actual
                                    dayRender: function (date, cell) {
                                        // Verificar si la fecha actual coincide con la fecha renderizada
                                        if (date.format('YYYY-MM-DD') === fechaActual) {
                                            // Aplicar estilo de fondo verde
                                            cell.css('background-color', '#9fcd9f');
                                        }
                                    }

                                });
                            });
                        </script>




                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once 'views/partials/footer.php'; ?>