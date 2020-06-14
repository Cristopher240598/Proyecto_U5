<?php
ob_start();
require_once './includes/nav-login.php';

if (isset($_POST['submit']))
{
    $nom = mysqli_real_escape_string($conn, $_POST['nombre']);
    $mar = mysqli_real_escape_string($conn, $_POST['marca']);
    $desc = mysqli_real_escape_string($conn, $_POST['descripcion']);

    //Guardar la imagen
    if (isset($_FILES['imagen']))
    {
        $file = $_FILES['imagen'];
        $filename = $file['name'];
        $mimetype = $file['type'];
        if ($mimetype == "image/jpg" || $mimetype == 'image/jpeg' ||
                $mimetype == 'image/png' || $mimetype == 'image/gif')
        {
            if (!is_dir('imagenesProductos'))
            {
                mkdir('imagenesProductos', 0777, TRUE);
            }
            move_uploaded_file($file['tmp_name'], 'imagenesProductos/' . $filename);
        }
    }
    $sql = "INSERT INTO productos(nombre, marca, imagen, descripcion) "
            . "VALUES('$nom', '$mar', '$filename', '$desc')";
    if (mysqli_query($conn, $sql))
    {
        header('Location: read-products.php');
    } else
    {
        echo 'Error en la insercción de productos: ' . mysqli_error($conn);
    }
}
?>
<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Crear Nuevo Producto</h2>
            </div>
            <form class="formulario" action="create-product.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input class="form-control ancho-artista" type="text" name="nombre" id="nombre" autofocus="">
                </div>
                <div class="form-group">
                    <label for="">Marca</label>
                    <input class="form-control ancho-marca" type="text" name="marca" id="marca" autofocus="">
                </div>
                <div class="form-group d-flex flex-column">
                    <label for="">Imagen</label>
                    <input type="file" name="imagen" id="imagen" autofocus>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <img class="ancho-imagen" src="" id="imagenSalida">
                </div>
                <div>
                    <label for="">Descripción</label>
                    <textarea class="form-control altura-desc" name="descripcion" id="descripcion" autofocus=""></textarea>
                </div>
                
                <input class="btn btn-info btn-block" type="submit" name="submit" value="Crear">
            </form>
        </div>
    </section>
</main>

<?php
ob_end_flush();
require_once './includes/footer.php';
?>