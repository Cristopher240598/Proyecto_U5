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
        header('Location: read-movies.php'); // crea tu vista donde listas los generos y la rediriges ahi
    } else
    {
        echo 'Error al insertar en temas discos, verifique query: ' . mysqli_error($conn);
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
                    <input class="form-control" name="genero" id="genero" type="text" pattern="[A-Z a-z]+" required="true">
                </div>
                <input class="btn btn-success btn-block" type="submit" name="submit" value="Crear">
            </form>
        </div>
    </section>
</main>

<?php
ob_end_flush();
require_once './includes/footer.php'; 
?>
