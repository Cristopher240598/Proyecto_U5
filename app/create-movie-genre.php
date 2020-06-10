<?php
ob_start();
require_once './includes/nav-login.php';
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Crear género de películas</h2>
            </div>
            <form class="formulario" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Género de película</label>
                    <input class="form-control" type="text">
                </div>
                <input class="btn btn-info btn-block" type="submit" name="submit" value="Crear">
            </form>
        </div>
    </section>
</main>

<?php
ob_end_flush();
require_once './includes/footer.php'; 
?>
