<?php
ob_start();
require_once './includes/nav-login.php';

$sql2 = "SELECT * FROM temas_discos";
$resultSet = mysqli_query($conn, $sql2);
$temas = mysqli_fetch_all($resultSet, MYSQLI_ASSOC);
mysqli_free_result($resultSet);

if (isset($_POST['submit']))
{
    $título = mysqli_real_escape_string($conn, $_POST['titulo']);
    $artista = mysqli_real_escape_string($conn, $_POST['artista']);
    $disquera = mysqli_real_escape_string($conn, $_POST['disquera']);
    $canciones = mysqli_real_escape_string($conn, $_POST['canciones']);
    $genero = mysqli_real_escape_string($conn, $_POST['genero']);
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
            if (!is_dir('imagenesDiscos'))
            {
                mkdir('imagenesDiscos', 0777, TRUE);
            }
            move_uploaded_file($file['tmp_name'], 'imagenesDiscos/' . $filename);
        }
    }
    $sql = "INSERT INTO discos(id_temaDisco, titulo, artista, disquera, numeroCanciones, imagen, descripcion) "
            . "VALUES($genero, '$título', '$artista', '$disquera', $canciones, '$filename', '$descripcion')";
    if (mysqli_query($conn, $sql))
    {
        header('Location: read-discs.php');
    } else
    {
        echo 'Error al insertar en discos, verifique query: ' . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Ingresar nuevo disco</h2>
            </div>
            <form class="formulario" method="POST" action="create-disc.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Título*</label>
                    <input class="form-control" name="titulo" id="titulo" type="text" onchange="valtexto200('titulo')" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label for="">Artista*</label>
                    <input class="form-control ancho-artista" name="artista" id="artista" type="text" onchange="valtexto200('artista')" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label for="">Disquera*</label>
                    <input class="form-control ancho-disquera" type="text" name="disquera" id="disquera" onchange="valtexto200('disquera')" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label for="">Número de canciones*</label>
                    <input class="form-control ancho-canciones" type="number" min="1" max="99" maxlength="2" name="canciones" id="canciones" onchange="valNumCanciones('canciones')" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label for="genero">Género*</label>
                    <select class="form-control ancho-genero" name="genero" id="genero" required="true">
                        <optgroup label="Géneros musicales">
                            <?php foreach ($temas as $items) { ?>
                                <option value="<?php echo htmlspecialchars($items['id']); ?>"><?php echo htmlspecialchars($items['genero']); ?></option>
                            <?php } ?>
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción*</label>
                    <textarea name="descripcion" id="descripcion" class="form-control altura-desc" rows="4" cols="50" style="resize: none" onchange="valDesc('descripcion')" required></textarea>
                </div>
                <div class="form-group d-flex flex-column">
                    <label for="">Imagen*</label>
                    <input type="file" name="imagen" id="imagen" required autofocus>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <img class="ancho-imagen" src="" id="imagenSalida">
                </div>
                <input class="btn btn-success btn-block" type="submit" name="submit" value="Crear">
            </form>
            <p class="text-danger">* <b>Requerido</b></p>
        </div>
    </section>
</main>
<script>
    function valtexto200(idinput)
    {
        x = document.getElementById(idinput).value;
        if (validartexto200(x))
        {
            document.getElementById(idinput).style.backgroundColor = "#CEF6D8";
        } else
        {
            document.getElementById(idinput).style.backgroundColor = "#F6CECE";
        }
    }

    function valNumCanciones(idinput)
    {
        x = document.getElementById(idinput).value;
        if (validarnumero2(x))
        {
            document.getElementById(idinput).style.backgroundColor = "#CEF6D8";
        } else
        {
            document.getElementById(idinput).style.backgroundColor = "#F6CECE";
        }
    }

    function valDesc(idinput)
    {
        x = document.getElementById(idinput).value;
        if (validardesc(x))
        {
            document.getElementById(idinput).style.backgroundColor = "#CEF6D8";
        } else
        {
            document.getElementById(idinput).style.backgroundColor = "#F6CECE";
        }
    }
</script>

<?php
ob_end_flush();
require_once './includes/footer.php';
?>
