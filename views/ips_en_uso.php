<div id="tabla-de-info-ips" class="container-fluid">
    <div class="d-flex px-2 py-3">
        <div class="form-check me-3">
            <input class="form-check-input" type="radio" name="mostrar" value="equipos" id="equipos" checked>
            <label class="form-check-label" for="equipos">
                Equipos de computo
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="mostrar" value="impresoras" id="impresoras">
            <label class="form-check-label" for="impresoras">
                Impresoras
            </label>
        </div>
    </div>

    <h3 class="mb-2 tituloTable">Ips en uso</h3>
    <table id="tablaIps" class="table">
        <thead>
            <tr class="header-tabla">
                <th scope="col" class="border border-white w-50">Ip</th>
                <th scope="col" class="border border-white">Numero de serie</th>
                <th scope="col" class="border border-white">Ver detalles</th>
                <th scope="col" class="border border-white">Quitar del equipo</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div id="informacion-ip" class="container-fluid">
    <h3 class="mb-2 tituloInformacion"><i class="bi bi-pc-display-horizontal"></i> Datos del equipo de computo</h3>
    <table class="table">
        <tbody>
            <tr>
                <td scope="row" class="col-3"><b>Marca</b></td>
                <td id="marca-resguardo"></td>
            </tr>
            <tr>
                <td class="col-3"><b>Modelo</b></td>
                <td id="modelo-resguardo"></td>
            </tr>
            <tr>
                <td class="col-3"><b>No. de serie</b></td>
                <td id="n-serie-resguardo"></td>
            </tr>
            <tr id="hostname-res">
                <td class="col-3"><b>Hostname</b></td>
                <td id="hostname-resguardo"></td>
            </tr>
            <tr id="mac-res">
                <td class="col-3"><b>Mac</b></td>
                <td id="mac-resguardo"></td>
            </tr>
            <tr id="area-impresora">
                <td class="col-3"><b>Area</b></td>
                <td id="area-resguardo"></td>
            </tr>
            <tr id="departamento-impresoras">
                <td class="col-3"><b>Departamento</b></td>
                <td id="departamento-resguardo"></td>
            </tr>
            <tr>
                <td class="col-3"><b>Nodo</b></td>
                <td id="nodo-resguardo"></td>
            </tr>
            <tr>
                <td class="col-3"><b>IP</b></td>
                <td id="ip-resguardo"></td>
            </tr>
        </tbody>
    </table>
</div>