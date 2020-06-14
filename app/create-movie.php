<?php
ob_start();
require_once './includes/nav-login.php';
$sql2 = "SELECT * FROM temas_peliculas";
$resultSet = mysqli_query($conn, $sql2);
$temas = mysqli_fetch_all($resultSet, MYSQLI_ASSOC);
mysqli_free_result($resultSet);
mysqli_close($conn);
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Crear película</h2>
            </div>
            <form class="formulario" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Título</label>
                    <input class="form-control" type="text">
                </div>
                <div class="form-group">
                    <label for="">Reparto</label>
                    <input class="form-control" type="text">
                </div>
                <div class="form-group">
                    <label for="">Director</label>
                    <input class="form-control ancho-disquera" type="text">
                </div>
                <div class="form-group">
                    <label for="genero">Género*</label>
                    <select class="form-control ancho-genero" name="genero" id="genero" required="true">

                        <optgroup label="Géneros musicales">
                            <?php
                            foreach ($temas as $items) {
                                ?>
                            <option value="<?php echo htmlspecialchars($items['id']); ?>"><?php echo htmlspecialchars($items['genero']); ?></option>
                            <?php }
                            ?>
                        </optgroup>
                    </select>
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

<?php
ob_end_flush();
require_once './includes/footer.php';
?>