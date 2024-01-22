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

    @media (max-width: 990px) {


        th:nth-child(2),
        td:nth-child(2) {
            display: table-cell !important;
        }

        th:nth-child(4),
        td:nth-child(4) {
            display: table-cell !important;
        }

        th:nth-child(6),
        td:nth-child(6) {
            display: table-cell !important;
        }
        th:not(:nth-child(1)):not(:nth-child(2)):not(:nth-child(4)):not(:nth-child(6)),
        td:not(:nth-child(1)):not(:nth-child(2)):not(:nth-child(4)):not(:nth-child(6)) {
            display: none !important;
        }
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Asignar Cursos</h1>
        <div class="search-bar">


        </div>


    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a href="index.php?c=Admin&a=MostrarRegistroAsignar" class="btn btn-dark"><i
                                class="bi bi-person-plus"></i> Asignar Estudiantes y Docentes</a>
                        <div class="row" style="margin-top:10px;">
                            <div class="col-md-4">
                                <input type="text" name="buscarCorreo" id="buscarCorreo" style="width:300px;"
                                    placeholder="Buscar por primer apellido del estudiante" title="Enter search keyword"
                                    onkeyup="consultarDatosAjaxAsignados()">
                            </div>
                            <div class="col-md-4">
                                <select id="grado" class="form-select" name="grado"
                                    onchange="consultarDatosAjaxAsignados()">
                                    <option value=" " selected>Seleccionar Grado</option>
                                    <option value="1er Grado">1er Grado</option>
                                    <option value="2do Grado">2do Grado</option>
                                    <option value="3ero Grado">3ero Grado</option>
                                    <option value="4to Grado">4to Grado</option>
                                    <option value="5to Grado">5to Grado</option>
                                    <option value="6to Grado">6to Grado</option>
                                    <option value="7mo Grado">7mo Grado</option>
                                    <option value="8vo Grado">8vo Grado</option>
                                    <option value="9no Grado">9no Grado</option>
                                    <option value="10mo Grado">10mo Grado</option>
                                    <option value="1er Bachillerato">1er Bachillerato</option>
                                    <option value="2do Bachillerato">2do Bachillerato</option>
                                    <option value="3er Bachillerato">3er Bachillerato</option>
                                </select>

                            </div>


                        </div>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="d-none d-lg-table-cell col-3">Nombre del Estudiante</th>
                                    <th scope="col" class="d-none d-lg-table-cell col-2">Nombre del curso</th>
                                    <th scope="col" class="d-none d-lg-table-cell">Materia</th>
                                    <th scope="col" class="d-none d-lg-table-cell">Grado(Paralelo)</th>
                                
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="datosCursos">

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="assets/js/cursos/AsignarAdminAjax.js"></script>

<script>
    // Verificar si hay una opción seleccionada al cargar la página
    window.addEventListener('DOMContentLoaded', function () {
        var selectElement = document.getElementById('grado');
        console.log(selectElement);
        if (selectElement.value != '') {
            consultarDatosAjaxAsignados();
        }
    });
</script>
<?php require_once 'views/partials/footer.php'; ?>