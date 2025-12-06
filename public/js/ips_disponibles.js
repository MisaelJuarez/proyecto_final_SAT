let tablaIps;
let tablaResguaros;
let id_resguardo = null;
let id_ip = null;
let btn_ip_asignar;
let btn_seleccionar_resguardo;
let modalObtenerResguardo;

const modal = document.getElementById('buscar-resguardo');
const tabla_resguardos = document.getElementById('tablaResguardos');
const tabla_ips = document.getElementById('tablaIps');
const contenedor_asignar = document.getElementById('contenedor-asignar');
const tabla_de_info_ips = document.getElementById('tabla-de-info-ips');
const ip_seleccionada = document.getElementById('ip-seleccionada');
const btn_obtener_resguardos = document.getElementById('btn-obtener-resguardos');
const btn_asignar_ip = document.getElementById('btn-asignar-ip');

const obtener_resguaros_para_asignar_ip = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_resguaros_para_asignar_ip');
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
                    { data: 'hostname' }, 
                    { data: 'mac' }, 
                    {
                        data: 'id_resguardo',
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-info seleccionar-resguardo" 
                                    data-id="${data}"  
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

const obtener_ips_disponibles = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_ips_disponibles');
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
                    { data: 'ip', className: "border border-dark" }, 
                    {
                        data: 'id_ip',
                        className: "text-center border border-dark",
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-info asignar-ip"
                                    data-id="${data}"
                                    data-ip=${row.ip}
                                >
                                    <i class="bi bi-arrow-up-right-circle"></i>
                                </button>
                            `;
                        }
                    }
                ],
                "lengthChange": false,
                "pageLength": 7,
                language: { url: "./public/json/lenguaje.json" },
                dom: '<"custom-toolbar"lf>tip', 
            });
        }
    });
}

const asignar_ip_al_equipo = () => {
    let data = new FormData();
    data.append('id_ip',id_ip);
    data.append('id_resguaro',id_resguardo);
    data.append('metodo','asignar_ip_al_equipo');
    fetch("app/controller/home.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({title: `${respuesta[1]}`,icon: "success"});
            contenedor_asignar.style.display = 'none';
            tabla_de_info_ips.style.display = 'block';
            id_resguardo = null;
            id_ip = null;
            btn_obtener_resguardos.textContent = 'Equipos de computo';
            obtener_ips_disponibles();
            obtener_resguaros_para_asignar_ip();
        }else {
            Swal.fire({title: `${respuesta[1]}`,icon: "error"});
        }
    })
}

tabla_ips.addEventListener('click', (e) => {
    btn_ip_asignar = e.target.closest(".asignar-ip");

    if (btn_ip_asignar) {
        id_ip = btn_ip_asignar.dataset.id;
        tabla_de_info_ips.style.display = 'none';
        contenedor_asignar.style.display = 'block';
        ip_seleccionada.textContent = btn_ip_asignar.dataset.ip; 
    }
});

tabla_resguardos.addEventListener('click', (e) => {
    btn_seleccionar_resguardo = e.target.closest(".seleccionar-resguardo"); 
    
    if (btn_seleccionar_resguardo) {
        id_resguardo = btn_seleccionar_resguardo.dataset.id;
        modalObtenerResguardo = bootstrap.Modal.getInstance(modal);
        if (modalObtenerResguardo) modalObtenerResguardo.hide();
        btn_obtener_resguardos.textContent = `${btn_seleccionar_resguardo.dataset.nserie}`;
    }
});

btn_asignar_ip.addEventListener('click', () => {
    console.log('ID IP: ',id_ip);
    console.log('ID RESGUARDO: ',id_resguardo);
    asignar_ip_al_equipo();
});

document.addEventListener('DOMContentLoaded', () =>{
    contenedor_asignar.style.display = 'none';
    obtener_ips_disponibles();
    obtener_resguaros_para_asignar_ip();
});