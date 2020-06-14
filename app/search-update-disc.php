<?php
ob_start();
require_once './includes/nav-login.php'; 

$sql = 'SELECT * FROM discos';

$resultado = mysqli_query($conn, $sql);

$discos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

mysqli_free_result($resultado);

mysqli_close($conn);

?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Modificar discos</h2>
            </div>
            <div class="padding-columnas">
                <div class="row no-gutters">
                    <?php foreach ($discos as $disco){ ?>
                        <div class="col-12 col-md-6 col-lg-4 padding-celda">
                            <div class="clean-product-item">
                                <div class="image">
                                    <img class="rounded-circle img-fluid d-block mx-auto imagen" src="<?= $base ?>imagenesDiscos/<?php echo htmlspecialchars($disco['imagen']); ?>">
                                </div>
                                <div class="text-center product-name margen-txt-col">
                                    <h2 class="text-info tamanio-titulo-col"><?php echo htmlspecialchars($disco['titulo']); ?></h2>
                                    <p class="tamanio-subtitulo-col"><?php echo htmlspecialchars($disco['artista']); ?></p>
                                </div>
                                <div class="text-center product-name">
                                    <a class="btn btn-info btn-color" role="button" href="update-disc.php?id=<?php echo $disco['id'] ?>">Modificar</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
ob_end_flush();
require_once './includes/footer.php';
?>
