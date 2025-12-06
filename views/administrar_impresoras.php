<div id="tabla-de-info-impresoras" class="container-fluid">
    <h3 class="mb-2 tituloTable">Impresoras</h3>
    <table id="tablaImpresoras" class="table">
        <thead>
            <tr class="header-tabla">
                <th scope="col" class="border border-white">Marca</th>
                <th scope="col" class="border border-white">Modelo</th>
                <th scope="col" class="border border-white">Numero de serie</th>
                <th scope="col" class="border border-white">Area</th>
                <th scope="col" class="border border-white">Departamento</th>
                <th scope="col" class="border border-white">Ip</th>
                <th scope="col" class="border border-white">Nodo</th>
                <th scope="col" class="border border-white">Actualizar</th>
                <th scope="col" class="border border-white">Baja</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div id="contenedor_modificar_impresoras" class="container">
    <div class="">
        <h3>Modificar Impresoras</h3>
        <form action="" class="mt-4" id="formulario-modificar-impresora">
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
                        <button id="btn-modificar-impresora" type="button" class="btn btn-warning boton">Modificar Informacion</button>
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
            <button id="btn-sin-ip" class="btn btn-primary">Sin ip</button>
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