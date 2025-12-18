<div class="main-container">
    <div id="tabla-de-info-ips" class="centered-container">
        <div class="card shadow-sm">
            <!-- Encabezado compacto -->
            <div class="card-header text-center py-3">
                <div class="d-flex justify-content-center align-items-center gap-3 mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="mostrar" value="equipos" id="equipos" checked>
                        <label class="form-check-label" for="equipos">
                            <i class="fas fa-desktop me-1"></i>Equipos
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="mostrar" value="impresoras" id="impresoras">
                        <label class="form-check-label" for="impresoras">
                            <i class="fas fa-print me-1"></i>Impresoras
                        </label>
                    </div>
                </div>
                
                <h4 class="mb-0 tituloTable">
                    <i class="fas fa-network-wired me-2"></i>IPs en Uso
                </h4>
            </div>

            <!-- Tabla compacta centrada -->
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table id="tablaIps" class="table table-hover mx-auto compact-table">
                        <thead>
                            <tr class="header-tabla">
                                <th scope="col" class="text-center border border-white"><i class="fas fa-ip-address me-1"></i> IP</th>
                                <th scope="col" class="text-center border border-white"><i class="fas fa-barcode me-1"></i> Serie</th>
                                <th scope="col" class="text-center border border-white"><i class="fas fa-eye me-1"></i> Detalles</th>
                                <th scope="col" class="text-center border border-white"><i class="fas fa-unlink me-1"></i> Quitar</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <!-- Contenido dinámico centrado -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de información - más compacta -->
    <div id="informacion-ip" class="centered-container mt-4">
        <div class="card shadow-sm">
            <div class="card-header text-center py-2">
                <h4 class="mb-0 tituloInformacion">
                    <i class="fas fa-info-circle me-2"></i>Detalles del Dispositivo
                </h4>
            </div>
            
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table table-sm mx-auto compact-details">
                        <tbody>
                            <tr class="text-center">
                                <td class="col-4 fw-bold"><i class="fas fa-tag me-1 text-bronce"></i>Marca</td>
                                <td id="marca-resguardo" class="col-8">-</td>
                            </tr>
                            <tr class="text-center">
                                <td class="col-4 fw-bold"><i class="fas fa-cube me-1 text-bronce"></i>Modelo</td>
                                <td id="modelo-resguardo" class="col-8">-</td>
                            </tr>
                            <tr class="text-center">
                                <td class="col-4 fw-bold"><i class="fas fa-barcode me-1 text-bronce"></i>No. Serie</td>
                                <td id="n-serie-resguardo" class="col-8">-</td>
                            </tr>
                            <tr id="hostname-res" class="text-center">
                                <td class="col-4 fw-bold"><i class="fas fa-desktop me-1 text-bronce"></i>Hostname</td>
                                <td id="hostname-resguardo" class="col-8">-</td>
                            </tr>
                            <tr id="mac-res" class="text-center">
                                <td class="col-4 fw-bold"><i class="fas fa-network-wired me-1 text-bronce"></i>MAC</td>
                                <td id="mac-resguardo" class="col-8">-</td>
                            </tr>
                            <tr id="area-impresora" class="text-center">
                                <td class="col-4 fw-bold"><i class="fas fa-building me-1 text-bronce"></i>Área</td>
                                <td id="area-resguardo" class="col-8">-</td>
                            </tr>
                            <tr id="departamento-impresoras" class="text-center">
                                <td class="col-4 fw-bold"><i class="fas fa-sitemap me-1 text-bronce"></i>Depto</td>
                                <td id="departamento-resguardo" class="col-8">-</td>
                            </tr>
                            <tr class="text-center">
                                <td class="col-4 fw-bold"><i class="fas fa-server me-1 text-bronce"></i>Nodo</td>
                                <td id="nodo-resguardo" class="col-8">-</td>
                            </tr>
                            <tr class="text-center table-primary">
                                <td class="col-4 fw-bold"><i class="fas fa-ip-address me-1 text-bronce"></i>IP</td>
                                <td id="ip-resguardo" class="col-8 fw-bold">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>