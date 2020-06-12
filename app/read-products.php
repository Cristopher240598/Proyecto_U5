<?php
ob_start();
require_once './includes/nav-login.php';

$sql = 'SELECT * FROM productos ORDER BY marca';
$resultado = mysqli_query($conn, $sql);
$producto = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
mysqli_free_result($resultado);
mysqli_close($conn);
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Productos</h2>
            </div>
            <div class="products padding-columnas">
                <div class="row no-gutters">
                    <?php foreach ($producto as $productos){ ?>
                        <div class="col-12 col-md-6 col-lg-4 padding-celda">
                            <div class="clean-product-item">
                                <div class="image">
                                    <img class="rounded-circle img-fluid d-block mx-auto imagen" src="<?= $base ?>imagenesproductos/<?php echo htmlspecialchars($productos['imagen']); ?>">
                                </div>
                                <div class="text-center margen-txt-col padding-texto-art">
                                    <p class="tamanio-txt">
                                        ID: <?php echo htmlspecialchars($productos['id']); ?><br>
                                        Nombre: <?php echo htmlspecialchars($productos['nombre']); ?><br>
                                        Marca: <?php echo htmlspecialchars($productos['marca']); ?><br>                                      
                                        Descripción: <?php echo htmlspecialchars($productos['descripcion']); ?>
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