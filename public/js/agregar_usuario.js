let tablaResguaros;
let id_resguardo = null;
let btn_seleccionar_resguardo;
let modalObtenerResguardo;

let optionsAreas = '<option value="" selected>Seleccione el area</option>';
let optionsPuestos = '<option value="" selected>Seleccione el puesto</option>';
let optionsDepatamentos = '<option value="" selected>Seleccione el departamento</option>';

const area = document.getElementById('area');
const puesto = document.getElementById('puesto');
const departamento = document.getElementById('departamento');

const tabla_Resguardos = document.getElementById('tablaResguardos');
const btn_obtener_resguardos = document.getElementById('btn-obtener-resguardos');
const btn_agregar_usuario = document.getElementById('btn-agregar-usuario');

const formulario_agregar_usuario = document.getElementById('formulario-agregar-usuario');

const modal = document.getElementById('buscar-resguardo');

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

const obtener_resguaros = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_resguaros');
    fetch("app/controller/home.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        if (tablaResguaros) {
            tablaResguaros.clear().rows.add(respuesta).draw(); 
        } else {
            tablaResguaros = $('#tablaResguardos').DataTable({
                data: respuesta, 
                columns: [
                    { data: 'n_serie' }, 
                    { data: 'marca' }, 
                    { data: 'hostname' }, 
                    { data: 'mac' }, 
                    {
                        data: 'id_resguardo',
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-info seleccionar-resguardo" 
                                    data-id="${data}"  
                                    data-marca="${row.marca}" 
                                    data-nserie="${row.n_serie}" 
                                >
                                    Seleccionar
                                </button>
                            `;
                        }
                    }
                ],
                "lengthChange": false,
                "pageLength": 5,
                "info": false,
                language: { url: "./public/json/lenguaje.json" },
                dom: '<"custom-toolbar"lf>tip', 
                initComplete: () => {
                    $("div.custom-toolbar .dataTables_filter").prependTo(".custom-toolbar").addClass("left-section");
                }
            });
        }
    });
};

const agregar_nuevo_usuario = () => {
    let data = new FormData(document.getElementById('formulario-agregar-usuario'));
    data.append('id_resguaro',id_resguardo);
    data.append('metodo','agregar_nuevo_usuario');
    fetch("app/controller/home.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({title: `${respuesta[1]}`,icon: "success"});
            formulario_agregar_usuario.reset();
            btn_obtener_resguardos.textContent = 'Seleccionar resguardo';
            id_resguardo = null;
        }else {
            Swal.fire({title: `${respuesta[1]}`,icon: "error"});
        }
    })
}

area.addEventListener('change', (e) => {
    if (area.value != '') {
        obtener_info_tabla('departamentos',optionsDepatamentos,'id_departamento','nombre_departamento',departamento,1,area.value);
    } else {
        departamento.value = '';
        departamento.innerHTML = '<option value="" selected>Seleccione el departamento</option>'
    }
});

btn_obtener_resguardos.addEventListener('click', () => obtener_resguaros());

tabla_Resguardos.addEventListener('click', (e) => {
    btn_seleccionar_resguardo = e.target.closest(".seleccionar-resguardo"); 

    if (btn_seleccionar_resguardo) {
        id_resguardo = btn_seleccionar_resguardo.dataset.id;
        btn_obtener_resguardos.textContent = `${btn_seleccionar_resguardo.dataset.marca} | ${btn_seleccionar_resguardo.dataset.nserie}`;
        modalObtenerResguardo = bootstrap.Modal.getInstance(modal);
        if (modalObtenerResguardo) modalObtenerResguardo.hide();
    }
});

btn_agregar_usuario.addEventListener('click', () => agregar_nuevo_usuario());

document.addEventListener('DOMContentLoaded', () => {
    obtener_info_tabla('puestos',optionsPuestos,'id_puesto','nombre_puesto',puesto,2,'');
    obtener_info_tabla('areas',optionsAreas,'id_area','nombre_area',area,2,'');
});