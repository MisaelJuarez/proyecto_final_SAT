let tablaIps;
let btn_info_ip;
let btn_quitar_ip;

const tabla_ips = document.getElementById('tablaIps');
const tabla_de_info_ips = document.getElementById('tabla-de-info-ips');
const informacion_ip = document.getElementById('informacion-ip');

const marca_resguardo = document.getElementById('marca-resguardo');
const modelo_resguardo = document.getElementById('modelo-resguardo');
const n_serie_resguardo = document.getElementById('n-serie-resguardo');
const hostname_resguardo = document.getElementById('hostname-resguardo');
const mac_resguardo = document.getElementById('mac-resguardo');
const nodo_resguardo = document.getElementById('nodo-resguardo');
const ip_resguardo = document.getElementById('ip-resguardo');

const obtener_ips_en_uso = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_ips_en_uso');
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
                    { data: 'n_serie', className: "border border-dark" }, 
                    {
                        data: 'id_ip',
                        className: "text-center border border-dark",
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-success info-ip"
                                    data-id="${data}"
                                >
                                    <i class="bi bi-file-text"></i>
                                </button>
                            `;
                        }
                    },
                    {
                        data: 'id_ip',
                        className: "text-center border border-dark",
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-danger quitar-ip"
                                    data-id="${data}"
                                    data-resguardo="${row.id_resguardo}"
                                >
                                    <i class="bi bi-arrow-down-left-circle"></i>
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

const obtener_informacion_ip = (id) => {
    let data = new FormData();
    data.append('id',id);
    data.append('metodo','obtener_informacion_ip');
    fetch("app/controller/home.php",{
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {        
        marca_resguardo.textContent = respuesta['marca'];
        modelo_resguardo.textContent = respuesta['modelo'];
        n_serie_resguardo.textContent = respuesta['n_serie'];
        hostname_resguardo.textContent = respuesta['hostname'];
        mac_resguardo.textContent = respuesta['mac'];
        nodo_resguardo.textContent = respuesta['nodo'];;
        ip_resguardo.textContent = respuesta['ip_numero'];
    });
}

const retirar_ip_del_equipo = (id_ip,id_resguardo) => {
    console.log('ID IP: ',id_ip);
    console.log('ID RESGUARDO: ',id_resguardo);
    let data = new FormData();
    data.append('id_ip',id_ip);
    data.append('id_resguardo',id_resguardo);
    data.append('metodo','retirar_ip_del_equipo');
    fetch("app/controller/home.php",{
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async (respuesta) => { 
        if (respuesta[0] == 1) {
            await Swal.fire({title: `${respuesta[1]}`,text: "La ip ahora se encuentra disponible",icon: "success"});
            obtener_ips_en_uso();
        } else {
            await Swal.fire({title: `${respuesta[1]}`,text: "La ip ahora se encuentra disponible",icon: "error"});
        }
    });
}

tabla_ips.addEventListener('click', (e) => {
    btn_info_ip = e.target.closest('.info-ip');
    btn_quitar_ip = e.target.closest('.quitar-ip');

    if (btn_info_ip) {
        obtener_informacion_ip(btn_info_ip.dataset.id);
        tabla_de_info_ips.style.display = 'none';
        informacion_ip.style.display = 'block';
    }

    if (btn_quitar_ip) {
        Swal.fire({
            title: 'Retirar ip del equipo',
            text: "¿Está seguro de que desea retirar esa dirección IP del equipo?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, retirar ip",
            cancelButtonText: "Cancelar"
            }).then((result) => {
            if (result.isConfirmed) {
                retirar_ip_del_equipo(btn_quitar_ip.dataset.id,btn_quitar_ip.dataset.resguardo);
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', () =>{
    informacion_ip.style.display = 'none';
    obtener_ips_en_uso();
});