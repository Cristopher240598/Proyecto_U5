<?PHP require_once './includes/nav-login.php'; ?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Crear audífonos</h2>
            </div>
            <form class="formulario" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Marca</label>
                    <input class="form-control ancho-marca" type="text">
                </div>
                <div class="form-group">
                    <label for="">Modelo</label>
                    <input class="form-control ancho-artista" type="text">
                </div>
                <div class="form-group">
                    <label for="">Potencia máxima (mW)</label>
                    <input class="form-control ancho-disquera" type="number">
                </div>
                <div class="form-group">
                    <label for="">Peso (gr)</label>
                    <input class="form-control ancho-peso" type="number">
                </div>
                <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea class="form-control altura-desc"></textarea>
                </div>
                <div class="form-group d-flex flex-column">
                    <label for="">Imagen</label>
                    <input type="file">
                </div>
                <div class="form-group d-flex justify-content-center">
                    <img class="ancho-imagen" src="img/discos.jpg">
                </div>
                <input class="btn btn-info btn-block" type="submit" name="submit" value="Crear">
            </form>
        </div>
    </section>
</main>

<?php require_once './includes/footer.php'; ?>  