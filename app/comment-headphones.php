<?php
ob_start();
require_once './includes/nav-login-user.php';

if (isset($_GET['id']))
{
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM audifonos WHERE id = $id";
    $resultado = mysqli_query($conn, $sql);
    $audifonos = mysqli_fetch_assoc($resultado);
    $imagenAudifonos = $audifonos['imagen'];
    mysqli_free_result($resultado);
    //Comentarios
    $sqlComAu = "SELECT comA.comentario, us.nombre, us.imagen
        FROM comentarios_audifonos comA
        INNER JOIN usuarios us
        ON comA.id_usuario = us.id
        WHERE comA.id_audifonos = $id "
            . "ORDER BY comA.id";
    $resComAu = mysqli_query($conn, $sqlComAu);
    $comentriosAu = mysqli_fetch_all($resComAu, MYSQLI_ASSOC);
    mysqli_free_result($resComAu);
}

if (isset($_POST['submit']) && isset($_GET['id']))
{
    $idAu = mysqli_real_escape_string($conn, $_GET['id']);
    $comentario = mysqli_real_escape_string($conn, $_POST['comentario']);
    $sql = "INSERT INTO comentarios_audifonos(id_audifonos, id_usuario, comentario) "
            . "VALUES($idAu, $idUsuarioLog, '$comentario')";
    if (mysqli_query($conn, $sql))
    {
        header("Location: comment-headphones.php?id=$idAu");
    } else
    {
        echo 'Error en la insercción de audífonos: ' . mysqli_error($conn);
    }
}
    mysqli_close($conn);
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-articulos">
                <h2 class="text-info tamanio-titulo"><?php echo htmlspecialchars($audifonos['modelo']); ?></h2>
                <p class="tamanio-subtitulo"><?php echo htmlspecialchars($audifonos['marca']); ?></p>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <img class="rounded-circle img-fluid" src="<?= $base ?>imagenesAudifonos/<?php echo htmlspecialchars($audifonos['imagen']); ?>">
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2">
                    <div class="text-center p-5">
                        <p class="tamanio-txt">
                            Potencia máxima: <?php echo htmlspecialchars($audifonos['potenciaMaxima']); ?> mW<br>
                            Peso: <?php echo htmlspecialchars($audifonos['peso']); ?> gr<br>
                            Descripción: <?php echo htmlspecialchars($audifonos['descripcion']); ?>
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
            <?php foreach ($comentriosAu as $comentarioAu){ ?>
                <div class="text-center block-heading">
                    <p class="text-left tamanio-usuario-com">
                        <img class="rounded-circle com-usuario" src="<?= $base ?>imagenesUsuario/<?php echo htmlspecialchars($comentarioAu['imagen']); ?>"><?php echo htmlspecialchars($comentarioAu['nombre']) ?>
                    </p>
                    <p class="text-justify tamanio-com"><?php echo htmlspecialchars($comentarioAu['comentario']) ?></p>
                    <hr>
                </div>
            <?php } ?>
            <div class="text-center block-heading">
                <form class="formulario ancho-form" action="comment-headphones.php?id=<?php echo $audifonos['id'] ?>" method="POST" enctype="multipart/form-data">
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
