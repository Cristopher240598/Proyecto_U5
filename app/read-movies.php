<?php
ob_start();
require_once './includes/nav-login.php';
$sql = "SELECT p.id, p.titulo, p.reparto, p.director, p.imagen, p.descripcion, tp.genero "
        . "FROM peliculas p "
        . "INNER JOIN temas_peliculas tp ON p.id_temaPelicula = tp.id ORDER BY titulo";
$resultado = mysqli_query($conn, $sql);
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
                                <div class="text-center margen-txt-col padding-texto-art">
                                    <p class="tamanio-txt">
                                    Id: <?php echo htmlspecialchars($peli['id']); ?><br>
                                    Titulo:<?php echo htmlspecialchars($peli['titulo']); ?><br>
                                    Genero: <?php echo htmlspecialchars($peli['genero']); ?><br>
                                    Reparto: <?php echo htmlspecialchars($peli['reparto']); ?><br>
                                    Director: <?php echo htmlspecialchars($peli['director']); ?><br>
                                    Descripcion: <?php echo htmlspecialchars($peli['descripcion']); ?>
                                  
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