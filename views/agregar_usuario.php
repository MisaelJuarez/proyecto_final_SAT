<div class="container">
    <div class="">
        <h3>Agrega un nuevo usuario</h3>
        <form action="" class="mt-4" id="formulario-agregar-usuario">
            <div class="row">
                <div class="col d-flex flex-wrap justify-content-start">
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="nombre" class="form-label">Ingrese su nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Ingrese su nombre">
                    </div>
                
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="apellidos" class="form-label">Ingrese sus apellidos</label>
                        <input type="text" class="form-control" name="apellidos" placeholder="Ingrese sus apellidos">
                    </div>    
    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="rfc" class="form-label">Ingrese su rfc</label>
                        <input type="text" class="form-control" name="rfc" placeholder="Ingrese su rfc">
                    </div>
    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="rfc_corto" class="form-label">Ingrese sus rfc corto</label>
                        <input type="text" class="form-control" name="rfc_corto" placeholder="Ingrese sus rfc corto">
                    </div>     
    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="n_empleado" class="form-label">Numero de empleado</label>
                        <input type="text" class="form-control" name="n_empleado" id="n_empleado" placeholder="Ingrese su nombre numero de empleado">
                    </div>
                    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="puesto" class="form-label">Ingrese el puesto</label>
                        <select class="contenedor-input form-select" name="puesto" id="puesto" aria-label="Default select example">
                        </select> 
                    </div> 
    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="area" class="form-label">Ingrese el area</label>
                        <select class="contenedor-input form-select" name="area" id="area" aria-label="Default select example">
                        </select> 
                    </div> 
                    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="departamento" class="form-label">Ingrese el departamento</label>
                        <select class="contenedor-input form-select" name="departamento" id="departamento" aria-label="Default select example">
                            <option value="" selected>Seleccione el departamento</option>
                        </select>  
                    </div> 
    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="btn-obtener-resguardos" class="form-label">Seleccione el equipo de computo</label>
                        <button type="button" id="btn-obtener-resguardos" class="form-control text-start" placeholder="Presiona para ver resguardos" data-bs-toggle="modal" data-bs-target="#buscar-resguardo">
                            Seleccionar resguardo
                        </button> 
                    </div> 
    
                    <div class="contenedor-input ms-4 mb-3">
                    </div>  
                    
                    <div class="contenedor-boton ms-4 mb-4">
                        <button id="btn-agregar-usuario" type="button" class="btn btn-success boton">Agregar usuario</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="buscar-resguardo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header h-buscar">
            <h5 class="modal-title" id="staticBackdropLabel">Selecciona el reguardo del usaurio</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body b-buscar">
            <table id="tablaResguardos" class="table table-secondary table-striped p-5">
                <thead>
                    <tr>
                        <th scope="col">numero de serie</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Hostname</th>
                        <th scope="col">Mac</th>
                        <th scope="col">Seleccionar</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>