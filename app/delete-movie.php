<?php
ob_start();
require_once './includes/nav-login.php';

$sql = 'SELECT id, titulo, descripcion  FROM peliculas';
$result = mysqli_query($conn, $sql);
$peliculas = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
if (isset($_GET['id']))
{
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sqlimagen = "SELECT imagen FROM peliculas WHERE id = $id";
    $res = mysqli_query($conn, $sqlimagen);
    $img = mysqli_fetch_assoc($res);
    $imagenpeli = $img['imagen'];
    unlink("imagenesPeliculas/$imagenpeli");
    $sql = "DELETE FROM peliculas WHERE id = $id";
    if (mysqli_query($conn, $sql))
    {
        header('Location: delete-movie.php');
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
                <h2 class="text-info tamanio-titulo">Eliminar películas</h2>
            </div>
            <div class="padding-columnas">
                <div class="row no-gutters">
                    <?php foreach ($peliculas as $peli) { ?>
                        <div class="col-12 col-md-6 col-lg-4 padding-celda">
                            <div class="clean-product-item">
                                <div class="image">
                                    <img class="rounded-circle img-fluid d-block mx-auto imagen" src="<?= $base ?>imagenesPeliculas/<?php echo htmlspecialchars($peli['imagen']); ?>">
                                </div>
                                <div class="text-center product-name margen-txt-col">
                                    <h2 class="text-info tamanio-titulo-col"><?php echo htmlspecialchars($peli['titulo']); ?></h2>
                                     <p><?php echo htmlspecialchars($peli['descripcion']); ?></p>
                                </div>
                                <div class="text-center product-name">
                                    <a class="btn btn-danger btn-color" role="button" href="delete-movie.php?id=<?php echo $peli['id'] ?>">Eliminar</a>
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