<?php
ob_start();
require_once './includes/nav-login.php';

$sql = 'SELECT id, titulo, artista, imagen FROM discos';
$resultSet = mysqli_query($conn, $sql);
$discos = mysqli_fetch_all($resultSet, MYSQLI_ASSOC);
mysqli_free_result($resultSet);

if (isset($_GET['id']))
{
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    $sqlImg = "SELECT imagen FROM discos WHERE id = $id";
    
    $resultSet = mysqli_query($conn, $sqlImg);
    
    $img = mysqli_fetch_all($resultSet, MYSQLI_ASSOC);
    
    $imgDiscos = $img[0]['imagen'];
    
    unlink("imagenesDiscos/$imgDiscos");
    
    $sql = "DELETE FROM discos WHERE id = $id";
    
    if (mysqli_query($conn, $sql))
    {
        header('Location: delete-disc.php');
    } else
    {
        echo 'Error en el query eliminar: ' . mysqli_error($conn);
    }
    mysqli_free_result($resultSet);
}
mysqli_close($conn);
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Elimina disco seleccionado</h2>
            </div>
            <div class="padding-columnas">             
                <div class="row no-gutters">
                    <?php foreach ($discos as $disco) { ?>
                        <div class="col-12 col-md-6 col-lg-4 padding-celda">
                            <div class="clean-product-item">
                                <div class="image">
                                    <img class="rounded-circle img-fluid d-block mx-auto imagen" src="<?= $base ?>imagenesDiscos/<?php echo htmlspecialchars($disco['imagen']); ?>">
                                </div>
                                <div class="text-center product-name margen-txt-col">
                                    <h2 class="text-info tamanio-titulo-col"><?php echo htmlspecialchars($disco['titulo']); ?></h2>
                                    <p class="tamanio-subtitulo-col"><?php echo htmlspecialchars($audifono['artista']); ?></p>
                                </div>
                                <div class="text-center product-name">
                                    <a class="btn btn-danger btn-color" onclick="alerta()" role="button" href="delete-disc.php?id=<?php echo $audifono['id'] ?>">Eliminar</a>
                                </div>
                                <div class="text-center product-name">
                                    <a class="btn btn-secondary" role="button" href="index.php">Eliminar</a>
                                    <p id="txtmensaje"></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>             
            </div>
        </div>
    </section>
</main>
<script type="text/javascript">

    function alerta()
    {
        var mensaje;
        var opcion = confirm("¿Deseas borrar disco?");
        if (opcion == true) {
            alert("Disco borrado");
        } else {
            mensaje = "Cancelar";
        }
        document.getElementById("txtmensaje").innerHTML = mensaje;
    }
</script>
<?php
ob_end_flush();
require_once './includes/footer.php';
?>