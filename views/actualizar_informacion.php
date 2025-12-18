<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <div class="form-header-spec">
                <div class="header-icon-spec">
                    <i class="bi bi-person-badge-fill"></i>
                </div>
                <h1 class="form-title-spec">Información Personal</h1>
                <p class="form-subtitle-spec">Visualizara los siguientes campos con su información personal en el sistema</p>
            </div>

            <div class="elegant-form-container-spec">
                <form action="" class="mt-3" id="formulario-actualizar-informacion">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group-elegant-spec">
                                <div class="input-label-container-spec">
                                    <i class="bi bi-person input-icon-spec"></i>
                                    <label for="nombre" class="form-label-elegant-spec">Nombre(s)</label>
                                </div>
                                <input type="text" class="form-control-elegant-spec" id="nombre" name="nombre" placeholder="Ingrese su(s) nombre(s)">
                                <div class="input-border-spec"></div>
                            </div>

                            <div class="form-group-elegant-spec">
                                <div class="input-label-container-spec">
                                    <i class="bi bi-card-text input-icon-spec"></i>
                                    <label for="rfc" class="form-label-elegant-spec">RFC</label>
                                </div>
                                <input type="text" class="form-control-elegant-spec" id="rfc" name="rfc" placeholder="Ingrese su RFC completo">
                                <div class="input-border-spec"></div>
                            </div>
                            <div class="form-group-elegant-spec">
                                <div class="input-label-container-spec">
                                    <i class="bi bi-person-circle input-icon-spec"></i>
                                    <label for="usuario" class="form-label-elegant-spec">Nombre de Usuario</label>
                                </div>
                                <input type="text" class="form-control-elegant-spec" id="usuario" name="usuario" placeholder="Ingrese su nombre de usuario">
                                <div class="input-border-spec"></div>
                            </div>
                            <div class="form-group-elegant-spec">
                                <div class="input-label-container-spec">
                                    <i class="bi bi-lock input-icon-spec"></i>
                                    <label for="password" class="form-label-elegant-spec">Contraseña</label>
                                </div>
                                <input type="password" class="form-control-elegant-spec" id="pass" name="pass" placeholder="Ingrese su nueva contraseña">
                                <div class="input-border-spec"></div>
                                <div class="password-toggle-spec">
                                    <i class="bi bi-eye toggle-password-spec"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group-elegant-spec">
                                <div class="input-label-container-spec">
                                    <i class="bi bi-person-lines-fill input-icon-spec"></i>
                                    <label for="apellidos" class="form-label-elegant-spec">Apellidos</label>
                                </div>
                                <input type="text" class="form-control-elegant-spec" id="apellidos" name="apellidos" placeholder="Ingrese sus apellidos">
                                <div class="input-border-spec"></div>
                            </div>

                            <div class="form-group-elegant-spec">
                                <div class="input-label-container-spec">
                                    <i class="bi bi-card-heading input-icon-spec"></i>
                                    <label for="rfc_corto" class="form-label-elegant-spec">RFC Corto</label>
                                </div>
                                <input type="text" class="form-control-elegant-spec" id="rfc_corto" name="rfc_corto" placeholder="Ingrese RFC corto">
                                <div class="input-border-spec"></div>
                            </div>
                            <div class="form-group-elegant-spec">
                                <div class="input-label-container-spec">
                                    <i class="bi bi-envelope input-icon-spec"></i>
                                    <label for="correo" class="form-label-elegant-spec">Correo Electrónico</label>
                                </div>
                                <input type="email" class="form-control-elegant-spec" id="correo" name="correo" placeholder="correo@ejemplo.com">
                                <div class="input-border-spec"></div>
                            </div>
                            <div class="form-group-elegant-spec">
                                <div class="input-label-container-spec">
                                    <i class="bi bi-building input-icon-spec"></i>
                                    <label for="area" class="form-label-elegant-spec">Área de Pertenencia</label>
                                </div>
                                <select class="form-control-elegant-spec" id="area" name="area">
                                    <option value="" disabled selected>Seleccione su área</option>
                                </select>
                                <div class="input-border-spec"></div>
                                <i class="bi bi-chevron-down select-arrow-spec"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-footer-spec mt-4 pt-3 border-top">
                        <div class="d-flex justify-content-center">
                            <button id="btn-actualizar-informacion" type="button" class="btn-elegant-spec btn-update-spec">
                                <i class="bi bi-check-circle me-2"></i>
                                <span>Guardar Información</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>