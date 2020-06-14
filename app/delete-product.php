<?php
ob_start();
require_once './includes/nav-login.php';

$sql = 'SELECT id, nombre, marca, imagen FROM productos ORDER BY marca';
$resultado = mysqli_query($conn, $sql);
$productos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
mysqli_free_result($resultado);
if (isset($_GET['id']))
{
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql2 = "SELECT imagen FROM productos WHERE id = $id";
    $res = mysqli_query($conn, $sql2);
    $img = mysqli_fetch_assoc($res);
    $imgproductos = $img['imagen'];
    unlink("imagenesProductos/$imgproductos");
    $sql = "DELETE FROM productos WHERE id = $id";
    if (mysqli_query($conn, $sql))
    {
        header('Location: delete-product.php');
    } else
    {
        echo 'Error al eliminar producto: ' . mysqli_error($conn);
    }
    mysqli_free_result($res);
}
mysqli_close($conn);
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Eliminar Productos</h2>
            </div>
            <div class="padding-columnas">             
                <div class="row no-gutters">
                    <?php foreach ($productos as $producto) { ?>
                        <div class="col-12 col-md-6 col-lg-4 padding-celda">
                            <div class="clean-product-item">
                                <div class="image">
                                    <img class="rounded-circle img-fluid d-block mx-auto imagen" src="<?= $base ?>imagenesProductos/<?php echo htmlspecialchars($producto['imagen']); ?>">
                                </div>
                                <div class="text-center product-name margen-txt-col">
                                    <h2 class="text-info tamanio-titulo-col"><?php echo htmlspecialchars($producto['nombre']); ?></h2>
                                    <p class="tamanio-subtitulo-col"><?php echo htmlspecialchars($producto['marca']); ?></p>
                                </div>
                                <div class="text-center product-name">
                                    <a class="btn btn-danger btn-color" role="button" href="delete-product.php?id=<?php echo $producto['id'] ?>">Eliminar</a>
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