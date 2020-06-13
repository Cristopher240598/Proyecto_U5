<?php
ob_start();
require_once './includes/nav-login.php';

$sql = 'SELECT id, marca, modelo, imagen FROM audifonos ORDER BY marca';
$resultado = mysqli_query($conn, $sql);
$audifonos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
mysqli_free_result($resultado);
if (isset($_GET['id']))
{
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql2 = "SELECT imagen FROM audifonos WHERE id = $id";
    $res = mysqli_query($conn, $sql2);
    $img = mysqli_fetch_assoc($res);
    $imgAudifonos = $img['imagen'];
    unlink("imagenesAudifonos/$imgAudifonos");
    $sql = "DELETE FROM audifonos WHERE id = $id";
    if (mysqli_query($conn, $sql))
    {
        header('Location: delete-headphones.php');
    } else
    {
        echo 'Error al eliminar: ' . mysqli_error($conn);
    }
    mysqli_free_result($res);
}
mysqli_close($conn);
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Eliminar audífonos</h2>
            </div>
            <div class="padding-columnas">             
                <div class="row no-gutters">
                    <?php foreach ($audifonos as $audifono) { ?>
                        <div class="col-12 col-md-6 col-lg-4 padding-celda">
                            <div class="clean-product-item">
                                <div class="image">
                                    <img class="rounded-circle img-fluid d-block mx-auto imagen" src="<?= $base ?>imagenesAudifonos/<?php echo htmlspecialchars($audifono['imagen']); ?>">
                                </div>
                                <div class="text-center product-name margen-txt-col">
                                    <h2 class="text-info tamanio-titulo-col"><?php echo htmlspecialchars($audifono['modelo']); ?></h2>
                                    <p class="tamanio-subtitulo-col"><?php echo htmlspecialchars($audifono['marca']); ?></p>
                                </div>
                                <div class="text-center product-name">
                                    <a class="btn btn-danger btn-color" role="button" href="delete-headphones.php?id=<?php echo $audifono['id'] ?>">Eliminar</a>
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