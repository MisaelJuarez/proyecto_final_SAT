<div id="tabla-de-admin-usuarios" class="container-fluid">
    <h3 class="mb-2 tituloTable text-center">
        <i class="bi bi-people-fill me-2"></i> Administrar usuarios
    </h3>
    <table id="tablaUsuariosAdministrar" class="table">
        <thead>
            <tr class="header-tabla">
                <th scope="col" class="border border-white text-start">
                    <i class="bi bi-file-earmark-text me-1"></i> RFC Corto
                </th>
                <th scope="col" class="border border-white text-start">
                    <i class="bi bi-person me-1"></i> Nombre
                </th>
                <th scope="col" class="border border-white text-start">
                    <i class="bi bi-card-text me-1"></i> Apellidos
                </th>
                <th scope="col" class="border border-white text-start">
                    <i class="bi bi-person-badge me-1"></i> No. Empleado
                </th>
                <th scope="col" class="border border-white text-start">
                    <i class="bi bi-briefcase me-1"></i> Puesto
                </th>
                <th scope="col" class="border border-white text-start">
                    <i class="bi bi-diagram-3 me-1"></i> Area
                </th>
                <th scope="col" class="border border-white text-start">
                    <i class="bi bi-building me-1"></i> Departamento
                </th>
                <th scope="col" class="border border-white text-start">
                    <i class="bi bi-pc-display me-1"></i> N. Serie equipo
                </th>
                <th scope="col" class="border border-white text-start">
                    <i class="bi bi-pencil-square me-1"></i> Modificar
                </th>
                <th scope="col" class="border border-white text-start">
                    <i class="bi bi-person-x me-1"></i> Baja
                </th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div id="contenedor-modificar-usuario" class="container">
    <div class="">
        <h3 class="text-center">
            <i class="bi bi-pencil-square me-2"></i> Modificar la informacion del usuario
        </h3>
        <form action="" class="mt-4" id="formulario-modificar-usuario">
            <div class="row">
                <div class="col d-flex flex-wrap justify-content-start">
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="nombre" class="form-label">
                            <i class="bi bi-person-circle me-1"></i> Nombre
                        </label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese nombre">
                    </div>
                
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="apellidos" class="form-label">
                            <i class="bi bi-card-text me-1"></i> Apellidos
                        </label>
                        <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Ingrese apellidos">
                    </div>    
    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="rfc" class="form-label">
                            <i class="bi bi-file-text me-1"></i> RFC
                        </label>
                        <input type="text" class="form-control" name="rfc" id="rfc" placeholder="Ingrese RFC">
                    </div>
    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="rfc_corto" class="form-label">
                            <i class="bi bi-file-earmark-text me-1"></i> RFC Corto
                        </label>
                        <input type="text" class="form-control" name="rfc_corto" id="rfc_corto" placeholder="Ingrese RFC corto">
                    </div>     
    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="n_empleado" class="form-label">
                            <i class="bi bi-person-badge me-1"></i> Número de empleado
                        </label>
                        <input type="text" class="form-control" name="n_empleado" id="n_empleado" placeholder="Ingrese número de empleado">
                    </div>
                    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="puesto" class="form-label">
                            <i class="bi bi-briefcase me-1"></i> Puesto
                        </label>
                        <select class="contenedor-input form-select" name="puesto" id="puesto" aria-label="Default select example">
                        </select> 
                    </div> 
    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="area" class="form-label">
                            <i class="bi bi-diagram-3 me-1"></i> Área
                        </label>
                        <select class="contenedor-input form-select" name="area" id="area" aria-label="Default select example">
                        </select> 
                    </div> 
                    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="departamento" class="form-label">
                            <i class="bi bi-building me-1"></i> Departamento
                        </label>
                        <select class="contenedor-input form-select" name="departamento" id="departamento" aria-label="Default select example">
                            <option value="" selected>Seleccione el departamento</option>
                        </select>  
                    </div> 
    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="btn-obtener-resguardos" class="form-label">
                            <i class="bi bi-pc-display me-1"></i> Equipo de cómputo
                        </label>
                        <button type="button" id="btn-obtener-resguardos" class="form-control text-start btn-resguardo" placeholder="Presiona para ver resguardos" data-bs-toggle="modal" data-bs-target="#buscar-resguardo">
                            <i class="bi bi-search me-2"></i> Seleccionar resguardo
                        </button> 
                    </div>  
    
                    <div class="contenedor-input ms-4 mb-3"></div>  
                    
                    <div class="contenedor-boton ms-4 mb-4">
                        <button id="btn-modificar-usuario" type="button" class="btn btn-warning boton">
                            <i class="bi bi-check-circle me-2"></i> Modificar información
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="contenedor-baja-usuario" class="container">
    <div class="">        
        <div id="informacion-usuario" class="container-fluid">
            <h3 class="mb-2 tituloInformacion text-center">
                <i class="bi bi-person-fill me-2"></i> Datos del usuario
            </h3>
            <table class="table">
                <thead>
                    <tr>
                        <td scope="row"><b><i class="bi bi-person me-1"></i> Nombre</b></td>
                        <td><b><i class="bi bi-card-text me-1"></i> Apellidos</b></td>
                        <td><b><i class="bi bi-person-badge me-1"></i> No. Empleado</b></td>
                        <td><b><i class="bi bi-file-text me-1"></i> RFC</b></td>
                        <td><b><i class="bi bi-file-earmark-text me-1"></i> RFC Corto</b></td>
                        <td><b><i class="bi bi-briefcase me-1"></i> Puesto</b></td>
                        <td><b><i class="bi bi-diagram-3 me-1"></i> Area</b></td>
                        <td><b><i class="bi bi-building me-1"></i> Departamento</b></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="nombre-usuario"></td>
                        <td id="apellidos-usuario"></td>
                        <td id="nEmpleado-usuario"></td>
                        <td id="rfc-usuario"></td>
                        <td id="rfc-corto-usuario"></td>
                        <td id="puesto-empleado"></td>
                        <td id="area-usuario"></td>
                        <td id="departamento-usuario"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <form action="" class="mt-4" id="formulario-baja-usuario">
            <div class="row">
                <div class="col d-flex flex-wrap justify-content-start">
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="descripcion" class="form-label">
                            <i class="bi bi-chat-left-text me-1"></i> Motivo de baja
                        </label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Ingrese el motivo de la baja"></textarea>
                    </div>
    
                    <div class="contenedor-input ms-4 mb-3"></div>  
                    
                    <div class="contenedor-boton ms-4 mb-4">
                        <button id="btn-baja-usuario" type="button" class="btn btn-danger boton">
                            <i class="bi bi-person-x me-2"></i> Dar de baja usuario
                        </button>
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
                <h5 class="modal-title" id="staticBackdropLabel">
                    <i class="bi bi-pc-display-horizontal me-2"></i> Selecciona el resguardo del usuario
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body b-buscar">
                <div class="mb-3">
                    <button id="btn-sin-resguardo" class="btn btn-primary">
                        <i class="bi bi-slash-circle me-2"></i> Sin resguardo
                    </button>
                </div>
                <table id="tablaResguardos" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"><i class="bi bi-123 me-1"></i> Número de serie</th>
                            <th scope="col"><i class="bi bi-tag me-1"></i> Marca</th>
                            <th scope="col"><i class="bi bi-pc me-1"></i> Hostname</th>
                            <th scope="col"><i class="bi bi-ethernet me-1"></i> Mac</th>
                            <th scope="col"><i class="bi bi-check-circle me-1"></i> Seleccionar</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>