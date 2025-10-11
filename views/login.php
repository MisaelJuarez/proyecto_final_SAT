<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="<?=CSS.'login.css'?>" />
  <title>Sistema De Información Jurídica y Auditoria - SAT</title>
</head>
<body>
  <nav class="navbar navbar-light bg-light shadow-sm py-1">
    <div class="container d-flex justify-content-between align-items-center">
      <a class="navbar-brand d-flex align-items-center gap-2" href="#">
        <div class="logo-box">
          <img src="public/img/imagen2.png" alt="Logo" width="100%" height="auto">
        </div>
        <span class="fw-semibold text-dark">Sistema Jurídica y Auditoría (SIJA)</span>
      </a>
      <div class="logo-box">
        <img src="public/img/sat.png" alt="SAT" width="100%" height="auto">
      </div>
    </div>
  </nav>

  <div class="login-container">
    <div class="login-background"></div>

    <div class="login-card mx-auto text-center">
      <div class="sat-logo mb-3">
        <div class="sat-inner">
          <img src="public/img/sat2.png" alt="Logo SAT 2">
        </div>
      </div>
      <h1 class="login-title mb-2">Sistema de Información Jurídica y Auditoría</h1>
      <p class="login-subtitle mb-4">Servicio de Administración Tributaria</p>

      <form id="formulario_login">
        <div class="floating-label mb-4">
          <input type="text" class="form-control" id="usuario" name="usuario" placeholder=" " required>
          <label for="usuario"><i class="bi bi-person-circle me-2"></i>Usuario autorizado</label>
        </div>
        <div class="floating-label mb-4">
          <input type="password" class="form-control" id="pass" name="pass" placeholder=" " required>
          <label for="pass"><i class="bi bi-shield-lock me-2"></i>Contraseña de acceso</label>
        </div>
        <button type="button" id="btn-ingresar" class="btn btn-primary w-100 mb-3">
          <i class="bi bi-box-arrow-in-right me-2"></i>Acceder al Sistema
        </button>
        <div>
          <a href="#" class="login-link me-3"><i class="bi bi-question-circle me-1"></i>Recuperar acceso</a>
          <a href="#" class="login-link"><i class="bi bi-person-plus me-1"></i>Solicitar credenciales</a>
        </div>
      </form>

      <p class="footer-text mt-4">
        <i class="bi bi-shield-lock me-1"></i>
        Sistema protegido bajo las normativas de seguridad del SAT
      </p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?=JS.'login.js'?>"></script>
</body>
</html>



