<div class="container">
    <div class="">
        <h3>Agrega una nueva impresora</h3>
        <form action="" class="mt-4" id="formulario-agregar-impresora">
            <div class="row">
                <div class="col d-flex flex-wrap justify-content-start">
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="marca" class="form-label">Ingrese la marca de la impresora</label>
                        <input type="text" class="form-control" name="marca" id="marca" placeholder="Ingrese la marca del equipo">
                    </div>
                
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="modelo" class="form-label">Ingrese el modelo de la impresora</label>
                        <input type="text" class="form-control" name="modelo" id="modelo" placeholder="Ingrese el modelo">
                    </div>    
    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="n_serie" class="form-label">Ingrese el numero de serie</label>
                        <input type="text" class="form-control" name="n_serie" id="n_serie" placeholder="Ingrese el numero de serie del equipo">
                    </div>
    
                   <div class="contenedor-input ms-4 mb-3">
                        <label for="area" class="form-label">Ingrese el area donde se ubica</label>
                        <select class="contenedor-input form-select" name="area" id="area" aria-label="Default select example">
                            <option value="" selected>Seleccione el area</option>
                        </select> 
                    </div> 
                    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="departamento" class="form-label">Ingrese el departamento donde se ubica</label>
                        <select class="contenedor-input form-select" name="departamento" id="departamento" aria-label="Default select example">
                            <option value="" selected>Seleccione el departamento</option>
                        </select>  
                    </div> 
    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="nodo" class="form-label">Ingrese el nodo donde se ubica la impresora</label>
                        <input type="text" class="form-control" name="nodo" id="nodo" placeholder="Ingrese el nodo donde se ubica el equipo">

                    </div> 
    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="btn-obtener-ips" class="form-label">Seleccione la ip de la impresora</label>
                        <button type="button" id="btn-obtener-ips" class="form-control text-start" placeholder="Presiona para ver las ips" data-bs-toggle="modal" data-bs-target="#buscar-ips">
                            Selecciona la ip
                        </button> 
                    </div> 
    
                    <div class="contenedor-input ms-4 mb-3">
                    </div>  
                    
                    <div class="contenedor-boton ms-4 mb-4">
                        <button id="btn-agregar-impresora" type="button" class="btn btn-success boton">Agregar Impresora</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="buscar-ips" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header h-buscar">
            <h5 class="modal-title" id="staticBackdropLabel">Selecciona la ip del equipo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body b-buscar">
            <table id="tablaIps" class="table table-secondary table-striped p-5">
                <thead>
                    <tr>
                        <th scope="col">Ip</th>
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