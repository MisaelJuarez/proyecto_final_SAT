let tablaIps;
let tablaImpresoras;
let btn_info_impresora;
let id_impresora_modificar;
let id_ip = null;
let btn_seleccionar_ip;
let modalObtenerip;

const modal = document.getElementById('buscar-ips');
const tabla_de_info_impresoras = document.getElementById('tabla-de-info-impresoras');
const tabla_impresoras = document.getElementById('tablaImpresoras');
const contenedor_modificar_impresoras = document.getElementById('contenedor_modificar_impresoras');
const tabla_Ips = document.getElementById('tablaIps');
const btn_sin_ip = document.getElementById('btn-sin-ip');

let optionsAreas = '<option value="" selected>Seleccione el area</option>';
let optionsDepatamentos = '<option value="" selected>Seleccione el departamento</option>';

const marca = document.getElementById('marca');
const modelo = document.getElementById('modelo');
const n_serie = document.getElementById('n_serie');
const area = document.getElementById('area');
const departamento = document.getElementById('departamento');
const nodo = document.getElementById('nodo');
const btn_obtener_ips = document.getElementById('btn-obtener-ips');
const btn_modificar_impresora = document.getElementById('btn-modificar-impresora');

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

const obtener_datos_impresoras = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_datos_impresoras');
    fetch("app/controller/home.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {     
        if (tablaImpresoras) {
            tablaImpresoras.clear().rows.add(respuesta).draw(); 
        } else {
            tablaImpresoras = $('#tablaImpresoras').DataTable({
                data: respuesta, 
                columns: [
                    { data: 'marca', className: "border border-dark" }, 
                    { data: 'modelo', className: "border border-dark" }, 
                    { data: 'n_serie', className: "border border-dark" }, 
                    { data: 'nombre_area', className: "border border-dark" }, 
                    { data: 'nombre_departamento', className: "border border-dark" }, 
                    { data: 'ip', className: "border border-dark" }, 
                    { data: 'nodo', className: "border border-dark"},   
                    {
                        data: 'id_impresora',
                        className: "text-center border border-dark",
                        render: function(data, type, row) {
                            return `<button class="btn btn-warning info-impresora" data-id="${data}"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    `
                        }
                    },
                    {
                        data: 'id_impresora',
                        className: "text-center border border-dark",
                        render: function(data, type, row) {
                            return `<button class="btn btn-danger info-usuario" data-id="${data}"
                                    >
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                    `
                        }
                    }
                ],
                "lengthChange": false,
                "pageLength": 5,
                language: { url: "./public/json/lenguaje.json" },
                dom: '<"custom-toolbar"lf>tip', 
            });
        }
    });
}

const obtener_datos_impresora_modificar = (id) => {
    let data = new FormData();
    data.append('id',id); 
    data.append('metodo','obtener_datos_impresora_modificar');
    fetch("app/controller/home.php",{
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        console.log(respuesta);  
        marca.value = respuesta['marca'];
        modelo.value = respuesta['modelo'];
        n_serie.value = respuesta['n_serie'];
        nodo.value = respuesta['nodo'];
        btn_obtener_ips.textContent = (respuesta['ip'] == null) ? 'Selecciona la ip' : respuesta['ip'];
        area.value = respuesta['area'];
        setTimeout(() => area.dispatchEvent(new Event('change')), 10);
        setTimeout(() => departamento.value = respuesta['departamento'], 100);
        id_ip = respuesta['ip_impresora'];
    });
}

const modificar_informacion_impresora = () => {
    let data = new FormData(document.getElementById('formulario-modificar-impresora'));
    data.append('id',id_impresora_modificar);
    data.append('id_ip',id_ip);
    data.append('metodo','modificar_informacion_impresora');
    fetch("app/controller/home.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({icon: "success",title:`${respuesta[1]}`});
            contenedor_modificar_impresoras.style.display = "none";
            tabla_de_info_impresoras.style.display = "block";
            obtener_datos_impresoras();
        } else {
            Swal.fire({icon: "error",title:`${respuesta[1]}`});
        }
    });
}

area.addEventListener('change', (e) => {
    if (e.target.value != '') {
        obtener_info_tabla('departamentos',optionsDepatamentos,'id_departamento','nombre_departamento',departamento,1,e.target.value);
    } else {
        departamento.value = '';
        departamento.innerHTML = '<option value="" selected>Seleccione el departamento</option>'
    }
});

tabla_impresoras.addEventListener('click', (e) => {
    btn_info_impresora = e.target.closest(".info-impresora");

    if (btn_info_impresora) {
        tabla_de_info_impresoras.style.display = 'none';
        contenedor_modificar_impresoras.style = 'block'
        id_impresora_modificar = btn_info_impresora.dataset.id;
        obtener_datos_impresora_modificar(btn_info_impresora.dataset.id);
        console.log(btn_info_impresora.dataset.id);
    }
});

tabla_Ips.addEventListener('click', (e) => {
    btn_seleccionar_ip = e.target.closest(".seleccionar-ip"); 

    if (btn_seleccionar_ip) {
        id_ip = btn_seleccionar_ip.dataset.id;
        btn_obtener_ips.textContent = btn_seleccionar_ip.dataset.ip;
        modalObtenerip = bootstrap.Modal.getInstance(modal);
        if (modalObtenerip) modalObtenerip.hide();
    }
});

btn_sin_ip.addEventListener('click', () => {
    id_ip = null;
    btn_obtener_ips.textContent = 'Seleccione la ip del equipo';
    modalObtenerip = bootstrap.Modal.getInstance(modal);
    if (modalObtenerip) modalObtenerip.hide();
});

btn_modificar_impresora.addEventListener('click', () => {
    modificar_informacion_impresora();
});

document.addEventListener('DOMContentLoaded',() => {
    contenedor_modificar_impresoras.style.display = 'none';
    obtener_info_tabla('areas',optionsAreas,'id_area','nombre_area',area,2,'');
    obtener_ips();
    obtener_datos_impresoras();
});