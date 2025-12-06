let tablaIps;
let id_ip = null;
let btn_seleccionar_ip;
let optionsAreas = '<option value="" selected>Seleccione el area</option>';
let optionsDepatamentos = '<option value="" selected>Seleccione el departamento</option>';
let modalObtenerip;

const modal = document.getElementById('buscar-ips');
const btn_obtener_ips = document.getElementById('btn-obtener-ips');
const area = document.getElementById('area');
const departamento = document.getElementById('departamento');
const tabla_Ips = document.getElementById('tablaIps');
const btn_agregar_impresora = document.getElementById('btn-agregar-impresora');
const formulario_agregar_impresora = document.getElementById('formulario-agregar-impresora');

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

const obtener_ips = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_ips');
    fetch("app/controller/home.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        if (tablaIps) {
            tablaIps.clear().rows.add(respuesta).draw(); 
        } else {
            tablaIps = $('#tablaIps').DataTable({
                data: respuesta, 
                columns: [
                    { data: 'ip' }, 
                    {
                        data: 'id_ip',
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-info seleccionar-ip" 
                                    data-id="${data}"  
                                    data-ip="${row.ip}"  
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

const agregar_nueva_impresora = () => {
    let data = new FormData(document.getElementById('formulario-agregar-impresora'));
    data.append('id_ip',id_ip);
    data.append('metodo','agregar_nueva_impresora');
    fetch("app/controller/home.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({title: `${respuesta[1]}`,icon: "success"});
            formulario_agregar_impresora.reset();
            btn_obtener_ips.textContent = 'Selecciona la ip';
            id_ip = null;
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

tabla_Ips.addEventListener('click', (e) => {
    btn_seleccionar_ip = e.target.closest(".seleccionar-ip"); 

    if (btn_seleccionar_ip) {
        id_ip = btn_seleccionar_ip.dataset.id;
        btn_obtener_ips.textContent = btn_seleccionar_ip.dataset.ip;
        modalObtenerip = bootstrap.Modal.getInstance(modal);
        if (modalObtenerip) modalObtenerip.hide();
        console.log(id_ip);
    }
});

btn_agregar_impresora.addEventListener('click', () => {
    agregar_nueva_impresora();
});

document.addEventListener('DOMContentLoaded', () => {
    obtener_info_tabla('areas',optionsAreas,'id_area','nombre_area',area,2,'');
    obtener_ips();
});