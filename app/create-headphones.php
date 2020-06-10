<?php
ob_start();
require_once './includes/nav-login.php';

if (isset($_POST['submit']))
{
    $marca = mysqli_real_escape_string($conn, $_POST['marca']);
    $modelo = mysqli_real_escape_string($conn, $_POST['modelo']);
    $potencia = mysqli_real_escape_string($conn, $_POST['potencia']);
    $peso = mysqli_real_escape_string($conn, $_POST['peso']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    //Guardar la imagen
    if (isset($_FILES['imagen']))
    {
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
    }
    $sql = "INSERT INTO audifonos(marca, modelo, potenciaMaxima, peso, imagen, descripcion) "
            . "VALUES('$marca', '$modelo', $potencia, $peso, '$filename', '$descripcion')";
    if (mysqli_query($conn, $sql))
    {
        header('Location: read-headphones.php');
    } else
    {
        echo 'Error en la insercción de audífonos: ' . mysqli_error($conn);
    }
}
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Crear audífonos</h2>
            </div>
            <form class="formulario" action="create-headphones.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="marca">Marca</label>
                    <input class="form-control ancho-marca" type="text" name="marca" id="marca" autofocus>
                </div>
                <div class="form-group">
                    <label for="modelo">Modelo</label>
                    <input class="form-control ancho-artista" type="text" name="modelo" id="modelo" autofocus>
                </div>
                <div class="form-group">
                    <label for="potencia">Potencia máxima (mW)</label>
                    <input class="form-control ancho-disquera" type="number" name="potencia" id="potencia" autofocus="">
                </div>
                <div class="form-group">
                    <label for="peso">Peso (gr)</label>
                    <input class="form-control ancho-peso" type="number" name="peso" id="peso" autofocus>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control altura-desc" name="descripcion" id="descripcion" autofocus=""></textarea>
                </div>
                <div class="form-group d-flex flex-column">
                    <label for="">Imagen</label>
                    <input type="file" name="imagen" id="imagen" autofocus>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <img class="ancho-imagen" src="" id="imagenSalida">
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