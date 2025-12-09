<div id="tabla-de-info-ips" class="container-fluid">
    <h3 class="mb-2 tituloTable">Ips disponible</h3>
    <table id="tablaIps" class="table">
        <thead>
            <tr class="header-tabla">
                <th scope="col" class="border border-white w-75">Ip</th>
                <th scope="col" class="border border-white">Asignar IP</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div id="contenedor-asignar" class="container">
    <div class="">
        <h3>Asignar IP</h3>
        <form action="" class="mt-4" id="formulario-agregar-ip">
            <div class="row">
                <div class="col d-flex flex-wrap justify-content-start">
                    <div class="contenedor-input ms-4 mb-3">
                        <p class="fs-4">IP</p>
                        <p id="ip-seleccionada" class="ip_seleccionada"></p>
                    </div>

                    <div class="contenedor-input ms-4 mb-3">
                        <p>Seleccione un opcion</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="asignar" id="equipos" value="equipos">
                            <label class="form-check-label" for="equipos">
                                Equipos de computo
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="asignar" id="impresoras" value="impresoras">
                            <label class="form-check-label" for="impresoras">
                                Impresoras
                            </label>
                        </div>
                    </div> 

                    <div class="contenedor-input ms-4 mb-3" id="asignar-resguardo-contenedor">
                        <label for="btn-obtener-resguardos" class="form-label">Asigar a un equipo</label>
                        <button type="button" id="btn-obtener-resguardos" class="form-control text-start" data-bs-toggle="modal" data-bs-target="#buscar-resguardo">
                            Equipos de computo
                        </button> 
                    </div> 

                    <div class="contenedor-input ms-4 mb-3" id="asignar-impresoras-contenedor">
                        <label for="btn-obtener-impresoras" class="form-label">Asigar a una impresora</label>
                        <button type="button" id="btn-obtener-impresoras" class="form-control text-start" data-bs-toggle="modal" data-bs-target="#buscar-impresoras">
                            Impresoras
                        </button> 
                    </div> 
                    
                    <div class="contenedor-input ms-4 mb-3" id="asignar-impresoras-contenedor">
                    </div> 

                    <div class="contenedor-boton ms-4 mb-4">
                        <button id="btn-asignar-ip" type="button" class="btn btn-success boton">Asignar ip</button>
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
            <h5 class="modal-title" id="staticBackdropLabel">Asignar la ip a un equipo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body b-buscar">
            <table id="tablaResguardos" class="table table-secondary table-striped p-5">
                <thead>
                    <tr>
                        <th scope="col">numero de serie</th>
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

<div class="modal fade" id="buscar-impresoras" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header h-buscar">
            <h5 class="modal-title" id="staticBackdropLabel">Asignar la ip a una impresora</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body b-buscar">
            <table id="tablaImpresoras" class="table table-secondary table-striped p-5">
                <thead>
                    <tr>
                        <th scope="col">Modelo</th>
                        <th scope="col">numero de serie</th>
                        <th scope="col">Area</th>
                        <th scope="col">Departamento</th>
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