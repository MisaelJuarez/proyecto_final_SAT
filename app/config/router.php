<?php
$view = $_GET['view'] ?? 'inicio';

if (!isset($_SESSION['usuario']) && $view !== 'login') {
    header("location:login");
    exit();
}

if (isset($_SESSION['usuario']) && $view === 'login') {
    header("location:inicio");
    exit();
}

$vista = 'error404';
$hoja_css = '';
$hoja_js = '';
$titulo = '';

switch ($view) {
    case 'inicio':
        $vista = 'inicio.php';
        $hoja_css = '<link rel="stylesheet" href="'.CSS .'inicio.css">';
        $hoja_js = '<script src="'.JS.'inicio.js"></script>';
        $titulo = 'inicio';
        break;
    case 'agregar':
        $vista = 'agregar_usuario.php';
        $hoja_css = '<link rel="stylesheet" href="'.CSS .'agregar_usuario.css">';
        $hoja_js = '<script src="'.JS.'agregar_usuario.js"></script>';
        $titulo = 'agregar usuario';
        break;

    default:
        $vista = 'error404';
        break;
}
?>