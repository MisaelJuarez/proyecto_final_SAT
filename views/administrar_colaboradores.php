<div id="informacion-de-colaboradores" class="container">
    <h3 class="mb-4 text-center">
        <i class="bi bi-people-fill me-2"></i> Administrar colaboradores
    </h3>
    <table id="tablaColaboradores" class="table table-striped p-5 mt-4">
        <thead>
            <tr>
                <th scope="col"><i class="bi bi-person me-1"></i> Nombre</th>
                <th scope="col"><i class="bi bi-person-vcard me-1"></i> Apellidos</th>
                <th scope="col"><i class="bi bi-envelope me-1"></i> Correo</th>
                <th scope="col"><i class="bi bi-building me-1"></i> Area</th>
                <th scope="col"><i class="bi bi-person-badge me-1"></i> Rol</th>
                <th scope="col"><i class="bi bi-gear me-1"></i> Acciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div id="contenedor-editar-colaborador" class="container">
    <h3 class="text-center">
        <i class="bi bi-pencil-square me-2"></i> Editar usuario
    </h3>
    <form action="" class="mt-4" id="formulario-editar-colaborador">
        <div class="row">
            <div class="col d-flex flex-wrap justify-content-start">
                <div class="contenedor-input ms-4 mb-4">
                    <label for="nombre" class="form-label">
                        <i class="bi bi-person-circle me-1"></i> Ingrese su nombre
                    </label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre">
                </div>
            
                <div class="contenedor-input ms-4 mb-4">
                    <label for="apellidos" class="form-label">
                        <i class="bi bi-card-text me-1"></i> Ingrese sus apellidos
                    </label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Ingrese sus apellidos">
                </div>    

                <div class="contenedor-input ms-4 mb-4">
                    <label for="rfc" class="form-label">
                        <i class="bi bi-file-text me-1"></i> Ingrese su rfc
                    </label>
                    <input type="text" class="form-control" id="rfc" name="rfc" placeholder="Ingrese su rfc">
                </div>

                <div class="contenedor-input ms-4 mb-4">
                    <label for="rfc_corto" class="form-label">
                        <i class="bi bi-file-earmark-text me-1"></i> Ingrese sus rfc corto
                    </label>
                    <input type="text" class="form-control" id="rfc_corto" name="rfc_corto" placeholder="Ingrese sus rfc corto">
                </div>    

                <div class="contenedor-input ms-4 mb-4">
                    <label for="usuario" class="form-label">
                        <i class="bi bi-person me-1"></i> Ingrese su nombre de usuario
                    </label>
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese su nombre de usuario">
                </div>

                <div class="contenedor-input ms-4 mb-4">
                    <label for="correo" class="form-label">
                        <i class="bi bi-envelope me-1"></i> Ingrese su correo electronico
                    </label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingrese su correo">
                </div>    
                
                <div class="contenedor-input ms-4 mb-4">
                    <label for="password" class="form-label">
                        <i class="bi bi-lock me-1"></i> Ingrese su contraseña
                    </label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Ingrese su contraseña">
                </div>    
                
                <div class="contenedor-input ms-4 mb-3">
                    <label for="departamento" class="form-label">
                        <i class="bi bi-diagram-3 me-1"></i> Ingresa el area que pertenece
                    </label>
                    <select class="contenedor-input form-select" name="area" id="area" aria-label="Default select example">
                    </select>  
                </div>

                <select class="contenedor-input ms-4 mb-4 form-select" id="tipo" name="tipo" aria-label="Default select example">
                    <option selected>
                        <i class="bi bi-person-check me-1"></i> Ingrese el tipo de usuario
                    </option>
                    <option value="1">
                        <i class="bi bi-shield-check me-1"></i> Administrador
                    </option>
                    <option value="2">
                        <i class="bi bi-person me-1"></i> Usuario
                    </option>
                </select>  
                
                <div class="contenedor-input ms-4 mb-3">
                </div>

                <div class="contenedor-boton ms-4 mb-4">
                    <button id="btn-editar-colaborador" type="button" class="btn btn-warning boton">
                        <i class="bi bi-check-circle me-2"></i> Modificar informacion
                    </button>
                </div>

            </div>
        </div>
    </form>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
