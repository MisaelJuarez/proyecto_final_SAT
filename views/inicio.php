<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="<?=CSS."bootstrap.min.css"?>">
  <link rel="stylesheet" href="<?=CSS."icons/font/bootstrap-icons.min.css"?>">
  <link rel="stylesheet" href="<?=CSS.'inicio.css'?>" />
  <title>Sistema Integral SADCTI</title>
</head>
<body>
  <header class="government-header">
    <div class="container">
      <div class="header-institutional">
        <div class="government-branding">
          <div class="gov-logo-container">
            <img src="public/img/gobierno.png" alt="Gobierno de México" class="gov-logo">
          </div>
          <div class="institution-info-center">
            <h1 class="institution-name">SERVICIO DE ADMINISTRACIÓN TRIBUTARIA</h1>
            <h2 class="department-name">Subadministración Desconcentrada de Comunicaciones y Tecnologías de la Información</h2>
            <div class="location-tag">Distrito Federal "4 Sur"</div>
          </div>
          <div class="sat-logo-container">
            <img src="public/img/sat.png" alt="Servicio de Administración Tributaria" class="sat-logo">
          </div>
        </div>
      </div>
    </div>
  </header>

  <main class="government-content">
    <section class="institutional-presentation">
      <div class="container">
        <div class="presentation-content">
          <div class="presentation-header">
            <h1 class="presentation-title">
              <span class="title-main">BIENVENIDO AL SISTEMA</span>
              <span class="title-sub">SADCTI</span>
            </h1>
            <div class="presentation-divider"></div>
            <p class="presentation-mission">
              Plataforma oficial para la administración, control y optimización de recursos tecnológicos 
              y procesos de comunicación institucional.
            </p>
          </div>
          
          <div class="institutional-values">
            <div class="value-card">
              <div class="value-icon">
                <i class="bi bi-shield-check"></i>
              </div>
              <h3 class="value-title">Seguridad Institucional</h3>
              <p class="value-description">Protección de información gubernamental con estándares de seguridad del más alto nivel.</p>
            </div>
            
            <div class="value-card">
              <div class="value-icon">
                <i class="bi bi-cpu"></i>
              </div>
              <h3 class="value-title">Gestión Tecnológica</h3>
              <p class="value-description">Administración eficiente de recursos informáticos y sistemas de comunicación.</p>
            </div>
            
            <div class="value-card">
              <div class="value-icon">
                <i class="bi bi-clipboard-data"></i>
              </div>
              <h3 class="value-title">Control y Auditoría</h3>
              <p class="value-description">Seguimiento y verificación de procesos conforme a normativas institucionales.</p>
            </div>
            
            <div class="value-card">
              <div class="value-icon">
                <i class="bi bi-file-earmark-check"></i>
              </div>
              <h3 class="value-title">Cumplimiento Normativo</h3>
              <p class="value-description">Alineación con regulaciones gubernamentales y organismos fiscalizadores.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="government-purpose">
      <div class="container">
        <div class="purpose-statement">
          <h2 class="purpose-title">
            <i class="bi bi-bullseye"></i> PROPÓSITO INSTITUCIONAL
          </h2>
          <div class="purpose-content">
            <div class="purpose-text">
              <p class="purpose-paragraph">
                El Sistema Integral SADCTI tiene como objetivo fundamental proveer una plataforma tecnológica robusta 
                y segura para la gestión integral de comunicaciones y tecnologías de la información en el ámbito 
                de la administración pública federal.
              </p>
              <p class="purpose-paragraph">
                Este sistema está diseñado para optimizar procesos, garantizar la seguridad de la información 
                y asegurar el cumplimiento de las normativas establecidas.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="info-banner">
      <div class="container">
        <div class="banner-content">
          <div class="banner-icon">
            <i class="bi bi-shield-lock"></i>
          </div>
          <div class="banner-message">
            <h3 class="banner-title">SISTEMA DE GESTIÓN INSTITUCIONAL</h3>
            <p class="banner-text">
              Plataforma diseñada para el manejo seguro y eficiente de información y recursos tecnológicos.
            </p>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer class="government-footer">
    <div class="container">
      <div class="footer-institutional">
        <div class="footer-identity">
          <div class="footer-brand">
            <h4 class="footer-title">SADCTI</h4>
            <p class="footer-subtitle">Subadministración Desconcentrada de Comunicaciones y Tecnologías de la Información</p>
          </div>
          <div class="footer-emblems">
            <img src="public/img/gobierno.png" alt="Gobierno de México" class="footer-emblem">
            <img src="public/img/sat.png" alt="SAT" class="footer-emblem">
          </div>
        </div>
        
        <div class="footer-contact">
          <div class="contact-section">
            <h5 class="contact-title">INFORMACIÓN DE CONTACTO</h5>
            <div class="contact-info">
              <p><i class="bi bi-geo-alt"></i> Distrito Federal "4 Sur"</p>
              <p><i class="bi bi-clock"></i> Horario: Lunes a Viernes 8:00 - 18:00 hrs</p>
            </div>
          </div>
          
          <div class="contact-section">
            <h5 class="contact-title">SERVICIO DE ADMINISTRACIÓN TRIBUTARIA</h5>
            <div class="contact-info">
              <p><i class="bi bi-telephone"></i> Teléfono: 01 800 463 6728</p>
              <p><i class="bi bi-envelope"></i> Correo: atencion.ciudadana@sat.gob.mx</p>
            </div>
          </div>
        </div>
      </div>
      
      <div class="footer-legal">
        <div class="legal-notice">
          <p class="legal-text">
            <i class="bi bi-shield-lock"></i> Sistema protegido bajo normativas de seguridad
          </p>
          <p class="copyright">
            &copy; 2025 Gobierno de México - SADCTI. Todos los derechos reservados.
          </p>
        </div>
        <div class="system-version">
          <span class="version">Versión 3.2.1</span>
        </div>
      </div>
    </div>
  </footer>
  <script src="<?=JS."bootstrap.bundle.min.js"?>"></script>
</body>
</html>