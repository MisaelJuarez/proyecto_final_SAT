<div class="container">
    <h3>Agrega un nuevo colaborador</h3>
    <form action="" class="mt-4" id="formulario-agregar-colaborador">
        <div class="row">
            <div class="col d-flex flex-wrap justify-content-start">
                <div class="contenedor-input ms-4 mb-4">
                    <label for="nombre" class="form-label">Ingrese su nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Ingrese su nombre">
                </div>
            
                <div class="contenedor-input ms-4 mb-4">
                    <label for="apellidos" class="form-label">Ingrese sus apellidos</label>
                    <input type="text" class="form-control" name="apellidos" placeholder="Ingrese sus apellidos">
                </div>    

                <div class="contenedor-input ms-4 mb-4">
                    <label for="rfc" class="form-label">Ingrese su rfc</label>
                    <input type="text" class="form-control" name="rfc" placeholder="Ingrese su rfc">
                </div>

                <div class="contenedor-input ms-4 mb-4">
                    <label for="rfc_corto" class="form-label">Ingrese sus rfc corto</label>
                    <input type="text" class="form-control" name="rfc_corto" placeholder="Ingrese sus rfc corto">
                </div>    

                <div class="contenedor-input ms-4 mb-4">
                    <label for="usuario" class="form-label">Ingrese su nombre de usuario</label>
                    <input type="text" class="form-control" name="usuario" placeholder="Ingrese su nombre de usuario">
                </div>
                
                <div class="contenedor-input ms-4 mb-4">
                    <label for="correo" class="form-label">Ingrese su correo electronico</label>
                    <input type="email" class="form-control" name="correo" placeholder="Ingrese su correo">
                </div>

                <div class="contenedor-input ms-4 mb-4">
                    <label for="password" class="form-label">Ingrese su contraseña</label>
                    <input type="password" class="form-control" name="pass" placeholder="Ingrese su contraseña">
                </div>    
                
                <div class="contenedor-input ms-4 mb-4">
                    <label for="password" class="form-label">Ingrese el area que pertenece</label>
                    <select class="contenedor-input form-select" name="area" id="area" aria-label="Default select example">
                    </select> 
                </div>


                <select class="contenedor-input ms-4 mb-4 form-select" name="tipo" aria-label="Default select example">
                    <option selected>Ingrese el tipo de usuario</option>
                    <option value="1">Administrador</option>
                    <option value="2">Usuario</option>
                </select>  

                <div class="contenedor-input ms-4 mb-4">
                </div>

                <div class="contenedor-boton ms-4 mb-4">
                    <button id="btn-agregar-colaborador" type="button" class="btn btn-success boton">Agregar colaborador</button>
                </div>

            </div>
        </div>
    </form>
</div>