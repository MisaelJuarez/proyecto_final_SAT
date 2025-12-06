<div class="container">
    <div class="">
        <h3>Agrega una nueva ip</h3>
        <form action="" class="mt-4" id="formulario-agregar-ip">
            <div class="row">
                <div class="col d-flex flex-wrap justify-content-start">
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="ip" class="form-label">Ingresa la ip</label>
                        <input type="text" class="form-control" name="ip" id="ip" placeholder="1.1.1.1">
                    </div>
    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="btn-obtener-resguardos" class="form-label">Asigar a un equipo (opcional)</label>
                        <button type="button" id="btn-obtener-resguardos" class="form-control text-start" data-bs-toggle="modal" data-bs-target="#buscar-resguardo">
                            Equipos de computo
                        </button> 
                    </div> 
                    
                    <div class="contenedor-boton ms-4 mb-4">
                        <button id="btn-agregar-ip" type="button" class="btn btn-success boton">Agregar nueva ip</button>
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