<?php require_once 'views/partials/encabezado.php'; ?>

<style>
    
    @media (max-width: 990px) {


        th:nth-child(2),
        td:nth-child(2) {
            display: table-cell !important;
        }

        th:nth-child(5),
        td:nth-child(5) {
            display: table-cell !important;
        }

        th:nth-child(6),
        td:nth-child(6) {
            display: table-cell !important;
        }

        th:not(:nth-child(1)):not(:nth-child(2)):not(:nth-child(5)):not(:nth-child(6)),
        td:not(:nth-child(1)):not(:nth-child(2)):not(:nth-child(5)):not(:nth-child(6)) {
            display: none !important;
        }
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Calendario</h1>
        <div class="search-bar">


        </div>


    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#basicModalRegistrar"
                            class="btn btn-dark"><i class="bi bi-person-plus"></i> Registrar Evento</button>

                        <div class="row" style="margin-top:10px;">
                            <div class="col-md-4">
                                <input type="text" name="buscarEvent" id="buscarEvento" style="width:300px;"
                                    placeholder="Buscar por evento" title="Enter search keyword"
                                    onkeyup="consultarDatosAjaxAsignados()">
                            </div>


                        </div>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="d-none d-lg-table-cell">Nombre del Evento</th>
                                    <th scope="col" class="d-none d-lg-table-cell">Fecha Inicio</th>
                                    <th scope="col" class="d-none d-lg-table-cell">Fecha Fin</th>
                                    <th scope="col" class="d-none d-lg-table-cell">Acciones</th>

                                </tr>
                            </thead>

                            <tbody id="datosCalendario">

                            </tbody>
                        </table>



                        <!--------------MODAL Registrar-------------->
                        <div class="modal fade" id="basicModalRegistrar" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Registro</h5>
                                       </div>
                                    <div class="modal-body">
                                        <form class="form" id="form"
                                            method="post" enctype="multipart/form-data">
                                            <div class="col-md-12"> <label for="inputName5" class="form-label">Nombre del Evento
                                                    
                                                </label>
                                                <input type="text" class="form-control" name="eventoModal"
                                                    id="eventoModal" required>
                                            </div>

                                                <input type="text" class="form-control" name="idCalendario"
                                                    id="idCalendario" hidden>
                                            <div class="col-md-12"> <label for="inputName5" class="form-label">Fecha
                                                    Inicio</label>
                                                <input type="date" class="form-control" name="fechaInicioModal"
                                                    id="fechaInicioModal" required>

                                            </div>


                                            <div class="col-md-12"> <label for="inputName5" class="form-label">Fecha
                                                    Fin</label>
                                                <input type="date" class="form-control" name="fechaFinModal"
                                                    id="fechaFinModal" required>

                                            </div>

                                    </div>
                                    <div class="text-center" style="margin:10px"> <button type="submit"
                                            class="btn btn-primary" id="botonG" >Guardar</button>
                                        <a href="#" data-bs-dismiss="modal" id="cerrar" class="btn btn-secondary">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </div>





                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="assets/js/calendario/calendario.js"></script>

<?php require_once 'views/partials/footer.php'; ?>