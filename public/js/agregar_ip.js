let tablaResguaros;
let id_resguardo = null;
let btn_seleccionar_resguardo;
let modalObtenerResguardo;

const tabla_Resguardos = document.getElementById('tablaResguardos');
const btn_obtener_resguardos = document.getElementById('btn-obtener-resguardos');
const modal = document.getElementById('buscar-resguardo');
const btn_agregar_ip = document.getElementById('btn-agregar-ip');
const formulario_agregar_ip = document.getElementById('formulario-agregar-ip');

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

const agregar_nueva_ip = () => {
    console.log(id_resguardo);
    
    let data = new FormData(document.getElementById('formulario-agregar-ip'));
    data.append('id_resguaro',id_resguardo);
    data.append('metodo','agregar_nueva_ip');
    fetch("app/controller/home.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({title: `${respuesta[1]}`,icon: "success"});
            formulario_agregar_ip.reset();
            btn_obtener_resguardos.textContent = 'Equipos de computo';
            id_resguardo = null;
        }else {
            Swal.fire({title: `${respuesta[1]}`,icon: "error"});
        }
    })
}

tabla_Resguardos.addEventListener('click', (e) => {
    btn_seleccionar_resguardo = e.target.closest(".seleccionar-resguardo"); 
    
    if (btn_seleccionar_resguardo) {
        id_resguardo = btn_seleccionar_resguardo.dataset.id;
        btn_obtener_resguardos.textContent = `${btn_seleccionar_resguardo.dataset.nserie}`;
        modalObtenerResguardo = bootstrap.Modal.getInstance(modal);
        if (modalObtenerResguardo) modalObtenerResguardo.hide();
    }
});

btn_agregar_ip.addEventListener('click', () => agregar_nueva_ip());

document.addEventListener('DOMContentLoaded', () => obtener_resguaros_para_asignar_ip());
