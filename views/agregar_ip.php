<div class="main-container">
    <div id="agregar-ip-container" class="centered-container compact">
        <div class="card shadow-sm">
            <div class="card-header text-center py-3">
                <h4 class="mb-0 tituloAgregar">
                    <i class="fas fa-plus-circle me-2"></i>Agregar Nueva IP
                </h4>
            </div>
            
            <div class="card-body p-4">
                <form action="" class="mt-2" id="formulario-agregar-ip">
                    <!-- Campo IP principal -->
                    <div class="row justify-content-center mb-4">
                        <div class="col-md-10 col-lg-8">
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-body text-center p-3">
                                    <h6 class="card-title mb-3">
                                        <i class="fas fa-network-wired me-2 text-bronce"></i>Dirección IP
                                    </h6>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-bronce text-white py-2">
                                            <i class="fas fa-ip-address"></i>
                                        </span>
                                        <input type="text" 
                                               class="form-control text-center py-2" 
                                               name="ip" 
                                               id="ip" 
                                               placeholder="Ejemplo: 192.168.1.100"
                                               style="font-family: 'Courier New', monospace; font-size: 0.9rem;">
                                    </div>
                                    <small class="text-muted mt-1 d-block">Formato: XXX.XXX.XXX.XXX</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Selección de tipo de dispositivo -->
                    <div class="row justify-content-center mb-4">
                        <div class="col-md-10 col-lg-8">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center p-3">
                                    <h6 class="card-title mb-3">
                                        <i class="fas fa-desktop me-2 text-bronce"></i>Asignar a Dispositivo (Opcional)
                                    </h6>
                                    
                                    <div class="d-flex justify-content-center gap-3 mb-3">
                                        <div class="form-check card-option">
                                            <input class="form-check-input" type="radio" name="asignar" id="equipos" value="equipos">
                                            <label class="form-check-label card p-2" for="equipos">
                                                <i class="fas fa-computer fa-lg mb-1 text-bronce"></i><br>
                                                <span class="fw-medium small">Equipos</span>
                                            </label>
                                        </div>
                                        
                                        <div class="form-check card-option">
                                            <input class="form-check-input" type="radio" name="asignar" id="impresoras" value="impresoras">
                                            <label class="form-check-label card p-2" for="impresoras">
                                                <i class="fas fa-print fa-lg mb-1 text-bronce"></i><br>
                                                <span class="fw-medium small">Impresoras</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de selección -->
                    <div class="row justify-content-center" id="botones-asignacion">
                        <div class="col-md-10 col-lg-8 text-center">
                            <!-- Botón para equipos -->
                            <div class="mb-3" id="contenedor-btn-equipos">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-3">
                                        <h6 class="card-subtitle mb-2 small">
                                            <i class="fas fa-search me-1 text-bronce"></i>Buscar Equipo
                                        </h6>
                                        <button type="button" 
                                                id="btn-obtener-resguardos" 
                                                class="btn btn-bronce-outline btn-sm w-100 py-2"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#buscar-resguardo">
                                            <i class="fas fa-laptop me-1"></i>Seleccionar Equipo
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Botón para impresoras -->
                            <div class="mb-3" id="contenedor-btn-impresoras">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-3">
                                        <h6 class="card-subtitle mb-2 small">
                                            <i class="fas fa-search me-1 text-bronce"></i>Buscar Impresora
                                        </h6>
                                        <button type="button" 
                                                id="btn-obtener-impresoras" 
                                                class="btn btn-bronce-outline btn-sm w-100 py-2"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#buscar-impresoras">
                                            <i class="fas fa-print me-1"></i>Seleccionar Impresora
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Contenedor para información seleccionada -->
                            <div id="contenedor-dispositivo-seleccionado" class="d-none mb-3">
                                <div class="card border-success shadow-sm">
                                    <div class="card-body p-3 text-center">
                                        <h6 class="card-title text-success mb-2 small">
                                            <i class="fas fa-check-circle me-1"></i>Dispositivo Seleccionado
                                        </h6>
                                        <div id="info-dispositivo" class="small text-start"></div>
                                        <button type="button" id="btn-limpiar-seleccion" class="btn btn-sm btn-outline-danger mt-2 py-1">
                                            <i class="fas fa-times me-1"></i>Cambiar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botón principal -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-10 col-lg-8 text-center">
                            <button id="btn-agregar-ip" type="button" class="btn btn-vino btn-md w-100 py-2">
                                <i class="fas fa-plus-circle me-2"></i>Agregar IP
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para buscar equipos -->
<div class="modal fade" id="buscar-resguardo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header text-center py-2">
                <h6 class="modal-title w-100 mb-0">
                    <i class="fas fa-laptop me-2"></i>Seleccionar Equipo
                </h6>
                <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3">
                <div class="table-responsive">
                    <table id="tablaResguardos" class="table table-sm table-hover mx-auto compact-table">
                        <thead>
                            <tr class="text-center header-modal">
                                <th scope="col"><i class="fas fa-barcode me-1"></i> Serie</th>
                                <th scope="col"><i class="fas fa-tag me-1"></i> Hostname</th>
                                <th scope="col"><i class="fas fa-network-wired me-1"></i> MAC</th>
                                <th scope="col"><i class="fas fa-mouse-pointer me-1"></i> Sel.</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <!-- Contenido dinámico -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para buscar impresoras -->
<div class="modal fade" id="buscar-impresoras" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header text-center py-2">
                <h6 class="modal-title w-100 mb-0">
                    <i class="fas fa-print me-2"></i>Seleccionar Impresora
                </h6>
                <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3">
                <div class="table-responsive">
                    <table id="tablaImpresoras" class="table table-sm table-hover mx-auto compact-table">
                        <thead>
                            <tr class="text-center header-modal">
                                <th scope="col"><i class="fas fa-print me-1"></i> Modelo</th>
                                <th scope="col"><i class="fas fa-barcode me-1"></i> Serie</th>
                                <th scope="col"><i class="fas fa-building me-1"></i> Área</th>
                                <th scope="col"><i class="fas fa-mouse-pointer me-1"></i> Sel.</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <!-- Contenido dinámico -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>