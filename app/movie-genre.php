<?php
ob_start();
require_once './includes/nav-login.php';

$genero = mysqli_real_escape_string($conn, $_POST['genero']);
$sql = "SELECT * FROM temas_peliculas";
$result = mysqli_query($conn, $sql);
$temas = mysqli_fetch_array($result);
mysqli_free_result($result);
mysqli_close($conn);
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Géneros de películas</h2>
            </div>
            <div class="d-flex justify-content-center products padding-columnas">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Género</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($temas as $items) {
                                ?>
                            <form method="POST" action="movie-genre.php">
                                <tr>
                                    <td class = "largo-id"> <?php echo htmlspecialchars($items['id']); ?> </td>
                                    <td class = "largo-genero"> <?php echo htmlspecialchars($items['genero']); ?> </td>
                                    <input class="btn btn-info btn-mod-gm" role="button" href="update-music-genre.php">Modificar</a>
                                    <input class="btn btn-danger" role="button" href="#">Eliminar</a>
                                </tr>
                            </form>
                        <?php } ?>                       
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
ob_end_flush();
require_once './includes/footer.php';
?>

