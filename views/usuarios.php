<div id="tabla-de-info-usuarios" class="container">
    <h3 class="mb-3 text-center">
        <i class="bi bi-people-fill me-2"></i> Usuarios
    </h3>
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-excel exportar-excel">
            <i class="bi bi-file-excel-fill me-2"></i> Exportar a Excel
        </button>
    </div>
    
    <div class="table-responsive">
        <table id="tablaUsuarios" class="table table-sm table-hover">
            <thead>
                <tr class="header-tabla">
                    <th scope="col" class="text-center py-2">
                        <i class="bi bi-file-earmark-text me-1"></i> RFC Corto
                    </th>
                    <th scope="col" class="text-center py-2">
                        <i class="bi bi-person me-1"></i> Nombre
                    </th>
                    <th scope="col" class="text-center py-2">
                        <i class="bi bi-card-text me-1"></i> Apellidos
                    </th>
                    <th scope="col" class="text-center py-2">
                        <i class="bi bi-person-badge me-1"></i> No. Emp
                    </th>
                    <th scope="col" class="text-center py-2">
                        <i class="bi bi-briefcase me-1"></i> Puesto
                    </th>
                    <th scope="col" class="text-center py-2">
                        <i class="bi bi-diagram-3 me-1"></i> Area
                    </th>
                    <th scope="col" class="text-center py-2">
                        <i class="bi bi-building me-1"></i> Depto
                    </th>
                    <th scope="col" class="text-center py-2">
                        <i class="bi bi-pc-display me-1"></i> Serie
                    </th>
                    <th scope="col" class="text-center py-2">
                        <i class="bi bi-eye me-1"></i> Detalle
                    </th>
                    <th scope="col" class="text-center py-2">
                        <i class="bi bi-printer me-1"></i> Imprimir
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<div id="informacion-usuario" class="container mt-4">
    <!-- Sección de datos del usuario -->
    <div class="mb-4">
        <h3 class="text-center mb-3">
            <i class="bi bi-person-fill me-2"></i> Datos del usuario
        </h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td scope="row" class="col-3 bg-bronce-suave">
                            <b><i class="bi bi-person me-1"></i> Nombre</b>
                        </td>
                        <td id="nombre-usuario" class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="col-3 bg-bronce-suave">
                            <b><i class="bi bi-card-text me-1"></i> Apellidos</b>
                        </td>
                        <td id="apellidos-usuario" class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="col-3 bg-bronce-suave">
                            <b><i class="bi bi-person-badge me-1"></i> No. Empleado</b>
                        </td>
                        <td id="nEmpleado-usuario" class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="col-3 bg-bronce-suave">
                            <b><i class="bi bi-file-text me-1"></i> RFC</b>
                        </td>
                        <td id="rfc-usuario" class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="col-3 bg-bronce-suave">
                            <b><i class="bi bi-file-earmark-text me-1"></i> RFC Corto</b>
                        </td>
                        <td id="rfc-corto-usuario" class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="col-3 bg-bronce-suave">
                            <b><i class="bi bi-briefcase me-1"></i> Puesto</b>
                        </td>
                        <td id="puesto-empleado" class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="col-3 bg-bronce-suave">
                            <b><i class="bi bi-diagram-3 me-1"></i> Area</b>
                        </td>
                        <td id="area-usuario" class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="col-3 bg-bronce-suave">
                            <b><i class="bi bi-building me-1"></i> Departamento</b>
                        </td>
                        <td id="departamento-usuario" class="text-center"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Sección de datos del equipo -->
    <div>
        <h3 class="text-center mb-3">
            <i class="bi bi-pc-display-horizontal me-2"></i> Datos del equipo de cómputo
        </h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td scope="row" class="col-3 bg-bronce-suave">
                            <b><i class="bi bi-tag me-1"></i> Marca</b>
                        </td>
                        <td id="marca-resguardo" class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="col-3 bg-bronce-suave">
                            <b><i class="bi bi-pc me-1"></i> Modelo</b>
                        </td>
                        <td id="modelo-resguardo" class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="col-3 bg-bronce-suave">
                            <b><i class="bi bi-123 me-1"></i> No. de serie</b>
                        </td>
                        <td id="n-serie-resguardo" class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="col-3 bg-bronce-suave">
                            <b><i class="bi bi-pc-display me-1"></i> Hostname</b>
                        </td>
                        <td id="hostname-resguardo" class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="col-3 bg-bronce-suave">
                            <b><i class="bi bi-ethernet me-1"></i> Mac</b>
                        </td>
                        <td id="mac-resguardo" class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="col-3 bg-bronce-suave">
                            <b><i class="bi bi-diagram-2 me-1"></i> Nodo</b>
                        </td>
                        <td id="nodo-resguardo" class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="col-3 bg-bronce-suave">
                            <b><i class="bi bi-wifi me-1"></i> IP</b>
                        </td>
                        <td id="ip-resguardo" class="text-center"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>