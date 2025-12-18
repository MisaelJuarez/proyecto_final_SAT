<div class="container">
    <h3 class="text-center">
        <i class="bi bi-person-plus-fill me-2"></i> Agrega un nuevo colaborador
    </h3>
    <form action="" class="mt-4" id="formulario-agregar-colaborador">
        <div class="row">
            <div class="col d-flex flex-wrap justify-content-between">
                <!-- Columna izquierda -->
                <div class="columna-formulario">
                    <div class="contenedor-input mb-3">
                        <label for="nombre" class="form-label">
                            <i class="bi bi-person-circle me-1"></i> Nombre
                        </label>
                        <input type="text" class="form-control" name="nombre" placeholder="Ingrese nombre">
                    </div>
                
                    <div class="contenedor-input mb-3">
                        <label for="apellidos" class="form-label">
                            <i class="bi bi-card-text me-1"></i> Apellidos
                        </label>
                        <input type="text" class="form-control" name="apellidos" placeholder="Ingrese apellidos">
                    </div>    

                    <div class="contenedor-input mb-3">
                        <label for="rfc" class="form-label">
                            <i class="bi bi-file-text me-1"></i> RFC
                        </label>
                        <input type="text" class="form-control" name="rfc" placeholder="Ingrese RFC">
                    </div>

                    <div class="contenedor-input mb-3">
                        <label for="rfc_corto" class="form-label">
                            <i class="bi bi-file-earmark-text me-1"></i> RFC Corto
                        </label>
                        <input type="text" class="form-control" name="rfc_corto" placeholder="Ingrese RFC corto">
                    </div>
                </div>

                <!-- Columna derecha -->
                <div class="columna-formulario">
                    <div class="contenedor-input mb-3">
                        <label for="usuario" class="form-label">
                            <i class="bi bi-person me-1"></i> Usuario
                        </label>
                        <input type="text" class="form-control" name="usuario" placeholder="Ingrese usuario">
                    </div>
                    
                    <div class="contenedor-input mb-3">
                        <label for="correo" class="form-label">
                            <i class="bi bi-envelope me-1"></i> Correo
                        </label>
                        <input type="email" class="form-control" name="correo" placeholder="Ingrese correo">
                    </div>

                    <div class="contenedor-input mb-3">
                        <label for="password" class="form-label">
                            <i class="bi bi-lock me-1"></i> Contraseña
                        </label>
                        <input type="password" class="form-control" name="pass" placeholder="Ingrese contraseña">
                    </div>    
                    
                    <div class="contenedor-input mb-3">
                        <label for="password" class="form-label">
                            <i class="bi bi-diagram-3 me-1"></i> Área
                        </label>
                        <select class="contenedor-input form-select" name="area" id="area" aria-label="Default select example">
                        </select> 
                    </div>

                    <div class="contenedor-input mb-3">
                        <label for="tipo" class="form-label">
                            <i class="bi bi-person-check me-1"></i> Tipo de usuario
                        </label>
                        <select class="contenedor-input form-select" name="tipo" aria-label="Default select example">
                            <option selected value="">Seleccione tipo</option>
                            <option value="1">
                                <i class="bi bi-shield-check me-1"></i> Administrador
                            </option>
                            <option value="2">
                                <i class="bi bi-person me-1"></i> Usuario
                            </option>
                        </select>  
                    </div>
                </div>

                <!-- Botón centrado -->
                <div class="col-12 mt-3 text-center">
                    <div class="contenedor-boton mx-auto">
                        <button id="btn-agregar-colaborador" type="button" class="btn boton">
                            <i class="bi bi-plus-circle me-2"></i> Agregar colaborador
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>