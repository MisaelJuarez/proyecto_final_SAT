<div class="container">
    <h3 class="text-center mb-4">
        <i class="bi bi-person-plus-fill me-2"></i> Agrega un nuevo usuario
    </h3>
    
    <form action="" class="mt-4" id="formulario-agregar-usuario">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="row">
                    <!-- Columna Izquierda -->
                    <div class="col-md-6">
                        <div class="contenedor-input mx-auto mb-3">
                            <label for="nombre" class="form-label text-center d-block">
                                <i class="bi bi-person-circle me-1"></i> Nombre
                            </label>
                            <input type="text" class="form-control text-center" name="nombre" placeholder="Ingrese nombre">
                        </div>
                    
                        <div class="contenedor-input mx-auto mb-3">
                            <label for="apellidos" class="form-label text-center d-block">
                                <i class="bi bi-card-text me-1"></i> Apellidos
                            </label>
                            <input type="text" class="form-control text-center" name="apellidos" placeholder="Ingrese apellidos">
                        </div>    

                        <div class="contenedor-input mx-auto mb-3">
                            <label for="rfc" class="form-label text-center d-block">
                                <i class="bi bi-file-text me-1"></i> RFC
                            </label>
                            <input type="text" class="form-control text-center" name="rfc" placeholder="Ingrese RFC">
                        </div>

                        <div class="contenedor-input mx-auto mb-3">
                            <label for="rfc_corto" class="form-label text-center d-block">
                                <i class="bi bi-file-earmark-text me-1"></i> RFC Corto
                            </label>
                            <input type="text" class="form-control text-center" name="rfc_corto" placeholder="Ingrese RFC corto">
                        </div>     
                    </div>
                    
                    <!-- Columna Derecha -->
                    <div class="col-md-6">
                        <div class="contenedor-input mx-auto mb-3">
                            <label for="n_empleado" class="form-label text-center d-block">
                                <i class="bi bi-person-badge me-1"></i> Número de empleado
                            </label>
                            <input type="text" class="form-control text-center" name="n_empleado" id="n_empleado" placeholder="Ingrese número de empleado">
                        </div>
                        
                        <div class="contenedor-input mx-auto mb-3">
                            <label for="puesto" class="form-label text-center d-block">
                                <i class="bi bi-briefcase me-1"></i> Puesto
                            </label>
                            <select class="form-select text-center" name="puesto" id="puesto" aria-label="Default select example">
                                <option value="" selected class="text-center">Seleccione puesto</option>
                            </select> 
                        </div> 

                        <div class="contenedor-input mx-auto mb-3">
                            <label for="area" class="form-label text-center d-block">
                                <i class="bi bi-diagram-3 me-1"></i> Área
                            </label>
                            <select class="form-select text-center" name="area" id="area" aria-label="Default select example">
                                <option value="" selected class="text-center">Seleccione área</option>
                            </select> 
                        </div> 
                        
                        <div class="contenedor-input mx-auto mb-3">
                            <label for="departamento" class="form-label text-center d-block">
                                <i class="bi bi-building me-1"></i> Departamento
                            </label>
                            <select class="form-select text-center" name="departamento" id="departamento" aria-label="Default select example">
                                <option value="" selected class="text-center">Seleccione departamento</option>
                            </select>  
                        </div> 

                        <div class="contenedor-input mx-auto mb-3">
                            <label for="btn-obtener-resguardos" class="form-label text-center d-block">
                                <i class="bi bi-pc-display me-1"></i> Equipo de cómputo
                            </label>
                            <button type="button" id="btn-obtener-resguardos" class="btn btn-outline-secondary w-100" data-bs-toggle="modal" data-bs-target="#buscar-resguardo">
                                <i class="bi bi-search me-2"></i> Seleccionar resguardo
                            </button> 
                        </div>
                    </div>
                </div>
                
                <!-- Botón agregar usuario -->
                <div class="row justify-content-center mt-2">
                    <div class="col-md-6">
                        <div class="contenedor-boton mx-auto">
                            <button id="btn-agregar-usuario" type="button" class="btn btn-success w-100">
                                <i class="bi bi-plus-circle me-2"></i> Agregar usuario
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal de búsqueda de resguardos -->
<div class="modal fade" id="buscar-resguardo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title w-100" id="staticBackdropLabel">
                    <i class="bi bi-pc-display-horizontal me-2"></i> Selecciona el resguardo del usuario
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="table-responsive">
                    <table id="tablaResguardos" class="table table-sm table-hover">
                        <thead>
                            <tr class="header-tabla">
                                <th scope="col" class="text-center"><i class="bi bi-123 me-1"></i> Número de serie</th>
                                <th scope="col" class="text-center"><i class="bi bi-tag me-1"></i> Marca</th>
                                <th scope="col" class="text-center"><i class="bi bi-pc me-1"></i> Hostname</th>
                                <th scope="col" class="text-center"><i class="bi bi-ethernet me-1"></i> Mac</th>
                                <th scope="col" class="text-center"><i class="bi bi-check-circle me-1"></i> Seleccionar</th>
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