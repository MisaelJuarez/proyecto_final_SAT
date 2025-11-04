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
    case 'agregar_colaborador':
        $vista = 'agregar_colaborador.php';
        $hoja_css = '<link rel="stylesheet" href="'.CSS .'agregar_colaborador.css">';
        $hoja_js = '<script src="'.JS.'agregar_colaborador.js"></script>';
        $titulo = 'agregar colaborador';
        break;
    case 'actualizar_informacion':
        $vista = 'actualizar_informacion.php';
        $hoja_css = '<link rel="stylesheet" href="'.CSS .'actualizar_informacion.css">';
        $hoja_js = '<script src="'.JS.'actualizar_informacion.js"></script>';
        $titulo = 'actualizar informacion';
        break;
    case 'administrar_colaboradores':
        $vista = 'administrar_colaboradores.php';
        $hoja_css = '<link rel="stylesheet" href="'.CSS .'administrar_colaboradores.css">';
        $hoja_js = '<script src="'.JS.'administrar_colaboradores.js"></script>';
        $titulo = 'administrar colaboradores';
        break;

    default:
        $vista = 'error404';
        break;
}
?>