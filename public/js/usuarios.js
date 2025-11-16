let tablaUsuarios;
let btn_info_usuario;
const tabla_de_info_usuarios = document.getElementById('tabla-de-info-usuarios');
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

const obtener_datos_usuarios = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_datos_usuarios');
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
                    { data: 'n_serie', className: "border border-dark",
                        render: function(data, type, row) {
                            return (row.n_serie == null) ? '<span class="badge bg-danger">Sin equipo</span>' : row.n_serie;
                        }
                    }, 
                    { 
                        data: 'activo', className: "border border-dark text-center",
                        render: function(data, type, row) {
                            return (data == 1) ? '<i class="bi bi-check2 fs-4 text-success"></i>' : '<i class="bi bi-x-lg fs-4 text-danger"></i>';
                        }
                    }, 
                    {
                        data: 'id_usuario',
                        className: "text-center border border-dark",
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-success info-usuario"
                                    data-id="${data}"
                                    data-serie="${row.n_serie}"
                                >
                                    <i class="bi bi-file-text"></i>
                                </button>
                            `;
                        }
                    }
                ],
                "lengthChange": false,
                "pageLength": 6,
                language: { url: "./public/json/lenguaje.json" },
                dom: '<"custom-toolbar"lf>tip', 
            });
        }
    });
}

const mostrar_informacion_usuario = (id,equipo) => {
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

        if (equipo != null) {
            marca_resguardo.textContent = respuesta[0]['marca'];
            modelo_resguardo.textContent = respuesta[0]['modelo'];
            n_serie_resguardo.textContent = respuesta[0]['n_serie'];
            hostname_resguardo.textContent = respuesta[0]['hostname'];
            mac_resguardo.textContent = respuesta[0]['mac'];
            nodo_resguardo.textContent = '';
            ip_resguardo.textContent = respuesta[0]['ip'];
        }

    });
}

tabla_de_info_usuarios.addEventListener('click', (e) => {
    btn_info_usuario = e.target.closest(".info-usuario"); 

    if (btn_info_usuario) {
        mostrar_informacion_usuario(btn_info_usuario.dataset.id,btn_info_usuario.dataset.serie);
        tabla_de_info_usuarios.style.display = 'none';
        informacion_usuario.style.display = 'block';
    }
});

document.addEventListener('DOMContentLoaded', () => {
    informacion_usuario.style.display = 'none';
    obtener_datos_usuarios();
});