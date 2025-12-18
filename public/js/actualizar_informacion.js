const nombre = document.getElementById('nombre');
const apellidos = document.getElementById('apellidos');
const rfc = document.getElementById('rfc');
const rfc_corto = document.getElementById('rfc_corto');
const usuario = document.getElementById('usuario');
const area = document.getElementById('area');
const correo = document.getElementById('correo');

const btn_actualizar_informacion = document.getElementById('btn-actualizar-informacion');
let areas = '<option selected>Ingrese el area que pertenece</option>';
let optionsAreas = '<option value="" selected>Seleccione el area</option>';

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

const obtener_informacion_actualizar = () => {
    let data = new FormData();
    data.append('metodo','obtener_informacion_actualizar');
    fetch("app/controller/usuario.php",{
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        nombre.value = respuesta['nombre'];
        apellidos.value = respuesta['apellidos'];
        rfc.value = respuesta['rfc'];
        rfc_corto.value = respuesta['rfc_corto'];
        usuario.value = respuesta['usuario'];
        correo.value = respuesta['correo'];
        setTimeout(() => area.value = respuesta['area'], 10);
    });
}

const actualizar_informacion = () => {
    const nombreValue = nombre.value.trim();
    const apellidosValue = apellidos.value.trim();
    const rfcValue = rfc.value.trim();
    const correoValue = correo.value.trim();
    
    // Validación de campos requeridos
    if (!nombreValue || !apellidosValue || !rfcValue || !correoValue) {
        Swal.fire({
            icon: "warning",
            title: "Campos incompletos",
            html: `
                <div style="text-align: center; padding: 10px;">
                    <div style="color: #722f37; font-size: 1.2rem; margin-bottom: 10px; font-weight: bold;">
                        <i class="fas fa-exclamation-triangle" style="color: #b08d57; margin-right: 10px;"></i>
                        Complete todos los campos obligatorios
                    </div>
                    <div style="color: #7a756e; font-size: 0.85rem; background: #f8f5f2; padding: 10px; border-radius: 8px; margin-top: 15px; border-left: 4px solid #b08d57;">
                        Nombre, apellidos, RFC y correo electrónico son requeridos.
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
    
    // Validación de formato de correo
    const emailRegex = /^\S+@\S+\.\S+$/;
    if (!emailRegex.test(correoValue)) {
        Swal.fire({
            icon: "warning",
            title: "Correo inválido",
            html: `
                <div style="text-align: center; padding: 10px;">
                    <div style="color: #722f37; font-size: 1.2rem; margin-bottom: 10px; font-weight: bold;">
                        <i class="fas fa-envelope" style="color: #b08d57; margin-right: 10px;"></i>
                        Formato de correo incorrecto
                    </div>
                    <div style="color: #7a756e; font-size: 0.85rem; background: #f8f5f2; padding: 10px; border-radius: 8px; margin-top: 15px; border-left: 4px solid #b08d57;">
                        Ingrese un correo electrónico válido (ejemplo: usuario@institucion.gob.mx)
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
            correo.focus();
            correo.select();
        });
        return;
    }
    
    // Mostrar confirmación
    Swal.fire({
        title: 'Confirmar actualización',
        html: `
            <div style="text-align: center; padding: 10px;">
                <div style="color: #722f37; font-size: 1.3rem; margin-bottom: 15px; font-weight: bold;">
                    <i class="fas fa-user-edit" style="color: #b08d57; margin-right: 10px; font-size: 2rem;"></i>
                    ¿Actualizar información personal?
                </div>
                <div style="color: #5a5349; font-size: 0.9rem; background: #f8f5f2; padding: 15px; border-radius: 8px; border: 1px solid #f0e9df;">
                    <strong>Su sesión se cerrará automáticamente</strong><br>
                    Deberá iniciar sesión nuevamente con los datos actualizados.
                </div>
            </div>
        `,
        background: '#ffffff',
        color: '#3c3a36',
        icon: 'info',
        iconColor: '#b08d57',
        showCancelButton: true,
        confirmButtonColor: '#722f37',
        cancelButtonColor: '#b08d57',
        confirmButtonText: 'Sí, actualizar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true,
        focusConfirm: false,
        focusCancel: true,
        customClass: {
            popup: 'border-radius-16',
            confirmButton: 'btn-vino',
            cancelButton: 'btn-bronce'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const btnOriginalText = btn_actualizar_informacion.innerHTML;
            btn_actualizar_informacion.innerHTML = '<span class="loading"></span> Actualizando...';
            btn_actualizar_informacion.disabled = true;
            
            let data = new FormData(document.getElementById('formulario-actualizar-informacion'));
            data.append('metodo','actualizar_informacion');
            
            fetch("app/controller/usuario.php",{
                method:"POST",
                body: data
            })
            .then(respuesta => respuesta.json())
            .then(async respuesta => {
                btn_actualizar_informacion.innerHTML = btnOriginalText;
                btn_actualizar_informacion.disabled = false;
                
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
                                <div style="color: #5a5349; font-size: 0.9rem; background: #f8f5f2; padding: 15px; border-radius: 8px; border-left: 4px solid #b08d57; margin: 15px 0;">
                                    ${respuesta[2]}
                                </div>
                                <div style="color: #7a756e; font-size: 0.85rem; background: #f8f5f2; padding: 10px; border-radius: 8px; border: 1px dashed #b08d57;">
                                    <i class="fas fa-info-circle" style="color: #b08d57; margin-right: 5px;"></i>
                                    Redirigiendo al inicio de sesión...
                                </div>
                            </div>
                        `,
                        background: '#ffffff',
                        color: '#3c3a36',
                        iconColor: '#b08d57',
                        confirmButtonColor: '#722f37',
                        confirmButtonText: 'Continuar',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        customClass: {
                            popup: 'border-radius-16',
                            confirmButton: 'btn-vino'
                        }
                    });
                    
                    setTimeout(() => {
                        cerrar_session();
                    }, 500);
                    
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
                                    Verifique los datos e intente nuevamente.
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
                btn_actualizar_informacion.innerHTML = btnOriginalText;
                btn_actualizar_informacion.disabled = false;
                
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
    });
}

btn_actualizar_informacion.addEventListener('click', () => actualizar_informacion());

document.addEventListener('DOMContentLoaded', () => {
    obtener_info_tabla('areas',optionsAreas,'id_area','nombre_area',area,2,'');
    obtener_informacion_actualizar();
    
    // Añadir icono al botón si no lo tiene
    if (!btn_actualizar_informacion.innerHTML.includes('fa-')) {
        btn_actualizar_informacion.innerHTML = `<i class="fas fa-save me-2"></i>${btn_actualizar_informacion.innerHTML}`;
    }
    
    // Establecer estilos para el botón
    btn_actualizar_informacion.style.cssText = `
        background: linear-gradient(135deg, #722f37 0%, #8a3b45 100%);
        color: white;
        border: 1px solid #b08d57;
        border-radius: 8px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-family: 'Arial', sans-serif;
    `;
    
    btn_actualizar_informacion.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-2px)';
        this.style.boxShadow = '0 5px 15px rgba(114, 47, 55, 0.2)';
    });
    
    btn_actualizar_informacion.addEventListener('mouseleave', function() {
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