<div class="main-container">
    <div id="tabla-de-info-ips" class="centered-container">
        <h3 class="mb-4 tituloTable text-center"><i class="fas fa-list me-2"></i>IPs Disponibles</h3>
        <div class="table-responsive">
            <table id="tablaIps" class="table table-hover mx-auto">
                <thead>
                    <tr class="header-tabla">
                        <th scope="col" class="text-center border border-white w-75"><i class="fas fa-network-wired me-2"></i>Dirección IP</th>
                        <th scope="col" class="text-center border border-white"><i class="fas fa-tasks me-2"></i>Asignar IP</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div id="contenedor-asignar" class="centered-container">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h3 class="mb-0"><i class="fas fa-edit me-2"></i>Asignar IP</h3>
            </div>
            <div class="card-body">
                <form action="" class="mt-4" id="formulario-agregar-ip">
                    <div class="text-center mb-5">
                        <p class="text-muted mb-2">IP seleccionada:</p>
                        <div class="ip-display mx-auto p-3 rounded">
                            <p id="ip-seleccionada" class="ip_seleccionada mb-0 fw-bold text-center"></p>
                        </div>
                    </div>

                    <div class="row justify-content-center g-4">
                        <div class="col-md-8 col-lg-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <h5 class="card-title mb-4"><i class="fas fa-desktop me-2"></i>Tipo de dispositivo</h5>
                                    <div class="d-flex justify-content-center gap-4 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="asignar" id="equipos" value="equipos">
                                            <label class="form-check-label" for="equipos">
                                                <i class="fas fa-computer me-2"></i>Equipos de cómputo
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="asignar" id="impresoras" value="impresoras">
                                            <label class="form-check-label" for="impresoras">
                                                <i class="fas fa-print me-2"></i>Impresoras
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 col-lg-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <h5 class="card-title mb-4"><i class="fas fa-link me-2"></i>Asignación</h5>
                                    
                                    <div class="mb-4" id="asignar-resguardo-contenedor">
                                        <label for="btn-obtener-resguardos" class="form-label fw-medium d-block mb-2">Seleccionar equipo:</label>
                                        <button type="button" id="btn-obtener-resguardos" class="btn btn-outline mx-auto" data-bs-toggle="modal" data-bs-target="#buscar-resguardo">
                                            <i class="fas fa-search me-2"></i>Buscar equipo de cómputo
                                        </button> 
                                    </div>

                                    <div class="mb-4" id="asignar-impresoras-contenedor">
                                        <label for="btn-obtener-impresoras" class="form-label fw-medium d-block mb-2">Seleccionar impresora:</label>
                                        <button type="button" id="btn-obtener-impresoras" class="btn btn-outline mx-auto" data-bs-toggle="modal" data-bs-target="#buscar-impresoras">
                                            <i class="fas fa-search me-2"></i>Buscar impresora
                                        </button> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-center mt-5">
                            <button id="btn-asignar-ip" type="button" class="btn btn-lg btn-center">
                                <i class="fas fa-check-circle me-2"></i>Asignar IP
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="buscar-resguardo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title w-100"><i class="fas fa-desktop me-2"></i>Asignar IP a un equipo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablaResguardos" class="table table-hover mx-auto">
                        <thead>
                            <tr class="text-center">
                                <th scope="col"><i class="fas fa-barcode me-1"></i> Número de serie</th>
                                <th scope="col"><i class="fas fa-tag me-1"></i> Hostname</th>
                                <th scope="col"><i class="fas fa-network-wired me-1"></i> MAC</th>
                                <th scope="col"><i class="fas fa-mouse-pointer me-1"></i> Seleccionar</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="buscar-impresoras" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title w-100"><i class="fas fa-print me-2"></i>Asignar IP a una impresora</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablaImpresoras" class="table table-hover mx-auto">
                        <thead>
                            <tr class="text-center">
                                <th scope="col"><i class="fas fa-print me-1"></i> Modelo</th>
                                <th scope="col"><i class="fas fa-barcode me-1"></i> Número de serie</th>
                                <th scope="col"><i class="fas fa-building me-1"></i> Área</th>
                                <th scope="col"><i class="fas fa-sitemap me-1"></i> Departamento</th>
                                <th scope="col"><i class="fas fa-mouse-pointer me-1"></i> Seleccionar</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>