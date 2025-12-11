<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <title>Recuperar contraseña</title>
</head>
<body>
    <div class="row mt-5">
        <div class="col-4"></div>
    
        <div class="col-4">
            <h1>Recuperar tu contraseña</h1>
            <form action="" id="form-recuperar-pass">
                <div class="mb-3">
                    <label for="correo" class="form-label">Ingrese el correo con el que se registro</label>
                    <input type="email" class="form-control" name="correo" id="correo" placeholder="name@example.com">
                </div>
                <button id="btn_recuperar_pass" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Recuperar contraseña</button>
            </form>
        </div>
    
        <div class="col-4"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Token envidado a <span id="correo-enviado"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="form-verificar-token">
                    <label for="toke" class="form-label">Ingrese el token enviado a su correo</label>
                    <input type="email" class="form-control" name="token" id="toek">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn-verificar-token">Verificar</button>
            </div>
            </div>
        </div>
    </div>

    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/alerts.js"></script>
    <script src="../public/js/recovery.js"></script>
</body>
</html>