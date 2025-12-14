<div class="container">
    <h3>Consultar usuarios</h3>
    <form action="" id="form-consultar-usuarios" class="d-flex">

        <div class="contenedor-input ms-4 mb-3">
            <label for="area" class="form-label">Buscar por area</label>
            <select class="contenedor-input form-select" name="area" id="area" aria-label="Default select example">
                <option value="" selected>Seleccione el area</option>
            </select> 
        </div> 

        <div class="contenedor-input ms-4 mb-3">
            <label for="departamento" class="form-label">Buscar por departamento</label>
            <select class="contenedor-input form-select" name="departamento" id="departamento" aria-label="Default select example">
                <option value="" selected>Seleccione el departamento</option>
            </select>  
        </div> 

        <div class="contenedor-input ms-4 mb-3">
            <label for="puesto" class="form-label">Buscar por puesto</label>
            <select class="contenedor-input form-select" name="puesto" id="puesto" aria-label="Default select example">
                <option value="" selected>Seleccione el puesto</option>
            </select> 
        </div> 

        <div class="contenedor-boton mt-3 ms-4 d-flex align-items-center">
            <button id="buscar-usuario" class="btn btn-info" type="button">Buscar</button>
        </div>
    </form>

    <div class="ms-4" id="btns_exportar">
        <button id="exportar_excel" class="btn btn-success me-2" type="button">Excel</button>
        <button id="exportar_pdf" class="btn btn-danger" type="button">PDF</button>
    </div>

    <table id="tablaUsuarios" class="table">
        <thead>
            <tr class="header-tabla">
                <th scope="col" class="border border-white">RFC Corto</th>
                <th scope="col" class="border border-white">Nombre</th>
                <th scope="col" class="border border-white">Apellidos</th>
                <th scope="col" class="border border-white">No. Empleado</th>
                <th scope="col" class="border border-white">Puesto</th>
                <th scope="col" class="border border-white">Area</th>
                <th scope="col" class="border border-white">Departamento</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>