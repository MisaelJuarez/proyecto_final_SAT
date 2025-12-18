const btn_agregar_colaborador = document.getElementById('btn-agregar-colaborador');
const area = document.getElementById('area');
let areas = '<option selected>Ingrese el area que pertenece</option>';

const formulario_agregar_colaborador = document.getElementById('formulario-agregar-colaborador');

const obtener_areas = () => {
    let data = new FormData();
    data.append('condicion',2);
    data.append('tabla','areas');
    data.append('metodo','obtener_informacion_tabla');
    fetch("app/controller/home.php",{
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        respuesta.map(area => {
            areas += `
                <option value="${area['id_area']}">${area['nombre_area']}</option>
            `;
        });
        area.innerHTML = areas;
    });
}

const agregar_colaborador = () => {
    let data = new FormData(document.getElementById('formulario-agregar-colaborador'));
    data.append('metodo','agregar_colaborador');
    
    const btnOriginalText = btn_agregar_colaborador.innerHTML;
    btn_agregar_colaborador.innerHTML = '<span class="loading"></span> Procesando...';
    btn_agregar_colaborador.disabled = true;
    
    fetch("app/controller/usuario.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        btn_agregar_colaborador.innerHTML = btnOriginalText;
        btn_agregar_colaborador.disabled = false;
        
        if (respuesta[0] == 1) {
            await Swal.fire({
                title: respuesta[1],
                html: `
                    <div style="text-align: center; padding: 10px;">
                        <div style="color: #722f37; font-size: 1.5rem; margin-bottom: 15px; font-weight: bold;">
                            <i class="fas fa-user-check" style="color: #b08d57; margin-right: 10px;"></i>
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
            formulario_agregar_colaborador.reset();
            
            // Restaurar el select de áreas
            area.innerHTML = areas;
            
        } else {
            Swal.fire({
                title: respuesta[1],
                html: `
                    <div style="text-align: center; padding: 10px;">
                        <div style="color: #722f37; font-size: 1.3rem; margin-bottom: 10px; font-weight: bold;">
                            <i class="fas fa-user-times" style="color: #8a3b45; margin-right: 10px;"></i>
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
        btn_agregar_colaborador.innerHTML = btnOriginalText;
        btn_agregar_colaborador.disabled = false;
        
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

btn_agregar_colaborador.addEventListener('click', () => agregar_colaborador());

document.addEventListener('DOMContentLoaded', () => {
    obtener_areas();
    
    // Añadir icono al botón si no lo tiene
    if (!btn_agregar_colaborador.innerHTML.includes('fa-')) {
        btn_agregar_colaborador.innerHTML = `<i class="fas fa-user-plus me-2"></i>${btn_agregar_colaborador.innerHTML}`;
    }
    
    // Establecer estilos para el botón
    btn_agregar_colaborador.style.cssText = `
        background: linear-gradient(135deg, #722f37 0%, #8a3b45 100%);
        color: white;
        border: 1px solid #b08d57;
        border-radius: 8px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-family: 'Arial', sans-serif;
    `;
    
    btn_agregar_colaborador.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-2px)';
        this.style.boxShadow = '0 5px 15px rgba(114, 47, 55, 0.2)';
    });
    
    btn_agregar_colaborador.addEventListener('mouseleave', function() {
        this.style.transform = '';
        this.style.boxShadow = '';
    });
    
    // Añadir estilos CSS para loading y otros elementos
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