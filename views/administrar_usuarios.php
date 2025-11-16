<div id="tabla-de-admin-usuarios" class="container-fluid">
    <h3 class="mb-2 tituloTable">Administrar usuarios</h3>
    <table id="tablaUsuariosAdministrar" class="table">
        <thead>
            <tr class="header-tabla">
                <th scope="col" class="border border-white text-start">RFC Corto</th>
                <th scope="col" class="border border-white text-start">Nombre</th>
                <th scope="col" class="border border-white text-start">Apellidos</th>
                <th scope="col" class="border border-white text-start">No. Empleado</th>
                <th scope="col" class="border border-white text-start">Puesto</th>
                <th scope="col" class="border border-white text-start">Area</th>
                <th scope="col" class="border border-white text-start">Departamento</th>
                <th scope="col" class="border border-white text-start">N. Serie equipo</th>
                <th scope="col" class="border border-white text-start">Activo</th>
                <th scope="col" class="border border-white text-start">Modificar</th>
                <th scope="col" class="border border-white text-start">Baja</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div id="contenedor-modificar-usuario" class="container">
    <div class="">
        <h3>Modificar la informacion del usuario</h3>
        <form action="" class="mt-4" id="formulario-agregar-colaborador">
            <div class="row">
                <div class="col d-flex flex-wrap justify-content-start">
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="nombre" class="form-label">Ingrese su nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Ingrese su nombre">
                    </div>
                
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="apellidos" class="form-label">Ingrese sus apellidos</label>
                        <input type="text" class="form-control" name="apellidos" placeholder="Ingrese sus apellidos">
                    </div>    
    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="rfc" class="form-label">Ingrese su rfc</label>
                        <input type="text" class="form-control" name="rfc" placeholder="Ingrese su rfc">
                    </div>
    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="rfc_corto" class="form-label">Ingrese sus rfc corto</label>
                        <input type="text" class="form-control" name="rfc_corto" placeholder="Ingrese sus rfc corto">
                    </div>     
    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="usuario" class="form-label">Numero de empleado</label>
                        <input type="text" class="form-control" name="n_empleado" placeholder="Ingrese su nombre numero de empleado">
                    </div>
                    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="usuario" class="form-label">Ingrese el puesto</label>
                        <select class="contenedor-input form-select" name="puesto" id="puesto" aria-label="Default select example">
                        </select> 
                    </div> 
    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="usuario" class="form-label">Ingrese el area</label>
                        <select class="contenedor-input form-select" name="area" id="area" aria-label="Default select example">
                        </select> 
                    </div> 
                    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="usuario" class="form-label">Ingrese el departamento</label>
                        <select class="contenedor-input form-select" name="departamento" id="departamento" aria-label="Default select example">
                        </select>  
                    </div> 
    
                    <div class="contenedor-input ms-4 mb-3">
                        <label for="usuario" class="form-label">Ingrese el equipo de computo</label>
                        <select class="contenedor-input form-select" name="equipo_computo" id="equipo_computo" aria-label="Default select example">
                        </select>  
                    </div> 
    
                    <div class="contenedor-input ms-4 mb-3">
                    </div>  
                    
                    <div class="contenedor-boton ms-4 mb-4">
                        <button id="btn-agregar-colaborador" type="button" class="btn btn-warning boton">Modificar informacion</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>