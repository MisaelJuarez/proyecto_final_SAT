<?php
require_once "./app/config/dependencias.php";
session_start();
require_once "./app/config/rutas.php";
require_once("./app/config/router.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=CSS."bootstrap.min.css"?>">
    <link rel="stylesheet" href="<?=CSS."icons/font/bootstrap-icons.min.css"?>">
    <link rel="stylesheet" href="<?=CSS."table.css";?>">
    <link rel="stylesheet" href="<?=CSS."index.css"?>">
    <?php if (isset($hoja_css)) echo $hoja_css; ?>
    <title><?= ($titulo !== '') ? $titulo : 'login' ?></title>
</head>
<body>
    
    <?php if (isset($_SESSION['usuario'])): ?>
    <div class="contenedor-nav" id="contenedorNav">
        <aside class="barra-lateral" id="barra-lateral">
            <?php require_once("./views/componentes/nav-left.php") ?>
        </aside>

        <main class="main-contenedor">
            <header class="barra-superior">
                <?php require_once("./views/componentes/nav-top.php") ?>
            </header>
            <section class="p-2">
                <?php require_once "./views/".$vista;?>
            </section>
        </main>
    </div>
    <?php else: ?>
        <?php require_once("./views/login.php"); ?>
    <?php endif; ?>

    <script src="<?=JS."bootstrap.bundle.min.js"?>"></script>
    <script src="<?=JS."alerts.js"?>"></script>
    <script src="<?=JS."jquery.js"?>"></script>
    <script src="<?=JS."table.js"?>"></script>
    <?php if (isset($_SESSION['usuario'])) echo '<script src="'.JS.'index.js"></script>' ?>
    <?php if (isset($hoja_js)) echo $hoja_js; ?>
</body>
</html>