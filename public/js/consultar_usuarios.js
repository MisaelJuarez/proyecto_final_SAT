let tablaUsuarios;

let optionsAreas = '<option value="" selected>Todas las areas</option>';
let optionsPuestos = '<option value="" selected>Todos los puestos</option>';
let optionsDepatamentos = '<option value="" selected>Todos los departamentos</option>';

const area = document.getElementById('area');
const puesto = document.getElementById('puesto');
const departamento = document.getElementById('departamento');

const buscar_usuario = document.getElementById('buscar-usuario');
const btns_exportar = document.getElementById('btns_exportar');
const exportar_excel = document.getElementById('exportar_excel');
const exportar_pdf = document.getElementById('exportar_pdf');

const obtener_info_tabla = (tabla,options,id_campo,nombre_campo,etiqueta,condicion,area) => {
    let data = new FormData();
    data.append('condicion',condicion);
    data.append('area',area) 
    data.append('tabla',tabla);
    data.append('metodo','obtener_informacion_tabla');
    fetch("app/controller/home.php",{
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        respuesta.map(campo => {
            options += `
                <option value="${campo[id_campo]}">${campo[nombre_campo]}</option>
            `;
        });
        etiqueta.innerHTML = options;
    });
}

const consultar_usuarios = () => {
    let data = new FormData(document.getElementById('form-consultar-usuarios'));
    data.append('metodo', 'consultar_usuarios');
    fetch("app/controller/home.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {     
        if (tablaUsuarios) {
            tablaUsuarios.clear().rows.add(respuesta).draw(); 
        } else {
            tablaUsuarios = $('#tablaUsuarios').DataTable({
                data: respuesta, 
                columns: [
                    { data: 'rfc_corto', className: "border border-dark" }, 
                    { data: 'nombre', className: "border border-dark" }, 
                    { data: 'apellidos', className: "border border-dark" }, 
                    { data: 'n_empleado', className: "border border-dark" }, 
                    { data: 'nombre_puesto', className: "border border-dark" }, 
                    { data: 'nombre_area', className: "border border-dark"}, 
                    { data: 'nombre_departamento', className: "border border-dark"}, 
                ],
                "lengthChange": false,
                "pageLength": 5,
                "searching": false,
                language: { url: "./public/json/lenguaje.json" },
            });
        }
    });
}

area.addEventListener('change', (e) => {
    if (area.value != '') {
        obtener_info_tabla('departamentos',optionsDepatamentos,'id_departamento','nombre_departamento',departamento,1,area.value);
    } else {
        departamento.value = '';
        departamento.innerHTML = '<option value="" selected>Seleccione el departamento</option>'
    }
});

buscar_usuario.addEventListener('click', () => {
    btns_exportar.style.display = 'block';
    consultar_usuarios();
});

exportar_excel.addEventListener('click', () => {
    window.open(`./views/exportar_excel.php?area=${area.value}&departamento=${departamento.value}&puesto=${puesto.value}&metodo=consultar_usuarios`);
});

exportar_pdf.addEventListener('click', () => {
    window.open(`./views/imprimir.php?area=${btoa(area.value)}&departamento=${btoa(departamento.value)}&puesto=${puesto.value}&metodo=${btoa('consultar_usuarios')}`, "_blank");
});

document.addEventListener('DOMContentLoaded',() => {
    btns_exportar.style.display = 'none';
    obtener_info_tabla('areas',optionsAreas,'id_area','nombre_area',area,2,'');
    obtener_info_tabla('puestos',optionsPuestos,'id_puesto','nombre_puesto',puesto,2,'');
});