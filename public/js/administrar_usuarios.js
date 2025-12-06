let id_usuario_modificar;
let id_usuario_baja;
let tablaUsuariosAdministrar;
let btn_obtener_info_modificar_usuarios;
let btn_baja_usuario;

const tabla_de_admin_usuarios = document.getElementById('tabla-de-admin-usuarios');
const contenedor_modificar_usuario = document.getElementById('contenedor-modificar-usuario');
const btn_sin_resguardo = document.getElementById('btn-sin-resguardo');
const btn_dar_baja_usuario = document.getElementById('btn-baja-usuario');
const contenedor_baja_usuario = document.getElementById('contenedor-baja-usuario');

let tablaResguaros;
let id_resguardo = null;
let id_resguardo_baja = null;
let ip_ultimo_registro = null;
let id_ip_baja = null;
let btn_seleccionar_resguardo;
let modalObtenerResguardo;

let optionsAreas = '<option value="" selected>Seleccione el area</option>';
let optionsPuestos = '<option value="" selected>Seleccione el puesto</option>';
let optionsDepatamentos = '<option value="" selected>Seleccione el departamento</option>';

const tabla_Resguardos = document.getElementById('tablaResguardos');
const btn_obtener_resguardos = document.getElementById('btn-obtener-resguardos');

const modal = document.getElementById('buscar-resguardo');

const nombre = document.getElementById('nombre');
const apellidos = document.getElementById('apellidos');
const rfc = document.getElementById('rfc');
const rfc_corto = document.getElementById('rfc_corto');
const n_empleado = document.getElementById('n_empleado');

const nombre_usuario = document.getElementById('nombre-usuario');
const apellidos_usuario = document.getElementById('apellidos-usuario');
const nEmpleado_usuario = document.getElementById('nEmpleado-usuario');
const rfc_usuario = document.getElementById('rfc-usuario');
const rfc_corto_usuario = document.getElementById('rfc-corto-usuario');
const puesto_empleado = document.getElementById('puesto-empleado');
const area_usuario = document.getElementById('area-usuario');
const departamento_usuario = document.getElementById('departamento-usuario');

const area = document.getElementById('area');
const puesto = document.getElementById('puesto');
const departamento = document.getElementById('departamento');

const btn_modificar_usuario = document.getElementById('btn-modificar-usuario');

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

