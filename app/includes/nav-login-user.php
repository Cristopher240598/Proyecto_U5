<?PHP
session_start();
if ($_SERVER['QUERY_STRING'] == 'noname')
{
    session_unset();
    header('Location: index.php');
}
$usuario = $_SESSION['usuario']['nombre'];
$imagenUsuario = $_SESSION['usuario']['imagen'];
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
                <li class="nav-item" role="presentation">
                    <a class="nav-link tamanio-letra-nav" href="discs.php">discos</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link tamanio-letra-nav" href="movies.php">películas</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link tamanio-letra-nav" href="headphones.php">audífonos</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link tamanio-letra-nav" href="products.php">productos</a>
                </li>
            </ul>
            <div class="dropdown d-lg-flex align-items-lg-center">
                <a class="dropdown-toggle nav-link nav-link-usuario usuario" data-toggle="dropdown" aria-expanded="false" href="#">
                    <img class="rounded-circle imagen-usuario" src="<?= $base ?>imagenesUsuario/<?= $imagenUsuario ?>"><?php echo htmlspecialchars($usuario); ?>
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