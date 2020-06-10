<?php
ob_start();
require_once './includes/nav.php';
?>

<main class="principal">
<header class="masthead text-center text-white">
    <div class="masthead-content">
        <div class="container">
            <h1 class="masthead-heading mb-0">Music &amp; Tech</h1>
            <h2 class="masthead-subheading mb-0">Everything is here !</h2>
        </div>
    </div>
    <div class="bg-circle-1 bg-circle"></div>
    <div class="bg-circle-2 bg-circle"></div>
    <div class="bg-circle-3 bg-circle"></div>
    <div class="bg-circle-4 bg-circle"></div>
</header>
<section>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-lg-2">
                <div class="p-5">
                    <img class="rounded-circle img-fluid" src="img/discos.jpg">
                </div>
            </div>
            <div class="col-lg-6 order-lg-1">
                <div class="text-center p-5">
                    <h2 class="display-4">Discos</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-lg-1">
                <div class="p-5"><img class="rounded-circle img-fluid" src="img/audifonos.jpg"></div>
            </div>
            <div class="col-lg-6 order-lg-2">
                <div class="text-center p-5">
                    <h2 class="display-4">Audifonos</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-lg-2">
                <div class="p-5">
                    <img class="rounded-circle img-fluid" src="img/peliculas.jpg">
                </div>
            </div>
            <div class="col-lg-6 order-lg-1">
                <div class="text-center p-5">
                    <h2 class="display-4">Películas</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-lg-1">
                <div class="p-5">
                    <img class="rounded-circle img-fluid" src="img/productos.jpg">
                </div>
            </div>
            <div class="col-lg-6 order-lg-2">
                <div class="text-center p-5">
                    <h2 class="display-4">Productos</h2>
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