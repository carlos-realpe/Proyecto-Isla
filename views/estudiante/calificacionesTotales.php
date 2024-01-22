<?php require_once 'views/partials/encabezado.php'; ?>
<script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

<style>
    h5 {
        text-align: center;
        font-weight: bold;
    }

    .letra {
        font-weight: normal;
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
                                <button id="exportButton" class="btn btn-danger mb-3"><i
                                        class="bi bi-file-earmark-pdf-fill"></i></button>
                                <div id="acta1" style="width:98%">
                                    <table id="example" class="display nowrap" style="width:100%">
                                        <thead>

                                            <tr>
                                                <th class="text-center" colspan="6"><img
                                                        src="assets/institucion/logo.png" alt="no found" width="100px">
                                                    <h7 style="margin:80px">INFORME DE RENDIMIENTO ACADEMICO POR PARCIAL
                                                    </h7>
                                                    <img src="assets/institucion/logoG.jpeg" alt="no found"
                                                        width="200px">
                                                </th>
                                            </tr>

                                            <tr>
                                                <th>Nombre</th>
                                                <th colspan="3" class="text-center letra">
                                                    <?php echo $usuario['nombre'] ?>
                                                </th>
                                                <th colspan="2" class="text-center letra">1er Parcial</th>
                                            </tr>

                                            <tr>
                                                <th>Curso</th>
                                                <th colspan="5" class="text-center letra">
                                                    <?php echo $usuario['grado'] ?>
                                                </th>
                                            </tr>



                                            <tr>
                                                <th>Materia</th>
                                                <th>Tarea</th>
                                                <th>Foros</th>
                                                <th>Evaluaciones</th>
                                                <th>Promedio</th>
                                                <th>Caulitativa</th>
                                            </tr>
                                        </thead>
                                        <tbody id="datosEstudiante">

                                            <?php $con = 0;
                                            $promedioGeneral = 0;

   
                                            foreach ($calificacionEvaluacion as $evaluacion) {                                
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $evaluacion['nombre_materia'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($calificacionTarea[$con]['primerParcial'], 2); ?>
                                                    </td>

                                                    <td>
                                                        <?php echo number_format($calificacionForo[$con]['primerParcial'], 2); ?>
                                                    </td>

                                                    <td>
                                                        <?php echo number_format($evaluacion['primerParcial'], 2) ?>
                                                    </td>

                                                    <?php
                                                    $promedio = ($calificacionForo[$con]['primerParcial'] + $calificacionTarea[$con]['primerParcial'] + $evaluacion['primerParcial']) / 3;
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

                                                    switch (true) {
                                                        case $promedioGeneral >= 9 && $promedioGeneral <= 10:
                                                            $caracterGeneral = "DA";
                                                            break;
                                                        case $promedioGeneral >= 7 && $promedioGeneral < 9:
                                                            $caracterGeneral = "AA";
                                                            break;
                                                        case $promedioGeneral >= 4.01 && $promedioGeneral < 7:
                                                            $caracterGeneral = "APA";
                                                            break;
                                                        case $promedioGeneral >= 0 && $promedioGeneral <= 4:
                                                            $caracterGeneral = "NAA";
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

                                            <tr>
                                                <th colspan="4">Promedio General:</th>
                                                <th>
                                                    <?php echo number_format($promedioGeneral / $con, 2) ?>
                                                </th>
                                                <th class="letra">
                                                    <?php echo $caracterGeneral ?>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="6" class="text-center">Escala de Aprovechamiento</th>

                                            </tr>

                                            <tr>
                                                <td>DA - Domina los Aprendizajes</td>
                                                <td colspan="5" class="text-center">(9.00-10.00)</td>
                                            </tr>

                                            <tr>
                                                <td>AA - Alcanza los Aprendizajes</td>
                                                <td colspan="5" class="text-center">(7.00-8.99)</td>
                                            </tr>

                                            <tr>
                                                <td>EPA - Está próximo a Alcanzar</td>
                                                <td colspan="5" class="text-center">(4.01-6.99)</td>
                                            </tr>

                                            <tr>
                                                <td>NAA - No Alcanza los Aprendizajes</td>
                                                <td colspan="5" class="text-center">(0-4.00)</td>
                                            </tr>

                                            <tr>
                                                <td rowspan="3" colspan="3" style="height:150px" class="text-center">
                                                    <hr>FIRMA RECTOR(A)
                                                </td>
                                                <td rowspan="3" colspan="3" style="height:150px" class="text-center">
                                                    <hr>FIRMA TUTOR(A)
                                                </td>

                                            </tr>


                                        </tbody>
                                    </table>


                                </div>
                            </div>









                            <!-- Segundo PARICAL -->
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <button id="exportButton2" class="btn btn-danger mb-3"><i
                                        class="bi bi-file-earmark-pdf-fill"></i></button>


                                <div id="acta2" style="width:98%">
                                    <table id="example2" class="display nowrap" style="width:100%">
                                        <thead>

                                            <tr>
                                                <th class="text-center" colspan="6"><img
                                                        src="assets/institucion/logo.png" alt="no found" width="100px">
                                                    <h7 style="margin:80px">INFORME DE RENDIMIENTO ACADEMICO POR PARCIAL
                                                    </h7>
                                                    <img src="assets/institucion/logoG.jpeg" alt="no found"
                                                        width="200px">
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Nombre</th>
                                                <th colspan="3" class="text-center letra">
                                                    <?php echo $usuario['nombre'] ?>
                                                </th>
                                                <th colspan="2" class="text-center letra">2do Parcial</th>
                                            </tr>

                                            <tr>
                                                <th>Curso</th>
                                                <th colspan="5" class="text-center letra">
                                                    <?php echo $usuario['grado'] ?>
                                                </th>
                                            </tr>

                                            <tr>

                                                <th>Materia</th>
                                                <th>Tarea</th>
                                                <th>Foros</th>
                                                <th>Evaluaciones</th>
                                                <th>Promedio</th>
                                                <th>Caulitativa</th>
                                            </tr>
                                        </thead>
                                        <tbody id="datosEstudiante">

                                            <?php $con = 0;
                                            $promedioGeneral = 0;
                                            foreach ($calificacionEvaluacion as $evaluacion) { ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $evaluacion['nombre_materia'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($calificacionTarea[$con]['segundoParcial'], 2); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($calificacionForo[$con]['segundoParcial'], 2); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($evaluacion['segundoParcial'], 2) ?>
                                                    </td>

                                                    <?php

                                                    $promedio2 = ($calificacionForo[$con]['segundoParcial'] + $calificacionTarea[$con]['segundoParcial'] + $evaluacion['segundoParcial']) / 3;
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

                                                    switch (true) {
                                                        case $promedioGeneral >= 9 && $promedioGeneral <= 10:
                                                            $caracterGeneral = "DA";
                                                            break;
                                                        case $promedioGeneral >= 7 && $promedioGeneral < 9:
                                                            $caracterGeneral = "AA";
                                                            break;
                                                        case $promedioGeneral >= 4.01 && $promedioGeneral < 7:
                                                            $caracterGeneral = "APA";
                                                            break;
                                                        case $promedioGeneral >= 0 && $promedioGeneral <= 4:
                                                            $caracterGeneral = "NAA";
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

                                            <tr>
                                                <th colspan="4">Promedio General:</th>
                                                <th>
                                                    <?php echo number_format($promedioGeneral / $con, 2) ?>
                                                </th>
                                                <th class="letra">
                                                    <?php echo $caracterGeneral ?>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="6" class="text-center">Escala de Aprovechamiento</th>

                                            </tr>

                                            <tr>
                                                <td>DA - Domina los Aprendizajes</td>
                                                <td colspan="5" class="text-center">(9.00-10.00)</td>
                                            </tr>

                                            <tr>
                                                <td>AA - Alcanza los Aprendizajes</td>
                                                <td colspan="5" class="text-center">(7.00-8.99)</td>
                                            </tr>

                                            <tr>
                                                <td>EPA - Está próximo a Alcanzar</td>
                                                <td colspan="5" class="text-center">(4.01-6.99)</td>
                                            </tr>

                                            <tr>
                                                <td>NAA - No Alcanza los Aprendizajes</td>
                                                <td colspan="5" class="text-center">(0-4.00)</td>
                                            </tr>

                                            <tr>
                                                <td rowspan="3" colspan="3" style="height:150px" class="text-center">
                                                    <hr>FIRMA RECTOR(A)
                                                </td>
                                                <td rowspan="3" colspan="3" style="height:150px" class="text-center">
                                                    <hr>FIRMA TUTOR(A)
                                                </td>

                                            </tr>

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
<!-- jQuery, Popper.js, Bootstrap JS 
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

-->

<script>
    document.getElementById('exportButton').addEventListener('click', () => {
        const element = document.getElementById('acta1');
        const options = {
            margin: 3,  // Puedes ajustar el valor según tus necesidades
            filename: 'archivo.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 3 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' },
        };

        // Invoca html2pdf con el elemento y las opciones
        html2pdf(element, options);
    });

    document.getElementById('exportButton2').addEventListener('click', () => {
        const element = document.getElementById('acta2');
        const options = {
            margin: 3,  // Puedes ajustar el valor según tus necesidades
            filename: 'archivo.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 3 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' },
        };

        // Invoca html2pdf con el elemento y las opciones
        html2pdf(element, options);
    });
</script>
<?php require_once 'views/partials/footer.php'; ?>