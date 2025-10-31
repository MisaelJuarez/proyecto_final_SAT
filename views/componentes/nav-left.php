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
                    <a href="<?=url('inicio');?>" class="nav-link active">principal</a>
                    <a href="<?=url('prueba1');?>" class="nav-link">En proceso</a>
                    <a href="<?=url('prueba2');?>" class="nav-link">En proceso</a>
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
