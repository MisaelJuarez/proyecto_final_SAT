let tablaUsuarios;
let btn_info_usuario;
let btn_info_usuario_imprimir;
let btn_eliminar_usuario;

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

const obtener_datos_usuarios_bajas = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_datos_usuarios_bajas');
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
                    },
                    {
                        data: 'id_usuario',
                        className: "text-center border border-dark",
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-success info-usuario-imprimir"
                                    data-id="${data}"
                                    data-serie="${row.n_serie}"
                                >
                                    <i class="bi bi-printer-fill"></i>
                                </button>
                            `;
                        }
                    },
                    {
                        data: 'id_usuario',
                        className: "text-center border border-dark",
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-danger eliminar-usuario"
                                    data-id="${data}"
                                    data-resguardo="${row.id_resguardo}"
                                    data-nombre="${row.nombre}"
                                    data-apellidos="${row.apellidos}"
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
        console.log(respuesta);
        
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

const eliminar_usuario = (id) => {
    let data = new FormData();
    data.append('id_usuario',id);
    data.append('metodo','eliminar_usuario');
    fetch("app/controller/home.php",{
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async (respuesta) => {        
        if (respuesta[0] == 1) {
            await Swal.fire({title: `${respuesta[1]}`,icon: "success",draggable: true});
            obtener_datos_usuarios_bajas();
        }else {
            Swal.fire({title: `${respuesta[1]}`,icon: "error",draggable: true});
        }
    });
}

const eliminar_usuario_resguardo = (id_usuario,id_resguardo) => {
    let data = new FormData();
    data.append('id_usuario',id_usuario);
    data.append('id_resguardo',id_resguardo);
    data.append('metodo','eliminar_usuario');
    fetch("app/controller/home.php",{
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {        
        if (respuesta[0] == 1) {
            Swal.fire({title: `${respuesta[1]}`,icon: "success",draggable: true});
            obtener_datos_usuarios_bajas();
        }else {
            Swal.fire({title: `${respuesta[1]}`,icon: "error",draggable: true});
        }
    });
}

tabla_de_info_usuarios.addEventListener('click', (e) => {
    btn_info_usuario = e.target.closest(".info-usuario"); 
    btn_info_usuario_imprimir = e.target.closest('.info-usuario-imprimir');
    btn_eliminar_usuario = e.target.closest('.eliminar-usuario');

    if (btn_info_usuario) {
        mostrar_informacion_usuario(btn_info_usuario.dataset.id,btn_info_usuario.dataset.serie);
        tabla_de_info_usuarios.style.display = 'none';
        informacion_usuario.style.display = 'block';
    }
    if (btn_info_usuario_imprimir) {
        id_imprimir_usuario = btn_info_usuario_imprimir.dataset.id;
        window.open(`./views/imprimir.php?registro=${btoa(id_imprimir_usuario)}&metodo=${btoa('imprimir_usuario')}`, "_blank");
    }

    if (btn_eliminar_usuario) {
        Swal.fire({
            title: "Eliminar usuario",
            text: `${btn_eliminar_usuario.dataset.nombre} ${btn_eliminar_usuario.dataset.apellidos}`,
            showDenyButton: (btn_eliminar_usuario.dataset.resguardo != "null") ? true : false,
            showCancelButton: true,
            confirmButtonText: "Eliminar",
            denyButtonText: `Eliminar con resguardo`,
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                eliminar_usuario(btn_eliminar_usuario.dataset.id);
            } else if (result.isDenied) {
                eliminar_usuario_resguardo(btn_eliminar_usuario.dataset.id,btn_eliminar_usuario.dataset.resguardo);
            }
        });
    }

});

document.addEventListener('DOMContentLoaded', () => {
    informacion_usuario.style.display = 'none';
    obtener_datos_usuarios_bajas();
});