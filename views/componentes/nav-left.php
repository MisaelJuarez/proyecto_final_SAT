
<link rel="stylesheet" href="<?=CSS.'navbar.css'?>" />
<div class="government-navbar">
    <!-- Header de Usuario -->
    <div class="user-header">
        <div class="user-avatar">
            <i class="bi bi-person-circle"></i>
        </div>
        <div class="user-info">
            <h5 class="user-name"><?=$_SESSION['usuario']['nombre']?> <?=$_SESSION['usuario']['apellidos']?></h5>
            <span class="user-role">Usuario Autorizado</span>
        </div>
        <div class="user-status">
            <div class="status-indicator active"></div>
        </div>
    </div>
    
    <div class="nav-divider"></div>
    
    <!-- Menú de Navegación -->
    <div class="government-menu" id="governmentAccordion">
        <!-- Sección Usuarios -->
        <div class="menu-section">
            <button class="menu-header <?=($grupo_actual == 'usuarios') ? 'active' : ''?>" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapseUsuarios" 
                    aria-expanded="<?=($grupo_actual == 'usuarios') ? 'true' : 'false'?>" 
                    aria-controls="collapseUsuarios">
                <div class="header-content">
                    <div class="header-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <span class="header-text">Usuarios</span>
                </div>
                <div class="header-arrow">
                    <i class="bi bi-chevron-down"></i>
                </div>
            </button>
            <div id="collapseUsuarios" 
                 class="menu-collapse collapse <?=($grupo_actual == 'usuarios') ? 'show' : ''?>" 
                 aria-labelledby="headingUsuarios" 
                 data-bs-parent="#governmentAccordion">
                <div class="menu-links">
                    <a href="<?=url('usuarios');?>" 
                       class="menu-link <?=($grupo_actual == 'usuarios') ? 'active' : ''?>">
                        <i class="bi bi-eye"></i>
                        <span>Visualizar usuarios</span>
                    </a>
                    <a href="<?=url('administrar_usuarios');?>" 
                       class="menu-link <?=($grupo_actual == 'usuarios') ? 'active' : ''?>">
                        <i class="bi bi-gear"></i>
                        <span>Administrar usuarios</span>
                    </a>
                    <a href="<?=url('agregar_usuario');?>" 
                       class="menu-link <?=($grupo_actual == 'usuarios') ? 'active' : ''?>">
                        <i class="bi bi-person-plus"></i>
                        <span>Agregar nuevo usuario</span>
                    </a>
                    <a href="<?=url('bajas_usuarios');?>" 
                       class="menu-link <?=($grupo_actual == 'usuarios') ? 'active' : ''?>">
                        <i class="bi bi-person-dash"></i>
                        <span>Bajas usuarios</span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Sección Resguardos -->
        <div class="menu-section">
            <button class="menu-header <?=($grupo_actual == 'resguardos') ? 'active' : ''?>" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapseResguardos" 
                    aria-expanded="<?=($grupo_actual == 'resguardos') ? 'true' : 'false'?>" 
                    aria-controls="collapseResguardos">
                <div class="header-content">
                    <div class="header-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <span class="header-text">Resguardos</span>
                </div>
                <div class="header-arrow">
                    <i class="bi bi-chevron-down"></i>
                </div>
            </button>
            <div id="collapseResguardos" 
                 class="menu-collapse collapse <?=($grupo_actual == 'resguardos') ? 'show' : ''?>" 
                 aria-labelledby="headingResguardos" 
                 data-bs-parent="#governmentAccordion">
                <div class="menu-links">
                    <a href="<?=url('resguardos');?>" 
                       class="menu-link <?=($grupo_actual == 'resguardos') ? 'active' : ''?>">
                        <i class="bi bi-eye"></i>
                        <span>Visualizar resguardos</span>
                    </a>
                    <a href="<?=url('administrar_resguardos');?>" 
                       class="menu-link <?=($grupo_actual == 'resguardos') ? 'active' : ''?>">
                        <i class="bi bi-gear"></i>
                        <span>Administrar resguardos</span>
                    </a>
                    <a href="<?=url('agregar_resguardo');?>" 
                       class="menu-link <?=($grupo_actual == 'resguardos') ? 'active' : ''?>">
                        <i class="bi bi-file-earmark-plus"></i>
                        <span>Agregar nuevo resguardo</span>
                    </a>
                    <a href="<?=url('bajas_resguardos');?>" 
                       class="menu-link <?=($grupo_actual == 'resguardos') ? 'active' : ''?>">
                        <i class="bi bi-file-earmark-minus"></i>
                        <span>Bajas resguardos</span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Sección Impresoras -->
        <div class="menu-section">
            <button class="menu-header <?=($grupo_actual == 'impresoras') ? 'active' : ''?>" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapseImpresoras" 
                    aria-expanded="<?=($grupo_actual == 'impresoras') ? 'true' : 'false'?>" 
                    aria-controls="collapseImpresoras">
                <div class="header-content">
                    <div class="header-icon">
                        <i class="bi bi-printer-fill"></i>
                    </div>
                    <span class="header-text">Impresoras</span>
                </div>
                <div class="header-arrow">
                    <i class="bi bi-chevron-down"></i>
                </div>
            </button>
            <div id="collapseImpresoras" 
                 class="menu-collapse collapse <?=($grupo_actual == 'impresoras') ? 'show' : ''?>" 
                 aria-labelledby="headingImpresoras" 
                 data-bs-parent="#governmentAccordion">
                <div class="menu-links">
                    <a href="<?=url('impresoras');?>" 
                       class="menu-link <?=($grupo_actual == 'impresoras') ? 'active' : ''?>">
                        <i class="bi bi-eye"></i>
                        <span>Visualizar impresoras</span>
                    </a>
                    <a href="<?=url('administrar_impresoras');?>"
                       class="menu-link <?=($grupo_actual == 'impresoras') ? 'active' : ''?>">
                        <i class="bi bi-gear"></i>
                        <span>Administrar impresoras</span>
                    </a>
                    <a href="<?=url('agregar_impresora');?>" 
                       class="menu-link <?=($grupo_actual == 'impresoras') ? 'active' : ''?>">
                        <i class="bi bi-plus-circle"></i>
                        <span>Agregar nueva impresora</span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Sección IPs -->
        <div class="menu-section">
            <button class="menu-header <?=($grupo_actual == 'ips') ? 'active' : ''?>" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapseIPs" 
                    aria-expanded="<?=($grupo_actual == 'ips') ? 'true' : 'false'?>" 
                    aria-controls="collapseIPs">
                <div class="header-content">
                    <div class="header-icon">
                        <i class="bi bi-router-fill"></i>
                    </div>
                    <span class="header-text">Direcciones IP</span>
                </div>
                <div class="header-arrow">
                    <i class="bi bi-chevron-down"></i>
                </div>
            </button>
            <div id="collapseIPs" 
                 class="menu-collapse collapse <?=($grupo_actual == 'ips') ? 'show' : ''?>" 
                 aria-labelledby="headingIPs" 
                 data-bs-parent="#governmentAccordion">
                <div class="menu-links">
                    <a href="<?=url('ips_disponibles');?>" 
                       class="menu-link <?=($grupo_actual == 'ips') ? 'active' : ''?>">
                        <i class="bi bi-check-circle"></i>
                        <span>IPs disponibles</span>
                    </a>
                    <a href="<?=url('ips_en_uso');?>" 
                       class="menu-link <?=($grupo_actual == 'ips') ? 'active' : ''?>">
                        <i class="bi bi-circle-fill"></i>
                        <span>IPs en uso</span>
                    </a>
                    <a href="<?=url('agregar_ip');?>" 
                       class="menu-link <?=($grupo_actual == 'ips') ? 'active' : ''?>">
                        <i class="bi bi-plus-circle"></i>
                        <span>Agregar nueva IP</span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Sección Consultas -->
        <div class="menu-section">
            <button class="menu-header <?=($grupo_actual == 'consultas') ? 'active' : ''?>" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapseConsultas" 
                    aria-expanded="<?=($grupo_actual == 'consultas') ? 'true' : 'false'?>" 
                    aria-controls="collapseConsultas">
                <div class="header-content">
                    <div class="header-icon">
                        <i class="bi bi-search"></i>
                    </div>
                    <span class="header-text">Consultas</span>
                </div>
                <div class="header-arrow">
                    <i class="bi bi-chevron-down"></i>
                </div>
            </button>
            <div id="collapseConsultas" 
                 class="menu-collapse collapse <?=($grupo_actual == 'consultas') ? 'show' : ''?>" 
                 aria-labelledby="headingConsultas" 
                 data-bs-parent="#governmentAccordion">
                <div class="menu-links">
                    <a href="<?=url('consultar_usuarios');?>" 
                       class="menu-link <?=($grupo_actual == 'consultas') ? 'active' : ''?>">
                        <i class="bi bi-people"></i>
                        <span>Consultar usuarios</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Pie de Navbar -->
    <div class="nav-footer">
        <div class="system-info">
            <i class="bi bi-shield-lock"></i>
            <span>Sistema Seguro SADCTI</span>
        </div>
    </div>
</div>