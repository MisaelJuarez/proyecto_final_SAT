<div>
    <button id="mostrar-ocultar-nav" class="botones">
        <i class="bi bi-arrow-left-right">    
    </i></button>
</div>
<div class="">
    <?php if ($_SESSION['usuario']['administrador'] == '1'): ?>
    <button id="agregar_usuario" class="botones me-4" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Agregar usuarios">
        <i class="bi bi-person-add"></i>
    </button>
    <?php endif; ?>
    <button id="cerrar_sesion" class="botones" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cerrar session">
        <i class="bi bi-power"></i>
    </button>
</div>
