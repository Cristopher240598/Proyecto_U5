<?php
ob_start();
require_once './includes/nav-login-user.php';

if (isset($_GET['id']))
{
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM productos WHERE id = $id";
    $resultadop = mysqli_query($conn, $sql);
    $productos = mysqli_fetch_assoc($resultadop);
    $imagenproductos = $productos['imagen'];
    mysqli_free_result($resultadop);
    //Comentarios
    $sqlComP = "SELECT comP.comentario, us.nombre, us.imagen
        FROM comentarios_productos comP
        INNER JOIN usuarios us
        ON comP.id_usuario = us.id
        WHERE comP.id_producto = $id "
            . "ORDER BY comP.id";
    $resComP = mysqli_query($conn, $sqlComP);
    $comentariosP = mysqli_fetch_all($resComP, MYSQLI_ASSOC);
    mysqli_free_result($resComP);
}

if (isset($_POST['submit']) && isset($_GET['id']))
{
    $idAu = mysqli_real_escape_string($conn, $_GET['id']);
    $comentario = mysqli_real_escape_string($conn, $_POST['comentario']);
    $sql = "INSERT INTO comentarios_productos(id_producto, id_usuario, comentario) "
            . "VALUES($idAu, $idUsuarioLog, '$comentario')";
    if (mysqli_query($conn, $sql))
    {
        header("Location: comment-products.php?id=$idAu");
    } else
    {
        echo 'Error en la insercción de comentario en productos: ' . mysqli_error($conn);
    }
}
    mysqli_close($conn);
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-articulos">
                <h2 class="text-info tamanio-titulo"><?php echo htmlspecialchars($productos['nombre']); ?></h2>
                <p class="tamanio-subtitulo"><?php echo htmlspecialchars($productos['marca']); ?></p>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <img class="rounded-circle img-fluid" src="<?= $base ?>imagenesProductos/<?php echo htmlspecialchars($productos['imagen']); ?>">
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2">
                    <div class="text-center p-5">
                        <p class="tamanio-txt">
                            Descripción: <?php echo htmlspecialchars($productos['descripcion']); ?>
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
            <?php foreach ($comentariosP as $comentarioP){ ?>
                <div class="text-center block-heading">
                    <p class="text-left tamanio-usuario-com">
                        <img class="rounded-circle com-usuario" src="<?= $base ?>imagenesUsuario/<?php echo htmlspecialchars($comentarioP['imagen']); ?>"><?php echo htmlspecialchars($comentarioP['nombre']) ?>
                    </p>
                    <p class="text-justify tamanio-com"><?php echo htmlspecialchars($comentarioP['comentario']) ?></p>
                    <hr>
                </div>
            <?php } ?>
            <div class="text-center block-heading">
                <form class="formulario ancho-form" action="comment-products.php?id=<?php echo $productos['id'] ?>" method="POST" enctype="multipart/form-data">
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
