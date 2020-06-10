<?php
ob_start();
require_once './includes/nav-login.php';

$sql = 'SELECT * FROM audifonos ORDER BY marca';
$resultado = mysqli_query($conn, $sql);
$audifonos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
mysqli_free_result($resultado);
mysqli_close($conn);
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Audífonos</h2>
            </div>
            <div class="products padding-columnas">
                <div class="row no-gutters">
                    <?php foreach ($audifonos as $audifono){ ?>
                        <div class="col-12 col-md-6 col-lg-4 padding-celda">
                            <div class="clean-product-item">
                                <div class="image">
                                    <img class="rounded-circle img-fluid d-block mx-auto imagen" src="<?= $base ?>imagenesAudifonos/<?php echo htmlspecialchars($audifono['imagen']); ?>">
                                </div>
                                <div class="text-center margen-txt-col padding-texto-art">
                                    <p class="tamanio-txt">
                                        ID: <?php echo htmlspecialchars($audifono['id']); ?><br>
                                        Marca: <?php echo htmlspecialchars($audifono['marca']); ?><br>
                                        Modelo: <?php echo htmlspecialchars($audifono['modelo']); ?><br>
                                        Potencia máxima: <?php echo htmlspecialchars($audifono['potenciaMaxima']); ?> mW<br>
                                        Peso: <?php echo htmlspecialchars($audifono['peso']); ?> gr<br>
                                        Descripción: <?php echo htmlspecialchars($audifono['descripcion']); ?>
                                    </p>
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