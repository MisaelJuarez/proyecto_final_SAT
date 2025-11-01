<div class="container">
    <h3>Actualiza tu informacion</h3>
    <form action="" class="mt-4" id="formulario-actualizar-informacion">
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
                    <label for="password" class="form-label">Ingrese su contraseña</label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Ingrese su contraseña">
                </div>    
                
                <select class="contenedor-input ms-4 mb-4 form-select" id="area" name="area" aria-label="Default select example">
                    <option selected>Ingrese el area que pertenece</option>
                    <option value="1">----</option>
                    <option value="2">......</option>
                </select>  

                <select class="contenedor-input ms-4 mb-4 form-select" id="tipo" name="tipo" aria-label="Default select example">
                    <option selected>Ingrese el tipo de usuario</option>
                    <option value="1">Administrador</option>
                    <option value="2">Usuario</option>
                </select>  

                <div class="contenedor-boton ms-4 mb-4">
                    <button id="btn-actualizar-informacion" type="button" class="btn btn-info boton">Actualizar informacion</button>
                </div>

            </div>
        </div>
    </form>
</div>