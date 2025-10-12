<?php
if (!isset($_SESSION['usuario'])) {
    header("location:login");
    exit();
}
?>
<head>
    <!-- <link rel="stylesheet" href="<?=CSS."home.css"?>"> -->
    <title>Inicio</title>
</head>
<body>
    
    <div class="container">
        <h1>Bienvenido <?=$_SESSION['usuario']['nombre']?> <?=$_SESSION['usuario']['apellidos']?></h1>
    </div>

    <!-- <script src="<?=JS."home.js"?>"></script> -->
</body>
