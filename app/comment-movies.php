<?php
ob_start();
require_once './includes/nav-login-user.php';

if (isset($_GET['id']))
{
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT p.id, p.titulo, p.reparto, p.director, p.imagen, p.descripcion, tp.genero "
            . "FROM peliculas p "
            . "INNER JOIN temas_peliculas tp ON p.id_temaPelicula = tp.id "
            . "WHERE p.id = $id";
    $resultado = mysqli_query($conn, $sql);
    $peliculas = mysqli_fetch_assoc($resultado);
    $imagenPeliculas = $peliculas['imagen'];
    mysqli_free_result($resultado);
    //Comentarios
    $sqlComenta = "SELECT comP.comentario, us.nombre, us.imagen 
        FROM comentarios_peliculas comP
        INNER JOIN usuarios us 
        ON comp.id_usuario = us.id 
        WHERE comP.id_pelicula = $id "
            . "ORDER BY comP.id";
    $resComAu = mysqli_query($conn, $sqlComenta);
    $comentariosPeli = mysqli_fetch_all($resComAu, MYSQLI_ASSOC);
    mysqli_free_result($resComAu);
}

if (isset($_POST['submit']) && isset($_GET['id']))
{
    $idPeli = mysqli_real_escape_string($conn, $_GET['id']);
    $comentario = mysqli_real_escape_string($conn, $_POST['comentario']);
    $sql = "INSERT INTO comentarios_peliculas(id_pelicula, id_usuario, comentario) "
            . "VALUES($idPeli, $idUsuarioLog, '$comentario')";
    if (mysqli_query($conn, $sql))
    {
        header("Location: comment-movies.php?id=$idPeli");
    } else
    {
        echo 'Error en la insercción de peliculas: ' . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-articulos">
                <h2 class="text-info tamanio-titulo"><?php echo htmlspecialchars($peliculas['titulo']); ?></h2>
                <p class="tamanio-subtitulo"><?php echo htmlspecialchars($peliculas['genero']); ?></p>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <img class="rounded-circle img-fluid" src="<?= $base ?>imagenesPeliculas/<?php echo htmlspecialchars($peliculas['imagen']); ?>">
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2">
                    <div class="text-center p-5">
                        <p class="tamanio-txt">
                            Reparto: <?php echo htmlspecialchars($peliculas['reparto']); ?><br>
                            Director: <?php echo htmlspecialchars($peliculas['director']); ?><br>
                            Descripción: <?php echo htmlspecialchars($peliculas['descripcion']); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="text-center block-heading margen-titulo-com">
                <h2 class="text-left text-info" style="font-size: 30px;">Comentarios</h2>
            </div>
            <?php foreach ($comentariosPeli as $comentario)
            { ?>
                <div class="text-center block-heading">
                    <p class="text-left tamanio-usuario-com">
                        <img class="rounded-circle com-usuario" src="<?= $base ?>imagenesUsuario/<?php echo htmlspecialchars($comentario['imagen']); ?>"><?php echo htmlspecialchars($comentario['nombre']) ?>
                    </p>
                    <p class="text-justify tamanio-com"><?php echo htmlspecialchars($comentario['comentario']) ?></p>
                    <hr>
                </div>
            <?php } ?>
            <div class="text-center block-heading">
                <form class="formulario ancho-form" action="comment-movies.php?id=<?php echo $peliculas['id'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <textarea class="form-control alt-form-com" name="comentario" id="comentario" autofocus></textarea>
                    </div>
                    <input class="btn btn-info btn-block ancho-btn-com" type="submit" name="submit" value="Comentar">
                </form>
            </div>
        </div>
    </section>
</main>

<?php
ob_end_flush();
require_once './includes/footer.php';
?>