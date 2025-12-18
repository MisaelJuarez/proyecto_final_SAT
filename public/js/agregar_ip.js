let tablaResguaros;
let tablaimpresoras;
let id_resguardo = null;
let id_impresora = null;
let btn_seleccionar_resguardo;
let btn_seleccionar_impresora;
let modalObtenerResguardo;
let modalObtenerImpresora;
let chekedInput = '';

const asignar_resguardo_contenedor = document.getElementById('contenedor-btn-equipos');
const asignar_impresoras_contenedor = document.getElementById('contenedor-btn-impresoras');

const tabla_Resguardos = document.getElementById('tablaResguardos');
const tabla_impresoras = document.getElementById('tablaImpresoras');
const btn_obtener_resguardos = document.getElementById('btn-obtener-resguardos');
const btn_obtener_impresoras = document.getElementById('btn-obtener-impresoras');
const modal = document.getElementById('buscar-resguardo');
const modalImpresora = document.getElementById('buscar-impresoras');
const btn_agregar_ip = document.getElementById('btn-agregar-ip');
const formulario_agregar_ip = document.getElementById('formulario-agregar-ip');
const radios = document.querySelectorAll('input[name="asignar"]');

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
                        className: "text-center",
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-seleccionar-resguardo seleccionar-resguardo" 
                                    data-id="${data}"  
                                    data-nserie="${row.n_serie}" 
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

