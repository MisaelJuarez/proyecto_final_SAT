let tablaIps;
let tablaResguardos;
let id_ip = null;
let btn_seleccionar_ip;
let btn_obtener_info_modificar_resguardo;
let id_resguardo_modificar;
let modalObtenerip;

const modal = document.getElementById('buscar-ips');
const tabla_de_info_resguardos = document.getElementById('tabla-de-info-resguardos');
const contenedor_modificar_resguardos = document.getElementById('contenedor_modificar_resguardos');
const tabla_Ips = document.getElementById('tablaIps');
const tabla_resguardos = document.getElementById('tablaResguardos');
const btn_sin_ip = document.getElementById('btn-sin-ip');

const marca = document.getElementById('marca');
const modelo = document.getElementById('modelo');
const n_serie = document.getElementById('n_serie');
const hostname = document.getElementById('hostname');
const mac = document.getElementById('mac');
const nodo = document.getElementById('nodo');
const btn_obtener_ips = document.getElementById('btn-obtener-ips');

const btn_modificar_resguardo = document.getElementById('btn-modificar-resguardo');

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

const obtener_datos_resguardos = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_datos_resguardos');
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
                    { 
                        data: 'ip_numero', 
                        className: "border border-dark",
                        render: function(data) {
                            return data ? 
                                `<span class="badge-ip"><i class="fas fa-ip-address me-1"></i>${data}</span>` : 
                                '<span class="badge-no-ip"><i class="fas fa-ban me-1"></i>Sin IP</span>';
                        }
                    }, 
                    {
                        data: 'id_resguardo',
                        className: "text-center border border-dark",
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-modificar-resguardo modificar-resguardo"
                                    data-id="${data}"
                                    style="background: linear-gradient(135deg, #b08d57 0%, #d4b483 100%); 
                                           color: white; 
                                           border: 1px solid #8a3b45;
                                           border-radius: 6px;
                                           padding: 8px 12px;
                                           font-weight: 500;"
                                >
                                    <i class="fas fa-edit me-1"></i>Editar
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

const obtener_datos_resguardo_modificar = (id) => {
    let data = new FormData();
    data.append('id',id); 
    data.append('metodo','obtener_datos_resguardo_modificar');
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
        hostname.value = respuesta['hostname'];
        mac.value = respuesta['mac'];
        nodo.value = respuesta['nodo'];
        
        if (respuesta['ip_numero'] == null) {
            btn_obtener_ips.textContent = 'Selecciona la ip';
            btn_obtener_ips.innerHTML = '<i class="fas fa-search me-1"></i>Selecciona la IP';
        } else {
            btn_obtener_ips.textContent = respuesta['ip_numero'];
            btn_obtener_ips.innerHTML = `<i class="fas fa-ip-address me-1"></i>${respuesta['ip_numero']}`;
        }
        
        id_ip = respuesta['ip'];
    });
}

