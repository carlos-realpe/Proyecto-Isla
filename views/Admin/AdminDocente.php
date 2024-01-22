<?php require_once 'views/partials/encabezado.php'; ?>
<style>
    .nombre {
        width: 100px;
    }

    .apellido {
        width: 10px;
    }

    .email {
        width: 150px;
    }

    .estado {
        width: 50px
    }

    .botones {
        width: 80px;

    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Docentes</h1>
        <div class="search-bar">


        </div>


    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a href="index.php?c=Docente&a=VistaRegistrarDocente" class="btn btn-dark"><i
                                class="bi bi-person-plus"></i> Registrar Docente</a>
                        <div style="margin-top:10px;">
                            <input type="text" name="query" id="buscarCorreo" style="width:300px;"
                                placeholder="Buscar por email" title="Enter search keyword"
                                onkeyup="consultarDatosAjaxDocente()">
                        </div>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="d-none d-lg-table-cell">Nombre</th>
                                    <th scope="col" class="d-none d-lg-table-cell">Apellido</th>
                                    <th scope="col" class="d-none d-lg-table-cell">Título</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="datosDocente">

                                <!--  <tr>
                                    <th style="width:20px;" scope="row">1</th>
                                    <td class="nombre d-none d-lg-table-cell">Brandon Jacob</td>
                                    <td class="apellido d-none d-lg-table-cell">Designer</td>
                                    <td class="estado d-none d-lg-table-cell">28</td>
                                    <td class="email">2016-05-25</td>
                                <td class="botones"><a href="#" class="btn btn-danger mr-2 mb-2"><i class="bi bi-trash"></i></a> <a href="#" class="btn btn-dark mr-2 mb-2"><i class="bi bi-pencil"></i></</a></td>
                              </tr>-->

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="assets/js/DocenteAdminAjax.js"></script>
<?php require_once 'views/partials/footer.php'; ?>