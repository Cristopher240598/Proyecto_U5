<?php
ob_start();
require_once './includes/nav-login.php';
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Discos</h2>
            </div>
            <div class="padding-columnas">
                <div class="row no-gutters">
                    
                        <div class="col-12 col-md-6 col-lg-4 padding-celda">
                            <div class="clean-product-item">
                                <div class="image">
                                    <img class="rounded-circle img-fluid d-block mx-auto imagen" src="img/audifonos.jpg">
                                </div>
                                <div class="text-center margen-txt-col padding-texto-art">
                                    <p class="tamanio-txt">
                                        ID: 5<br>
                                        Titulo: Club life vol. 4<br>
                                        Artista: Tiësto<br>
                                        Disquera: Music Freedom<br>
                                        Número de canciones: 9<br>
                                        Género: Electrónica<br>
                                        Descripción: sdfgf dfhdf dghd ghd gdh dghdgdd dghd dhd  dgfh  fhjf  fghj
                                    </p>
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