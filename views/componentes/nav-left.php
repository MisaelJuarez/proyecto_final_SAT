<h5 class="mb-3 text-center p-3"><?=$_SESSION['usuario']['nombre']?> <?=$_SESSION['usuario']['apellidos']?></h5>
<hr/>
<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Usuarios
        </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <nav class="nav flex-column">
                    <a href="<?=url('usuarios');?>" class="nav-link active">Visualizar usuarios</a>
                    <a href="<?=url('administrar_usuarios');?>" class="nav-link">Administrar usuarios</a>
                    <a href="<?=url('agregar_usuario');?>" class="nav-link">Agregar un nuevo usuario</a>
                </nav>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Resguardos
        </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <nav class="nav flex-column">
                    <a href="<?=url('#');?>" class="nav-link active">Visualizar resguardos</a>
                    <a href="<?=url('#');?>" class="nav-link">Administrar resguardos</a>
                    <a href="<?=url('#');?>" class="nav-link">Agregar un nuevo resguardo</a>
                </nav>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingFive">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
            Impresoras
        </button>
        </h2>
        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <nav class="nav flex-column">
                    <a href="<?=url('#');?>" class="nav-link active">Visualizar impresoras</a>
                    <a href="<?=url('#');?>" class="nav-link">Administrar impresoras</a>
                    <a href="<?=url('#');?>" class="nav-link">Agregar una nueva impresora</a>
                </nav>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Ips
        </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <nav class="nav flex-column">
                    <a href="<?=url('#');?>" class="nav-link active">Visualizar ips</a>
                    <a href="<?=url('#');?>" class="nav-link">Administrar ips</a>
                    <a href="<?=url('#');?>" class="nav-link">Agregar una nueva ip</a>
                    <a href="<?=url('#');?>" class="nav-link">Ips disponibles</a>
                    <a href="<?=url('#');?>" class="nav-link">Ips en uso</a>
                </nav>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingFour">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            Areas
        </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <nav class="nav flex-column">
                    <a href="<?=url('#');?>" class="nav-link active">Visualizar areas</a>
                    <a href="<?=url('#');?>" class="nav-link">Administrar areas</a>
                    <a href="<?=url('#');?>" class="nav-link">Agregar una nueva area</a>
                </nav>
            </div>
        </div>
    </div>
</div>
