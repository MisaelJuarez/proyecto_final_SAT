<?php
if (!isset($_SESSION['usuario'])) {
    header("location:login");
    exit();
}
?>
<head>
    <link rel="stylesheet" href="<?=CSS."home.css"?>">
    <title>Inicio</title>
</head>
<body>
    <div class="contenedor-nav" id="contenedorNav">
        <aside class="barra-lateral" id="barra-lateral">
            <h5 class="mb-3 text-center p-3"><?=$_SESSION['usuario']['nombre']?> <?=$_SESSION['usuario']['apellidos']?></h5>
            <hr/>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        En proceso
                    </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <nav class="nav flex-column">
                                <a href="#" class="nav-link active">En proceso</a>
                                <a href="#" class="nav-link">En proceso</a>
                                <a href="#" class="nav-link">En proceso</a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        En proceso
                    </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <nav class="nav flex-column">
                                <a href="#" class="nav-link active">En proceso</a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        En proceso
                    </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <nav class="nav flex-column">
                                <a href="#" class="nav-link active">En proceso</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <main class="main-contenedor">
            <header class="barra-superior">
                <div>
                    <button id="mostrar-ocultar-nav" class="botones">
                        <i class="bi bi-arrow-left-right">    
                    </i></button>
                </div>
                <div>
                    <button class="botones" id="cerrar_sesion">
                        <i class="bi bi-power"></i>
                    </button>
                </div>
            </header>
            <section class="p-3">
                <p>Contenido Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
            </section>
        </main>
    </div>

    <script src="<?=JS."home.js"?>"></script>
</body>
