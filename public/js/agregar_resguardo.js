let tablaIps;
let id_ip = null;
let btn_seleccionar_ip;
let modalObtenerip;

const modal = document.getElementById('buscar-ips');
const btn_obtener_ips = document.getElementById('btn-obtener-ips');
const tabla_Ips = document.getElementById('tablaIps');
const btn_agregar_resguardo = document.getElementById('btn-agregar-resguardo');

const formulario_agregar_resguardo = document.getElementById('formulario-agregar-reguardo');

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

const agregar_nuevo_resguardo = () => {
    console.log('ID IP: ',id_ip);
    let data = new FormData(document.getElementById('formulario-agregar-reguardo'));
    data.append('id_ip',id_ip);
    data.append('metodo','agregar_nuevo_resguardo');
    fetch("app/controller/home.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({title: `${respuesta[1]}`,icon: "success"});
            formulario_agregar_resguardo.reset();
            btn_obtener_ips.textContent = 'Selecciona la ip';
            id_ip = null;
        }else {
            Swal.fire({title: `${respuesta[1]}`,icon: "error"});
        }
    })
}

tabla_Ips.addEventListener('click', (e) => {
    btn_seleccionar_ip = e.target.closest(".seleccionar-ip"); 

    if (btn_seleccionar_ip) {
        console.log(btn_seleccionar_ip.dataset.id);
        console.log(btn_seleccionar_ip.dataset.ip);
        id_ip = btn_seleccionar_ip.dataset.id;
        btn_obtener_ips.textContent = btn_seleccionar_ip.dataset.ip;
        modalObtenerip = bootstrap.Modal.getInstance(modal);
        if (modalObtenerip) modalObtenerip.hide();
    }
});

btn_agregar_resguardo.addEventListener('click', () => agregar_nuevo_resguardo());

document.addEventListener('DOMContentLoaded', () => obtener_ips());