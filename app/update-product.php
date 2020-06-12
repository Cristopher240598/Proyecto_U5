<?PHP
ob_start();
require_once './includes/nav-login.php';

if (isset($_GET['id']))
{
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM productos WHERE id = $id";
    $resultado = mysqli_query($conn, $sql);
    $productos = mysqli_fetch_assoc($resultado);
    $imagenproductos = $productos['imagen'];
    mysqli_free_result($resultado);
}

if (isset($_POST['submit']) && isset($_GET['id']))
{
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $nom = mysqli_real_escape_string($conn, $_POST['nombre']);
    $mar = mysqli_real_escape_string($conn, $_POST['marca']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    //Guardar la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['name'] != null)
    {
        unlink("imagenesproductos/$imagenAudifonos");
        $file = $_FILES['imagen'];
        $filename = $file['name'];
        $mimetype = $file['type'];
        if ($mimetype == "image/jpg" || $mimetype == 'image/jpeg' ||
                $mimetype == 'image/png' || $mimetype == 'image/gif')
        {
            if (!is_dir('imagenesproductos'))
            {
                mkdir('imagenesproductos', 0777, TRUE);
            }
            move_uploaded_file($file['tmp_name'], 'imagenesproductos/' . $filename);
        }
        $sql = "UPDATE productos SET nombre = '$nom', marca = '$mar', "
                . "imagen = '$filename', descripcion = '$descripcion' "
                . "WHERE id = $id";
    } else
    {
        $sql = "UPDATE productos SET nombre = '$nom', marca = '$mar', "
                . "descripcion = '$descripcion' "
                . "WHERE id = $id";
    }
    if (mysqli_query($conn, $sql))
    {
        header('Location: read-products.php');
    } else
    {
        echo 'Error al actualizar el producto: ' . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Modificar audífonos</h2>
            </div>
            <form class="formulario" action="update-product.php?id=<?php echo $productos['id'] ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input class="form-control ancho-marca" type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($productos['nombre']); ?>" autofocus>
                </div>
                <div class="form-group">
                    <label for="">Marca</label>
                    <input class="form-control ancho-artista" type="text" name="marca" id="marca" value="<?php echo htmlspecialchars($productos['marca']); ?>" autofocus>
                </div>
                <div class="form-group d-flex flex-column">
                    <label for="">Imagen</label>
                    <input type="file" name="imagen" id="imagen" autofocus>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <img class="ancho-imagen" id="imagenSalida" src="<?= $base ?>imagenesproductos/<?php echo htmlspecialchars($productos['imagen']); ?>">
                </div>
                <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea class="form-control altura-desc" name="descripcion" id="descripcion" autofocus><?php echo htmlspecialchars($productos['descripcion']); ?></textarea>
                </div>
                
                <input class="btn btn-info btn-block" type="submit" name="submit" value="Guardar cambios">
            </form>
        </div>
    </section>
</main>

<?php 
ob_end_flush();
require_once './includes/footer.php'; 
?>  