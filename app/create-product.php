<?php
ob_start();
require_once './includes/nav-login.php';
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Crear producto</h2>
            </div>
            <form class="formulario">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input class="form-control ancho-artista" type="text" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label for="">Marca</label>
                    <input class="form-control ancho-marca" type="text" maxlength="200" required>
                </div>
                <div>
                    <label for="">Descripción</label>
                    <textarea class="form-control altura-desc" maxlength="16,777,215" required></textarea>
                </div>
                <div class="form-group d-flex flex-column">
                    <label for="">Imagen</label>
                    <input type="file" accept="image/" required>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <img class="ancho-imagen" src="img/discos.jpg">
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