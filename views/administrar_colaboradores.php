<div id="informacion-de-colaboradores" class="container">
    <h3 class="mb-4">Administrar colaboradores</h3>
    <table id="tablaColaboradores" class="table table-secondary table-striped p-5 mt-4">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Correo</th>
                <th scope="col">Area</th>
                <th scope="col">Rol</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div id="contenedor-editar-colaborador" class="container">
    <h3>Editar usuario</h3>
    <form action="" class="mt-4" id="formulario-editar-colaborador">
        <div class="row">
            <div class="col d-flex flex-wrap justify-content-start">
                <div class="contenedor-input ms-4 mb-4">
                    <label for="nombre" class="form-label">Ingrese su nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre">
                </div>
            
                <div class="contenedor-input ms-4 mb-4">
                    <label for="apellidos" class="form-label">Ingrese sus apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Ingrese sus apellidos">
                </div>    

                <div class="contenedor-input ms-4 mb-4">
                    <label for="rfc" class="form-label">Ingrese su rfc</label>
                    <input type="text" class="form-control" id="rfc" name="rfc" placeholder="Ingrese su rfc">
                </div>

                <div class="contenedor-input ms-4 mb-4">
                    <label for="rfc_corto" class="form-label">Ingrese sus rfc corto</label>
                    <input type="text" class="form-control" id="rfc_corto" name="rfc_corto" placeholder="Ingrese sus rfc corto">
                </div>    

                <div class="contenedor-input ms-4 mb-4">
                    <label for="usuario" class="form-label">Ingrese su nombre de usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese su nombre de usuario">
                </div>

                <div class="contenedor-input ms-4 mb-4">
                    <label for="correo" class="form-label">Ingrese su correo electronico</label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingrese su correo">
                </div>    
                
                <div class="contenedor-input ms-4 mb-4">
                    <label for="password" class="form-label">Ingrese su contraseña</label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Ingrese su contraseña">
                </div>    
                <div class="contenedor-input ms-4 mb-3">
                    <label for="departamento" class="form-label">Ingresa el area que pertenece</label>
                    <select class="contenedor-input form-select" name="area" id="area" aria-label="Default select example">
                    </select>  
                </div>

                <select class="contenedor-input ms-4 mb-4 form-select" id="tipo" name="tipo" aria-label="Default select example">
                    <option selected>Ingrese el tipo de usuario</option>
                    <option value="1">Administrador</option>
                    <option value="2">Usuario</option>
                </select>  
                
                <div class="contenedor-input ms-4 mb-3">
                </div>

                <div class="contenedor-boton ms-4 mb-4">
                    <button id="btn-editar-colaborador" type="button" class="btn btn-warning boton">Modificar informacion</button>
                </div>

            </div>
        </div>
    </form>
</div>