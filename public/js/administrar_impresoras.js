let tablaIps;
let tablaImpresoras;
let btn_info_impresora;
let id_impresora_modificar;
let id_ip = null;
let btn_seleccionar_ip;
let modalObtenerip;

const modal = document.getElementById('buscar-ips');
const tabla_de_info_impresoras = document.getElementById('tabla-de-info-impresoras');
const tabla_impresoras = document.getElementById('tablaImpresoras');
const contenedor_modificar_impresoras = document.getElementById('contenedor_modificar_impresoras');
const tabla_Ips = document.getElementById('tablaIps');
const btn_sin_ip = document.getElementById('btn-sin-ip');

let optionsAreas = '<option value="" selected>Seleccione el area</option>';
let optionsDepatamentos = '<option value="" selected>Seleccione el departamento</option>';

const marca = document.getElementById('marca');
const modelo = document.getElementById('modelo');
const n_serie = document.getElementById('n_serie');
const area = document.getElementById('area');
const departamento = document.getElementById('departamento');
const nodo = document.getElementById('nodo');
const btn_obtener_ips = document.getElementById('btn-obtener-ips');
const btn_modificar_impresora = document.getElementById('btn-modificar-impresora');

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
                        className: "text-center",
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-seleccionar-ip seleccionar-ip" 
                                    data-id="${data}"  
                                    data-ip="${row.ip}"  
                                    style="background: linear-gradient(135deg, #722f37 0%, #8a3b45 100%); 
                                           color: white; 
                                           border: 1px solid #b08d57;
                                           border-radius: 6px;
                                           padding: 6px 12px;
                                           font-weight: 500;"
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

