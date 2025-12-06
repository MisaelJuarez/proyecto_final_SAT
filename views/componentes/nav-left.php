<h5 class="mb-3 text-center p-3"><?=$_SESSION['usuario']['nombre']?> <?=$_SESSION['usuario']['apellidos']?></h5>
<hr/>
<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button <?=($grupo_actual == 'usuarios') ? '' : 'collapsed'?>" 
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#collapseOne" 
                aria-expanded="<?=($grupo_actual == 'usuarios') ? 'true' : 'false'?>" 
                aria-controls="collapseOne">
                    Usuarios
        </button>
        </h2>
        <div id="collapseOne" 
             class="accordion-collapse collapse <?=($grupo_actual == 'usuarios') ? 'show' : ''?>" 
             aria-labelledby="headingOne" 
             data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <nav class="nav flex-column">
                    <a href="<?=url('usuarios');?>" 
                       class="nav-link <?=($grupo_actual == 'usuarios') ? 'active' : ''?>">
                        Visualizar usuarios
                    </a>
                    <a href="<?=url('administrar_usuarios');?>" 
                       class="nav-link <?=($grupo_actual == 'usuarios') ? 'active' : ''?>">
                        Administrar usuarios
                    </a>
                    <a href="<?=url('agregar_usuario');?>" 
                       class="nav-link <?=($grupo_actual == 'usuarios') ? 'active' : ''?>">
                        Agregar un nuevo usuario
                    </a>
                    <a href="<?=url('bajas_usuarios');?>" 
                       class="nav-link <?=($grupo_actual == 'usuarios') ? 'active' : ''?>">
                        Bajas usuarios
                    </a>
                </nav>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button <?=($grupo_actual == 'resguardos') ? '' : 'collapsed'?>" 
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#collapseTwo" 
                aria-expanded="<?=($grupo_actual == 'resguardos') ? 'true' : 'false'?>" 
                aria-controls="collapseTwo">          
                    Resguardos
        </button>
        </h2>
        <div id="collapseTwo" 
             class="accordion-collapse collapse <?=($grupo_actual == 'resguardos') ? 'show' : ''?>" 
             aria-labelledby="headingTwo" 
             data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <nav class="nav flex-column">
                    <a href="<?=url('resguardos');?>" 
                       class="nav-link <?=($grupo_actual == 'resguardos') ? 'active' : ''?>">
                        Visualizar resguardos
                    </a>
                    <a href="<?=url('administrar_resguardos');?>" 
                       class="nav-link <?=($grupo_actual == 'resguardos') ? 'active' : ''?>">
                        Administrar resguardos
                    </a>
                    <a href="<?=url('agregar_resguardo');?>" 
                       class="nav-link <?=($grupo_actual == 'resguardos') ? 'active' : ''?>">
                        Agregar un nuevo resguardo
                    </a>
                    <a href="<?=url('bajas_resguardos');?>" 
                       class="nav-link <?=($grupo_actual == 'resguardos') ? 'active' : ''?>">
                        Bajas resguardos
                    </a>
                </nav>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingFive">
        <button class="accordion-button <?=($grupo_actual == 'impresoras') ? '' : 'collapsed'?>" 
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#collapseFive" 
                aria-expanded="<?=($grupo_actual == 'impresoras') ? 'true' : 'false'?>" 
                aria-controls="collapseFive">
            Impresoras
        </button>
        </h2>
        <div id="collapseFive" 
             class="accordion-collapse collapse <?=($grupo_actual == 'impresoras') ? 'show' : ''?>" 
             aria-labelledby="headingFive" 
             data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <nav class="nav flex-column">
                    <a href="<?=url('impresoras');?>" 
                       class="nav-link <?=($grupo_actual == 'impresoras') ? 'active' : ''?>">
                        Visualizar impresoras
                    </a>
                    <a href="<?=url('administrar_impresoras');?>"
                       class="nav-link <?=($grupo_actual == 'impresoras') ? 'active' : ''?>">
                        Administrar impresoras
                    </a>
                    <a href="<?=url('agregar_impresora');?>" 
                       class="nav-link <?=($grupo_actual == 'impresoras') ? 'active' : ''?>">
                        Agregar una nueva impresora
                    </a>
                </nav>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button <?=($grupo_actual == 'ips') ? '' : 'collapsed'?>" 
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#collapseThree" 
                aria-expanded="<?=($grupo_actual == 'ips') ? 'true' : 'false'?>" 
                aria-controls="collapseThree">
                Ips
        </button>
        </h2>
        <div id="collapseThree" 
             class="accordion-collapse collapse <?=($grupo_actual == 'ips') ? 'show' : ''?>" 
             aria-labelledby="headingThree" 
             data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <nav class="nav flex-column">
                    <a href="<?=url('ips_disponibles');?>" 
                       class="nav-link <?=($grupo_actual == 'ips') ? 'active' : ''?>">
                        Ips disponibles
                    </a>
                    <a href="<?=url('ips_en_uso');?>" 
                       class="nav-link <?=($grupo_actual == 'ips') ? 'active' : ''?>">
                        Ips en uso
                    </a>
                    <a href="<?=url('agregar_ip');?>" 
                       class="nav-link <?=($grupo_actual == 'ips') ? 'active' : ''?>">
                        Agregar una nueva ip
                    </a>
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
