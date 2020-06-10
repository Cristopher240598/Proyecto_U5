<?php
ob_start();
require_once './includes/nav-login.php';
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Modificar películas</h2>
            </div>
            <div class="padding-columnas">
                <div class="row no-gutters">
                    
                        <div class="col-12 col-md-6 col-lg-4 padding-celda">
                            <div class="clean-product-item">
                                <div class="image">
                                    <img class="rounded-circle img-fluid d-block mx-auto imagen" src="img/audifonos.jpg">
                                </div>
                                <div class="text-center product-name margen-txt-col">
                                    <h2 class="text-info tamanio-titulo-col">7 Magníficos</h2>
                                </div>
                                <div class="text-center product-name">
                                    <a class="btn btn-info btn-color" role="button" href="update-movie.php">Modificar</a>
                                </div>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </section>
</main>

<?php
ob_end_flush();
require_once './includes/footer.php';
?>