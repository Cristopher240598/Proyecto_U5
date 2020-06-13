<?php
ob_start();
require_once './includes/nav-login.php';

$sql = 'SELECT d.id, t.genero, d.titulo, d.artista, d.numeroCanciones, d.disquera, d.descripcion FROM discos d, temas_discos t WHERE d.id_temaDisco = t.id';
//$sql = 'SELECT u.ID, u.Nombre_usuario, u.Contrasena, r.Nombre_rol FROM usuarios u, roles r WHERE u.ID_role = r.ID_role';
$resultSet = mysqli_query($conn, $sql);

$datos = mysqli_fetch_all($resultSet, MYSQLI_ASSOC);

mysqli_free_result($resultSet);

mysqli_close($conn);
?>

<main class="principal principal-1">
    <section>
        <div class="container container-fluid">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Discos</h2>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">GÉNERO</th>
                        <th scope="col">TITULO</th>
                        <th scope="col">ARTISTA</th>                        
                        <th scope="col">No. CANCIONES</th>
                        <th scope="col">DISQUERA</th>
                        <th scope="col">DESCRIPCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($datos as $disco)
                    {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($disco['id']) ?></td>
                            <td><?php echo htmlspecialchars($disco['genero']) ?></td>
                            <td><?php echo htmlspecialchars($disco['titulo']) ?></td>
                            <td><?php echo htmlspecialchars($disco['artista']) ?></td>
                            <td><?php echo htmlspecialchars($disco['numeroCanciones']) ?></td>
                            <td><?php echo htmlspecialchars($disco['disquera']) ?></td>
                            <td><?php echo htmlspecialchars($disco['descripcion']) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php
ob_end_flush();
require_once './includes/footer.php';
?>