<?php require_once 'views/partials/encabezado.php'; ?>
<style>
    ul {
        list-style: none;
    }

    a {
        text-decoration: none;
    }

    h5 {
        font-weight: bold;
        text-align: center;
    }

    #editor {
        height: 200px;
        /* Establece la altura deseada */
    }

    @media (max-width: 990px) {

        th:nth-child(2),
        td:nth-child(2) {
            display: table-cell !important;
        }

        th:nth-child(3),
        td:nth-child(3) {
            display: table-cell !important;
        }

        th:not(:nth-child(1)):not(:nth-child(2)):not(:nth-child(3)),
        td:not(:nth-child(1)):not(:nth-child(2)):not(:nth-child(3)) {
            display: none !important;
        }
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>
            <?php echo $type ?>
        </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="index.php?c=Docente&a=mostrarClases&type=<?php echo $type ?>">
                        <?php echo $type ?>
                    </a></li>

            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <hr>
                        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation"> <button class="nav-link active" id="home-tab"
                                    data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab"
                                    aria-controls="home" aria-selected="true">1er
                                    Parcial</button></li>
                            <li class="nav-item" role="presentation"> <button class="nav-link" id="profile-tab"
                                    data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab"
                                    aria-controls="profile" aria-selected="false">2do
                                    Parcial</button></li>
                        </ul>


                        <div class="tab-content pt-2" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <div>
                                    <h5>1er Parcial
                                    </h5>

                                    <!-- CACLIFICAICOn -->
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col" class="d-none d-lg-table-cell">Foro</th>
                                                <th scope="col" class="d-none d-lg-table-cell">Calificación</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $sumaCalificaciones = 0;
                                            $contador = 1;
                                            $cont = 0;
                                            $promedioForo=0;
                                            foreach ($foro as $foroResultado):
                                                if ($foroResultado["parcial"] == "1er Parcial") { ?>

                                                    <tr>
                                                        <th style="width:20px;" scope="row">
                                                            <?php echo $contador++; ?>
                                                        </th>
                                                        <td style="width:500px;" class="nombre d-none d-lg-table-cell"><a
                                                                href="#" >
                                                                <?php echo $foroResultado['titulo'] ?>
                                                            </a></td>
                                                        <td class="apellido d-none d-lg-table-cell">
                                                            <?php if ($foroResultado['calificacion'] == null) {
                                                                echo "---";
                                                            } else {
                                                                echo $foroResultado['calificacion'];
                                                                $sumaCalificaciones += $foroResultado['calificacion'];
                                                                $cont++;
                                                            } ?>
                                                        </td>

                                                    </tr>
                                                    <?php


                                                }
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                    <b>Promedio de los Foros 1er Parcial: </b>
                                    <?php if ($cont > 0)$promedioForo=$sumaCalificaciones / ($cont); echo $promedioForo?>



                                    <!-- TAREAS -->
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col" class="d-none d-lg-table-cell">Tareas</th>
                                                <th scope="col" class="d-none d-lg-table-cell">Calificación</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $sumaCalificacionesTareas = 0;
                                            $contador = 1;
                                            $cont = 0; $promedioTarea=0;
                                            foreach ($tarea as $tareaResultado):
                                                if ($tareaResultado["parcial_tarea"] == "1er Parcial") { ?>

                                                    <tr>
                                                        <th style="width:20px;" scope="row">
                                                            <?php echo $contador++; ?>
                                                        </th>
                                                        <td style="width:500px;" class="nombre d-none d-lg-table-cell"><a
                                                                href="#" >
                                                                <?php echo $tareaResultado['titulo_tarea'] ?>
                                                            </a></td>
                                                        <td class="apellido d-none d-lg-table-cell">
                                                            <?php if ($tareaResultado['calificacion'] == null) {
                                                                echo "---";
                                                            } else {
                                                                $cont++;
                                                                echo $tareaResultado['calificacion'];
                                                                $sumaCalificacionesTareas += $tareaResultado['calificacion'];

                                                            } ?>
                                                        </td>

                                                    </tr>
                                                    <?php
                                                }
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                    <b>Promedio de las Tareas 1er Parcial: </b>
                                    <?php if ($cont > 0)$promedioTarea=$sumaCalificacionesTareas / ($cont); echo $promedioTarea ?>









                                    <!-- EVALUACIONES -->


                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col" class="d-none d-lg-table-cell">Evaluaciones</th>
                                                <th scope="col" class="d-none d-lg-table-cell">Calificación</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $sumaCalificacionesEva = 0;
                                            $contador = 1;
                                            $cont = 0;
                                            $promedioEva=0;
                                            foreach ($evaluaciones as $evaluacionResultado):
                                                if ($evaluacionResultado["parcial"] == "1er Parcial") { ?>

                                                    <tr>
                                                        <th style="width:20px;" scope="row">
                                                            <?php echo $contador++; ?>
                                                        </th>
                                                        <td style="width:500px;" class="nombre d-none d-lg-table-cell"><a
                                                                href="#">
                                                                <?php echo $evaluacionResultado['nombreTitulo'] ?>
                                                            </a></td>
                                                        <td class="apellido d-none d-lg-table-cell">
                                                            <?php if ($evaluacionResultado['nota'] == null) {
                                                                echo "---";
                                                            } else {
                                                                $cont++;
                                                                echo $evaluacionResultado['nota'];
                                                            } ?>
                                                        </td>

                                                    </tr>
                                                    <?php
                                                    $sumaCalificacionesEva += $evaluacionResultado['nota'];
                                                }
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                    <b>Promedio de las Evaluaciones 1er Parcial: </b>
                                    <?php if ($cont > 0)$promedioEva=$sumaCalificacionesEva / $cont; echo $promedioEva?>


                                    <h5>Nota del Primer Parcial:
                                        <?php
                                        $total = ($promedioEva + $promedioForo + $promedioTarea) / 3;
                                        echo number_format($total, 2);
                                        ?>
                                    </h5>
                                </div>

                            </div>
























                            <!-- 2do Parcial -->
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                <div>


                                    <h5>2do Parcial
                                    </h5>



                                    <!-- CACLIFICAICOn -->
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col" class="d-none d-lg-table-cell">Foro</th>
                                                <th scope="col" class="d-none d-lg-table-cell">Calificación</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $sumaCalificaciones2 = 0;
                                            $contador = 1;
                                            $cont = 0; $promedioForo2=0;
                                            foreach ($foro as $foroResultado):
                                                if ($foroResultado["parcial"] == "2do Parcial") { ?>

                                                    <tr>
                                                        <th style="width:20px;" scope="row">
                                                            <?php echo $contador++; ?>
                                                        </th>
                                                        <td style="width:500px;" class="nombre d-none d-lg-table-cell"><a
                                                                href="#" >
                                                                <?php echo $foroResultado['titulo'] ?>
                                                            </a></td>
                                                        <td class="apellido d-none d-lg-table-cell">
                                                            <?php if ($foroResultado['calificacion'] == null) {
                                                                echo "---";
                                                            } else {
                                                                $cont++;
                                                                echo $foroResultado['calificacion'];
                                                            } ?>
                                                        </td>

                                                    </tr>
                                                    <?php
                                                    $sumaCalificaciones2 += $foroResultado['calificacion'];
                                                }
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                    <b>Promedio de los Foros 2do Parcial: </b>
                                    <?php if ($cont > 0)$promedioForo2= $sumaCalificaciones2 / $cont; echo $promedioForo2;?>




                                    <!-- TAREAS -->
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col" class="d-none d-lg-table-cell">Tareas</th>
                                                <th scope="col" class="d-none d-lg-table-cell">Calificación</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $sumaCalificacionesTareas2 = 0;
                                            $contador = 1;
                                            $cont = 0; $promedioTarea2=0;
                                            foreach ($tarea as $tareaResultado):
                                                if ($tareaResultado["parcial_tarea"] == "2do Parcial") { ?>

                                                    <tr>
                                                        <th style="width:20px;" scope="row">
                                                            <?php echo $contador++; ?>
                                                        </th>
                                                        <td style="width:500px;" class="nombre d-none d-lg-table-cell"><a
                                                                href="#">
                                                                <?php echo $tareaResultado['titulo_tarea'] ?>
                                                            </a></td>
                                                        <td class="apellido d-none d-lg-table-cell">
                                                            <?php if ($tareaResultado['calificacion'] == null) {
                                                                echo "---";
                                                            } else {
                                                                $cont++;
                                                                echo $tareaResultado['calificacion'];
                                                            } ?>
                                                        </td>

                                                    </tr>
                                                    <?php
                                                    $sumaCalificacionesTareas2 += $tareaResultado['calificacion'];
                                                }
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                    <b>Promedio de las Tareas 2do Parcial: </b>
                                    <?php if($cont>0)$promedioTarea2 =$sumaCalificacionesTareas2/$cont;  echo $promedioTarea2 ?>








                                    <!-- EVALUACIONES -->


                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col" class="d-none d-lg-table-cell">Evaluaciones</th>
                                                <th scope="col" class="d-none d-lg-table-cell">Calificación</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $sumaCalificacionesEva2 = 0;
                                            $contador = 1;
                                            $cont = 0; $promedioEva2=0;
                                            foreach ($evaluaciones as $evaluacionResultado):
                                                if ($evaluacionResultado["parcial"] == "2do Parcial") { ?>

                                                    <tr>
                                                        <th style="width:20px;" scope="row">
                                                            <?php echo $contador++; ?>
                                                        </th>
                                                        <td style="width:500px;" class="nombre d-none d-lg-table-cell"><a
                                                                href="#" >
                                                                <?php echo $evaluacionResultado['nombreTitulo'] ?>
                                                            </a></td>
                                                        <td class="apellido d-none d-lg-table-cell">
                                                            <?php if ($evaluacionResultado['nota'] == null) {
                                                                echo "---";
                                                            } else {
                                                                $cont++;
                                                                echo $evaluacionResultado['nota'];
                                                            } ?>
                                                        </td>

                                                    </tr>
                                                    <?php
                                                    $sumaCalificacionesEva2 += $evaluacionResultado['nota'];
                                                }
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                    <b>Promedio de las Evaluaciones 2do Parcial: </b>
                                    <?php if ($cont > 0)$promedioEva2=$sumaCalificacionesEva2/$cont; echo $promedioEva2?>
                                    <h5>Nota del Segundo Parcial:
                                        <?php
                                        $total2 = ($promedioEva2 + $promedioForo2 + $promedioTarea2) / 3;
                                        echo number_format($total2, 2);
                                        ?>
                                    </h5>


                                </div>


                            </div>


                        </div>
                    </div>
                    <h5>Calificacion Total :
                        <?php echo number_format(($total + $total2) / 2, 2); ?>
                    </h5>
                </div>
            </div>
        </div>


    </section>
</main>
<?php require_once 'views/partials/footer.php'; ?>