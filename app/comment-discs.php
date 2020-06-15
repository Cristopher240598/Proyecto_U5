<?php
ob_start();
require_once './includes/nav-login-user.php';

if (isset($_GET['id']))
{
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM discos WHERE id = $id";

    $resultSetQ = mysqli_query($conn, $sql);
    $discos = mysqli_fetch_assoc($resultSetQ);

    $imagenDisco = $discos['imagen'];
    mysqli_free_result($resultSetQ);

    //Comentarios
    $sqlComD = "SELECT comD.comentario, us.nombre, us.imagen
        FROM comentarios_discos comD
        INNER JOIN usuarios us
        ON comD.id_usuario = us.id
        WHERE comD.id_disco= $id "
            . "ORDER BY comD.id";

    $resComD = mysqli_query($conn, $sqlComD);

    $comentriosAu = mysqli_fetch_all($resComD, MYSQLI_ASSOC);

    mysqli_free_result($resComD);
}

if (isset($_POST['submit']) && isset($_GET['id']))
{
    $idD = mysqli_real_escape_string($conn, $_GET['id']);

    $comentario = mysqli_real_escape_string($conn, $_POST['comentario']);

    $sql = "INSERT INTO comentarios_discos(id_disco, id_usuario, comentario) "
            . "VALUES($idD, $idUsuarioLog, '$comentario')";

    if (mysqli_query($conn, $sql))
    {
        header("Location: comment-discs.php?id=$idD");
    } else
    {
        echo 'Error al insertar comentario del disco: ' . mysqli_error($conn);
    }
}
    mysqli_close($conn);
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-articulos">
                <h2 class="text-info tamanio-titulo"><?php echo htmlspecialchars($discos['titulo']); ?></h2>
                <p class="tamanio-subtitulo"><?php echo htmlspecialchars($discos['artista']); ?></p>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <img class="rounded-circle img-fluid" src="<?= $base ?>imagenesDiscos/<?php echo htmlspecialchars($discos['imagen']); ?>">
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2">
                    <div class="text-center p-5">
                        <p class="tamanio-txt">
                            Disquera: <?php echo htmlspecialchars($discos['disquera']); ?> mW<br>
                            Canciones: <?php echo htmlspecialchars($discos['numeroCanciones']); ?> gr<br>
                            Descripción: <?php echo htmlspecialchars($discos['descripcion']); ?>
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
            <?php foreach ($comentariosD as $comentarioD){ ?>
                <div class="text-center block-heading">
                    <p class="text-left tamanio-usuario-com">
                        <img class="rounded-circle com-usuario" src="<?= $base ?>imagenesUsuario/<?php echo htmlspecialchars($comentarioD['imagen']); ?>"><?php echo htmlspecialchars($comentarioD['nombre']) ?>
                    </p>
                    <p class="text-justify tamanio-com"><?php echo htmlspecialchars($comentarioD['comentario']) ?></p>
                    <hr>
                </div>
            <?php } ?>
            <div class="text-center block-heading">
                <form class="formulario ancho-form" action="comment-discs.php?id=<?php echo $discos['id'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <textarea class="form-control alt-form-com" name="comentario" id="comentario" maxlength="16,777,215" onchange="valDesc('comentario')" autofocus></textarea>
                    </div>
                    <input class="btn btn-info btn-block ancho-btn-com" type="submit" name="submit" value="Comentar">
                </form>
            </div>
        </div>
    </section>
</main>

<script>
  function valDesc(idinput){
    x = document.getElementById(idinput).value;
    if (validardesc(x)) {
      document.getElementById(idinput).style.backgroundColor = "#CEF6D8";
    }else{
      document.getElementById(idinput).style.backgroundColor = "#F6CECE";
    }
  }
</script>

<?php
ob_end_flush();
require_once './includes/footer.php';
?>