const obtener_impresoras_para_asignar_ip = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_impresoras_para_asignar_ip');
    fetch("app/controller/home.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        if (tablaimpresoras) {
            tablaimpresoras.clear().rows.add(respuesta).draw(); 
        } else {
            tablaimpresoras = $('#tablaImpresoras').DataTable({
                data: respuesta, 
                columns: [
                    { data: 'modelo' }, 
                    { data: 'n_serie' }, 
                    { data: 'nombre_area' }, 
                    { data: 'nombre_departamento' }, 
                    {
                        data: 'id_impresora',
                        className: "text-center",
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-seleccionar-impresora seleccionar-impresoras" 
                                    data-id="${data}"  
                                    data-nserie="${row.n_serie}" 
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

const agregar_nueva_ip = () => {
    console.log(id_resguardo);
    
    // Validación básica de IP
    const ipInput = document.getElementById('ip');
    const ipValue = ipInput?.value.trim();
    
    if (!ipValue) {
        Swal.fire({
            icon: "warning",
            title: "IP requerida",
            html: `
                <div style="text-align: center; padding: 10px;">
                    <div style="color: #722f37; font-size: 1.2rem; margin-bottom: 10px; font-weight: bold;">
                        <i class="fas fa-exclamation-triangle" style="color: #b08d57; margin-right: 10px;"></i>
                        Ingrese una dirección IP
                    </div>
                    <div style="color: #7a756e; font-size: 0.85rem; background: #f8f5f2; padding: 10px; border-radius: 8px; margin-top: 15px; border-left: 4px solid #b08d57;">
                        La dirección IP es un campo obligatorio.
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
        ipInput?.focus();
        return;
    }
    
    const btnOriginalText = btn_agregar_ip.innerHTML;
    btn_agregar_ip.innerHTML = '<span class="loading"></span> Procesando...';
    btn_agregar_ip.disabled = true;
    
    let data = new FormData(document.getElementById('formulario-agregar-ip'));
    data.append('id_resguaro',(chekedInput == 'equipos') ? id_resguardo : id_impresora);
    data.append('asignar',chekedInput);
    data.append('metodo','agregar_nueva_ip');
    
    fetch("app/controller/home.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        btn_agregar_ip.innerHTML = btnOriginalText;
        btn_agregar_ip.disabled = false;
        
        if (respuesta[0] == 1) {
            await Swal.fire({
                title: respuesta[1],
                html: `
                    <div style="text-align: center; padding: 10px;">
                        <div style="color: #722f37; font-size: 1.5rem; margin-bottom: 15px; font-weight: bold;">
                            <i class="fas fa-check-circle" style="color: #b08d57; margin-right: 10px;"></i>
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
            formulario_agregar_ip.reset();
            asignar_resguardo_contenedor.style.display = 'none';
            asignar_impresoras_contenedor.style.display = 'none';
            btn_obtener_resguardos.textContent = 'Equipos de computo';
            btn_obtener_resguardos.innerHTML = '<i class="fas fa-search me-2"></i>Equipos de computo';
            btn_obtener_impresoras.textContent = 'Impresoras';
            btn_obtener_impresoras.innerHTML = '<i class="fas fa-search me-2"></i>Impresoras';
            id_resguardo = null;
            id_impresora = null;
            
            // Desmarcar radios
            radios.forEach(radio => {
                radio.checked = false;
            });
            chekedInput = '';
            
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
        btn_agregar_ip.innerHTML = btnOriginalText;
        btn_agregar_ip.disabled = false;
        
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

radios.forEach(radio => {
    radio.addEventListener('change', function() {
        if (this.value == 'equipos') {
            chekedInput = 'equipos';
            asignar_impresoras_contenedor.style.display = 'none';
            asignar_resguardo_contenedor.style.display = 'block';
        }else if(this.value == 'impresoras'){
            chekedInput = 'impresoras';
            asignar_resguardo_contenedor.style.display = 'none';
            asignar_impresoras_contenedor.style.display = 'block';
        }
    });
});

tabla_Resguardos.addEventListener('click', (e) => {
    btn_seleccionar_resguardo = e.target.closest(".seleccionar-resguardo"); 
    
    if (btn_seleccionar_resguardo) {
        id_resguardo = btn_seleccionar_resguardo.dataset.id;
        btn_obtener_resguardos.textContent = `${btn_seleccionar_resguardo.dataset.nserie}`;
        btn_obtener_resguardos.innerHTML = `<i class="fas fa-laptop me-2"></i>${btn_seleccionar_resguardo.dataset.nserie}`;
        modalObtenerResguardo = bootstrap.Modal.getInstance(modal);
        if (modalObtenerResguardo) modalObtenerResguardo.hide();
    }
});

tabla_impresoras.addEventListener('click', (e) => {
    btn_seleccionar_impresora = e.target.closest(".seleccionar-impresoras"); 
    
    if (btn_seleccionar_impresora) {
        id_impresora = btn_seleccionar_impresora.dataset.id;
        modalObtenerImpresora = bootstrap.Modal.getInstance(modalImpresora);
        if (modalObtenerImpresora) modalObtenerImpresora.hide();
        btn_obtener_impresoras.textContent = `${btn_seleccionar_impresora.dataset.nserie}`;
        btn_obtener_impresoras.innerHTML = `<i class="fas fa-print me-2"></i>${btn_seleccionar_impresora.dataset.nserie}`;
    }
});

btn_agregar_ip.addEventListener('click', () => agregar_nueva_ip());

document.addEventListener('DOMContentLoaded', () => {
    asignar_resguardo_contenedor.style.display = 'none';
    asignar_impresoras_contenedor.style.display = 'none';
    obtener_resguaros_para_asignar_ip();
    obtener_impresoras_para_asignar_ip();
    
    // Estilizar botones principales
    if (btn_obtener_resguardos) {
        if (!btn_obtener_resguardos.innerHTML.includes('fa-')) {
            btn_obtener_resguardos.innerHTML = `<i class="fas fa-search me-2"></i>${btn_obtener_resguardos.textContent}`;
        }
        
        btn_obtener_resguardos.style.cssText = `
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
        
        btn_obtener_resguardos.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f8f5f2';
            this.style.borderColor = '#722f37';
        });
        
        btn_obtener_resguardos.addEventListener('mouseleave', function() {
            this.style.backgroundColor = 'white';
            this.style.borderColor = '#b08d57';
        });
    }
    
    if (btn_obtener_impresoras) {
        if (!btn_obtener_impresoras.innerHTML.includes('fa-')) {
            btn_obtener_impresoras.innerHTML = `<i class="fas fa-search me-2"></i>${btn_obtener_impresoras.textContent}`;
        }
        
        btn_obtener_impresoras.style.cssText = `
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
        
        btn_obtener_impresoras.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f8f5f2';
            this.style.borderColor = '#722f37';
        });
        
        btn_obtener_impresoras.addEventListener('mouseleave', function() {
            this.style.backgroundColor = 'white';
            this.style.borderColor = '#b08d57';
        });
    }
    
    if (btn_agregar_ip) {
        if (!btn_agregar_ip.innerHTML.includes('fa-')) {
            btn_agregar_ip.innerHTML = `<i class="fas fa-plus-circle me-2"></i>${btn_agregar_ip.innerHTML}`;
        }
        
        btn_agregar_ip.style.cssText = `
            background: linear-gradient(135deg, #722f37 0%, #8a3b45 100%);
            color: white;
            border: 1px solid #b08d57;
            border-radius: 8px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Arial', sans-serif;
        `;
        
        btn_agregar_ip.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 5px 15px rgba(114, 47, 55, 0.2)';
        });
        
        btn_agregar_ip.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    }
    
    // Estilizar radio buttons
    radios.forEach(radio => {
        const label = document.querySelector(`label[for="${radio.id}"]`);
        if (label && !label.innerHTML.includes('fa-')) {
            if (radio.id === 'equipos') {
                label.innerHTML = `<i class="fas fa-computer me-2"></i>${label.textContent}`;
            } else if (radio.id === 'impresoras') {
                label.innerHTML = `<i class="fas fa-print me-2"></i>${label.textContent}`;
            }
        }
    });
    
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
        .btn-seleccionar-resguardo:hover {
            background: linear-gradient(135deg, #8a3b45 0%, #722f37 100%) !important;
            transform: translateY(-1px);
        }
        
        .btn-seleccionar-impresora:hover {
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
        
        /* Estilos para radio buttons */
        .form-check-input:checked {
            background-color: #722f37;
            border-color: #722f37;
        }
        
        .form-check-input:focus {
            border-color: #b08d57;
            box-shadow: 0 0 0 0.25rem rgba(176, 141, 87, 0.25);
        }
        
        .form-check-label {
            font-family: 'Arial', sans-serif;
            font-weight: 500;
        }
    `;
    document.head.appendChild(style);
});