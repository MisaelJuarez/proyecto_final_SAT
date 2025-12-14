<?php

header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=archivo.xls");

require_once '../app/config/conexion.php';

$metodo = $_GET['metodo'];

class Imprimir extends Conexion {
    public function exportar_usuarios() {
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
                usuarios.puesto = puestos.id_puesto;
        ");
        
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        return $datos;
    }

    public function exportar_resguardos() {
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
            ON usuarios.puesto = puestos.id_puesto;
        ");

        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        return $datos;
    }

    public function consultar_usuarios() {
         // Recuperar los filtros desde el formulario (por ejemplo, usando POST)
        $area = isset($_GET['area']) ? $_GET['area'] : '';
        $departamento = isset($_GET['departamento']) ? $_GET['departamento'] : '';
        $puesto = isset($_GET['puesto']) ? $_GET['puesto'] : '';

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

// Comienza la tabla de Excel

if ($metodo == 'exportar_usuarios') {
    echo "<table border='1'>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>No. Empleado</th>
                <th>RFC</th>
                <th>RFC Corto</th>
                <th>Puesto</th>
                <th>Area</th>
                <th>Departamento</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>No. Serie</th>
                <th>Mac Address</th>
                <th>Nodo</th>
                <th>IP</th>
            </tr>";
    
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
        echo "<td>{$usuario['marca']}</td>";
        echo "<td>{$usuario['modelo']}</td>";
        echo "<td>{$usuario['n_serie']}</td>";
        echo "<td>{$usuario['mac']}</td>";
        echo "<td>{$usuario['nodo']}</td>";
        echo "<td>{$usuario['ip']}</td>";
        echo "</tr>";
    }
}elseif($metodo == 'exportar_resguardos') {
    echo "<table border='1'>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>No. Serie</th>
                <th>Mac Address</th>
                <th>Nodo</th>
                <th>IP</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>No. Empleado</th>
                <th>RFC</th>
                <th>RFC Corto</th>
                <th>Puesto</th>
                <th>Area</th>
                <th>Departamento</th>
            </tr>";
    
    foreach ($datos_usuario as $usuario) {
        echo "<tr>";
        echo "<td>{$usuario['marca']}</td>";
        echo "<td>{$usuario['modelo']}</td>";
        echo "<td>{$usuario['n_serie']}</td>";
        echo "<td>{$usuario['mac']}</td>";
        echo "<td>{$usuario['nodo']}</td>";
        echo "<td>{$usuario['ip_numero']}</td>";
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
}elseif($metodo == 'consultar_usuarios'){
    echo "<table border='1'>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>No. Empleado</th>
                <th>RFC</th>
                <th>RFC Corto</th>
                <th>Puesto</th>
                <th>Area</th>
                <th>Departamento</th>
                <th></th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>No. Serie</th>
                <th>Mac Address</th>
                <th>Nodo</th>
                <th>IP</th>
            </tr>";
    
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
        echo "<td></td>";
        echo "<td>{$usuario['marca']}</td>";
        echo "<td>{$usuario['modelo']}</td>";
        echo "<td>{$usuario['n_serie']}</td>";
        echo "<td>{$usuario['mac']}</td>";
        echo "<td>{$usuario['nodo']}</td>";
        echo "<td>{$usuario['ip_numero']}</td>";
        echo "</tr>";
    }
}
echo "</table>";
?>