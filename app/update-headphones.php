<?PHP
ob_start();
require_once './includes/nav-login.php';

if (isset($_GET['id']))
{
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM audifonos WHERE id = $id";
    $resultado = mysqli_query($conn, $sql);
    $audifonos = mysqli_fetch_assoc($resultado);
    $imagenAudifonos = $audifonos['imagen'];
    mysqli_free_result($resultado);
}

if (isset($_POST['submit']) && isset($_GET['id']))
{
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $marca = mysqli_real_escape_string($conn, $_POST['marca']);
    $modelo = mysqli_real_escape_string($conn, $_POST['modelo']);
    $potencia = mysqli_real_escape_string($conn, $_POST['potencia']);
    $peso = mysqli_real_escape_string($conn, $_POST['peso']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    //Guardar la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['name'] != null)
    {
        unlink("imagenesAudifonos/$imagenAudifonos");
        $file = $_FILES['imagen'];
        $filename = $file['name'];
        $mimetype = $file['type'];
        if ($mimetype == "image/jpg" || $mimetype == 'image/jpeg' ||
                $mimetype == 'image/png' || $mimetype == 'image/gif')
        {
            if (!is_dir('imagenesAudifonos'))
            {
                mkdir('imagenesAudifonos', 0777, TRUE);
            }
            move_uploaded_file($file['tmp_name'], 'imagenesAudifonos/' . $filename);
        }
        $sql = "UPDATE audifonos SET marca = '$marca', modelo = '$modelo', "
                . "potenciaMaxima = $potencia, peso = $peso, imagen = '$filename', descripcion = '$descripcion' "
                . "WHERE id = $id";
    } else
    {
        $sql = "UPDATE audifonos SET marca = '$marca', modelo = '$modelo', "
                . "potenciaMaxima = $potencia, peso = $peso, descripcion = '$descripcion' "
                . "WHERE id = $id";
    }
    if (mysqli_query($conn, $sql))
    {
        header('Location: read-headphones.php');
    } else
    {
        echo 'Error al actualizar audífonos: ' . mysqli_error($conn);
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
            <form class="formulario" action="update-headphones.php?id=<?php echo $audifonos['id'] ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Marca</label>
                    <input class="form-control ancho-marca" type="text" name="marca" id="marca" value="<?php echo htmlspecialchars($audifonos['marca']); ?>" autofocus>
                </div>
                <div class="form-group">
                    <label for="">Modelo</label>
                    <input class="form-control ancho-artista" type="text" name="modelo" id="modelo" value="<?php echo htmlspecialchars($audifonos['modelo']); ?>" autofocus>
                </div>
                <div class="form-group">
                    <label for="">Potencia máxima (mW)</label>
                    <input class="form-control ancho-disquera" type="number" name="potencia" id="potencia" value="<?php echo htmlspecialchars($audifonos['potenciaMaxima']); ?>" autofocus>
                </div>
                <div class="form-group">
                    <label for="">Peso (gr)</label>
                    <input class="form-control ancho-peso" type="number" name="peso" id="peso" value="<?php echo htmlspecialchars($audifonos['peso']); ?>" autofocus>
                </div>
                <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea class="form-control altura-desc" name="descripcion" id="descripcion" autofocus><?php echo htmlspecialchars($audifonos['descripcion']); ?></textarea>
                </div>
                <div class="form-group d-flex flex-column">
                    <label for="">Imagen</label>
                    <input type="file" name="imagen" id="imagen" autofocus>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <img class="ancho-imagen" id="imagenSalida" src="<?= $base ?>imagenesAudifonos/<?php echo htmlspecialchars($audifonos['imagen']); ?>">
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