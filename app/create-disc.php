<?php

ob_start();
require_once './includes/nav-login.php';
include './configuracion/connectionDB.php';

$errorMsg = array('titulo' => '', 'artista' => '', 'genero' => '', 'canciones' => '', 'disquera' => '', 'descripcion' => '');

if (isset($_POST['titulo']) and isset($_POST['artista']) and isset($_POST['disquera'])
    and isset($_POST['canciones']) and isset($_POST['genero']) and isset($_POST['descripcion']))
{
    $titulo = $_POST['titulo'];
    $artista = $_POST['artista'];
    $genero = $_POST['genero'];
    $canciones = $_POST['canciones'];
    $disquera = $_POST['disquera'];
    $descripcion = $_POST['descripcion'];

    if (!is_string($_POST['titulo']))
    {
        $errorMsg['titulo'] = 'Título debe ser texto <br />';
    } else
    {
        $titulo = $_POST['titulo'];
        
    }

    if (!is_string($_POST['artista']))
    {
        $errorMsg['artista'] = 'Campo Artista debe ser texto <br />';
    } else
    {
        $artista = $_POST['artista'];
    }

    if (!is_int($_POST['genero']))
    {
        $errorMsg['genero'] = 'Campo Genero debe ser texto <br />';
    } else
    {
        $genero = $_POST['genero'];
    }

    if (!is_int($_POST['canciones']))
    {
        $errorMsg['canciones'] = 'Campo Canciones debe ser número <br />';
    } else
    {
        $canciones = $_POST['canciones'];
    }

    if (!is_string($_POST['disquera']))
    {
        $errorMsg['disquera'] = 'Campo Diquera debe ser texto <br />';
    } else
    {
        $disquera = $_POST['disquera'];
    }
    
    if (!is_string($_POST['descripcion']))
    {
        $errorMsg['descripcion'] = 'Campo descripcion debe ser texto <br />';
    } else
    {
        $descripcion = $_POST['descripcion'];
    }
    //Falta la imagen
    $sql = "INSERT INTO discos VALUES ('" . $titulo . "', '" . $artista . "', '" . $disquera . "', '" . $canciones . "', '" . $genero . "', '" . $descripcion . "')";

    if (mysqli_query($connection, $sql))
    {
        header('Location: discs.php');
    } else
    {
        echo 'Error en insercion: ' . mysqli_error($connection);
    }

    mysqli_close($coneccion);
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
                    <input class="form-control" name="titulo" id="titulo" type="text" pattern="[A-Za-z]+" required="true">
                </div>
                <div class="form-group">
                    <label for="">Artista*</label>
                    <input class="form-control ancho-artista" name="artista" id="artista" type="text" pattern="[A-Za-z]+" required="true">
                </div>
                <div class="form-group">
                    <label for="">Disquera*</label>
                    <input class="form-control ancho-disquera" type="text" name="disquera" id="disquera" pattern="[A-Za-z]+" required="true">
                </div>
                <div class="form-group">
                    <label for="">Número de canciones*</label>
                    <input class="form-control ancho-canciones" type="number" min="1" max="99" maxlength="2" name="canciones" id="canciones" required="true">
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
                    <label for="descripcion">Descripción*</label>
                    <textarea name="descripcion" id="descripcion" class="form-control altura-desc" rows="4" cols="50" style="resize: none" required="true"></textarea>
                </div>
                <div class="form-group d-flex flex-column">
                    <label for="">Imagen</label>
                    <input type="file">
                </div>
                <div class="form-group d-flex justify-content-center">
                    <img class="ancho-imagen" src="img/discos.jpg">
                </div>
                <input class="btn btn-success btn-block" type="submit" name="submit" value="Crear">
            </form>
            <p class="text-danger">* <b>Requerido</b></p>
        </div>
    </section>
</main>

<?php
ob_end_flush();
require_once './includes/footer.php';
?>