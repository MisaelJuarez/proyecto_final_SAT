<div>
    <button id="mostrar-ocultar-nav" class="botones">
        <i class="bi bi-arrow-left-right"></i>
    </button>
</div>
<div class="">
    <?php if ($_SESSION['usuario']['administrador'] == '1'): ?>
    <button id="btn-ir-administrar-colaboradores" class="botones me-4" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Administrar colaboradores">
        <i class="bi bi-people-fill"></i>
    </button>
    <button id="btn-ir-agregar-colaborador" class="botones me-4" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Agregar colaborador">
        <i class="bi bi-person-fill-add"></i>
    </button>
    <button id="btn-ir-actualizar-informacion" class="botones me-4" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Actualizar informacion">
        <i class="bi bi-person-fill-gear"></i>
    </button>
    <?php endif; ?>
    <button id="cerrar_sesion" class="botones" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cerrar session">
        <i class="bi bi-power"></i>
    </button>
</div>
