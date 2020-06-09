<?PHP require_once './includes/nav-login.php'; ?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Géneros de pelíclulas</h2>
            </div>
            <div class="d-flex justify-content-center products padding-columnas">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Género</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="largo-id">12</td>
                                <td class="largo-genero">Electrónica sfdsfsdf sdfsdfdf</td>
                                <td class="largo-accion">
                                    <a class="btn btn-info btn-mod-gm" role="button" href="update-movie-genre.php">Modificar</a>
                                    <a class="btn btn-danger" role="button" href="#">Eliminar</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require_once './includes/footer.php'; ?>  