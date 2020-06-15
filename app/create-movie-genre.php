<?php
ob_start();
require_once './includes/nav-login.php';
if (isset($_POST['submit']))
{
    $genero = mysqli_real_escape_string($conn, $_POST['genero']);
    $sql = "INSERT INTO temas_peliculas(genero) "
            . "VALUES('$genero')";
    if (mysqli_query($conn, $sql))
    {
        header('Location: movie-genre.php');
    } else
    {
        echo 'Error al insertar en temas peliculas, verifique query: ' . mysqli_error($conn);
    }
}
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Crear género de películas</h2>
            </div>
            <form class="formulario" method="POST" action="create-movie-genre.php">
                <div class="form-group">
                    <label for="">Género de película</label>
                    <input class="form-control" name="genero" id="genero" type="text" maxlength="255" onchange="valtexto255('genero')" required="true">
                </div>
                <input class="btn btn-success btn-block" type="submit" name="submit" value="Crear">
            </form>
        </div>
    </section>
</main>

<script>
  function valtexto255(idinput){
    x = document.getElementById(idinput).value;
    if (validartexto200(x)) {
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
