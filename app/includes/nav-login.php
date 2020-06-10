<?php
session_start();
if ($_SERVER['QUERY_STRING'] == 'noname')
{
    session_unset();
    header('Location: index.php');
}
$usuario = $_SESSION['usuario']['nombre'];
require_once './includes/header.php';
?>

<nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-dark navbar-custom padding-nav-logueado">
    <div class="container">
        <a class="navbar-brand">
            <img class="tamanio-logo" src="img/logo.png">
        </a>
        <button data-toggle="collapse" class="navbar-toggler" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="nav navbar-nav ml-auto opciones-nav">
                <li class="nav-item dropdown d-lg-flex align-items-lg-center espacio-opc">
                    <a class="dropdown-toggle nav-link tamanio-letra-nav" data-toggle="dropdown" aria-expanded="false" href="#">discos</a>
                    <div class="dropdown-menu fondo-menu" role="menu">
                        <a class="dropdown-item" role="presentation" href="create-disc.php">
                            <i class="fa fa-pencil margen-iconos"></i>Crear
                        </a>
                        <a class="dropdown-item" role="presentation" href="read-discs.php">
                            <i class="fa fa-list margen-iconos"></i>Consultar
                        </a>
                        <a class="dropdown-item" role="presentation" href="search-update-disc.php">
                            <i class="fa fa-pencil-square-o margen-iconos"></i>Modificar
                        </a>
                        <a class="dropdown-item" role="presentation" href="delete-disc.php">
                            <i class="fa fa-remove margen-iconos"></i>Eliminar
                        </a>
                        <hr class="margen-hr">
                        <span class="padding-genero">
                            <i class="fa fa-music margen-iconos"></i>Género
                        </span>
                        <a class="dropdown-item" role="presentation" href="create-music-genre.php">
                            <i class="fa fa-pencil margen-iconos"></i>Crear
                        </a>
                        <a class="dropdown-item" role="presentation" href="music-genre.php">
                            <i class="fa fa-list margen-iconos"></i>Consultar
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown d-lg-flex align-items-lg-center espacio-opc">
                    <a class="dropdown-toggle nav-link tamanio-letra-nav" data-toggle="dropdown" aria-expanded="false" href="#">películas</a>
                    <div class="dropdown-menu fondo-menu" role="menu">
                        <a class="dropdown-item" role="presentation" href="create-movie.php">
                            <i class="fa fa-pencil margen-iconos"></i>Crear
                        </a>
                        <a class="dropdown-item" role="presentation" href="read-movies.php">
                            <i class="fa fa-list margen-iconos"></i>Consultar
                        </a>
                        <a class="dropdown-item" role="presentation" href="search-update-movie.php">
                            <i class="fa fa-pencil-square-o margen-iconos"></i>Modificar
                        </a>
                        <a class="dropdown-item" role="presentation" href="delete-movie.php">
                            <i class="fa fa-remove margen-iconos"></i>Eliminar
                        </a>
                        <hr class="margen-hr">
                        <span class="padding-genero">
                            <i class="fas fa-video margen-iconos"></i>Género
                        </span>
                        <a class="dropdown-item" role="presentation" href="create-movie-genre.php">
                            <i class="fa fa-pencil margen-iconos"></i>Crear
                        </a>
                        <a class="dropdown-item" role="presentation" href="movie-genre.php">
                            <i class="fa fa-list margen-iconos"></i>Consultar
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown d-lg-flex align-items-lg-center espacio-opc">
                    <a class="dropdown-toggle nav-link tamanio-letra-nav" data-toggle="dropdown" aria-expanded="false" href="#">audífonos</a>
                    <div class="dropdown-menu fondo-menu" role="menu">
                        <a class="dropdown-item" role="presentation" href="create-headphones.php">
                            <i class="fa fa-pencil margen-iconos"></i>Crear
                        </a>
                        <a class="dropdown-item" role="presentation" href="read-headphones.php">
                            <i class="fa fa-list margen-iconos"></i>Consultar
                        </a>
                        <a class="dropdown-item" role="presentation" href="search-update-headphones.php">
                            <i class="fa fa-pencil-square-o margen-iconos"></i>Modificar
                        </a>
                        <a class="dropdown-item" role="presentation" href="delete-headphones.php">
                            <i class="fa fa-remove margen-iconos"></i>Eliminar
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown d-lg-flex align-items-lg-center">
                    <a class="dropdown-toggle nav-link tamanio-letra-nav" data-toggle="dropdown" aria-expanded="false" href="#">productos</a>
                    <div class="dropdown-menu fondo-menu" role="menu">
                        <a class="dropdown-item" role="presentation" href="create-product.php">
                            <i class="fa fa-pencil margen-iconos"></i>Crear
                        </a>
                        <a class="dropdown-item" role="presentation" href="read-products.php">
                            <i class="fa fa-list margen-iconos"></i>Consultar
                        </a>
                        <a class="dropdown-item" role="presentation" href="search-update-product.php">
                            <i class="fa fa-pencil-square-o margen-iconos"></i>Modificar
                        </a>
                        <a class="dropdown-item" role="presentation" href="delete-product.php">
                            <i class="fa fa-remove margen-iconos"></i>Eliminar
                        </a>
                    </div>
                </li>
            </ul>
            <div class="dropdown d-lg-flex align-items-lg-center">
                <a class="dropdown-toggle nav-link nav-link-usuario usuario" data-toggle="dropdown" aria-expanded="false" href="#">
                    <i class="fa fa-user-circle-o icono-usuario"></i><?php echo htmlspecialchars($usuario); ?>
                </a>
                <div class="dropdown-menu fondo-menu" role="menu">
                    <a class="dropdown-item" role="presentation" href="index.php?noname">
                        <i class="fa fa-sign-out margen-iconos"></i>Cerrar sesión
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>