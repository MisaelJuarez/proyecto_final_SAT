let tablaColaboradores;
const btn_editar_colaborador = document.getElementById('btn-editar-colaborador');
const contenedor_editar_colaborador = document.getElementById('contenedor-editar-colaborador');
const informacion_de_colaboradores = document.getElementById('informacion-de-colaboradores');

const nombre = document.getElementById('nombre');
const apellidos = document.getElementById('apellidos');
const rfc = document.getElementById('rfc');
const rfc_corto = document.getElementById('rfc_corto');
const usuario = document.getElementById('usuario');
const area = document.getElementById('area');
const administrador = document.getElementById('tipo');
const correo = document.getElementById('correo');

let areas = '<option selected>Ingrese el area que pertenece</option>';
let id_colaborador_editar;

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

const obtener_datos_colaboradores = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_datos_colaboradores');
    fetch("app/controller/usuario.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        if (tablaColaboradores) {
            tablaColaboradores.clear().rows.add(respuesta).draw(); 
        } else {
            tablaColaboradores = $('#tablaColaboradores').DataTable({
                data: respuesta, 
                columns: [
                    { data: 'nombre' }, 
                    { data: 'apellidos' }, 
                    { data: 'correo' }, 
                    { data: 'nombre_area' }, 
                    { data: 'administrador',
                        render: function(data) {
                            return (data == 1) ? 
                                '<span class="badge-admin"><i class="fas fa-shield-alt me-1"></i>Administrador</span>' : 
                                '<span class="badge-user"><i class="fas fa-user me-1"></i>Usuario</span>';
                        }
                    }, 
                    {
                        data: 'id_colaborador',
                        className: "text-center",
                        render: function(data, type, row) {
                            return `
                                <div class="btn-group" role="group">
                                    <button class="btn btn-editar-colaborador editar-colaborador"
                                        data-id="${data}" 
                                        data-nombre="${row.nombre}" 
                                        data-apellidos="${row.apellidos}" 
                                        data-rfc="${row.rfc}" 
                                        data-rfccorto="${row.rfc_corto}" 
                                        data-usuario="${row.usuario}"   
                                        data-area='${row.area}'   
                                        data-administrador='${row.administrador}'   
                                        data-correo='${row.correo}'   
                                    >
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-eliminar-colaborador eliminar-colaborador"
                                        data-id="${data}"
                                    >
                                        <i class="fas fa-trash me-1"></i>Eliminar
                                    </button>
                                </div>
                            `;
                        }
                    } 
                ],
                "lengthChange": false,
                "pageLength": 8,
                language: { url: "./public/json/lenguaje.json" },
                dom: '<"custom-toolbar"lf>tip', 
                initComplete: function() {
                    // Estilizar botones de la tabla después de cargar
                    $('.btn-editar-colaborador').each(function() {
                        this.style.cssText = `
                            background: linear-gradient(135deg, #b08d57 0%, #d4b483 100%);
                            color: white;
                            border: 1px solid #8a3b45;
                            border-radius: 6px 0 0 6px;
                            padding: 6px 12px;
                            font-weight: 500;
                            font-size: 0.85rem;
                            transition: all 0.3s ease;
                        `;
                    });
                    
                    $('.btn-eliminar-colaborador').each(function() {
                        this.style.cssText = `
                            background: linear-gradient(135deg, #8a3b45 0%, #9d4a54 100%);
                            color: white;
                            border: 1px solid #722f37;
                            border-radius: 0 6px 6px 0;
                            padding: 6px 12px;
                            font-weight: 500;
                            font-size: 0.85rem;
                            transition: all 0.3s ease;
                        `;
                    });
                }
            });
        }
    });
};

