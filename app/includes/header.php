<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Music&amp;Tech</title>
        <link rel="icon" type="image/png" href="./img/logo.png">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
        <link rel="stylesheet" href="assets/css/styles.css">
        <script src="assets/js/validaciones.js"></script>
    </head>
    <body>
<?php
$conn = mysqli_connect('localhost', 'cristopher', '240598', 'music_tech');

if (!$conn)
{
    echo 'Error de conexión: ' . mysqli_connect_error();
}
$base = "http://localhost/Proyecto_U5/app/";
?>