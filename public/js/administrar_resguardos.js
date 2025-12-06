let tablaIps;
let tablaResguardos;
let id_ip = null;
let btn_seleccionar_ip;
let btn_obtener_info_modificar_resguardo;
let id_resguardo_modificar;
let modalObtenerip;

const modal = document.getElementById('buscar-ips');
const tabla_de_info_resguardos = document.getElementById('tabla-de-info-resguardos');
const contenedor_modificar_resguardos = document.getElementById('contenedor_modificar_resguardos');
const tabla_Ips = document.getElementById('tablaIps');
const tabla_resguardos = document.getElementById('tablaResguardos');
const btn_sin_ip = document.getElementById('btn-sin-ip');

const marca = document.getElementById('marca');
const modelo = document.getElementById('modelo');
const n_serie = document.getElementById('n_serie');
const hostname = document.getElementById('hostname');
const mac = document.getElementById('mac');
const nodo = document.getElementById('nodo');
const btn_obtener_ips = document.getElementById('btn-obtener-ips');

const btn_modificar_resguardo = document.getElementById('btn-modificar-resguardo');

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

const obtener_datos_resguardos = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_datos_resguardos');
    fetch("app/controller/home.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {     
        if (tablaResguardos) {
            tablaResguardos.clear().rows.add(respuesta).draw(); 
        } else {
            tablaResguardos = $('#tablaResguardos').DataTable({
                data: respuesta, 
                columns: [
                    { data: 'marca', className: "border border-dark" }, 
                    { data: 'modelo', className: "border border-dark" }, 
                    { data: 'n_serie', className: "border border-dark" }, 
                    { data: 'hostname', className: "border border-dark" }, 
                    { data: 'mac', className: "border border-dark" }, 
                    { data: 'nodo', className: "border border-dark" }, 
                    { data: 'ip_numero', className: "border border-dark"}, 
                    {
                        data: 'id_resguardo',
                        className: "text-center border border-dark",
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-warning modificar-resguardo"
                                    data-id="${data}"
                                >
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            `;
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

const obtener_datos_resguardo_modificar = (id) => {
    let data = new FormData();
    data.append('id',id); 
    data.append('metodo','obtener_datos_resguardo_modificar');
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
        hostname.value = respuesta['hostname'];
        mac.value = respuesta['mac'];
        nodo.value = respuesta['nodo'];
        btn_obtener_ips.textContent = (respuesta['ip_numero'] == null) ? 'Selecciona la ip' : respuesta['ip_numero'];
        id_ip = respuesta['ip'];
    });
}

const modificar_informacion_resguardo = () => {
    let data = new FormData(document.getElementById('formulario-modificar-reguardo'));
    data.append('id',id_resguardo_modificar);
    data.append('id_ip',id_ip);
    data.append('metodo','modificar_informacion_resguardo');
    fetch("app/controller/home.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({icon: "success",title:`${respuesta[1]}`});
            contenedor_modificar_resguardos.style.display = "none";
            tabla_de_info_resguardos.style.display = "block";
            obtener_datos_resguardos();
        } else {
            Swal.fire({icon: "error",title:`${respuesta[1]}`});
        }
    });
}

tabla_Ips.addEventListener('click', (e) => {
    btn_seleccionar_ip = e.target.closest(".seleccionar-ip"); 

    if (btn_seleccionar_ip) {
        id_ip = btn_seleccionar_ip.dataset.id;
        btn_obtener_ips.textContent = btn_seleccionar_ip.dataset.ip;
        modalObtenerip = bootstrap.Modal.getInstance(modal);
        if (modalObtenerip) modalObtenerip.hide();
    }
});

tabla_resguardos.addEventListener('click', (e) => {
    btn_obtener_info_modificar_resguardo = e.target.closest(".modificar-resguardo");
    if (btn_obtener_info_modificar_resguardo) {
        tabla_de_info_resguardos.style.display = 'none';
        contenedor_modificar_resguardos.style.display = 'block';
        id_resguardo_modificar = btn_obtener_info_modificar_resguardo.dataset.id;
        console.log('ID RESGUARDO', id_resguardo_modificar);
        obtener_datos_resguardo_modificar(btn_obtener_info_modificar_resguardo.dataset.id);
    }
});

btn_sin_ip.addEventListener('click', () => {
    id_ip = null;
    btn_obtener_ips.textContent = 'Seleccione la ip del equipo';
    modalObtenerip = bootstrap.Modal.getInstance(modal);
    if (modalObtenerip) modalObtenerip.hide();
});

btn_modificar_resguardo.addEventListener('click', () => {
    modificar_informacion_resguardo();
});

document.addEventListener('DOMContentLoaded', () => {
    contenedor_modificar_resguardos.style.display = 'none';
    obtener_ips();
    obtener_datos_resguardos();
});