const obtener_resguaros = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_resguaros');
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
                    { data: 'marca' }, 
                    { data: 'hostname' }, 
                    { data: 'mac' }, 
                    {
                        data: 'id_resguardo',
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-info seleccionar-resguardo" 
                                    data-id="${data}"  
                                    data-marca="${row.marca}" 
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

const obtener_datos_usuarios_administrar = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_datos_usuarios');
    fetch("app/controller/home.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        if (tablaUsuariosAdministrar) {
            tablaUsuariosAdministrar.clear().rows.add(respuesta).draw(); 
        } else {
            tablaUsuariosAdministrar = $('#tablaUsuariosAdministrar').DataTable({
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
                                <button class="btn btn-warning modificar-usuario"
                                    data-id="${data}"
                                >
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            `;
                        }
                    },
                    {
                        data: 'id_usuario',
                        className: "text-center border border-dark",
                        render: function(data, type, row) {
                            return (row.n_serie != null) ?
                            `
                                <button class="btn btn-danger baja-usuario"
                                    data-id="${data}"
                                >
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            `
                            : ''
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

const obtener_datos_usuarios_modificar = (id) => {
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
        nombre.value = respuesta[0]['nombre'];
        apellidos.value = respuesta[0]['apellidos'];
        rfc.value = respuesta[0]['rfc'];
        rfc_corto.value = respuesta[0]['rfc_corto'];
        n_empleado.value = respuesta[0]['n_empleado'];
        puesto.value = respuesta[0]['puesto'];
        area.value =  respuesta[0]['area'];
        if (respuesta[0]['n_serie'] == null) {
            btn_obtener_resguardos.textContent = `Seleccionar resguardo`;
        }else {
            btn_obtener_resguardos.textContent = `${respuesta[0]['marca']} | ${respuesta[0]['n_serie']}`;
        }
        id_resguardo = respuesta[0]['id_resguardo'];
        setTimeout(() => area.dispatchEvent(new Event('change')), 10);
        setTimeout(() => departamento.value = respuesta[0]['departamento'], 100);
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
        console.log(respuesta);  
        nombre_usuario.textContent = respuesta[0]['nombre'];
        apellidos_usuario.textContent = respuesta[0]['apellidos'];
        nEmpleado_usuario.textContent = respuesta[0]['n_empleado'];
        rfc_usuario.textContent = respuesta[0]['rfc'];
        rfc_corto_usuario.textContent = respuesta[0]['rfc_corto'];
        puesto_empleado.textContent = respuesta[0]['nombre_puesto'];
        area_usuario.textContent =  respuesta[0]['nombre_area'];
        departamento_usuario.textContent = respuesta[0]['nombre_departamento'];
        id_resguardo_baja = respuesta[0]['id_resguardo'];
        ip_ultimo_registro = respuesta[0]['ip'];
        id_ip_baja = respuesta[0]['id_ip'];
    });
}

const modificar_informacion_usuario = () => {
    let data = new FormData(document.getElementById('formulario-modificar-usuario'));
    data.append('id',id_usuario_modificar);
    data.append('id_resguaro',id_resguardo);
    data.append('metodo','modificar_informacion_usuario');
    fetch("app/controller/home.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({icon: "success",title:`${respuesta[1]}`});
            contenedor_modificar_usuario.style.display = "none";
            tabla_de_admin_usuarios.style.display = "block";
            obtener_datos_usuarios_administrar();
        } else {
            Swal.fire({icon: "error",title:`${respuesta[1]}`});
        }
    });
}

const dar_baja_usuario = () => {
    let data = new FormData(document.getElementById('formulario-baja-usuario'));
    data.append('id_usuario',id_usuario_baja);
    data.append('id_resguardo',id_resguardo_baja);
    data.append('ip',ip_ultimo_registro);
    data.append('id_ip',id_ip_baja);
    data.append('metodo','dar_baja_usuario');
    fetch("app/controller/home.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({icon: "success",title:`${respuesta[1]}`});
            contenedor_modificar_usuario.style.display = "none";
            contenedor_baja_usuario.style.display = 'none';
            tabla_de_admin_usuarios.style.display = "block";
            obtener_datos_usuarios_administrar();
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

btn_obtener_resguardos.addEventListener('click', () => obtener_resguaros());

btn_sin_resguardo.addEventListener('click', () => {
    id_resguardo = null;
    btn_obtener_resguardos.textContent = 'Seleccionar resguardo';
    modalObtenerResguardo = bootstrap.Modal.getInstance(modal);
    if (modalObtenerResguardo) modalObtenerResguardo.hide();
});

tabla_Resguardos.addEventListener('click', (e) => {
    btn_seleccionar_resguardo = e.target.closest(".seleccionar-resguardo"); 

    if (btn_seleccionar_resguardo) {
        id_resguardo = btn_seleccionar_resguardo.dataset.id;
        btn_obtener_resguardos.textContent = `${btn_seleccionar_resguardo.dataset.marca} | ${btn_seleccionar_resguardo.dataset.nserie}`;
        modalObtenerResguardo = bootstrap.Modal.getInstance(modal);
        if (modalObtenerResguardo) modalObtenerResguardo.hide();
    }
});

tabla_de_admin_usuarios.addEventListener('click', (e) => {
    btn_obtener_info_modificar_usuarios = e.target.closest(".modificar-usuario");
    btn_baja_usuario = e.target.closest(".baja-usuario");

    if (btn_obtener_info_modificar_usuarios) {
        tabla_de_admin_usuarios.style.display = 'none';
        contenedor_baja_usuario.style.display = 'none';
        contenedor_modificar_usuario.style.display = 'block';
        id_usuario_modificar = btn_obtener_info_modificar_usuarios.dataset.id;
        obtener_datos_usuarios_modificar(btn_obtener_info_modificar_usuarios.dataset.id);
    }

    if (btn_baja_usuario) {
        tabla_de_admin_usuarios.style.display = 'none';
        contenedor_baja_usuario.style.display = 'none'
        contenedor_baja_usuario.style.display = 'block';
        id_usuario_baja = btn_baja_usuario.dataset.id
        mostrar_informacion_usuario(btn_baja_usuario.dataset.id)
        console.log(btn_baja_usuario.dataset.id);
    }
});

btn_modificar_usuario.addEventListener('click', () => {
    modificar_informacion_usuario();
});

btn_dar_baja_usuario.addEventListener('click', () => {
    console.log('RESGUARDO: ',id_resguardo_baja);
    console.log('USUARIO: : ',id_usuario_baja);
    dar_baja_usuario();
});

document.addEventListener('DOMContentLoaded', () => {
    contenedor_modificar_usuario.style.display = 'none';
    contenedor_baja_usuario.style.display = 'none';
    obtener_info_tabla('puestos',optionsPuestos,'id_puesto','nombre_puesto',puesto,2,'');
    obtener_info_tabla('areas',optionsAreas,'id_area','nombre_area',area,2,'');
    obtener_datos_usuarios_administrar();
});