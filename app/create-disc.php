<?php
ob_start();
require_once './includes/nav-login.php';

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
    $sql = "INSERT INTO audifonos(id_temaDisco, titulo, artista, disquera, numeroCanciones, imagen, descripcion) "
            . "VALUES('$genero', '$título', '$artista', '$disquera', '$canciones', '$filename', '$descripcion')";
    if (mysqli_query($conn, $sql))
    {
        header('Location: read-discs.php');
    } else
    {
        echo 'Error al insertar en discos, verifique query: ' . mysqli_error($conn);
    }
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
<<<<<<< HEAD
                    <label for="">Título*</label>
                    <input class="form-control" name="titulo" id="titulo" onchange="valtexto200('titulo')" maxlength="200" type="text" required>
                </div>
                <div class="form-group">
                    <label for="">Artista*</label>
                    <input class="form-control ancho-artista" name="artista" onchange="valtexto200('artista')" id="artista" maxlength="200" type="text" required>
                </div>
                <div class="form-group">
                    <label for="">Disquera*</label>
                    <input class="form-control ancho-disquera" type="text" name="disquera" id="disquera" onchange="valtexto200('disquera')" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label for="">Número de canciones*</label>
                    <input class="form-control ancho-canciones" type="number" name="canciones" onchange="valNumCanciones('canciones')" id="canciones" maxlength="200" required>
=======
                    <label for="">Título</label>
                    <input class="form-control" type="text" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label for="">Artista</label>
                    <input class="form-control ancho-artista" type="text" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label for="">Disquera</label>
                    <input class="form-control ancho-disquera" type="text" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label for="">Número de canciones</label>
                    <input class="form-control ancho-canciones" type="number" min="1" max="99" required>
>>>>>>> 60c2690d375b05f5f3a51849e624d6ed65ef2739
                </div>
                <div class="form-group">
                    <label for="genero">Género*</label>
                    <select class="form-control ancho-genero" name="genero" id="genero" required="true">
                        <optgroup label="Géneros musicales">
                            <option value="1">Rock</option>
                            <option value="2">Pop</option>
                            <option value="3">Electrónica</option>
                            <option value="4">Banda/Regional Mexicano</option>
                            <option value="5">Metal</option>
                            <option value="6">Opera</option>
                            <option value="7">Ritmos latinos</option>
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
<<<<<<< HEAD
                    <label for="descripcion">Descripción*</label>
                    <textarea name="descripcion" id="descripcion" class="form-control altura-desc" rows="4" cols="50" onchange="valDesc('descripcion')" style="resize: none" maxlength="16,777,215" required="true"></textarea>
                </div>
                <div class="form-group d-flex flex-column">
                    <label for="">Imagen*</label>
                    <input type="file" name="imagen" id="imagen" required="true" autofocus>
=======
                    <label for="">Descripción</label>
                    <textarea class="form-control altura-desc" maxlength="16,777,215" required></textarea>
                </div>
                <div class="form-group d-flex flex-column">
                    <label for="">Imagen</label>
                    <input type="file" required>
>>>>>>> 60c2690d375b05f5f3a51849e624d6ed65ef2739
                </div>
                <div class="form-group d-flex justify-content-center">
                    <img class="ancho-imagen" src="" id="imagenSalida">
                </div>
                <input class="btn btn-success btn-block" type="submit" id="bsubmit" name="submit" value="Crear" >
            </form>
            <p class="text-danger">* <b>Requerido</b></p>
        </div>
    </section>
</main>

<script>

      function valtexto200(idinput){
        x = document.getElementById(idinput).value;
        if (validartexto200(x)) {
          document.getElementById(idinput).style.backgroundColor = "#CEF6D8";
        }else{
          document.getElementById(idinput).style.backgroundColor = "#F6CECE";
        }
      }

      function valNumCanciones(idinput){
        x = document.getElementById(idinput).value;
        alert("987654")
        if (validarnumero2(x)) {
          document.getElementById(idinput).style.backgroundColor = "#CEF6D8";
        }else{
          document.getElementById(idinput).style.backgroundColor = "#F6CECE";
        }
      }

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
