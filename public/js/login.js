const logear_usuario = () => {
    let data = new FormData(document.getElementById('formulario_login'));
    const btnIngresar = document.getElementById('btn-ingresar');
    const originalText = btnIngresar.innerHTML;
    btnIngresar.innerHTML = '<span class="loading"></span> Verificando credenciales...';
    btnIngresar.disabled = true;
    
    fetch("app/controller/login.php", {
        method: "POST",
        body: data
    }).then(respuesta => respuesta.json())
    .then(async respuesta => {
        btnIngresar.innerHTML = originalText;
        btnIngresar.disabled = false;
        
        if (respuesta[0] == 1) {
            console.log(respuesta[1]);

            await Swal.fire({
                icon: "success",
                title: "Acceso autorizado",
                html: `
                    <div style="text-align: center; padding: 10px;">
                        <div style="color: #722f37; font-size: 1.5rem; margin-bottom: 15px; font-weight: bold;">
                            <i class="bi bi-shield-check" style="color: #b38e5d; margin-right: 10px;"></i>
                            ${respuesta[1]}
                        </div>
                        <div style="color: #5a5349; font-size: 0.9rem; background: #f8f5f2; padding: 10px; border-radius: 8px; border-left: 4px solid #b38e5d;">
                            Redirigiendo al sistema SADCTI...
                        </div>
                    </div>
                `,
                background: '#ffffff',
                color: '#3c3a36',
                iconColor: '#b38e5d',
                confirmButtonColor: '#722f37',
                confirmButtonText: 'Continuar',
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            setTimeout(() => {
                window.location = "inicio";
            }, 500);
            
        } else {
            console.log(respuesta[1]);
            
            Swal.fire({
                icon: "error",
                title: "Acceso denegado",
                html: `
                    <div style="text-align: center; padding: 10px;">
                        <div style="color: #722f37; font-size: 1.2rem; margin-bottom: 10px; font-weight: bold;">
                            <i class="bi bi-shield-exclamation" style="color: #9d4a54; margin-right: 10px;"></i>
                            ${respuesta[1]}
                        </div>
                        <div style="color: #7a756e; font-size: 0.85rem; background: #f8f5f2; padding: 10px; border-radius: 8px; margin-top: 15px; border-left: 4px solid #9d4a54;">
                            Verifique sus credenciales e intente nuevamente.
                        </div>
                    </div>
                `,
                background: '#ffffff',
                color: '#3c3a36',
                iconColor: '#9d4a54',
                confirmButtonColor: '#8c6d46',
                confirmButtonText: 'Reintentar',
                showCancelButton: true,
                cancelButtonText: 'Recuperar acceso',
                cancelButtonColor: '#a39e97',
                focusConfirm: true,
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('pass').value = '';
                    document.getElementById('pass').focus();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'Recuperar acceso',
                        html: `
                            <div style="text-align: left;">
                                <p style="color: #5a5349; margin-bottom: 15px;">Ingrese su correo electrónico para recuperar el acceso:</p>
                                <input type="email" id="recovery-email" class="swal2-input" placeholder="correo@institucion.gob.mx" style="border-color: #b38e5d;">
                            </div>
                        `,
                        background: '#ffffff',
                        color: '#3c3a36',
                        confirmButtonColor: '#722f37',
                        confirmButtonText: 'Enviar enlace',
                        showCancelButton: true,
                        cancelButtonText: 'Cancelar',
                        cancelButtonColor: '#a39e97',
                        preConfirm: () => {
                            const email = document.getElementById('recovery-email').value;
                            if (!email || !/^\S+@\S+\.\S+$/.test(email)) {
                                Swal.showValidationMessage('Por favor ingrese un correo electrónico válido');
                                return false;
                            }
                            return email;
                        }
                    }).then((result2) => {
                        if (result2.isConfirmed) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Enlace enviado',
                                html: `
                                    <div style="text-align: center;">
                                        <div style="color: #722f37; margin-bottom: 15px;">
                                            <i class="bi bi-envelope-check" style="color: #b38e5d; font-size: 2.5rem; margin-bottom: 15px;"></i>
                                        </div>
                                        <p style="color: #5a5349;">
                                            Se ha enviado un enlace de recuperación a:<br>
                                            <strong>${result2.value}</strong>
                                        </p>
                                        <div style="background: #f8f5f2; padding: 10px; border-radius: 8px; margin-top: 15px; font-size: 0.85rem; color: #7a756e;">
                                            <i class="bi bi-info-circle" style="color: #b38e5d; margin-right: 5px;"></i>
                                            Revise su bandeja de entrada (y carpeta de spam).
                                        </div>
                                    </div>
                                `,
                                background: '#ffffff',
                                confirmButtonColor: '#8c6d46',
                                confirmButtonText: 'Entendido'
                            });
                        }
                    });
                }
            });
        }
    }).catch(error => {
        btnIngresar.innerHTML = originalText;
        btnIngresar.disabled = false;
        
        console.error('Error en la solicitud:', error);
        Swal.fire({
            icon: "warning",
            title: "Error de conexión",
            html: `
                <div style="text-align: center; padding: 10px;">
                    <div style="color: #722f37; font-size: 1.2rem; margin-bottom: 10px; font-weight: bold;">
                        <i class="bi bi-wifi-off" style="color: #8c6d46; margin-right: 10px;"></i>
                        Error de conexión al servidor
                    </div>
                    <div style="color: #7a756e; font-size: 0.85rem; background: #f8f5f2; padding: 10px; border-radius: 8px; margin-top: 15px; border-left: 4px solid #8c6d46;">
                        Verifique su conexión a internet e intente nuevamente.
                    </div>
                </div>
            `,
            background: '#ffffff',
            color: '#3c3a36',
            iconColor: '#8c6d46',
            confirmButtonColor: '#722f37',
            confirmButtonText: 'Reintentar'
        }).then(() => {
            logear_usuario();
        });
    });
}

