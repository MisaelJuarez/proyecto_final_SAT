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

    public function consultar_usuarios(){
         // Recuperar los filtros desde el formulario (por ejemplo, usando POST)
        $area = isset($_GET['area']) ? base64_decode($_GET['area']) : '';
        $departamento = isset($_GET['departamento']) ? base64_decode($_GET['departamento']) : '';
        $puesto = isset($_GET['puesto']) ? base64_decode($_GET['puesto']) : '';

        // Crear el filtro base de la consulta
        $sql = "SELECT usuarios.*, areas.*, departamentos.*, puestos.*,resguardos.*,ips.ip AS ip_numero
                FROM usuarios
                INNER JOIN areas ON usuarios.area = areas.id_area
                INNER JOIN departamentos ON usuarios.departamento = departamentos.id_departamento
                INNER JOIN puestos ON usuarios.puesto = puestos.id_puesto
                INNER JOIN resguardos ON usuarios.equipo_computo = resguardos.id_resguardo
                INNER JOIN ips ON ips.id_ip = resguardos.ip
                WHERE 1"; // El WHERE 1 es una forma de comenzar la condición sin tener que preocuparnos por las primeras condiciones

        // Agregar condiciones dependiendo de los filtros proporcionados
        if ($area !== '') {
            $sql .= " AND usuarios.area = :area";
        }

        if ($departamento !== '') {
            $sql .= " AND usuarios.departamento = :departamento";
        }

        if ($puesto !== '') {
            $sql .= " AND usuarios.puesto = :puesto";
        }

        // Preparar la consulta
        $consulta = $this->obtener_conexion()->prepare($sql);

        // Vincular los parámetros de la consulta (si existen)
        if ($area !== '') {
            $consulta->bindParam(':area', $area, PDO::PARAM_INT);
        }

        if ($departamento !== '') {
            $consulta->bindParam(':departamento', $departamento, PDO::PARAM_INT);
        }

        if ($puesto !== '') {
            $consulta->bindParam(':puesto', $puesto, PDO::PARAM_INT);
        }

        // Ejecutar la consulta
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        return $datos;
    }
}

$consulta = new Imprimir();
$funcion = $metodo;
$datos_usuario = $consulta->$funcion();

if ($metodo == 'consultar_usuarios') {
    $nombre_archivo = 'usuarios';
}else{
    $nombre_archivo = ($metodo == 'imprimir_usuario') ? $datos_usuario['rfc_corto'].'_'.$datos_usuario['nombre'] : $datos_usuario['n_serie'].'_'.$datos_usuario['marca'];
}


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
            font-size: 15px;
            padding: 7px;
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

    <?php if ($metodo == 'consultar_usuarios'): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>No. Empleado</th>
                    <th>RFC</th>
                    <th>RFC Corto</th>
                    <th>Puesto</th>
                    <th>Area</th>
                    <th>Departamento</th>
                </tr>
            </thead>
             <tbody>
                <?php 
                    foreach ($datos_usuario as $usuario) {
                    echo "<tr>";
                        echo "<td>{$usuario['nombre']}</td>";
                        echo "<td>{$usuario['apellidos']}</td>";
                        echo "<td>{$usuario['n_empleado']}</td>";
                        echo "<td>{$usuario['rfc']}</td>";
                        echo "<td>{$usuario['rfc_corto']}</td>";
                        echo "<td>{$usuario['nombre_puesto']}</td>";
                        echo "<td>{$usuario['nombre_area']}</td>";
                        echo "<td>{$usuario['nombre_departamento']}</td>";
                    echo "</tr>";
                    }
                ?>
             </tbody>
        </table>
    <?php endif; ?>
</body>
</html>

<?php $html=ob_get_clean(); ?>

<?php
require_once '../librerias/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'Portrait');

$dompdf->render();

$dompdf->stream($nombre_archivo,['Attachment'=>false]);


?>