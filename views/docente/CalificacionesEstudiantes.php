<?php require_once 'views/partials/encabezado.php'; ?>
<script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

<style>
    #example_filter {
        width: 500px;
    }
.pagination{
    justify-content: center;
}
.dataTables_filter label{
     display: flex;
    align-items: center;
    
     margin:10px;
}
.dataTables_filter input{
    width:500px;
}

/* Estilos para el cuadro de selección de registros por página */
.dataTables_length label {
    display: flex;
    align-items: center;
     justify-content: center;
     margin:10px;
}

/* Ajuste adicional si es necesario */
.dataTables_length select {
    margin-left: 5px; /* Ajusta el margen izquierdo según sea necesario */
    max-width: 100px; /* Ajusta el ancho máximo según sea necesario */
}

#example_paginate{
     text-align: center;
}

    th,
    td {
        border: 1px solid #ddd;
        /* Bordes de celda de 1 píxel sólido con color gris claro (#ddd) */
        padding: 8px;
        /* Espaciado interno de las celdas */
        text-align: left;
        /* Alineación del texto a la izquierda */
    }

    table {
        border-collapse: collapse;
    }
</style>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>
            <?php echo $type ?>
        </h1>

    </div>
    <section class="section">


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

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
                                <!-- PRIMER PARICAL -->
                                <div id="acta1" style="width:98%">
                                    <table id="example" class="display nowrap" style="width:100%">
                                        <thead>

                                            <tr>
                                                <th>Nombre del Estudiante</th>
                                                <th>Tarea</th>
                                                <th>Foros</th>
                                                <th>Evaluaciones</th>
                                                <th>Promedio</th>
                                                <th>Caulitativa</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $con = 0;
                                            $promedioGeneral = 0;
                                            foreach ($mostrarForo as $datos) { ?>
                                                <tr>
                                                    <td style="width:250px">
                                                        <?php echo $datos['nombre'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($mostrarTarea[$con]['primerParcial'], 2) ?>
                                                    </td>

                                                    <td>
                                                        <?php echo number_format($datos['primerParcial'], 2) ?>
                                                    </td>

                                                    <td>
                                                        <?php echo number_format($mostrarEva[$con]['primerParcial'], 2) ?>
                                                    </td>

                                                    <?php
                                                    $promedio = ($datos['primerParcial']+ $mostrarTarea[$con]['primerParcial']+ $mostrarEva[$con]['primerParcial']) / 3;
                                                    $promedioGeneral = $promedio + $promedioGeneral;
                                                    switch (true) {
                                                        case $promedio >= 9 && $promedio <= 10:
                                                            $caracter = "DA";
                                                            break;
                                                        case $promedio >= 7 && $promedio < 9:
                                                            $caracter = "AA";
                                                            break;
                                                        case $promedio >= 4.01 && $promedio < 7:
                                                            $caracter = "APA";
                                                            break;
                                                        case $promedio >= 0 && $promedio <= 4:
                                                            $caracter = "NAA";
                                                            break;
                                                        // Puedes agregar más casos según sea necesario
                                                        default:
                                                            // Valor por defecto si ninguno de los casos anteriores se cumple
                                                            break;
                                                    }


                                                    ?>
                                                    <td>
                                                        <?php echo number_format($promedio, 2); ?>
                                                    </td>




                                                    <td>
                                                        <?php echo $caracter; ?>
                                                    </td>




                                                </tr>
                                                <?php $con++;
                                            } ?>


                                        </tbody>
                                    </table>


                                </div>
                            </div>









                            <!-- Segundo PARICAL -->
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


                                <div id="acta2" style="width:98%">
                                    <table id="example2" class="display nowrap" style="width:100%">
                                        <thead>

                                            <tr>
                                                <th>Nombre del Estudiante</th>
                                                <th>Tarea</th>
                                                <th>Foros</th>
                                                <th>Evaluaciones</th>
                                                <th>Promedio</th>
                                                <th>Caulitativa</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $con = 0;
                                            $promedioGeneral = 0;
                                            foreach ($mostrarForo as $datos) { ?>
                                                <tr>
                                                    <td  style="width:170px">
                                                        <?php echo $datos['nombre'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($mostrarTarea[$con]['segundoParcial'], 2) ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($datos['segundoParcial'], 2) ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($mostrarEva[$con]['segundoParcial'], 2)  ?>
                                                    </td>

                                                    <?php

                                                    $promedio2 = ($datos['segundoParcial']+$mostrarTarea[$con]['segundoParcial']+ $mostrarEva[$con]['segundoParcial']) / 3;
                                                    $promedioGeneral = $promedio2 + $promedioGeneral;
                                                    switch (true) {
                                                        case $promedio2 >= 9 && $promedio2 <= 10:
                                                            $caracter = "DA";
                                                            break;
                                                        case $promedio2 >= 7 && $promedio2 < 9:
                                                            $caracter = "AA";
                                                            break;
                                                        case $promedio2 >= 4.01 && $promedio2 < 7:
                                                            $caracter = "APA";
                                                            break;
                                                        case $promedio2 >= 0 && $promedio2 <= 4:
                                                            $caracter = "NAA";
                                                            break;
                                                        // Puedes agregar más casos según sea necesario
                                                        default:
                                                            // Valor por defecto si ninguno de los casos anteriores se cumple
                                                            break;
                                                    }

                                                    ?>
                                                    <td>
                                                        <?php echo number_format($promedio2, 2); ?>
                                                    </td>




                                                    <td>
                                                        <?php echo $caracter; ?>
                                                    </td>
                                                </tr>
                                                <?php $con++;
                                            } ?>


                                        </tbody>
                                    </table>

                                </div>
                            </div>





                        </div>



                    </div>
                </div>
            </div>
        </div>



    </section>
</main>


<script src="assets/data/jquery/jquery-3.3.1.min.js"></script>
<script src="assets/data/popper/popper.min.js"></script>
<script src="assets/data/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/data/datatables/datatables.min.js"></script>


<script src="assets/data/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="assets/data/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="assets/data/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="assets/data/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="assets/data/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>


<script type="text/javascript" src="assets/data/main.js"></script>


<?php require_once 'views/partials/footer.php'; ?>