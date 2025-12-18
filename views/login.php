<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="<?=CSS."bootstrap.min.css"?>">
  <link rel="stylesheet" href="<?=CSS."icons/font/bootstrap-icons.min.css"?>">
  <link rel="stylesheet" href="<?=CSS.'login.css'?>" />
  <title>SADCTI - Inicio de Sesión</title>
</head>
<body>
  <header class="header">
    <div class="header-container">
      <div class="logo-container">
        <img src="public/img/imagen2.png" alt="Logo Institución" class="institution-logo">
        <div class="institution-name">
          Subadministración Desconcentrada de Comunicaciones y Tecnologías<br>de la Información Distrito Federal "4 Sur"
        </div>
      </div>
      <div class="logo-box">
        <img src="public/img/sat.png" alt="SAT" class="institution-logo">
      </div>
    </div>
  </header>

  <main class="main-container">
    <section class="info-panel">
      <h1 class="system-name">SADCTI</h1>
      <p class="system-tagline">Subadministración Desconcentrada de Comunicaciones y Tecnologías de la Información</p>
      <p class="system-description">
        Su espacio único para la interacción con el gobierno. 
        SADCTI es un programa que te permite hacer busquedas y buena administración en resguados y datos personales en la empresa. 
      </p>
      
      <div class="divider"></div>
      
      <h3 style="color: var(--color-vino); margin-bottom: 20px; font-size: 1.3rem;">
        <i class="bi bi-stars bronze-accent"></i> Características del Sistema
      </h3>
      <ul class="features-list">
        <li><i class="bi bi-shield-check"></i> Seguridad de nivel empresarial</li>
        <li><i class="bi bi-folder-check"></i> Gestión centralizada de información personal</li>
        <li><i class="bi bi-clock-history"></i> Historial completo de equipos y resguardos seguros</li>
        <li><i class="bi bi-bell"></i> Notificaciones en tiempo real</li>
        <li><i class="bi bi-cloud-arrow-up"></i> Almacenamiento en la nube seguro</li>
      </ul>
    </section>

    <section class="login-panel">
      <div class="login-header">
        <h2 class="login-title">Iniciar Sesión</h2>
        <p class="login-subtitle">Acceda a su cuenta SADCTI</p>
      </div>

      <form id="formulario_login">
        <div class="form-group">
          <label for="usuario" class="form-label">
            <i class="bi bi-envelope"></i> correo electronico o usuario
          </label>
          <input 
            type="text" 
            class="form-control" 
            id="usuario" 
            name="usuario" 
            placeholder="ejemplo@dominio.com"
            required>
        </div>

        <div class="form-group">
          <label for="pass" class="form-label">
            <i class="bi bi-key"></i> Contraseña (password)
          </label>
          <div class="password-container">
            <input 
              type="password" 
              class="form-control" 
              id="pass" 
              name="pass" 
              placeholder="Ingrese su contraseña"
              required>
            <button type="button" class="password-toggle" id="togglePassword">
              <i class="bi bi-eye"></i>
            </button>
          </div>
        </div>

        <button type="button" id="btn-ingresar" class="btn btn-primary">
          <i class="bi bi-box-arrow-in-right"></i> Ingresar al Sistema
        </button>
      </form>

      <div class="help-section">
        <h3 class="help-title">¿Tiene alguna pregunta? Podemos ayudarle desde aquí</h3>
        <div class="help-links">
          <a href="./views/recovery.php" class="help-link">
            <i class="bi bi-key"></i> ¿Olvidó su contraseña?
          </a>
        </div>
      </div>
    </section>
  </main>

  <footer class="footer">
      <div class="copyright">
        <i class="bi bi-shield-lock"></i> Sistema protegido por el Servicio de Administración Tributaria - SADCTI © 2025
      </div>
    </div>
  </footer>

  <script src="<?=JS."bootstrap.bundle.min.js"?>"></script>
  <script src="<?=JS."alerts.js"?>"></script>
  <script src="<?=JS.'login.js'?>"></script>
  
  <script>
    document.getElementById('togglePassword').addEventListener('click', function() {
      const passwordInput = document.getElementById('pass');
      const icon = this.querySelector('i');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
      } else {
        passwordInput.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
      }
    });
    
    document.getElementById('btn-ingresar').addEventListener('click', function() {
      const btn = this;
      const originalText = btn.innerHTML;
      
      btn.innerHTML = '<span class="loading"></span> Ingresando...';
      btn.disabled = true;
      
    });
  </script>
</body>
</html>