document.getElementById('btn-ingresar').addEventListener('click', () => {
    const usuario = document.getElementById('usuario').value.trim();
    const pass = document.getElementById('pass').value.trim();
    
    if (!usuario || !pass) {
        Swal.fire({
            icon: "warning",
            title: "Campos incompletos",
            html: `
                <div style="text-align: center; padding: 10px;">
                    <div style="color: #722f37; font-size: 1.2rem; margin-bottom: 10px; font-weight: bold;">
                        <i class="bi bi-exclamation-triangle" style="color: #8c6d46; margin-right: 10px;"></i>
                        Complete todos los campos
                    </div>
                    <div style="color: #7a756e; font-size: 0.85rem; background: #f8f5f2; padding: 10px; border-radius: 8px; margin-top: 15px; border-left: 4px solid #8c6d46;">
                        Por favor ingrese su correo electrónico y contraseña.
                    </div>
                </div>
            `,
            background: '#ffffff',
            color: '#3c3a36',
            iconColor: '#8c6d46',
            confirmButtonColor: '#722f37',
            confirmButtonText: 'Entendido'
        });
        if (!usuario) {
            document.getElementById('usuario').focus();
        } else {
            document.getElementById('pass').focus();
        }
        
        return;
    }
    if (usuario.includes('@')) {
        const emailRegex = /^\S+@\S+\.\S+$/;
        if (!emailRegex.test(usuario)) {
            Swal.fire({
                icon: "warning",
                title: "Formato incorrecto",
                html: `
                    <div style="text-align: center; padding: 10px;">
                        <div style="color: #722f37; font-size: 1.2rem; margin-bottom: 10px; font-weight: bold;">
                            <i class="bi bi-envelope-x" style="color: #8c6d46; margin-right: 10px;"></i>
                            Correo electrónico inválido
                        </div>
                        <div style="color: #7a756e; font-size: 0.85rem; background: #f8f5f2; padding: 10px; border-radius: 8px; margin-top: 15px; border-left: 4px solid #8c6d46;">
                            Ingrese un correo electrónico válido (ejemplo: usuario@institucion.gob.mx)
                        </div>
                    </div>
                `,
                background: '#ffffff',
                color: '#3c3a36',
                iconColor: '#8c6d46',
                confirmButtonColor: '#722f37',
                confirmButtonText: 'Corregir'
            }).then(() => {
                document.getElementById('usuario').focus();
                document.getElementById('usuario').select();
            });
            return;
        }
    }
    
    logear_usuario();
});

document.getElementById('formulario_login').addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        e.preventDefault();
        document.getElementById('btn-ingresar').click();
    }
});

document.getElementById('usuario').addEventListener('blur', function() {
    const value = this.value.trim();
    if (value && value.includes('@')) {
        const emailRegex = /^\S+@\S+\.\S+$/;
        if (!emailRegex.test(value)) {
            this.style.borderColor = '#9d4a54';
            this.style.boxShadow = '0 0 0 2px rgba(157, 74, 84, 0.1)';
        } else {
            this.style.borderColor = '#b38e5d';
            this.style.boxShadow = '0 0 0 2px rgba(179, 142, 93, 0.1)';
        }
    } else {
        this.style.borderColor = '';
        this.style.boxShadow = '';
    }
});

document.getElementById('pass').addEventListener('input', function() {
    if (this.value.length > 0) {
        if (this.value.length < 6) {
            this.style.borderColor = '#9d4a54';
        } else {
            this.style.borderColor = '#b38e5d';
        }
    } else {
        this.style.borderColor = '';
    }
});
const inputs = document.querySelectorAll('.form-control');
inputs.forEach(input => {
    input.addEventListener('focus', function() {
        this.style.transform = 'translateY(-1px)';
        this.style.boxShadow = '0 4px 12px rgba(179, 142, 93, 0.15)';
    });
    
    input.addEventListener('blur', function() {
        this.style.transform = '';
        this.style.boxShadow = '';
    });
});
document.addEventListener('DOMContentLoaded', function() {
    console.log('Sistema SADCTI - Login inicializado');

    const savedUser = localStorage.getItem('sadcti_last_user');
    if (savedUser) {
        document.getElementById('usuario').value = savedUser;
        document.getElementById('pass').focus();
    }
    

    document.getElementById('usuario').addEventListener('change', function() {
        if (this.value.trim()) {
            localStorage.setItem('sadcti_last_user', this.value.trim());
        }
    });
});