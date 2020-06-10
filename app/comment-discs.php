<?php
ob_start();
require_once './includes/nav-login-user.php';
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-articulos">
                <h2 class="text-info tamanio-titulo">Club Life Vol. 5</h2>
                <p class="tamanio-subtitulo">Tiësto</p>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <img class="rounded-circle img-fluid" src="img/audifonos.jpg">
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2">
                    <div class="text-center p-5">
                        <p class="tamanio-txt">
                            Disquera: Music Freedom<br>
                            Número de canciones: 9<br>
                            Género: Electrónica<br>
                            Descripción: sdfgf dfhdf dghd ghd gdh dghdgdd dghd dhd  dgfh  fhjf  fghj
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="text-center block-heading margen-titulo-com">
                <h2 class="text-left text-info" style="font-size: 30px;">Comentarios</h2>
            </div>
            <div class="text-center block-heading">
                <p class="text-left tamanio-usuario-com">
                    <img class="rounded-circle com-usuario" src="img/peliculas.jpg">Usuario 1
                </p>
                <p class="text-justify tamanio-com">Comentario Comentario Comentario Comentario Comentario</p>
                <hr>
            </div>
            <div class="text-center block-heading">
                <form class="formulario ancho-form">
                    <div class="form-group">
                        <textarea class="form-control alt-form-com"></textarea>
                    </div>
                    <input class="btn btn-info btn-block ancho-btn-com" type="submit" name="submit" value="Comentar">
                </form>
            </div>
        </div>
    </section>
</main>

<?php
ob_end_flush();
require_once './includes/footer.php';
?>