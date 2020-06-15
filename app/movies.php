<?php
ob_start();
require_once './includes/nav-login-user.php';

$sql = "SELECT p.id, p.titulo, p.reparto, p.director, p.imagen, p.descripcion, tp.genero "
            . "FROM peliculas p "
            . "INNER JOIN temas_peliculas tp ON p.id_temaPelicula = tp.id ORDER BY titulo";$resultado = mysqli_query($conn, $sql);
$peliculas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
mysqli_free_result($resultado);
mysqli_close($conn);
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Películas</h2>
            </div>
            <div class="padding-columnas">
                <div class="row no-gutters">
                     <?php foreach ($peliculas as $peli){ ?>
                        <div class="col-12 col-md-6 col-lg-4 padding-celda">
                            <div class="clean-product-item">
                                <div class="image">
                                    <img class="rounded-circle img-fluid d-block mx-auto imagen" src="<?= $base ?>imagenesPeliculas/<?php echo htmlspecialchars($peli['imagen']); ?>">
                                </div>
                                <div class="text-center product-name margen-txt-col">
                                    <h2 class="text-info tamanio-titulo-col"><?php echo htmlspecialchars($peli['titulo']); ?></h2>
                                   <p>Genero: <?php echo htmlspecialchars($peli['genero']); ?></p>
                                   
                                </div>
                                <div class="text-center product-name">
                                    <a class="btn btn-info btn-color" role="button" href="comment-movies.php?id=<?php echo $peli['id'] ?>">Ver</a>
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
