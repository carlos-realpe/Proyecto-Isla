<?php require_once 'views/partials/encabezado.php'; ?>
<style>
    ul {
        list-style: none;
    }

    a {
        text-decoration: none;
    }

    #anim {
        background-color: var(--color-negro-sid);
        transition: transform 0.3s;
        /* Agrega una transición suave al transformar */
    }
</style>


<main id="main" class="main">

    <div class="pagetitle">

<h1><?php echo $typeLink ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>


                <li class="breadcrumb-item"><a href="index.php?c=Docente&a=mostrarClases&type=<?php echo $typeLink ?>"><?php echo $typeLink ?></a></li>
        
        
        
        
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                       
                        <div class="row">

<?php if($clases == null){ ?>
    <h5 style="color:red"><b>No se ha realizado aun la asignación de curso</b></h5>
<?php } ?>

                            <?php foreach ($clases as $resultado): ?>


                                <a class="col-sm-6" 
                                    href="index.php?c=Docente&a=Mostrar<?php echo $typeLink ?>Datos&idAsignacion=<?php echo $resultado['id_fk_curso']; ?>"
                                    style="color: inherit;">




                                    <div class="card" id="anim" onmouseover="agrandarTarjeta(this)"
                                        onmouseout="restaurarTarjeta(this)"
                                        style="background-color:var(--color-negro-sid);">
                                        <div class="card-body">
                                            <h5 class="card-title text-white"><b>Nombre del Curso:</b>
                                                <?php echo $resultado['nombre_curso'] ?>
                                            </h5>
                                            <p class="card-text text-white"><b>Materia:</b>
                                                <?php echo $resultado['nombre_materia'] ?>
                                            </p>
                                            <p class="card-text text-white"><b>Grado:</b>
                                                <?php echo $resultado['grado'] ?>
                                            </p>
                                            <p class="card-text text-white"><b>Paralelo:</b>
                                                <?php echo $resultado['paralelo'] ?>
                                            </p>
                                            <!--       <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                        </div>

                        </a>
                    </div>
                </div>
            </div>
    </section>
</main>
<script>
    function agrandarTarjeta(elemento) {
        elemento.style.transform = 'scale(1.1)';
    }

    function restaurarTarjeta(elemento) {
        elemento.style.transform = 'scale(1)';
    }
</script>


<?php require_once 'views/partials/footer.php'; ?>