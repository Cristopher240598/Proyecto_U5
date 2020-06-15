<?php
ob_start();
require_once './includes/nav-login.php';

$sql = 'SELECT * FROM temas_peliculas ORDER BY genero';
$resultado = mysqli_query($conn, $sql);
$peliculas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
mysqli_free_result($resultado);

if (isset($_POST['submit']))
{
    $titulopeli = mysqli_real_escape_string($conn, $_POST['titulo']);
    $repartopeli = mysqli_real_escape_string($conn, $_POST['reparto']);
    $directorpeli = mysqli_real_escape_string($conn, $_POST['director']);
    $categoriapeli = intval(mysqli_real_escape_string($conn, $_POST['genero']));
    $descripcionpeli = mysqli_real_escape_string($conn, $_POST['descripcion']);
    //Guardar la imagen
    if (isset($_FILES['imagen']))
    {
        $archivo = $_FILES['imagen'];
        $filename = $archivo['name'];
        $mimetype = $archivo['type'];
        if ($mimetype == "image/jpg" || $mimetype == 'image/jpeg' ||
                $mimetype == 'image/png' || $mimetype == 'image/gif')
        {
            if (!is_dir('imagenesPeliculas'))
            {
                mkdir('imagenesPeliculas', 0777, TRUE);
            }
            move_uploaded_file($archivo['tmp_name'], 'imagenesPeliculas/' . $filename);
        }
    }
    $sql = "INSERT INTO peliculas(id_temaPelicula, titulo, reparto , director, imagen, descripcion ) "
            . "VALUES('$categoriapeli', '$titulopeli', '$repartopeli', '$directorpeli', '$filename', '$descripcionpeli')";
    if (mysqli_query($conn, $sql))
    {
        header('Location: read-movies.php');
    } else
    {
        echo 'Error en la insercción de pelicula: ' . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Crear película</h2>
            </div>
            <form class="formulario" enctype="multipart/form-data" action="create-movie.php" method="POST">
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input id="titulo" name="titulo" class="form-control" type="text" autofocus onchange="valtexto200('titulo')" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label for="reparto">Reparto</label>
                    <input id="reparto" name="reparto" class="form-control" type="text" maxlength="200" onchange="valtexto200('reparto')" autofocus required>
                </div>
                <div class="form-group">
                    <label for="director">Director</label>
                    <input id="director" name="director" class="form-control ancho-disquera" type="text" onchange="valtexto200('director')" maxlength="200" autofocus required>
                </div>
                <div class="form-group">
                    <label for="genero">Género</label>
                    <select id="genero" name="genero" class="form-control ancho-genero" required>
                        <optgroup label="Género">
                            <?php foreach ($peliculas as $pelicula) { ?>
                                <option value="<?php echo htmlspecialchars($pelicula['id']); ?>"><?php echo htmlspecialchars($pelicula['genero']); ?></option>
                            <?php } ?>
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" class="form-control altura-desc" onchange="valDesc('descripcion')" required></textarea>
                </div>
                <div class="form-group d-flex flex-column">
                    <label for="imagen">Imagen</label>
                    <input id="imagen" name="imagen" type="file"  accept="image/*" autofocus required>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <img class="ancho-imagen" src="" id="imagenSalida">
                </div>
                <input class="btn btn-info btn-block" type="submit" name="submit" value="Crear">
            </form>
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
