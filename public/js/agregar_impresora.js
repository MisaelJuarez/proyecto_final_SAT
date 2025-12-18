let tablaIps;
let id_ip = null;
let btn_seleccionar_ip;
let optionsAreas = '<option value="" selected>Seleccione el area</option>';
let optionsDepatamentos = '<option value="" selected>Seleccione el departamento</option>';
let modalObtenerip;

const modal = document.getElementById('buscar-ips');
const btn_obtener_ips = document.getElementById('btn-obtener-ips');
const area = document.getElementById('area');
const departamento = document.getElementById('departamento');
const tabla_Ips = document.getElementById('tablaIps');
const btn_agregar_impresora = document.getElementById('btn-agregar-impresora');
const formulario_agregar_impresora = document.getElementById('formulario-agregar-impresora');

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

const agregar_nueva_impresora = () => {
    // Obtener valores básicos para validación
    const marca = document.getElementById('marca')?.value.trim();
    const modelo = document.getElementById('modelo')?.value.trim();
    const n_serie = document.getElementById('n_serie')?.value.trim();
    const nodo = document.getElementById('nodo')?.value.trim();
    
    // Validación simple
    if (!marca || !modelo || !n_serie || !nodo) {
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
                        Marca, modelo, número de serie y nodo son obligatorios.
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
    
    const btnOriginalText = btn_agregar_impresora.innerHTML;
    btn_agregar_impresora.innerHTML = '<span class="loading"></span> Procesando...';
    btn_agregar_impresora.disabled = true;
    
    let data = new FormData(document.getElementById('formulario-agregar-impresora'));
    data.append('id_ip',id_ip);
    data.append('metodo','agregar_nueva_impresora');
    
    fetch("app/controller/home.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        btn_agregar_impresora.innerHTML = btnOriginalText;
        btn_agregar_impresora.disabled = false;
        
        if (respuesta[0] == 1) {
            await Swal.fire({
                title: respuesta[1],
                html: `
                    <div style="text-align: center; padding: 10px;">
                        <div style="color: #722f37; font-size: 1.5rem; margin-bottom: 15px; font-weight: bold;">
                            <i class="fas fa-print" style="color: #b08d57; margin-right: 10px;"></i>
                            ${respuesta[1]}
                        </div>
                    </div>
                `,
                background: '#ffffff',
                color: '#3c3a36',
                icon: "success",
                iconColor: '#b08d57',
                confirmButtonColor: '#722f37',
                confirmButtonText: 'Aceptar',
                customClass: {
                    popup: 'border-radius-16',
                    confirmButton: 'btn-vino'
                }
            });
            formulario_agregar_impresora.reset();
            btn_obtener_ips.textContent = 'Selecciona la ip';
            btn_obtener_ips.innerHTML = '<i class="fas fa-search me-1"></i>Selecciona la IP';
            id_ip = null;
            
            // Restaurar selects
            area.innerHTML = optionsAreas;
            departamento.innerHTML = '<option value="" selected>Seleccione el departamento</option>';
            
        } else {
            Swal.fire({
                title: respuesta[1],
                html: `
                    <div style="text-align: center; padding: 10px;">
                        <div style="color: #722f37; font-size: 1.3rem; margin-bottom: 10px; font-weight: bold;">
                            <i class="fas fa-times-circle" style="color: #8a3b45; margin-right: 10px;"></i>
                            ${respuesta[1]}
                        </div>
                    </div>
                `,
                background: '#ffffff',
                color: '#3c3a36',
                icon: "error",
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
        btn_agregar_impresora.innerHTML = btnOriginalText;
        btn_agregar_impresora.disabled = false;
        
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

area.addEventListener('change', (e) => {
    if (area.value != '') {
        obtener_info_tabla('departamentos',optionsDepatamentos,'id_departamento','nombre_departamento',departamento,1,area.value);
    } else {
        departamento.value = '';
        departamento.innerHTML = '<option value="" selected>Seleccione el departamento</option>'
    }
});

tabla_Ips.addEventListener('click', (e) => {
    btn_seleccionar_ip = e.target.closest(".seleccionar-ip"); 

    if (btn_seleccionar_ip) {
        id_ip = btn_seleccionar_ip.dataset.id;
        btn_obtener_ips.textContent = btn_seleccionar_ip.dataset.ip;
        btn_obtener_ips.innerHTML = `<i class="fas fa-ip-address me-1"></i>${btn_seleccionar_ip.dataset.ip}`;
        modalObtenerip = bootstrap.Modal.getInstance(modal);
        if (modalObtenerip) modalObtenerip.hide();
        console.log(id_ip);
    }
});

btn_agregar_impresora.addEventListener('click', () => {
    agregar_nueva_impresora();
});

document.addEventListener('DOMContentLoaded', () => {
    obtener_info_tabla('areas',optionsAreas,'id_area','nombre_area',area,2,'');
    obtener_ips();
    
    // Estilizar botón de obtener IPs
    if (btn_obtener_ips) {
        if (!btn_obtener_ips.innerHTML.includes('fa-')) {
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
    
    // Estilizar botón principal
    if (btn_agregar_impresora) {
        if (!btn_agregar_impresora.innerHTML.includes('fa-')) {
            btn_agregar_impresora.innerHTML = `<i class="fas fa-plus-circle me-2"></i>${btn_agregar_impresora.innerHTML}`;
        }
        
        btn_agregar_impresora.style.cssText = `
            background: linear-gradient(135deg, #722f37 0%, #8a3b45 100%);
            color: white;
            border: 1px solid #b08d57;
            border-radius: 8px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Arial', sans-serif;
        `;
        
        btn_agregar_impresora.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 5px 15px rgba(114, 47, 55, 0.2)';
        });
        
        btn_agregar_impresora.addEventListener('mouseleave', function() {
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
        
        /* Estilos para botones de tabla */
        .btn-seleccionar-ip:hover {
            background: linear-gradient(135deg, #8a3b45 0%, #722f37 100%) !important;
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