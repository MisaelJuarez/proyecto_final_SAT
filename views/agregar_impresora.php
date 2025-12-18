<div class="container">
    <h3 class="text-center mb-4">
        <i class="bi bi-plus-circle me-2"></i> Agrega una nueva impresora
    </h3>
    
    <form action="" class="mt-4" id="formulario-agregar-impresora">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="row">
                    <!-- Columna Izquierda -->
                    <div class="col-md-6">
                        <div class="contenedor-input mx-auto mb-3">
                            <label for="marca" class="form-label text-center d-block">
                                <i class="bi bi-tag me-1"></i> Marca de la impresora
                            </label>
                            <input type="text" class="form-control text-center" name="marca" id="marca" placeholder="Ingrese marca">
                        </div>
                    
                        <div class="contenedor-input mx-auto mb-3">
                            <label for="modelo" class="form-label text-center d-block">
                                <i class="bi bi-printer me-1"></i> Modelo
                            </label>
                            <input type="text" class="form-control text-center" name="modelo" id="modelo" placeholder="Ingrese modelo">
                        </div>    

                        <div class="contenedor-input mx-auto mb-3">
                            <label for="n_serie" class="form-label text-center d-block">
                                <i class="bi bi-123 me-1"></i> Número de serie
                            </label>
                            <input type="text" class="form-control text-center" name="n_serie" id="n_serie" placeholder="Ingrese número de serie">
                        </div>

                        <div class="contenedor-input mx-auto mb-3">
                            <label for="area" class="form-label text-center d-block">
                                <i class="bi bi-diagram-3 me-1"></i> Área
                            </label>
                            <select class="form-select text-center" name="area" id="area" aria-label="Default select example">
                                <option value="" selected class="text-center">Seleccione el área</option>
                            </select> 
                        </div>
                    </div>
                    
                    <!-- Columna Derecha -->
                    <div class="col-md-6">
                        <div class="contenedor-input mx-auto mb-3">
                            <label for="departamento" class="form-label text-center d-block">
                                <i class="bi bi-building me-1"></i> Departamento
                            </label>
                            <select class="form-select text-center" name="departamento" id="departamento" aria-label="Default select example">
                                <option value="" selected class="text-center">Seleccione el departamento</option>
                            </select>  
                        </div> 

                        <div class="contenedor-input mx-auto mb-3">
                            <label for="nodo" class="form-label text-center d-block">
                                <i class="bi bi-diagram-2 me-1"></i> Nodo
                            </label>
                            <input type="text" class="form-control text-center" name="nodo" id="nodo" placeholder="Ingrese nodo">
                        </div> 

                        <div class="contenedor-input mx-auto mb-3">
                            <label for="btn-obtener-ips" class="form-label text-center d-block">
                                <i class="bi bi-wifi me-1"></i> IP de la impresora
                            </label>
                            <button type="button" id="btn-obtener-ips" class="btn btn-outline-secondary w-100" data-bs-toggle="modal" data-bs-target="#buscar-ips">
                                <i class="bi bi-search me-2"></i> Seleccionar IP
                            </button> 
                        </div> 

                        <div class="contenedor-boton mx-auto mt-3">
                            <button id="btn-agregar-impresora" type="button" class="btn btn-success w-100">
                                <i class="bi bi-plus-circle me-2"></i> Agregar Impresora
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="buscar-ips" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title w-100" id="staticBackdropLabel">
                    <i class="bi bi-wifi me-2"></i> Selecciona la IP del equipo
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="table-responsive">
                    <table id="tablaIps" class="table table-sm table-hover">
                        <thead>
                            <tr class="header-tabla">
                                <th scope="col" class="text-center"><i class="bi bi-wifi me-1"></i> IP</th>
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