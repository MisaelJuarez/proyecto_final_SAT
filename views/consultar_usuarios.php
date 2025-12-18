<div class="container">
    <h3 class="text-center mb-4">
        <i class="bi bi-search me-2"></i> Consultar usuarios
    </h3>
    
    <!-- Formulario de búsqueda -->
    <form action="" id="form-consultar-usuarios" class="row justify-content-center mb-4">
        <div class="col-md-4 col-lg-3 mb-3">
            <div class="contenedor-input">
                <label for="area" class="form-label text-center d-block">
                    <i class="bi bi-diagram-3 me-1"></i> Buscar por área
                </label>
                <select class="form-select text-center" name="area" id="area" aria-label="Default select example">
                    <option value="" selected class="text-center">Seleccione el área</option>
                </select> 
            </div>
        </div>

        <div class="col-md-4 col-lg-3 mb-3">
            <div class="contenedor-input">
                <label for="departamento" class="form-label text-center d-block">
                    <i class="bi bi-building me-1"></i> Buscar por departamento
                </label>
                <select class="form-select text-center" name="departamento" id="departamento" aria-label="Default select example">
                    <option value="" selected class="text-center">Seleccione el departamento</option>
                </select>  
            </div>
        </div>

        <div class="col-md-4 col-lg-3 mb-3">
            <div class="contenedor-input">
                <label for="puesto" class="form-label text-center d-block">
                    <i class="bi bi-briefcase me-1"></i> Buscar por puesto
                </label>
                <select class="form-select text-center" name="puesto" id="puesto" aria-label="Default select example">
                    <option value="" selected class="text-center">Seleccione el puesto</option>
                </select> 
            </div>
        </div>

        <div class="col-12 col-md-4 col-lg-3 mb-3 d-flex align-items-center justify-content-center">
            <div class="contenedor-boton">
                <button id="buscar-usuario" class="btn btn-buscar w-100" type="button">
                    <i class="bi bi-search me-2"></i> Buscar
                </button>
            </div>
        </div>
    </form>

    <!-- Botones de exportación -->
    <div class="text-center mb-4" id="btns_exportar">
        <button id="exportar_excel" class="btn btn-excel me-2" type="button">
            <i class="bi bi-file-earmark-excel me-1"></i> Excel
        </button>
        <button id="exportar_pdf" class="btn btn-pdf" type="button">
            <i class="bi bi-file-earmark-pdf me-1"></i> PDF
        </button>
    </div>

    <!-- Tabla de resultados -->
    <div class="table-responsive">
        <table id="tablaUsuarios" class="table table-sm table-hover">
            <thead>
                <tr class="header-tabla">
                    <th scope="col" class="text-center py-2">
                        <i class="bi bi-file-earmark-text me-1"></i> RFC Corto
                    </th>
                    <th scope="col" class="text-center py-2">
                        <i class="bi bi-person me-1"></i> Nombre
                    </th>
                    <th scope="col" class="text-center py-2">
                        <i class="bi bi-card-text me-1"></i> Apellidos
                    </th>
                    <th scope="col" class="text-center py-2">
                        <i class="bi bi-person-badge me-1"></i> No. Emp
                    </th>
                    <th scope="col" class="text-center py-2">
                        <i class="bi bi-briefcase me-1"></i> Puesto
                    </th>
                    <th scope="col" class="text-center py-2">
                        <i class="bi bi-diagram-3 me-1"></i> Area
                    </th>
                    <th scope="col" class="text-center py-2">
                        <i class="bi bi-building me-1"></i> Depto
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>