const editar_informacion_colaborador = (id) => {
    const nombreValue = nombre.value.trim();
    const apellidosValue = apellidos.value.trim();
    const rfcValue = rfc.value.trim();
    const correoValue = correo.value.trim();
    
    // Validación de campos
    if (!nombreValue || !apellidosValue || !rfcValue || !correoValue) {
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
                        Nombre, apellidos, RFC y correo electrónico son obligatorios.
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
    
    const btnOriginalText = btn_editar_colaborador.innerHTML;
    btn_editar_colaborador.innerHTML = '<span class="loading"></span> Actualizando...';
    btn_editar_colaborador.disabled = true;
    
    let data = new FormData(document.getElementById('formulario-editar-colaborador'));
    data.append('id',id);
    data.append('metodo','editar_informacion_colaborador');
    
    fetch("app/controller/usuario.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        btn_editar_colaborador.innerHTML = btnOriginalText;
        btn_editar_colaborador.disabled = false;
        
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
                            La información del colaborador ha sido actualizada correctamente.
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
            contenedor_editar_colaborador.style.display = "none";
            informacion_de_colaboradores.style.display = "block";
            obtener_datos_colaboradores();
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
        btn_editar_colaborador.innerHTML = btnOriginalText;
        btn_editar_colaborador.disabled = false;
        
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

const eliminar_colaborador = (id) => {
    const btnOriginalText = informacion_de_colaboradores.querySelector(`button[data-id="${id}"]`).innerHTML;
    informacion_de_colaboradores.querySelector(`button[data-id="${id}"]`).innerHTML = '<span class="loading"></span> Eliminando...';
    informacion_de_colaboradores.querySelector(`button[data-id="${id}"]`).disabled = true;
    
    let data = new FormData();
    data.append('id',id);
    data.append('metodo','eliminar_colaborador');
    
    fetch("app/controller/usuario.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        // Restaurar botón
        const buttons = document.querySelectorAll(`button[data-id="${id}"]`);
        buttons.forEach(btn => {
            btn.innerHTML = btnOriginalText;
            btn.disabled = false;
        });
        
        if (respuesta[0] == 1) {
            await Swal.fire({
                title: respuesta[1],
                html: `
                    <div style="text-align: center; padding: 10px;">
                        <div style="color: #722f37; font-size: 1.4rem; margin-bottom: 15px; font-weight: bold;">
                            <i class="fas fa-user-check" style="color: #b08d57; margin-right: 10px; font-size: 2.5rem;"></i>
                            ${respuesta[1]}
                        </div>
                        <div style="color: #5a5349; font-size: 0.9rem; background: #f8f5f2; padding: 15px; border-radius: 8px; border-left: 4px solid #b08d57; margin: 15px 0;">
                            Colaborador eliminado exitosamente del sistema.
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
            contenedor_editar_colaborador.style.display = "none";
            informacion_de_colaboradores.style.display = "block";
            obtener_datos_colaboradores();
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
                            No se pudo eliminar al colaborador.
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
        // Restaurar botón en caso de error
        const buttons = document.querySelectorAll(`button[data-id="${id}"]`);
        buttons.forEach(btn => {
            btn.innerHTML = btnOriginalText;
            btn.disabled = false;
        });
        
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

informacion_de_colaboradores.addEventListener('click', (e) => {
    if (e.target.classList.contains("editar-colaborador") || e.target.closest(".editar-colaborador")) {
        const btn = e.target.classList.contains("editar-colaborador") ? e.target : e.target.closest(".editar-colaborador");
        
        informacion_de_colaboradores.style.display = "none";
        contenedor_editar_colaborador.style.display = "block";

        nombre.value = btn.dataset.nombre;
        apellidos.value = btn.dataset.apellidos;
        rfc.value = btn.dataset.rfc;
        rfc_corto.value = btn.dataset.rfccorto;
        usuario.value = btn.dataset.usuario;
        area.value = btn.dataset.area;
        administrador.value = btn.dataset.administrador;
        correo.value = btn.dataset.correo;
        id_colaborador_editar = btn.dataset.id;
    }

    if (e.target.classList.contains("eliminar-colaborador") || e.target.closest(".eliminar-colaborador")) {
        const btn = e.target.classList.contains("eliminar-colaborador") ? e.target : e.target.closest(".eliminar-colaborador");
        
        console.log(btn.dataset.id);
        Swal.fire({
            title: "Eliminar colaborador",
            html: `
                <div style="text-align: center; padding: 10px;">
                    <div style="color: #722f37; font-size: 1.3rem; margin-bottom: 15px; font-weight: bold;">
                        <i class="fas fa-user-times" style="color: #8a3b45; margin-right: 10px; font-size: 2rem;"></i>
                        ¿Eliminar colaborador?
                    </div>
                    <div style="color: #5a5349; font-size: 0.9rem; background: #f8f5f2; padding: 15px; border-radius: 8px; border: 1px solid #f0e9df;">
                        <strong>Esta acción no se puede deshacer.</strong><br>
                        El colaborador será eliminado permanentemente del sistema.
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
                eliminar_colaborador(btn.dataset.id);
            }
        });
    }
});

btn_editar_colaborador.addEventListener('click', () => {
    if (id_colaborador_editar) {
        editar_informacion_colaborador(id_colaborador_editar);
    } else {
        Swal.fire({
            icon: "warning",
            title: "Seleccione un colaborador",
            html: `
                <div style="text-align: center; padding: 10px;">
                    <div style="color: #722f37; font-size: 1.2rem; margin-bottom: 10px; font-weight: bold;">
                        <i class="fas fa-user" style="color: #b08d57; margin-right: 10px;"></i>
                        Seleccione un colaborador primero
                    </div>
                    <div style="color: #7a756e; font-size: 0.85rem; background: #f8f5f2; padding: 10px; border-radius: 8px; margin-top: 15px; border-left: 4px solid #b08d57;">
                        Haga clic en el botón "Editar" de un colaborador para modificar sus datos.
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
    contenedor_editar_colaborador.style.display = "none";
    obtener_areas();
    obtener_datos_colaboradores();
    
    // Estilizar botón principal
    if (btn_editar_colaborador) {
        if (!btn_editar_colaborador.innerHTML.includes('fa-')) {
            btn_editar_colaborador.innerHTML = `<i class="fas fa-save me-2"></i>${btn_editar_colaborador.innerHTML}`;
        }
        
        btn_editar_colaborador.style.cssText = `
            background: linear-gradient(135deg, #722f37 0%, #8a3b45 100%);
            color: white;
            border: 1px solid #b08d57;
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Arial', sans-serif;
        `;
        
        btn_editar_colaborador.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 5px 15px rgba(114, 47, 55, 0.2)';
        });
        
        btn_editar_colaborador.addEventListener('mouseleave', function() {
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
        
        .badge-admin {
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
        
        .badge-user {
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
        .btn-editar-colaborador:hover {
            background: linear-gradient(135deg, #d4b483 0%, #b08d57 100%) !important;
            transform: translateY(-1px);
        }
        
        .btn-eliminar-colaborador:hover {
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