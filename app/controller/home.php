<?php
session_start();
require_once '../config/conexion.php';

class Home extends Conexion {
    public function obtener_datos_usuarios(){
        $consulta = $this->obtener_conexion()->prepare("SELECT 
            usuarios.*,
            areas.nombre_area,
            departamentos.nombre_departamento,
            resguardos.n_serie,
            puestos.nombre_puesto
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
        INNER JOIN 
            resguardos 
        ON 
            usuarios.equipo_computo = resguardos.id_resguardo
        INNER JOIN 
            puestos
        ON 
            usuarios.puesto = puestos.id_puesto
        ");

        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        echo json_encode($datos);
    }

    public function mostrar_informacion_usuario(){
        $id = $_POST['id'];

        $consulta = $this->obtener_conexion()->prepare("SELECT 
            usuarios.*,
            areas.nombre_area,
            departamentos.nombre_departamento,
            resguardos.*,
            ips.ip,
            puestos.nombre_puesto
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
        INNER JOIN 
            resguardos 
        ON 
            usuarios.equipo_computo = resguardos.id_resguardo
        INNER JOIN 
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
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        echo json_encode($datos);
    }
}

$consulta = new Home();
$metodo = $_POST['metodo'];
$consulta->$metodo();
?>