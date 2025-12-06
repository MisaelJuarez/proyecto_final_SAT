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
$grupo_actual = '';

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
    case 'usuarios':
        $vista = 'usuarios.php';
        $hoja_css = '<link rel="stylesheet" href="'.CSS .'usuarios.css">';
        $hoja_js = '<script src="'.JS.'usuarios.js"></script>';
        $titulo = 'usuarios';
        break;
    case 'administrar_usuarios':
        $vista = 'administrar_usuarios.php';
        $hoja_css = '<link rel="stylesheet" href="'.CSS .'administrar_usuarios.css">';
        $hoja_js = '<script src="'.JS.'administrar_usuarios.js"></script>';
        $titulo = 'administrar usuarios';
        break;
    case 'agregar_usuario':
        $vista = 'agregar_usuario.php';
        $hoja_css = '<link rel="stylesheet" href="'.CSS .'agregar_usuario.css">';
        $hoja_js = '<script src="'.JS.'agregar_usuario.js"></script>';
        $titulo = 'agregar usuario';
        break;
    case 'bajas_usuarios':
        $vista = 'bajas_usuarios.php';
        $hoja_css = '<link rel="stylesheet" href="'.CSS .'bajas_usuarios.css">';
        $hoja_js = '<script src="'.JS.'bajas_usuarios.js"></script>';
        $titulo = 'bajas usuarios';
        break;
    case 'resguardos':
        $vista = 'resguardos.php';
        $hoja_css = '<link rel="stylesheet" href="'.CSS .'resguardos.css">';
        $hoja_js = '<script src="'.JS.'resguardos.js"></script>';
        $titulo = 'resguardos';
        break;
    case 'administrar_resguardos':
        $vista = 'administrar_resguardos.php';
        $hoja_css = '<link rel="stylesheet" href="'.CSS .'administrar_resguardos.css">';
        $hoja_js = '<script src="'.JS.'administrar_resguardos.js"></script>';
        $titulo = 'administrar resguardos';
        break;
    case 'agregar_resguardo':
        $vista = 'agregar_resguardo.php';
        $hoja_css = '<link rel="stylesheet" href="'.CSS .'agregar_resguardo.css">';
        $hoja_js = '<script src="'.JS.'agregar_resguardo.js"></script>';
        $titulo = 'agregar resguardo';
        break;
    case 'bajas_resguardos':
        $vista = 'bajas_resguardos.php';
        $hoja_css = '<link rel="stylesheet" href="'.CSS .'bajas_resguardos.css">';
        $hoja_js = '<script src="'.JS.'bajas_resguardos.js"></script>';
        $titulo = 'bajas resguardos';
        break;


    case 'impresoras':
        $vista = 'impresoras.php';
        $hoja_css = '<link rel="stylesheet" href="'.CSS .'impresoras.css">';
        $hoja_js = '<script src="'.JS.'impresoras.js"></script>';
        $titulo = 'impresoras';
        break;
    case 'administrar_impresoras':
        $vista = 'administrar_impresoras.php';
        $hoja_css = '<link rel="stylesheet" href="'.CSS .'administrar_impresoras.css">';
        $hoja_js = '<script src="'.JS.'administrar_impresoras.js"></script>';
        $titulo = 'administrar impresoras';
        break;
    case 'agregar_impresora':
        $vista = 'agregar_impresora.php';
        $hoja_css = '<link rel="stylesheet" href="'.CSS .'agregar_impresora.css">';
        $hoja_js = '<script src="'.JS.'agregar_impresora.js"></script>';
        $titulo = 'agregar impresora';
        break;
    case 'ips_disponibles':
        $vista = 'ips_disponibles.php';
        $hoja_css = '<link rel="stylesheet" href="'.CSS .'ips_disponibles.css">';
        $hoja_js = '<script src="'.JS.'ips_disponibles.js"></script>';
        $titulo = 'ips disponibles';
        break;
    case 'ips_en_uso':
        $vista = 'ips_en_uso.php';
        $hoja_css = '<link rel="stylesheet" href="'.CSS .'ips_en_uso.css">';
        $hoja_js = '<script src="'.JS.'ips_en_uso.js"></script>';
        $titulo = 'ips en uso';
        break;
    case 'agregar_ip':
        $vista = 'agregar_ip.php';
        $hoja_css = '<link rel="stylesheet" href="'.CSS .'agregar_ip.css">';
        $hoja_js = '<script src="'.JS.'agregar_ip.js"></script>';
        $titulo = 'agregar ip';
        break;

    default:
        $vista = 'error404';
        break;
}

if (in_array($view, ['usuarios', 'administrar_usuarios', 'agregar_usuario', 'bajas_usuarios'])) {
    $grupo_actual = 'usuarios';
}

if (in_array($view, ['resguardos', 'administrar_resguardos', 'agregar_resguardo', 'bajas_resguardos'])) {
    $grupo_actual = 'resguardos';
}

if (in_array($view, ['impresoras', 'administrar_impresoras', 'agregar_impresora'])) {
    $grupo_actual = 'impresoras';
}

if (in_array($view, ['ips', 'administrar_ips', 'agregar_ip','ips_disponibles','ips_en_uso'])) {
    $grupo_actual = 'ips';
}


?>