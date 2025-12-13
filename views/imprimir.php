<?php
require_once '../app/config/conexion.php';

$metodo = base64_decode($_GET['metodo']);

class Imprimir extends Conexion {

    public function imprimir_usuario() {
        $id = base64_decode($_GET['registro']);

        $consulta = $this->obtener_conexion()->prepare("SELECT 
            usuarios.*,
            areas.*,
            departamentos.*,
            resguardos.*,
            ips.*,
            puestos.*
        FROM 
            usuarios
        INNER JOIN
            areas
        ON
            usuarios.area = areas.id_area
        INNER JOIN 
            departamentos 
        ON 
            usuarios.departamento = departamentos.id_departamento
        LEFT JOIN 
            resguardos 
        ON 
            usuarios.equipo_computo = resguardos.id_resguardo
        LEFT JOIN 
            ips
        ON 
            resguardos.ip = ips.id_ip
        INNER JOIN 
            puestos
        ON 
            usuarios.puesto = puestos.id_puesto
        WHERE id_usuario = :id
        ");
        
        $consulta->bindParam(':id',$id);
        $consulta->execute();
        $datos = $consulta->fetch(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        return $datos;
    }

    public function imprimir_resguardo(){
        $id = base64_decode($_GET['registro']);

        $consulta = $this->obtener_conexion()->prepare("SELECT 
            resguardos.*, 
            ips.ip AS ip_numero,
            usuarios.*,
            areas.*,
            departamentos.*,
            puestos.*
        FROM resguardos
        LEFT JOIN usuarios
            ON usuarios.equipo_computo = resguardos.id_resguardo
        LEFT JOIN ips
            ON ips.id_ip = resguardos.ip
        LEFT JOIN areas
            ON usuarios.area = areas.id_area
        LEFT JOIN departamentos
            ON usuarios.departamento = departamentos.id_departamento
        LEFT JOIN puestos
            ON usuarios.puesto = puestos.id_puesto
        WHERE resguardos.id_resguardo = :id;
        ");

        $consulta->bindParam(':id',$id);
        $consulta->execute();
        $datos = $consulta->fetch(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        return $datos;
    }
}

$consulta = new Imprimir();
$funcion = $metodo;
$datos_usuario = $consulta->$funcion();

?>

<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        h3 {
            margin: 0;
            margin-top: 20px;
            padding: 5px;
            background-color: #c6c6c6ff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: end;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>

    <?php if ($metodo == 'imprimir_usuario'): ?>
        <h3>Datos del usuario:</h3>
        <table class="table">
            <tbody>
                <tr>
                    <td><b>Nombre: </b></td>
                    <td><?=$datos_usuario['nombre']?></td>
                </tr>
                <tr>
                    <td class="col-3"><b>Apellidos:</b></td>
                    <td><?=$datos_usuario['apellidos']?></td>
                </tr>
                <tr>
                    <td class="col-3"><b>No. Empleado</b></td>
                    <td><?=$datos_usuario['n_empleado']?></td>
                </tr>
                <tr>
                    <td class="col-3"><b>RFC:</b></td>
                    <td><?=$datos_usuario['rfc']?></td>
                </tr>
                <tr>
                    <td class="col-3"><b>RFC Corto:</b></td>
                    <td><?=$datos_usuario['rfc_corto']?></td>
                </tr>
                <tr>
                    <td class="col-3"><b>Puesto:</b></td>
                    <td><?=$datos_usuario['nombre_puesto']?></td>
                </tr>
                <tr>
                    <td class="col-3"><b>Area:</b></td>
                    <td><?=$datos_usuario['nombre_area']?></td>
                </tr>
                <tr>
                    <td class="col-3"><b>Departamento:</b></td>
                    <td><?=$datos_usuario['nombre_departamento']?></td>
                </tr>
            </tbody>
        </table>

        <?php if ($datos_usuario['id_resguardo'] != ''): ?>
            <h3>Datos del resguardo:</h3>
            <table class="table">
                <tbody>
                    <tr>
                        <td><b>Marca: </b></td>
                        <td><?=$datos_usuario['marca']?></td>
                    </tr>
                    <tr>
                        <td class="col-3"><b>Modelo:</b></td>
                        <td><?=$datos_usuario['modelo']?></td>
                    </tr>
                    <tr>
                        <td class="col-3"><b>No. de serie:</b></td>
                        <td><?=$datos_usuario['n_serie']?></td>
                    </tr>
                    <tr>
                        <td class="col-3"><b>Mac Address:</b></td>
                        <td><?=$datos_usuario['mac']?></td>
                    </tr>
                    <tr>
                        <td class="col-3"><b>Nodo:</b></td>
                        <td><?=$datos_usuario['nodo']?></td>
                    </tr>
                    <tr>
                        <td class="col-3"><b>IP:</b></td>
                        <td><?= ($datos_usuario['ip']) ? $datos_usuario['ip'] : $datos_usuario['ip_ultimo_registro'] ?></td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($metodo == 'imprimir_resguardo'): ?>
        <h3>Datos del resguardo:</h3>
        <table class="table">
            <tbody>
                <tr>
                    <td><b>Marca: </b></td>
                    <td><?=$datos_usuario['marca']?></td>
                </tr>
                <tr>
                    <td class="col-3"><b>Modelo:</b></td>
                    <td><?=$datos_usuario['modelo']?></td>
                </tr>
                <tr>
                    <td class="col-3"><b>No. de serie:</b></td>
                    <td><?=$datos_usuario['n_serie']?></td>
                </tr>
                <tr>
                    <td class="col-3"><b>Mac Address:</b></td>
                    <td><?=$datos_usuario['mac']?></td>
                </tr>
                <tr>
                    <td class="col-3"><b>Nodo:</b></td>
                    <td><?=$datos_usuario['nodo']?></td>
                </tr>
                <tr>
                    <td class="col-3"><b>IP:</b></td>
                    <td><?= ($datos_usuario['ip_numero']) ? $datos_usuario['ip_numero'] : $datos_usuario['ip_ultimo_registro'] ?></td>
                </tr>
            </tbody>
        </table>  
        
        <?php if ($datos_usuario['id_usuario'] != ''): ?>
            <h3>Datos del usuario:</h3>
            <table class="table">
                <tbody>
                    <tr>
                        <td><b>Nombre: </b></td>
                        <td><?=$datos_usuario['nombre']?></td>
                    </tr>
                    <tr>
                        <td class="col-3"><b>Apellidos:</b></td>
                        <td><?=$datos_usuario['apellidos']?></td>
                    </tr>
                    <tr>
                        <td class="col-3"><b>No. Empleado</b></td>
                        <td><?=$datos_usuario['n_empleado']?></td>
                    </tr>
                    <tr>
                        <td class="col-3"><b>RFC:</b></td>
                        <td><?=$datos_usuario['rfc']?></td>
                    </tr>
                    <tr>
                        <td class="col-3"><b>RFC Corto:</b></td>
                        <td><?=$datos_usuario['rfc_corto']?></td>
                    </tr>
                    <tr>
                        <td class="col-3"><b>Puesto:</b></td>
                        <td><?=$datos_usuario['nombre_puesto']?></td>
                    </tr>
                    <tr>
                        <td class="col-3"><b>Area:</b></td>
                        <td><?=$datos_usuario['nombre_area']?></td>
                    </tr>
                    <tr>
                        <td class="col-3"><b>Departamento:</b></td>
                        <td><?=$datos_usuario['nombre_departamento']?></td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>

<?php $html=ob_get_clean(); ?>

<?php
require_once '../librerias/dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'Portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('ejemplo.pdf',['Attachment'=>false]);


?>