const obtener_datos_impresoras = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_datos_impresoras');
    fetch("app/controller/home.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {     
        if (tablaImpresoras) {
            tablaImpresoras.clear().rows.add(respuesta).draw(); 
        } else {
            tablaImpresoras = $('#tablaImpresoras').DataTable({
                data: respuesta, 
                columns: [
                    { data: 'marca', className: "border border-dark" }, 
                    { data: 'modelo', className: "border border-dark" }, 
                    { data: 'n_serie', className: "border border-dark" }, 
                    { data: 'nombre_area', className: "border border-dark" }, 
                    { data: 'nombre_departamento', className: "border border-dark" }, 
                    { 
                        data: 'ip', 
                        className: "border border-dark",
                        render: function(data) {
                            return data ? 
                                `<span class="badge-ip"><i class="fas fa-ip-address me-1"></i>${data}</span>` : 
                                '<span class="badge-no-ip"><i class="fas fa-ban me-1"></i>Sin IP</span>';
                        }
                    }, 
                    { data: 'nodo', className: "border border-dark"},   
                    {
                        data: 'id_impresora',
                        className: "text-center border border-dark",
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-info-impresora info-impresora" 
                                        data-id="${data}"
                                        style="background: linear-gradient(135deg, #b08d57 0%, #d4b483 100%); 
                                               color: white; 
                                               border: 1px solid #8a3b45;
                                               border-radius: 6px;
                                               padding: 6px 12px;
                                               margin: 2px;
                                               font-weight: 500;"
                                >
                                    <i class="fas fa-edit me-1"></i>Editar
                                </button>
                            `;
                        }
                    },
                    {
                        data: 'id_impresora',
                        className: "text-center border border-dark",
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-eliminar-impresora info-usuario" 
                                        data-id="${data}"
                                        style="background: linear-gradient(135deg, #8a3b45 0%, #9d4a54 100%); 
                                               color: white; 
                                               border: 1px solid #722f37;
                                               border-radius: 6px;
                                               padding: 6px 12px;
                                               margin: 2px;
                                               font-weight: 500;"
                                >
                                    <i class="fas fa-trash me-1"></i>Eliminar
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

const obtener_datos_impresora_modificar = (id) => {
    let data = new FormData();
    data.append('id',id); 
    data.append('metodo','obtener_datos_impresora_modificar');
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
        nodo.value = respuesta['nodo'];
        
        if (respuesta['ip'] == null) {
            btn_obtener_ips.textContent = 'Selecciona la ip';
            btn_obtener_ips.innerHTML = '<i class="fas fa-search me-1"></i>Selecciona la IP';
        } else {
            btn_obtener_ips.textContent = respuesta['ip'];
            btn_obtener_ips.innerHTML = `<i class="fas fa-ip-address me-1"></i>${respuesta['ip']}`;
        }
        
        area.value = respuesta['area'];
        setTimeout(() => area.dispatchEvent(new Event('change')), 10);
        setTimeout(() => departamento.value = respuesta['departamento'], 100);
        id_ip = respuesta['ip_impresora'];
    });
}

const modificar_informacion_impresora = () => {
    const marcaValue = marca.value.trim();
    const modeloValue = modelo.value.trim();
    const nSerieValue = n_serie.value.trim();
    
    // Validación de campos requeridos
    if (!marcaValue || !modeloValue || !nSerieValue) {
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
                        Marca, modelo y número de serie son obligatorios.
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
    
    const btnOriginalText = btn_modificar_impresora.innerHTML;
    btn_modificar_impresora.innerHTML = '<span class="loading"></span> Actualizando...';
    btn_modificar_impresora.disabled = true;
    
    let data = new FormData(document.getElementById('formulario-modificar-impresora'));
    data.append('id',id_impresora_modificar);
    data.append('id_ip',id_ip);
    data.append('metodo','modificar_informacion_impresora');
    
    fetch("app/controller/home.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        btn_modificar_impresora.innerHTML = btnOriginalText;
        btn_modificar_impresora.disabled = false;
        
        if (respuesta[0] == 1) {
            await Swal.fire({
                icon: "success",
                title: respuesta[1],
                html: `
                    <div style="text-align: center; padding: 10px;">
                        <div style="color: #722f37; font-size: 1.4rem; margin-bottom: 15px; font-weight: bold;">
                            <i class="fas fa-check-circle" style="color: #b08d57; margin-right: 10px; font-size: 2.5rem;"></i>
                            ${respuesta[1]}
                        </div>
                        <div style="color: #5a5349; font-size: 0.9rem; background: #f8f5f2; padding: 15px; border-radius: 8px; border-left: 4px solid #b08d57;">
                            La información de la impresora ha sido actualizada correctamente.
                        </div>
                    </div>
                `,
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
            contenedor_modificar_impresoras.style.display = "none";
            tabla_de_info_impresoras.style.display = "block";
            obtener_datos_impresoras();
        } else {
            Swal.fire({
                icon: "error",
                title: respuesta[1],
                html: `
                    <div style="text-align: center; padding: 10px;">
                        <div style="color: #722f37; font-size: 1.2rem; margin-bottom: 10px; font-weight: bold;">
                            <i class="fas fa-times-circle" style="color: #8a3b45; margin-right: 10px;"></i>
                            ${respuesta[1]}
                        </div>
                        <div style="color: #7a756e; font-size: 0.85rem; background: #f8f5f2; padding: 10px; border-radius: 8px; margin-top: 15px; border-left: 4px solid #8a3b45;">
                            No se pudo actualizar la información. Verifique los datos.
                        </div>
                    </div>
                `,
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
    }).catch(error => {
        btn_modificar_impresora.innerHTML = btnOriginalText;
        btn_modificar_impresora.disabled = false;
        
        console.error('Error en la solicitud:', error);
        Swal.fire({
            icon: "warning",
            title: "Error de conexión",
            html: `
                <div style="text-align: center; padding: 10px;">
                    <div style="color: #722f37; font-size: 1.2rem; margin-bottom: 10px; font-weight: bold;">
                        <i class="fas fa-wifi" style="color: #b08d57; margin-right: 10px;"></i>
                        Error de conexión al servidor
                    </div>
                    <div style="color: #7a756e; font-size: 0.85rem; background: #f8f5f2; padding: 10px; border-radius: 8px; margin-top: 15px; border-left: 4px solid #b08d57;">
                        Verifique su conexión a internet e intente nuevamente.
                    </div>
                </div>
            `,
            background: '#ffffff',
            color: '#3c3a36',
            iconColor: '#b08d57',
            confirmButtonColor: '#722f37',
            confirmButtonText: 'Reintentar',
            customClass: {
                popup: 'border-radius-16',
                confirmButton: 'btn-vino'
            }
        });
    });
}

const eliminar_impresora = (id) => {
    Swal.fire({
        title: "Eliminar impresora",
        html: `
            <div style="text-align: center; padding: 10px;">
                <div style="color: #722f37; font-size: 1.3rem; margin-bottom: 15px; font-weight: bold;">
                    <i class="fas fa-print-slash" style="color: #8a3b45; margin-right: 10px; font-size: 2rem;"></i>
                    ¿Eliminar impresora?
                </div>
                <div style="color: #5a5349; font-size: 0.9rem; background: #f8f5f2; padding: 15px; border-radius: 8px; border: 1px solid #f0e9df;">
                    <strong>Esta acción no se puede deshacer.</strong><br>
                    La impresora será eliminada permanentemente del sistema.
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
        confirmButtonText: 'Sí, eliminar',
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
            // Aquí iría la función para eliminar la impresora
            console.log('Eliminar impresora con ID:', id);
            // Implementar la función de eliminación aquí
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

tabla_impresoras.addEventListener('click', (e) => {
    btn_info_impresora = e.target.closest(".info-impresora");

    if (btn_info_impresora) {
        tabla_de_info_impresoras.style.display = 'none';
        contenedor_modificar_impresoras.style.display = 'block';
        id_impresora_modificar = btn_info_impresora.dataset.id;
        obtener_datos_impresora_modificar(btn_info_impresora.dataset.id);
        console.log(btn_info_impresora.dataset.id);
    }
    
    // Manejar clic en botón eliminar
    const btnEliminar = e.target.closest(".info-usuario");
    if (btnEliminar) {
        eliminar_impresora(btnEliminar.dataset.id);
    }
});

tabla_Ips.addEventListener('click', (e) => {
    btn_seleccionar_ip = e.target.closest(".seleccionar-ip"); 

    if (btn_seleccionar_ip) {
        id_ip = btn_seleccionar_ip.dataset.id;
        btn_obtener_ips.innerHTML = `<i class="fas fa-ip-address me-1"></i>${btn_seleccionar_ip.dataset.ip}`;
        modalObtenerip = bootstrap.Modal.getInstance(modal);
        if (modalObtenerip) modalObtenerip.hide();
    }
});

btn_sin_ip.addEventListener('click', () => {
    id_ip = null;
    btn_obtener_ips.innerHTML = '<i class="fas fa-search me-1"></i>Seleccione la IP del equipo';
    modalObtenerip = bootstrap.Modal.getInstance(modal);
    if (modalObtenerip) modalObtenerip.hide();
});

btn_modificar_impresora.addEventListener('click', () => {
    if (id_impresora_modificar) {
        modificar_informacion_impresora();
    } else {
        Swal.fire({
            icon: "warning",
            title: "Seleccione una impresora",
            html: `
                <div style="text-align: center; padding: 10px;">
                    <div style="color: #722f37; font-size: 1.2rem; margin-bottom: 10px; font-weight: bold;">
                        <i class="fas fa-print" style="color: #b08d57; margin-right: 10px;"></i>
                        Seleccione una impresora primero
                    </div>
                    <div style="color: #7a756e; font-size: 0.85rem; background: #f8f5f2; padding: 10px; border-radius: 8px; margin-top: 15px; border-left: 4px solid #b08d57;">
                        Haga clic en el botón "Editar" de una impresora para modificar sus datos.
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
    }
});

document.addEventListener('DOMContentLoaded',() => {
    contenedor_modificar_impresoras.style.display = 'none';
    obtener_info_tabla('areas',optionsAreas,'id_area','nombre_area',area,2,'');
    obtener_ips();
    obtener_datos_impresoras();
    
    // Estilizar botones principales
    if (btn_obtener_ips && !btn_obtener_ips.innerHTML.includes('fa-')) {
        if (btn_obtener_ips.textContent.includes('Selecciona')) {
            btn_obtener_ips.innerHTML = `<i class="fas fa-search me-1"></i>${btn_obtener_ips.textContent}`;
        }
        
        btn_obtener_ips.style.cssText = `
            background: white;
            color: #722f37;
            border: 1px solid #b08d57;
            border-radius: 8px;
            padding: 10px 15px;
            font-weight: 500;
            transition: all 0.3s ease;
            font-family: 'Arial', sans-serif;
            text-align: left;
            width: 100%;
        `;
        
        btn_obtener_ips.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f8f5f2';
            this.style.borderColor = '#722f37';
        });
        
        btn_obtener_ips.addEventListener('mouseleave', function() {
            this.style.backgroundColor = 'white';
            this.style.borderColor = '#b08d57';
        });
    }
    
    if (btn_sin_ip) {
        btn_sin_ip.innerHTML = `<i class="fas fa-times me-1"></i>${btn_sin_ip.textContent}`;
        btn_sin_ip.style.cssText = `
            background: linear-gradient(135deg, #8a3b45 0%, #9d4a54 100%);
            color: white;
            border: 1px solid #722f37;
            border-radius: 8px;
            padding: 8px 15px;
            font-weight: 500;
            transition: all 0.3s ease;
            font-family: 'Arial', sans-serif;
            margin-top: 10px;
        `;
    }
    
    if (btn_modificar_impresora) {
        if (!btn_modificar_impresora.innerHTML.includes('fa-')) {
            btn_modificar_impresora.innerHTML = `<i class="fas fa-save me-2"></i>${btn_modificar_impresora.innerHTML}`;
        }
        
        btn_modificar_impresora.style.cssText = `
            background: linear-gradient(135deg, #722f37 0%, #8a3b45 100%);
            color: white;
            border: 1px solid #b08d57;
            border-radius: 8px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Arial', sans-serif;
        `;
        
        btn_modificar_impresora.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 5px 15px rgba(114, 47, 55, 0.2)';
        });
        
        btn_modificar_impresora.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    }
    
    // Añadir estilos CSS
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
        
        .badge-ip {
            background: linear-gradient(135deg, #722f37 0%, #8a3b45 100%);
            color: white;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .badge-no-ip {
            background: linear-gradient(135deg, #b08d57 0%, #d4b483 100%);
            color: white;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Estilos para botones de tabla */
        .btn-seleccionar-ip:hover {
            background: linear-gradient(135deg, #8a3b45 0%, #722f37 100%) !important;
            transform: translateY(-1px);
        }
        
        .btn-info-impresora:hover {
            background: linear-gradient(135deg, #d4b483 0%, #b08d57 100%) !important;
            transform: translateY(-1px);
        }
        
        .btn-eliminar-impresora:hover {
            background: linear-gradient(135deg, #9d4a54 0%, #8a3b45 100%) !important;
            transform: translateY(-1px);
        }
        
        /* Estilos para campos de formulario */
        .form-control {
            font-family: 'Arial', sans-serif;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #b08d57;
            box-shadow: 0 0 0 3px rgba(176, 141, 87, 0.25);
            outline: none;
        }
        
        select.form-control {
            background-color: white;
            cursor: pointer;
        }
    `;
    document.head.appendChild(style);
});