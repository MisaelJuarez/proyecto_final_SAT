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
                                    style="background-color: #722f37; border-color: #b08d57; color: white;"
                                >
                                    <i class="fas fa-check me-1"></i>Seleccionar
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
                            return (row.n_serie == null) ? '<span class="badge" style="background-color: #9d4a54; color: white;">Sin equipo</span>' : row.n_serie;
                        }
                    },  
                    {
                        data: 'id_usuario',
                        className: "text-center border border-dark",
                        render: function(data, type, row) {
                            return `
                                <button class="btn modificar-usuario"
                                    data-id="${data}"
                                    style="background-color: #b08d57; border-color: #8a3b45; color: white;"
                                >
                                    <i class="fas fa-edit me-1"></i>Editar
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
                                <button class="btn baja-usuario"
                                    data-id="${data}"
                                    style="background-color: #8a3b45; border-color: #722f37; color: white;"
                                >
                                    <i class="fas fa-trash me-1"></i>Eliminar
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
            btn_obtener_resguardos.innerHTML = `<i class="fas fa-search me-1"></i>Seleccionar resguardo`;
        }else {
            btn_obtener_resguardos.textContent = `${respuesta[0]['marca']} | ${respuesta[0]['n_serie']}`;
            btn_obtener_resguardos.innerHTML = `<i class="fas fa-laptop me-1"></i>${respuesta[0]['marca']} | ${respuesta[0]['n_serie']}`;
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
            await Swal.fire({
                icon: "success",
                title: respuesta[1],
                background: '#ffffff',
                color: '#3c3a36',
                iconColor: '#b08d57',
                confirmButtonColor: '#722f37',
                confirmButtonText: 'Aceptar',
                customClass: {
                    popup: 'border-radius-16',
                    confirmButton: 'btn-vino'
                }
            });
            contenedor_modificar_usuario.style.display = "none";
            tabla_de_admin_usuarios.style.display = "block";
            obtener_datos_usuarios_administrar();
        } else {
            Swal.fire({
                icon: "error",
                title: respuesta[1],
                background: '#ffffff',
                color: '#3c3a36',
                iconColor: '#8a3b45',
                confirmButtonColor: '#b08d57',
                confirmButtonText: 'Reintentar',
                customClass: {
                    popup: 'border-radius-16',
                    confirmButton: 'btn-bronce'
                }
            });
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
            await Swal.fire({
                icon: "success",
                title: respuesta[1],
                html: `
                    <div style="text-align: center; padding: 10px;">
                        <div style="color: #722f37; font-size: 1.3rem; margin-bottom: 15px; font-weight: bold;">
                            <i class="fas fa-user-check" style="color: #b08d57; margin-right: 10px;"></i>
                            ${respuesta[1]}
                        </div>
                        <div style="color: #5a5349; font-size: 0.9rem; background: #f8f5f2; padding: 10px; border-radius: 8px; border-left: 4px solid #b08d57;">
                            El usuario ha sido dado de baja correctamente.
                        </div>
                    </div>
                `,
                background: '#ffffff',
                color: '#3c3a36',
                iconColor: '#b08d57',
                confirmButtonColor: '#722f37',
                confirmButtonText: 'Aceptar',
                showConfirmButton: true,
                customClass: {
                    popup: 'border-radius-16',
                    confirmButton: 'btn-vino'
                }
            });
            contenedor_modificar_usuario.style.display = "none";
            contenedor_baja_usuario.style.display = 'none';
            tabla_de_admin_usuarios.style.display = "block";
            obtener_datos_usuarios_administrar();
        } else {
            Swal.fire({
                icon: "error",
                title: respuesta[1],
                html: `
                    <div style="text-align: center; padding: 10px;">
                        <div style="color: #722f37; font-size: 1.2rem; margin-bottom: 10px; font-weight: bold;">
                            <i class="fas fa-user-slash" style="color: #8a3b45; margin-right: 10px;"></i>
                            ${respuesta[1]}
                        </div>
                        <div style="color: #7a756e; font-size: 0.85rem; background: #f8f5f2; padding: 10px; border-radius: 8px; margin-top: 15px; border-left: 4px solid #8a3b45;">
                            No se pudo completar la operación.
                        </div>
                    </div>
                `,
                background: '#ffffff',
                color: '#3c3a36',
                iconColor: '#8a3b45',
                confirmButtonColor: '#b08d57',
                confirmButtonText: 'Reintentar',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                cancelButtonColor: '#a39e97',
                focusConfirm: true,
                customClass: {
                    popup: 'border-radius-16',
                    confirmButton: 'btn-bronce',
                    cancelButton: 'btn-outline-secondary'
                }
            });
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
    btn_obtener_resguardos.innerHTML = '<i class="fas fa-search me-1"></i>Seleccionar resguardo';
    modalObtenerResguardo = bootstrap.Modal.getInstance(modal);
    if (modalObtenerResguardo) modalObtenerResguardo.hide();
});

tabla_Resguardos.addEventListener('click', (e) => {
    btn_seleccionar_resguardo = e.target.closest(".seleccionar-resguardo"); 

    if (btn_seleccionar_resguardo) {
        id_resguardo = btn_seleccionar_resguardo.dataset.id;
        btn_obtener_resguardos.innerHTML = `<i class="fas fa-laptop me-1"></i>${btn_seleccionar_resguardo.dataset.marca} | ${btn_seleccionar_resguardo.dataset.nserie}`;
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
        contenedor_baja_usuario.style.display = 'none';
        contenedor_baja_usuario.style.display = 'block';
        id_usuario_baja = btn_baja_usuario.dataset.id
        mostrar_informacion_usuario(btn_baja_usuario.dataset.id)
        console.log(btn_baja_usuario.dataset.id);
    }
});

btn_modificar_usuario.addEventListener('click', () => {
    const nombreValue = nombre.value.trim();
    const apellidosValue = apellidos.value.trim();
    const rfcValue = rfc.value.trim();
    
    if (!nombreValue || !apellidosValue || !rfcValue) {
        Swal.fire({
            icon: "warning",
            title: "Campos incompletos",
            html: `
                <div style="text-align: center; padding: 10px;">
                    <div style="color: #722f37; font-size: 1.2rem; margin-bottom: 10px; font-weight: bold;">
                        <i class="fas fa-exclamation-triangle" style="color: #b08d57; margin-right: 10px;"></i>
                        Complete los campos requeridos
                    </div>
                    <div style="color: #7a756e; font-size: 0.85rem; background: #f8f5f2; padding: 10px; border-radius: 8px; margin-top: 15px; border-left: 4px solid #b08d57;">
                        Nombre, apellidos y RFC son obligatorios.
                    </div>
                </div>
            `,
            background: '#ffffff',
            color: '#3c3a36',
            iconColor: '#b08d57',
            confirmButtonColor: '#722f37',
            confirmButtonText: 'Entendido',
            customClass: {
                popup: 'border-radius-16',
                confirmButton: 'btn-vino'
            }
        });
        return;
    }
    
    const btnOriginalText = btn_modificar_usuario.innerHTML;
    btn_modificar_usuario.innerHTML = '<span class="loading"></span> Actualizando...';
    btn_modificar_usuario.disabled = true;
    
    setTimeout(() => {
        modificar_informacion_usuario();
        btn_modificar_usuario.innerHTML = btnOriginalText;
        btn_modificar_usuario.disabled = false;
    }, 300);
});

btn_dar_baja_usuario.addEventListener('click', () => {
    Swal.fire({
        title: 'Confirmar baja',
        html: `
            <div style="text-align: center; padding: 10px;">
                <div style="color: #722f37; font-size: 1.3rem; margin-bottom: 15px; font-weight: bold;">
                    <i class="fas fa-user-times" style="color: #8a3b45; margin-right: 10px; font-size: 2rem;"></i>
                    ¿Dar de baja al usuario?
                </div>
                <div style="color: #5a5349; font-size: 0.9rem; background: #f8f5f2; padding: 15px; border-radius: 8px; border: 1px solid #f0e9df;">
                    <strong>Esta acción no se puede deshacer.</strong><br>
                    El equipo asignado quedará disponible.
                </div>
            </div>
        `,
        background: '#ffffff',
        color: '#3c3a36',
        icon: 'warning',
        iconColor: '#8a3b45',
        showCancelButton: true,
        confirmButtonColor: '#8a3b45',
        cancelButtonColor: '#b08d57',
        confirmButtonText: 'Sí, dar de baja',
        cancelButtonText: 'Cancelar',
        reverseButtons: true,
        focusConfirm: false,
        focusCancel: true,
        customClass: {
            popup: 'border-radius-16',
            confirmButton: 'btn-danger-custom',
            cancelButton: 'btn-bronce'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const btnOriginalText = btn_dar_baja_usuario.innerHTML;
            btn_dar_baja_usuario.innerHTML = '<span class="loading"></span> Procesando...';
            btn_dar_baja_usuario.disabled = true;
            
            setTimeout(() => {
                dar_baja_usuario();
                btn_dar_baja_usuario.innerHTML = btnOriginalText;
                btn_dar_baja_usuario.disabled = false;
            }, 300);
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    contenedor_modificar_usuario.style.display = 'none';
    contenedor_baja_usuario.style.display = 'none';
    obtener_info_tabla('puestos',optionsPuestos,'id_puesto','nombre_puesto',puesto,2,'');
    obtener_info_tabla('areas',optionsAreas,'id_area','nombre_area',area,2,'');
    obtener_datos_usuarios_administrar();
    
    // Estilo para el loading spinner
    const style = document.createElement('style');
    style.textContent = `
        .loading {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #722f37;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 8px;
            vertical-align: middle;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .border-radius-16 {
            border-radius: 16px !important;
            border: 2px solid #b08d57;
        }
        
        .btn-vino {
            background: linear-gradient(135deg, #722f37 0%, #8a3b45 100%);
            color: white;
            border: 1px solid #b08d57;
            border-radius: 8px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-vino:hover {
            background: linear-gradient(135deg, #8a3b45 0%, #722f37 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(114, 47, 55, 0.2);
        }
        
        .btn-bronce {
            background: linear-gradient(135deg, #b08d57 0%, #d4b483 100%);
            color: white;
            border: 1px solid #8a3b45;
            border-radius: 8px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-bronce:hover {
            background: linear-gradient(135deg, #d4b483 0%, #b08d57 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(176, 141, 87, 0.2);
        }
        
        .btn-danger-custom {
            background: linear-gradient(135deg, #8a3b45 0%, #9d4a54 100%);
            color: white;
            border: 1px solid #722f37;
            border-radius: 8px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-danger-custom:hover {
            background: linear-gradient(135deg, #9d4a54 0%, #8a3b45 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(157, 74, 84, 0.2);
        }
        
        .btn-outline-secondary {
            background: transparent;
            color: #6c757d;
            border: 1px solid #6c757d;
            border-radius: 8px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-secondary:hover {
            background: #6c757d;
            color: white;
        }
    `;
    document.head.appendChild(style);
});