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
        LEFT JOIN 
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
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        echo json_encode($datos);
    }

    public function obtener_informacion_tabla(){
        $condicion = $_POST['condicion'];
        $tabla = $_POST['tabla'];

        if ($condicion == 1) {
            $area = $_POST['area'];
            $consulta = $this->obtener_conexion()->prepare("SELECT * FROM $tabla WHERE area = :area");
            $consulta->bindParam(':area',$area);
            $consulta->execute();
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            echo json_encode($datos);
        } else {
            $consulta = $this->obtener_conexion()->prepare("SELECT * FROM $tabla");
            $consulta->execute();
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            echo json_encode($datos);
        }
    }

    public function obtener_resguaros(){
        $consulta = $this->obtener_conexion()->prepare("SELECT * FROM resguardos");
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        echo json_encode($datos);
    }

    public function agregar_nuevo_usuario(){
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $rfc = $_POST['rfc'];
        $rfc_corto = $_POST['rfc_corto'];
        $nempleado = $_POST['n_empleado'];
        $puesto = $_POST['puesto'];
        $area = $_POST['area'];
        $departamento = $_POST['departamento'];

        if ($_POST['id_resguaro'] == 'null') {
            $id_resguaro = null;
        }else {
            $id_resguaro = $_POST['id_resguaro'];
        }

        if (empty($nombre) || empty($apellidos) || empty($rfc) || empty($rfc_corto) || empty($nempleado) || 
            empty($puesto) || empty($area) || empty($departamento) || !isset($departamento)) {
            echo json_encode([0,"Campos incompletos"]);
        } else if (is_numeric($nombre) || is_numeric($apellidos)) {
            echo json_encode([0,"No puedes ingresar numeros en nombre y apellidos"]);
        } else if (!is_numeric($nempleado)) {
            echo json_encode([0,"No puedes ingresar letras en numero de empleado"]);
        } else {

            $consultaRfc = $this->obtener_conexion()->prepare("SELECT rfc FROM usuarios WHERE rfc = :rfc");
            $consultaRfc->bindParam(':rfc',$rfc);
            $consultaRfc->execute();
            $rfc_reperido = $consultaRfc->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($rfc_reperido) {
                echo json_encode([0,"El rfc del usuario ya ha sido registrado"]);
                return;
            }

            $consultaNempleado = $this->obtener_conexion()->prepare("SELECT n_empleado FROM usuarios WHERE n_empleado = :n_empleado");
            $consultaNempleado->bindParam(':n_empleado',$nempleado);
            $consultaNempleado->execute();
            $nempleado_reperido = $consultaNempleado->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($nempleado_reperido) {
                echo json_encode([0,"El numero de empleado del usuario ya ha sido registrado"]);
                return;
            }
            
            $consultaEquipo = $this->obtener_conexion()->prepare("SELECT equipo_computo FROM usuarios WHERE equipo_computo = :equipo_computo");
            $consultaEquipo->bindParam(':equipo_computo',$id_resguaro);
            $consultaEquipo->execute();
            $equipo_reperido = $consultaEquipo->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($equipo_reperido) {
                echo json_encode([0,"El equipo de computo ya esta ocupado"]);
                return;
            }

            $insercion = $this->obtener_conexion()->prepare("INSERT INTO usuarios (nombre,apellidos,rfc,rfc_corto,
                    n_empleado,puesto,activo,departamento,area,equipo_computo) 
            VALUES(:nombre,:apellidos,:rfc,:rfc_corto,:n_empleado,:puesto,1,:departamento,:area,:equipo_computo)");
            
            $insercion->bindParam(':nombre',$nombre);
            $insercion->bindParam(':apellidos',$apellidos);
            $insercion->bindParam(':rfc',$rfc);
            $insercion->bindParam(':rfc_corto',$rfc_corto);
            $insercion->bindParam(':n_empleado',$nempleado);
            $insercion->bindParam(':puesto',$puesto);
            $insercion->bindParam(':departamento',$departamento);
            $insercion->bindParam(':area',$area);
            $insercion->bindParam(':equipo_computo',$id_resguaro);
            $insercion->execute();
            $this->cerrar_conexion();

            if ($insercion) {
                echo json_encode([1,"Usuario registrado"]);
            } else {
                echo json_encode([0,"Usuario NO registrado"]);
            }
        }
    }
}

$consulta = new Home();
$metodo = $_POST['metodo'];
$consulta->$metodo();
?>