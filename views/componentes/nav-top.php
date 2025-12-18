
<div class="elegant-toolbar" id="elegant-toolbar">
    <div class="toolbar-brand">
        <div class="brand-logo">
            <i class="bi bi-gem"></i>
        </div>
        <div class="brand-text">
            <span class="brand-title">SADCTI</span>
            <span class="brand-subtitle">Sistema de Gestión</span>
        </div>
    </div>
    
    <div class="toolbar-actions">
        <a href="<?=url('inicio');?>" class="tool-action" data-bs-toggle="tooltip" title="Inicio">
            <div class="action-icon">
                <i class="bi bi-house"></i>
            </div>
            <span class="action-label">Inicio</span>
        </a>
        <button id="mostrar-ocultar-nav" class="tool-action" data-bs-toggle="tooltip" title="Alternar Menú">
            <div class="action-icon">
                <i class="bi bi-list"></i>
            </div>
            <span class="action-label">Menú</span>
        </button>
        <button id="btn-ir-actualizar-informacion" class="tool-action" data-bs-toggle="tooltip" title="Mi Perfil">
            <div class="action-icon">
                <i class="bi bi-person-circle"></i>
            </div>
            <span class="action-label">Perfil</span>
        </button>
        
        <?php if ($_SESSION['usuario']['administrador'] == '1'): ?>
        <div class="dropdown">
            <button class="tool-action dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="action-icon">
                    <i class="bi bi-people"></i>
                </div>
                <span class="action-label">Administrar</span>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" id="btn-ir-administrar-colaboradores">
                        <i class="bi bi-person-gear"></i>
                        <span>Colaboradores</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" id="btn-ir-agregar-colaborador">
                        <i class="bi bi-person-add"></i>
                        <span>Nuevo Colaborador</span>
                    </a>
                </li>
            </ul>
        </div>
        <?php endif; ?>
        
       
    </div>
    <div class="toolbar-user">
        <div class="user-info">
        </div>
          <span class="action-label">Cerrar Sesión</span>
        <button id="cerrar_sesion" class="logout-btn" data-bs-toggle="tooltip" title="Cerrar Sesión">
            <div class="logout-icon">
                <i class="bi bi-box-arrow-right"></i>
            </div>
        </button>
    </div>
</div>