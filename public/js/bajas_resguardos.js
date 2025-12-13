let tablaResguardos;
let btn_info_resguardo_imprimir;

const tabla_de_info_resguardos = document.getElementById('tabla-de-info-resguardos');
const informacion_usuario = document.getElementById('informacion-usuario');

const nombre_usuario = document.getElementById('nombre-usuario');
const apellidos_usuario = document.getElementById('apellidos-usuario');
const nEmpleado_usuario = document.getElementById('nEmpleado-usuario');
const rfc_usuario = document.getElementById('rfc-usuario');
const rfc_corto_usuario = document.getElementById('rfc-corto-usuario');
const puesto_empleado = document.getElementById('puesto-empleado');
const area_usuario = document.getElementById('area-usuario');
const departamento_usuario = document.getElementById('departamento-usuario');

const marca_resguardo = document.getElementById('marca-resguardo');
const modelo_resguardo = document.getElementById('modelo-resguardo');
const n_serie_resguardo = document.getElementById('n-serie-resguardo');
const hostname_resguardo = document.getElementById('hostname-resguardo');
const mac_resguardo = document.getElementById('mac-resguardo');
const nodo_resguardo = document.getElementById('nodo-resguardo');
const ip_resguardo = document.getElementById('ip-resguardo');

const obtener_datos_resguardos_bajas = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_datos_resguardos_bajas');
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
                    { data: 'ip_ultimo_registro', className: "border border-dark"},   
                    {
                        data: 'id_resguardo',
                        className: "text-center border border-dark",
                        render: function(data, type, row) {

                            return (row.id_usuario == null) ? '<span class="badge bg-danger">Sin asignar</span>'
                                : 
                                `<button class="btn btn-success info-usuario" data-id="${row.id_usuario}"
                                 >
                                    <i class="bi bi-file-text"></i>
                                </button>
                                `

                        }
                    },
                    {
                        data: 'id_resguardo',
                        className: "text-center border border-dark",
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-success info-resguardo-imprimir"
                                    data-id="${data}"
                                >
                                    <i class="bi bi-printer-fill"></i>
                                </button>
                            `;
                        }
                    },
                    {
                        data: 'id_resguardo',
                        className: "text-center border border-dark",
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-danger eliminar-resguardo"
                                    data-id="${data}"
                                >
                                    <i class="bi bi-trash-fill"></i>
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

const mostrar_informacion_usuario = (id) => {
    let data = new FormData();
    data.append('id',id);
    data.append('metodo','mostrar_informacion_usuario');
    fetch("app/controller/home.php",{
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {        
        nombre_usuario.textContent = respuesta[0]['nombre'];
        apellidos_usuario.textContent = respuesta[0]['apellidos'];
        nEmpleado_usuario.textContent = respuesta[0]['n_empleado'];
        rfc_usuario.textContent = respuesta[0]['rfc'];
        rfc_corto_usuario.textContent = respuesta[0]['rfc_corto'];
        puesto_empleado.textContent = respuesta[0]['nombre_puesto'];
        area_usuario.textContent = respuesta[0]['nombre_area'];
        departamento_usuario.textContent = respuesta[0]['nombre_departamento'];

        marca_resguardo.textContent = respuesta[0]['marca'];
        modelo_resguardo.textContent = respuesta[0]['modelo'];
        n_serie_resguardo.textContent = respuesta[0]['n_serie'];
        hostname_resguardo.textContent = respuesta[0]['hostname'];
        mac_resguardo.textContent = respuesta[0]['mac'];
        nodo_resguardo.textContent = respuesta[0]['nodo'];
        ip_resguardo.textContent = respuesta[0]['ip_ultimo_registro'];        
    });
}

tabla_de_info_resguardos.addEventListener('click', (e) => {
    btn_info_usuario = e.target.closest(".info-usuario"); 
    btn_info_resguardo_imprimir = e.target.closest('.info-resguardo-imprimir');

    if (btn_info_usuario) {
        mostrar_informacion_usuario(btn_info_usuario.dataset.id);
        tabla_de_info_resguardos.style.display = 'none';
        informacion_usuario.style.display = 'block';
    }

    if (btn_info_resguardo_imprimir) {
        id_imprimir_usuario = btn_info_resguardo_imprimir.dataset.id;
        window.open(`./views/imprimir.php?registro=${btoa(id_imprimir_usuario)}&metodo=${btoa('imprimir_resguardo')}`, "_blank");
    }

});

document.addEventListener('DOMContentLoaded', () => {
    informacion_usuario.style.display = 'none';
    obtener_datos_resguardos_bajas();
});