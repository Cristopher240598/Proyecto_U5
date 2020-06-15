<?php
ob_start();
require_once './includes/nav-login.php';

if (isset($_GET['id']))
{
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM temas_discos WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $temas = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
}

if (isset($_POST['submit']) && isset($_GET['id']))
{
    $genero = mysqli_real_escape_string($conn, $_POST['genero']);    
    $sql = "UPDATE temas_discos SET genero = '$genero' WHERE id = $id";
    if (mysqli_query($conn, $sql))
    {
        header('Location: music-genre.php');
    } else
    {
        echo 'Error al actualizar en temas discos, verifique query: ' . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Modificar género de película</h2>
            </div>
            <form class="formulario" method="POST" action="update-music-genre.php?id=<?php echo $temas['id'] ?>">
                <div class="form-group">
                    <label for="">Género de película</label>
                    <input class="form-control" type="text" name="genero" id="genero" value="<?php echo htmlspecialchars($temas['genero']); ?>" maxlength="255" onchange="valtexto255('genero')" autofocus required>
                </div>
                <input class="btn btn-info btn-block" type="submit" name="submit" value="Guardar cambios">
            </form>
        </div>
    </section>
</main>
<script>
    function valtexto255(idinput)
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
</script>

<?php
ob_end_flush();
require_once './includes/footer.php';
?>