const modificar_informacion_resguardo = () => {
    const marcaValue = marca.value.trim();
    const modeloValue = modelo.value.trim();
    const nSerieValue = n_serie.value.trim();
    const hostnameValue = hostname.value.trim();
    const macValue = mac.value.trim();
    
    // Validación de campos requeridos
    if (!marcaValue || !modeloValue || !nSerieValue || !hostnameValue || !macValue) {
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
                        Marca, modelo, número de serie, hostname y MAC son obligatorios.
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
    
    // Validación básica de formato MAC
    const macRegex = /^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/;
    if (!macRegex.test(macValue)) {
        Swal.fire({
            icon: "warning",
            title: "Formato MAC incorrecto",
            html: `
                <div style="text-align: center; padding: 10px;">
                    <div style="color: #722f37; font-size: 1.2rem; margin-bottom: 10px; font-weight: bold;">
                        <i class="fas fa-network-wired" style="color: #b08d57; margin-right: 10px;"></i>
                        Formato de MAC inválido
                    </div>
                    <div style="color: #7a756e; font-size: 0.85rem; background: #f8f5f2; padding: 10px; border-radius: 8px; margin-top: 15px; border-left: 4px solid #b08d57;">
                        Ingrese una dirección MAC válida (ejemplo: 00:1A:2B:3C:4D:5E)
                    </div>
                </div>
            `,
            background: '#ffffff',
            color: '#3c3a36',
            iconColor: '#b08d57',
            confirmButtonColor: '#722f37',
            confirmButtonText: 'Corregir',
            customClass: {
                popup: 'border-radius-16',
                confirmButton: 'btn-vino'
            }
        }).then(() => {
            mac.focus();
            mac.select();
        });
        return;
    }
    
    const btnOriginalText = btn_modificar_resguardo.innerHTML;
    btn_modificar_resguardo.innerHTML = '<span class="loading"></span> Actualizando...';
    btn_modificar_resguardo.disabled = true;
    
    let data = new FormData(document.getElementById('formulario-modificar-reguardo'));
    data.append('id',id_resguardo_modificar);
    data.append('id_ip',id_ip);
    data.append('metodo','modificar_informacion_resguardo');
    
    fetch("app/controller/home.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        btn_modificar_resguardo.innerHTML = btnOriginalText;
        btn_modificar_resguardo.disabled = false;
        
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
                            La información del equipo ha sido actualizada correctamente.
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
            contenedor_modificar_resguardos.style.display = "none";
            tabla_de_info_resguardos.style.display = "block";
            obtener_datos_resguardos();
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
        btn_modificar_resguardo.innerHTML = btnOriginalText;
        btn_modificar_resguardo.disabled = false;
        
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

tabla_Ips.addEventListener('click', (e) => {
    btn_seleccionar_ip = e.target.closest(".seleccionar-ip"); 

    if (btn_seleccionar_ip) {
        id_ip = btn_seleccionar_ip.dataset.id;
        btn_obtener_ips.innerHTML = `<i class="fas fa-ip-address me-1"></i>${btn_seleccionar_ip.dataset.ip}`;
        modalObtenerip = bootstrap.Modal.getInstance(modal);
        if (modalObtenerip) modalObtenerip.hide();
    }
});

tabla_resguardos.addEventListener('click', (e) => {
    btn_obtener_info_modificar_resguardo = e.target.closest(".modificar-resguardo");
    if (btn_obtener_info_modificar_resguardo) {
        tabla_de_info_resguardos.style.display = 'none';
        contenedor_modificar_resguardos.style.display = 'block';
        id_resguardo_modificar = btn_obtener_info_modificar_resguardo.dataset.id;
        console.log('ID RESGUARDO', id_resguardo_modificar);
        obtener_datos_resguardo_modificar(btn_obtener_info_modificar_resguardo.dataset.id);
    }
});

btn_sin_ip.addEventListener('click', () => {
    id_ip = null;
    btn_obtener_ips.innerHTML = '<i class="fas fa-search me-1"></i>Seleccione la IP del equipo';
    modalObtenerip = bootstrap.Modal.getInstance(modal);
    if (modalObtenerip) modalObtenerip.hide();
});

btn_modificar_resguardo.addEventListener('click', () => {
    if (id_resguardo_modificar) {
        modificar_informacion_resguardo();
    } else {
        Swal.fire({
            icon: "warning",
            title: "Seleccione un equipo",
            html: `
                <div style="text-align: center; padding: 10px;">
                    <div style="color: #722f37; font-size: 1.2rem; margin-bottom: 10px; font-weight: bold;">
                        <i class="fas fa-laptop" style="color: #b08d57; margin-right: 10px;"></i>
                        Seleccione un equipo primero
                    </div>
                    <div style="color: #7a756e; font-size: 0.85rem; background: #f8f5f2; padding: 10px; border-radius: 8px; margin-top: 15px; border-left: 4px solid #b08d57;">
                        Haga clic en el botón "Editar" de un equipo para modificar sus datos.
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

document.addEventListener('DOMContentLoaded', () => {
    contenedor_modificar_resguardos.style.display = 'none';
    obtener_ips();
    obtener_datos_resguardos();
    
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
        
        btn_sin_ip.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-1px)';
            this.style.boxShadow = '0 3px 8px rgba(138, 59, 69, 0.2)';
        });
        
        btn_sin_ip.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    }
    
    if (btn_modificar_resguardo) {
        if (!btn_modificar_resguardo.innerHTML.includes('fa-')) {
            btn_modificar_resguardo.innerHTML = `<i class="fas fa-save me-2"></i>${btn_modificar_resguardo.innerHTML}`;
        }
        
        btn_modificar_resguardo.style.cssText = `
            background: linear-gradient(135deg, #722f37 0%, #8a3b45 100%);
            color: white;
            border: 1px solid #b08d57;
            border-radius: 8px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Arial', sans-serif;
        `;
        
        btn_modificar_resguardo.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 5px 15px rgba(114, 47, 55, 0.2)';
        });
        
        btn_modificar_resguardo.addEventListener('mouseleave', function() {
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
        
        .btn-modificar-resguardo:hover {
            background: linear-gradient(135deg, #d4b483 0%, #b08d57 100%) !important;
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
        
        /* Estilo especial para campo MAC */
        #mac {
            font-family: 'Courier New', monospace;
            letter-spacing: 1px;
        }
    `;
    document.head.appendChild(style);
});