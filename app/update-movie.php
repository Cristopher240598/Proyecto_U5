<?php
ob_start();
require_once './includes/nav-login.php';
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Modificar película</h2>
            </div>
            <form class="formulario" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Título</label>
                    <input class="form-control" type="text" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label for="">Reparto</label>
                    <input class="form-control" type="text" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label for="">Director</label>
                    <input class="form-control ancho-disquera" type="text" maxlength="200" required="">
                </div>
                <div class="form-group">
                    <label for="">Género</label>
                    <select class="form-control ancho-genero" required>
                        <optgroup label="Género">
                            <option value="1" selected="">Acción</option>
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
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
                <input class="btn btn-info btn-block" type="submit" name="submit" value="Guardar cambios">
            </form>
        </div>
    </section>
</main>

<?php
ob_end_flush();
require_once './includes/footer.php';
?>