<?php
ob_start();
require_once './includes/nav-login.php';

if (isset($_POST["titulo"]))
{
    
}
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Ingresar nuevo disco</h2>
            </div>
            <form class="formulario" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Título*</label>
                    <input class="form-control" name="titulo" id="titulo" type="text" required="true">
                </div>
                <div class="form-group">
                    <label for="">Artista*</label>
                    <input class="form-control ancho-artista" type="text" required="true">
                </div>
                <div class="form-group">
                    <label for="">Disquera*</label>
                    <input class="form-control ancho-disquera" type="text" required="true">
                </div>
                <div class="form-group">
                    <label for="">Número de canciones*</label>
                    <input class="form-control ancho-canciones" type="number" required="true">
                </div>
                <div class="form-group">
                    <label for="">Género*</label>
                    <select class="form-control ancho-genero" required="true">
                        <optgroup label="Género">
                            <option value="1" selected="">Electrónica</option>
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Descripción*</label>
                    <textarea class="form-control altura-desc" required="true"></textarea>
                </div>
                <div class="form-group d-flex flex-column">
                    <label for="">Imagen</label>
                    <input type="file">
                </div>
                <div class="form-group d-flex justify-content-center">
                    <img class="ancho-imagen" src="img/discos.jpg">
                </div>
                <input class="btn btn-success btn-block" type="submit" name="submit" value="Crear">
            </form>
            <p class="text-danger">* <b>Requerido</b></p>
        </div>
    </section>
</main>

<?php
ob_end_flush();
require_once './includes/footer.php';
?>