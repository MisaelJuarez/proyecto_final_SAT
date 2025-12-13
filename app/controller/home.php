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
        WHERE usuarios.baja = 2;
        ");

        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        echo json_encode($datos);
    }

    public function obtener_datos_usuarios_bajas() {
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
        WHERE usuarios.baja = 1;
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
        $consulta = $this->obtener_conexion()->prepare("SELECT * FROM resguardos WHERE baja = 2");
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
                    n_empleado,puesto,baja,departamento,area,equipo_computo) 
            VALUES(:nombre,:apellidos,:rfc,:rfc_corto,:n_empleado,:puesto,2,:departamento,:area,:equipo_computo)");
            
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

    public function modificar_informacion_usuario(){
        $id = $_POST['id'];
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

            $consultaRfc = $this->obtener_conexion()->prepare("SELECT rfc FROM usuarios WHERE rfc = :rfc AND id_usuario != :id_usuario");
            $consultaRfc->bindParam(':rfc',$rfc);
            $consultaRfc->bindParam(':id_usuario',$id);
            $consultaRfc->execute();
            $rfc_reperido = $consultaRfc->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($rfc_reperido) {
                echo json_encode([0,"El rfc del usuario ya ha sido registrado"]);
                return;
            }

            $consultaNempleado = $this->obtener_conexion()->prepare("SELECT n_empleado FROM usuarios WHERE n_empleado = :n_empleado AND id_usuario != :id_usuario");
            $consultaNempleado->bindParam(':n_empleado',$nempleado);
            $consultaNempleado->bindParam(':id_usuario',$id);
            $consultaNempleado->execute();
            $nempleado_reperido = $consultaNempleado->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($nempleado_reperido) {
                echo json_encode([0,"El numero de empleado del usuario ya ha sido registrado"]);
                return;
            }
            
            $consultaEquipo = $this->obtener_conexion()->prepare("SELECT equipo_computo FROM usuarios WHERE equipo_computo = :equipo_computo AND id_usuario != :id_usuario");
            $consultaEquipo->bindParam(':equipo_computo',$id_resguaro);
            $consultaEquipo->bindParam(':id_usuario',$id);
            $consultaEquipo->execute();
            $equipo_reperido = $consultaEquipo->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($equipo_reperido) {
                echo json_encode([0,"El equipo de computo ya esta ocupado"]);
                return;
            }

            $actualizacion = $this->obtener_conexion()->prepare("UPDATE usuarios 
            SET nombre = :nombre, apellidos = :apellidos, rfc = :rfc, rfc_corto = :rfc_corto,
                n_empleado = :n_empleado, puesto = :puesto, departamento = :departamento,
                area = :area, equipo_computo = :equipo_computo 
            WHERE id_usuario = :id_usuario");
            
            $actualizacion->bindParam(':nombre',$nombre);
            $actualizacion->bindParam(':apellidos',$apellidos);
            $actualizacion->bindParam(':rfc',$rfc);
            $actualizacion->bindParam(':rfc_corto',$rfc_corto);
            $actualizacion->bindParam(':n_empleado',$nempleado);
            $actualizacion->bindParam(':puesto',$puesto);
            $actualizacion->bindParam(':departamento',$departamento);
            $actualizacion->bindParam(':area',$area);
            $actualizacion->bindParam(':equipo_computo',$id_resguaro);
            $actualizacion->bindParam(':id_usuario',$id);
            $actualizacion->execute();
            $this->cerrar_conexion();

            if ($actualizacion) {
                echo json_encode([1,"Informacion del usuaro modificada"]);
            } else {
                echo json_encode([0,"La informacion no puede ser modificada"]);
            }
        }
    }

    public function obtener_ips(){
        $consulta = $this->obtener_conexion()->prepare("SELECT * FROM ips");
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        echo json_encode($datos);
    }

    public function agregar_nuevo_resguardo(){
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $n_serie = $_POST['n_serie'];
        $hostname = $_POST['hostname'];
        $mac = $_POST['mac'];
        $nodo = $_POST['nodo'];

        if ($_POST['id_ip'] == 'null') {
            $id_ip = null;
        }else {
            $id_ip = $_POST['id_ip'];
        }

        if (empty($marca) || empty($modelo) || empty($n_serie) || empty($hostname) || empty($mac) || empty($nodo)) {
            echo json_encode([0,"Campos incompletos"]);
        } else {

            $consultaNserie = $this->obtener_conexion()->prepare("SELECT n_serie FROM resguardos WHERE n_serie = :n_serie");
            $consultaNserie->bindParam(':n_serie',$n_serie);
            $consultaNserie->execute();
            $nserie_reperido = $consultaNserie->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($nserie_reperido) {
                echo json_encode([0,"El numero de serie ya ha sido registrado"]);
                return;
            }

            $consultaHostname = $this->obtener_conexion()->prepare("SELECT hostname FROM resguardos WHERE hostname = :hostname");
            $consultaHostname->bindParam(':hostname',$hostname);
            $consultaHostname->execute();
            $nempleado_reperido = $consultaHostname->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($nempleado_reperido) {
                echo json_encode([0,"El hostname ya ha sido registrado"]);
                return;
            }
            
            $consultaHostname = $this->obtener_conexion()->prepare("SELECT mac FROM resguardos WHERE mac = :mac");
            $consultaHostname->bindParam(':mac',$mac);
            $consultaHostname->execute();
            $nempleado_reperido = $consultaHostname->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($nempleado_reperido) {
                echo json_encode([0,"La mac ya ha sido registrado"]);
                return;
            }

            $consultaImpresora = $this->obtener_conexion()->prepare("SELECT ip_impresora FROM impresoras WHERE ip_impresora = :ip");
            $consultaImpresora->bindParam(':ip',$id_ip);
            $consultaImpresora->execute();
            $impresora_reperido = $consultaImpresora->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($impresora_reperido) {
                echo json_encode([0,"La ip ya esta ocupada"]);
                return;
            }

            $consultaEquipo = $this->obtener_conexion()->prepare("SELECT ip FROM resguardos WHERE ip = :ip");
            $consultaEquipo->bindParam(':ip',$id_ip);
            $consultaEquipo->execute();
            $equipo_reperido = $consultaEquipo->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($equipo_reperido) {
                echo json_encode([0,"La ip ya esta ocupada"]);
                return;
            }

            $insercion = $this->obtener_conexion()->prepare("INSERT INTO resguardos (marca,modelo,n_serie,hostname,
                    mac,nodo,ip,baja) 
            VALUES(:marca,:modelo,:n_serie,:hostname,:mac,:nodo,:ip,2)");
            
            $insercion->bindParam(':marca',$marca);
            $insercion->bindParam(':modelo',$modelo);
            $insercion->bindParam(':n_serie',$n_serie);
            $insercion->bindParam(':hostname',$hostname);
            $insercion->bindParam(':mac',$mac);
            $insercion->bindParam(':nodo',$nodo);
            $insercion->bindParam(':ip',$id_ip);
            $insercion->execute();
            $this->cerrar_conexion();

            if ($insercion) {
                
                if ($id_ip != null) {
                    $cambiarDisponibleIp = $this->obtener_conexion()->prepare("UPDATE ips 
                        SET disponible = 2 
                        WHERE id_ip = :id_ip");
                    
                    $cambiarDisponibleIp->bindParam(':id_ip',$id_ip);
                    $cambiarDisponibleIp->execute();
                    $this->cerrar_conexion();
                }

                echo json_encode([1,"Resguardo registrado"]);
            } else {
                echo json_encode([0,"Resguardo NO registrado"]);
            }
        }
    }

    public function obtener_datos_resguardos(){
        $consulta = $this->obtener_conexion()->prepare("SELECT 
            resguardos.*, 
            usuarios.*,
            ips.ip AS ip_numero
        FROM resguardos
        LEFT JOIN usuarios
            ON usuarios.equipo_computo = resguardos.id_resguardo
        LEFT JOIN ips
            ON ips.id_ip = resguardos.ip
        WHERE resguardos.baja = 2;
        ");

        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        echo json_encode($datos);
    }

    public function obtener_datos_resguardos_bajas(){
        $consulta = $this->obtener_conexion()->prepare("SELECT 
            resguardos.*, 
            usuarios.id_usuario,
            ips.ip AS ip_numero
        FROM resguardos
        LEFT JOIN usuarios
            ON usuarios.equipo_computo = resguardos.id_resguardo
        LEFT JOIN ips
            ON ips.id_ip = resguardos.ip
        WHERE resguardos.baja = 1;
        ");

        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        echo json_encode($datos);
    }

    public function obtener_datos_resguardo_modificar(){
         $id = $_POST['id'];

        $consulta = $this->obtener_conexion()->prepare("SELECT 
            resguardos.*,
            ips.id_ip,
            ips.ip AS ip_numero
        FROM 
            resguardos
        LEFT JOIN
            ips
        ON
            resguardos.ip = ips.id_ip
        WHERE id_resguardo = :id
        ");

        $consulta->bindParam(':id',$id);
        $consulta->execute();
        $datos = $consulta->fetch(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        echo json_encode($datos);
    }

    public function modificar_informacion_resguardo(){
        $id = $_POST['id'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $n_serie = $_POST['n_serie'];
        $hostname = $_POST['hostname'];
        $mac = $_POST['mac'];
        $nodo = $_POST['nodo'];

        if ($_POST['id_ip'] == 'null') {
            $id_ip = null;
        }else {
            $id_ip = $_POST['id_ip'];
        }

        if (empty($marca) || empty($modelo) || empty($n_serie) || empty($hostname) || empty($mac) || empty($nodo)) {
            echo json_encode([0,"Campos incompletos"]);
        } else {

            $ipActual = $this->obtener_conexion()->prepare("SELECT ip FROM resguardos WHERE n_serie = :n_serie");
            $ipActual->bindParam(':n_serie',$n_serie);
            $ipActual->execute();
            $ip_actual = $ipActual->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();

            $consultaNserie = $this->obtener_conexion()->prepare("SELECT n_serie FROM resguardos WHERE n_serie = :n_serie AND id_resguardo != :id_resguardo");
            $consultaNserie->bindParam(':n_serie',$n_serie);
            $consultaNserie->bindParam(':id_resguardo',$id);
            $consultaNserie->execute();
            $nserie_reperido = $consultaNserie->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($nserie_reperido) {
                echo json_encode([0,"El numero de serie ya ha sido registrado"]);
                return;
            }

            $consultaHostname = $this->obtener_conexion()->prepare("SELECT hostname FROM resguardos WHERE hostname = :hostname AND id_resguardo != :id_resguardo");
            $consultaHostname->bindParam(':hostname',$hostname);
            $consultaHostname->bindParam(':id_resguardo',$id);
            $consultaHostname->execute();
            $nempleado_reperido = $consultaHostname->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($nempleado_reperido) {
                echo json_encode([0,"El hostname ya ha sido registrado"]);
                return;
            }
            
            $consultaHostname = $this->obtener_conexion()->prepare("SELECT mac FROM resguardos WHERE mac = :mac AND id_resguardo != :id_resguardo");
            $consultaHostname->bindParam(':mac',$mac);
            $consultaHostname->bindParam(':id_resguardo',$id);
            $consultaHostname->execute();
            $nempleado_reperido = $consultaHostname->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($nempleado_reperido) {
                echo json_encode([0,"La mac ya ha sido registrado"]);
                return;
            }

            $consultaImpresora = $this->obtener_conexion()->prepare("SELECT ip_impresora FROM impresoras WHERE ip_impresora = :ip");
            $consultaImpresora->bindParam(':ip',$id_ip);
            $consultaImpresora->execute();
            $impresora_reperido = $consultaImpresora->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($impresora_reperido) {
                echo json_encode([0,"La ip ya esta ocupada"]);
                return;
            }

            $consultaEquipo = $this->obtener_conexion()->prepare("SELECT ip FROM resguardos WHERE ip = :ip AND id_resguardo != :id_resguardo");
            $consultaEquipo->bindParam(':ip',$id_ip);
            $consultaEquipo->bindParam(':id_resguardo',$id);
            $consultaEquipo->execute();
            $equipo_reperido = $consultaEquipo->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($equipo_reperido) {
                echo json_encode([0,"Esta ip ya esta ocupada"]);
                return;
            }

            $actualizacion = $this->obtener_conexion()->prepare("UPDATE resguardos 
            SET marca = :marca, modelo = :modelo, n_serie = :n_serie, hostname = :hostname,
                mac = :mac, nodo = :nodo, ip = :ip
            WHERE id_resguardo = :id_resguardo");
            
            $actualizacion->bindParam(':marca',$marca);
            $actualizacion->bindParam(':modelo',$modelo);
            $actualizacion->bindParam(':n_serie',$n_serie);
            $actualizacion->bindParam(':hostname',$hostname);
            $actualizacion->bindParam(':mac',$mac);
            $actualizacion->bindParam(':nodo',$nodo);
            $actualizacion->bindParam(':ip',$id_ip);
            $actualizacion->bindParam(':id_resguardo',$id);
            $actualizacion->execute();
            $this->cerrar_conexion();

            if ($actualizacion) {
                
                if ($ip_actual['ip'] != $id_ip) {
                    $cambiarDisponibleIp = $this->obtener_conexion()->prepare("UPDATE ips 
                        SET disponible = 2 
                        WHERE id_ip = :id_ip");
                    
                    $cambiarDisponibleIp->bindParam(':id_ip',$id_ip);
                    $cambiarDisponibleIp->execute();
                    $this->cerrar_conexion();
                    
                    $cambiarIpActual = $this->obtener_conexion()->prepare("UPDATE ips 
                        SET disponible = 1
                        WHERE id_ip = :id_ip");
                    
                    $cambiarIpActual->bindParam(':id_ip',$ip_actual['ip']);
                    $cambiarIpActual->execute();
                    $this->cerrar_conexion();
                }

                echo json_encode([1,"Informacion de resguardo modificada"]);
            } else {
                echo json_encode([0,"Informacion NO modificada"]);
            }
        }
    }

    public function obtener_ips_disponibles(){
        $consulta = $this->obtener_conexion()->prepare("SELECT * FROM ips WHERE disponible = 1");
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        echo json_encode($datos);
    }
    
    public function obtener_ips_en_uso(){
        $mostrar = $_POST['mostrar'];

        if ($mostrar == 'equipos') {
            $consulta = $this->obtener_conexion()->prepare("SELECT 
                ips.*, 
                resguardos.n_serie,
                resguardos.id_resguardo
            FROM ips
            INNER JOIN resguardos
                ON resguardos.ip = ips.id_ip
            WHERE disponible = 2;
            ");
    
            $consulta->execute();
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            echo json_encode($datos);
        } elseif ($mostrar == 'impresoras'){
            $consulta = $this->obtener_conexion()->prepare("SELECT 
                ips.*, 
                impresoras.n_serie,
                impresoras.id_impresora
            FROM ips
            INNER JOIN impresoras
                ON impresoras.ip_impresora = ips.id_ip;
            ");
    
            $consulta->execute();
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            echo json_encode($datos);
        }
    }

    public function obtener_resguaros_para_asignar_ip(){
        $consulta = $this->obtener_conexion()->prepare("SELECT * FROM resguardos WHERE ip IS NULL AND baja = 2");
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        echo json_encode($datos);
    }

    public function obtener_impresoras_para_asignar_ip() {
        $consulta = $this->obtener_conexion()->prepare("SELECT 
            impresoras.*, 
            areas.nombre_area,
            departamentos.nombre_departamento
        FROM impresoras
        LEFT JOIN areas
            ON impresoras.area = areas.id_area
        LEFT JOIN departamentos
            ON impresoras.departamento = departamentos.id_departamento
        WHERE impresoras.ip_impresora IS NULL;
        ");

        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        echo json_encode($datos);
    }

    public function agregar_nueva_ip(){
        $ip = $_POST['ip'];
        $asignar = $_POST['asignar'];

        if ($_POST['id_resguaro'] == 'null') {
            $id_resguaro = null;
        }else {
            $id_resguaro = $_POST['id_resguaro'];
        }

        if (empty($ip)) {
            echo json_encode([0,"Campos incompletos"]);
        } else {
            $consultaIp = $this->obtener_conexion()->prepare("SELECT ip FROM ips WHERE ip = :ip");
            $consultaIp->bindParam(':ip',$ip);
            $consultaIp->execute();
            $ip_reperido = $consultaIp->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($ip_reperido) {
                echo json_encode([0,"La ip que intentas ingresar ya esta registrada"]);
                return;
            }
            
            $insercion = $this->obtener_conexion()->prepare("INSERT INTO ips (ip,disponible) VALUES(:ip,1)");
            
            $insercion->bindParam(':ip',$ip);
            $insercion->execute();
            $this->cerrar_conexion();
            
            if ($insercion) {
                if ($id_resguaro == null) {
                    echo json_encode([1,"Ip registrada"]);
                }else {
                    $obtenerId = $this->obtener_conexion()->prepare("SELECT id_ip FROM ips WHERE ip = :ip");
                    $obtenerId->bindParam(':ip',$ip);
                    $obtenerId->execute();
                    $id_ip = $obtenerId->fetch(PDO::FETCH_ASSOC);
                    $this->cerrar_conexion();
                    
                    if ($asignar == 'equipos') {
                        $actualizacion = $this->obtener_conexion()->prepare("UPDATE resguardos 
                        SET ip = :ip 
                        WHERE id_resguardo = :id_resguardo");
                        $actualizacion->bindParam(':ip',$id_ip['id_ip']);
                        $actualizacion->bindParam(':id_resguardo',$id_resguaro);
                        $actualizacion->execute();
                        $this->cerrar_conexion();
                    }elseif ($asignar == 'impresoras'){
                        $actualizacion = $this->obtener_conexion()->prepare("UPDATE impresoras 
                        SET ip_impresora = :ip 
                        WHERE id_impresora = :id");
                        $actualizacion->bindParam(':ip',$id_ip['id_ip']);
                        $actualizacion->bindParam(':id',$id_resguaro);
                        $actualizacion->execute();
                        $this->cerrar_conexion();
                    }
                    
                    if ($actualizacion) {
                        $cambiarDisponibleIp = $this->obtener_conexion()->prepare("UPDATE ips 
                        SET disponible = 2 
                        WHERE id_ip = :id_ip");
                        
                        $cambiarDisponibleIp->bindParam(':id_ip',$id_ip['id_ip']);
                        $cambiarDisponibleIp->execute();
                        $this->cerrar_conexion();

                        echo json_encode([1,"Ip registrado y equipo de computo asignado"]);
                    }else {
                        echo json_encode([0,"Falla al asignar el equipo de computo"]);
                    }
                }

            } else {
                echo json_encode([0,"Ip NO registrado"]);
            }
        }
    }

    public function asignar_ip_al_equipo() {
        $id_ip = $_POST['id_ip'];
        $id_resguaro = $_POST['id_resguaro'];

        if ($id_resguaro == 'null') {
            echo json_encode([0,"No has asignado un equipo de computo"]);
            return;
        }

        $actualizacionResguardo = $this->obtener_conexion()->prepare("UPDATE resguardos 
            SET ip = :ip WHERE id_resguardo = :id_resguardo");
            
        $actualizacionResguardo->bindParam(':ip',$id_ip);
        $actualizacionResguardo->bindParam(':id_resguardo',$id_resguaro);
        $actualizacionResguardo->execute();
        $this->cerrar_conexion();

        if ($actualizacionResguardo) {
            $actualizacionIp = $this->obtener_conexion()->prepare("UPDATE ips 
            SET disponible = 2 WHERE id_ip = :id_ip");
            
            $actualizacionIp->bindParam(':id_ip',$id_ip);
            $actualizacionIp->execute();
            $this->cerrar_conexion();

            if ($actualizacionIp) {
                echo json_encode([1,"Ip asignada correctamente"]);
            }else {
                echo json_encode([0,"Error al asignar ip"]);
            }

        } else {
            echo json_encode([0,"Error al asignar ip"]);
        }
    }

    public function asignar_ip_a_impresora() {
        $id_ip = $_POST['id_ip'];
        $id_impresora = $_POST['id_impresora'];

        if ($id_impresora == 'null') {
            echo json_encode([0,"No has asignado una impresora"]);
            return;
        }

        $actualizacionImpresora = $this->obtener_conexion()->prepare("UPDATE impresoras 
            SET ip_impresora = :ip WHERE id_impresora = :id_impresora");
            
        $actualizacionImpresora->bindParam(':ip',$id_ip);
        $actualizacionImpresora->bindParam(':id_impresora',$id_impresora);
        $actualizacionImpresora->execute();
        $this->cerrar_conexion();

        if ($actualizacionImpresora) {
            $actualizacionIp = $this->obtener_conexion()->prepare("UPDATE ips 
            SET disponible = 2 WHERE id_ip = :id_ip");
            
            $actualizacionIp->bindParam(':id_ip',$id_ip);
            $actualizacionIp->execute();
            $this->cerrar_conexion();

            if ($actualizacionIp) {
                echo json_encode([1,"Ip asignada correctamente"]);
            }else {
                echo json_encode([0,"Error al asignar ip"]);
            }

        } else {
            echo json_encode([0,"Error al asignar ip"]);
        }
    }

    public function obtener_informacion_ip() {
        $id = $_POST['id'];
        $mostrar = $_POST['mostrar'];

        if ($mostrar == 'equipos') {
            $consulta = $this->obtener_conexion()->prepare("SELECT 
                ips.ip AS ip_numero, 
                resguardos.*
            FROM ips
            LEFT JOIN resguardos
                ON resguardos.ip = ips.id_ip
            WHERE id_ip = :id;
            ");
    
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            $datos = $consulta->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            echo json_encode($datos);
        } elseif($mostrar == 'impresoras') {
            $consulta = $this->obtener_conexion()->prepare("SELECT 
                ips.ip AS ip_numero, 
                impresoras.*,
                areas.nombre_area,
                departamentos.nombre_departamento
            FROM ips
            LEFT JOIN impresoras
                ON impresoras.ip_impresora = ips.id_ip
            LEFT JOIN areas
                ON impresoras.area = areas.id_area
            LEFT JOIN departamentos
                ON impresoras.departamento = departamentos.id_departamento
            WHERE id_ip = :id;
            ");
    
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            $datos = $consulta->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            echo json_encode($datos);
        }
    }

    public function retirar_ip_del_equipo() {
        $retirar = $_POST['retirar'];
        $id_ip = $_POST['id_ip'];
        $id = $_POST['id'];

        if ($retirar == 'equipos') {
            $actualizacion = $this->obtener_conexion()->prepare("UPDATE resguardos 
                SET ip = NULL
                WHERE id_resguardo = :id_resguardo");
            $actualizacion->bindParam(':id_resguardo',$id);
            $actualizacion->execute();
            $this->cerrar_conexion();
        }elseif ($retirar == 'impresoras') {
            $actualizacion = $this->obtener_conexion()->prepare("UPDATE impresoras 
                SET ip_impresora = NULL
                WHERE id_impresora = :id_impresora");
            $actualizacion->bindParam(':id_impresora',$id);
            $actualizacion->execute();
            $this->cerrar_conexion();
        }
        
        if ($actualizacion) {
            $actualizacionIp = $this->obtener_conexion()->prepare("UPDATE ips 
                SET disponible = 1
                WHERE id_ip = :id_ip");
            $actualizacionIp->bindParam(':id_ip',$id_ip);
            $actualizacionIp->execute();
            $this->cerrar_conexion();

            if ($actualizacionIp) {
                echo json_encode([1,"La IP fue quitada exitosamente"]);
            }else {
                echo json_encode([0,"Error al quitar IP"]);
            }
            
        }else {
            echo json_encode([0,"Error al quitar IP"]);
        }
    }

    public function obtener_datos_impresoras() {
        $consulta = $this->obtener_conexion()->prepare("SELECT 
            impresoras.*, 
            ips.ip,
            areas.nombre_area,
            departamentos.nombre_departamento
        FROM impresoras
        LEFT JOIN ips
            ON impresoras.ip_impresora = ips.id_ip
        LEFT JOIN areas
            ON impresoras.area = areas.id_area
        LEFT JOIN departamentos
            ON impresoras.departamento = departamentos.id_departamento
        ");

        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        echo json_encode($datos);
    }

    public function agregar_nueva_impresora() {
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $n_serie = $_POST['n_serie'];
        $area = $_POST['area'];
        $departamento = $_POST['departamento'];
        $nodo = $_POST['nodo'];

        if ($_POST['id_ip'] == 'null') {
            $id_ip = null;
        }else {
            $id_ip = $_POST['id_ip'];
        }

        if (empty($marca) || empty($modelo) || empty($n_serie) || empty($area) || empty($departamento) || empty($nodo)) {
            echo json_encode([0,"Campos incompletos"]);
        } else {

            $consultaNserie = $this->obtener_conexion()->prepare("SELECT n_serie FROM impresoras WHERE n_serie = :n_serie");
            $consultaNserie->bindParam(':n_serie',$n_serie);
            $consultaNserie->execute();
            $nserie_reperido = $consultaNserie->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($nserie_reperido) {
                echo json_encode([0,"El numero de serie ya ha sido registrado"]);
                return;
            }


            $consultaEquipo = $this->obtener_conexion()->prepare("SELECT ip FROM resguardos WHERE ip = :ip");
            $consultaEquipo->bindParam(':ip',$id_ip);
            $consultaEquipo->execute();
            $equipo_reperido = $consultaEquipo->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($equipo_reperido) {
                echo json_encode([0,"La ip ya esta ocupada"]);
                return;
            }
            
            $consultaImpresora = $this->obtener_conexion()->prepare("SELECT ip_impresora FROM impresoras WHERE ip_impresora = :ip");
            $consultaImpresora->bindParam(':ip',$id_ip);
            $consultaImpresora->execute();
            $impresora_reperido = $consultaImpresora->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($impresora_reperido) {
                echo json_encode([0,"La ip ya esta ocupada"]);
                return;
            }

            $insercion = $this->obtener_conexion()->prepare("INSERT INTO impresoras (marca,modelo,n_serie,ip_impresora,
                    area,departamento,nodo) 
            VALUES(:marca,:modelo,:n_serie,:ip_impresora,:area,:departamento,:nodo)");
            
            $insercion->bindParam(':marca',$marca);
            $insercion->bindParam(':modelo',$modelo);
            $insercion->bindParam(':n_serie',$n_serie);
            $insercion->bindParam(':ip_impresora',$id_ip);
            $insercion->bindParam(':area',$area);
            $insercion->bindParam(':departamento',$departamento);
            $insercion->bindParam(':nodo',$nodo);
            $insercion->execute();
            $this->cerrar_conexion();

            if ($insercion) {
                
                if ($id_ip != null) {
                    $cambiarDisponibleIp = $this->obtener_conexion()->prepare("UPDATE ips 
                        SET disponible = 2 
                        WHERE id_ip = :id_ip");
                    
                    $cambiarDisponibleIp->bindParam(':id_ip',$id_ip);
                    $cambiarDisponibleIp->execute();
                    $this->cerrar_conexion();
                }

                echo json_encode([1,"Impresora registrada"]);
            } else {
                echo json_encode([0,"Impresora NO registrada"]);
            }
        }
    }

    public function obtener_datos_impresora_modificar() {
         $id = $_POST['id'];

        $consulta = $this->obtener_conexion()->prepare("SELECT 
            impresoras.*, 
            ips.*,
            areas.*,
            departamentos.*
        FROM impresoras
        LEFT JOIN ips
            ON impresoras.ip_impresora = ips.id_ip
        LEFT JOIN areas
            ON impresoras.area = areas.id_area
        LEFT JOIN departamentos
            ON impresoras.departamento = departamentos.id_departamento
        WHERE id_impresora = :id;
        ");

        $consulta->bindParam(':id',$id);
        $consulta->execute();
        $datos = $consulta->fetch(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        echo json_encode($datos);
    }

    public function modificar_informacion_impresora() {
        $id = $_POST['id'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $n_serie = $_POST['n_serie'];
        $area = $_POST['area'];
        $departamento = $_POST['departamento'];
        $nodo = $_POST['nodo'];

        if ($_POST['id_ip'] == 'null') {
            $id_ip = null;
        }else {
            $id_ip = $_POST['id_ip'];
        }

        if (empty($marca) || empty($modelo) || empty($n_serie) || empty($area) || empty($departamento) || empty($nodo)) {
            echo json_encode([0,"Campos incompletos"]);
        } else {

            $ipActual = $this->obtener_conexion()->prepare("SELECT ip_impresora FROM impresoras WHERE n_serie = :n_serie");
            $ipActual->bindParam(':n_serie',$n_serie);
            $ipActual->execute();
            $ip_actual = $ipActual->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();

            $consultaNserie = $this->obtener_conexion()->prepare("SELECT n_serie FROM impresoras WHERE n_serie = :n_serie AND id_impresora != :id_impresora");
            $consultaNserie->bindParam(':n_serie',$n_serie);
            $consultaNserie->bindParam(':id_impresora',$id);
            $consultaNserie->execute();
            $nserie_reperido = $consultaNserie->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($nserie_reperido) {
                echo json_encode([0,"El numero de serie ya ha sido registrado"]);
                return;
            }

            $consultaEquipo = $this->obtener_conexion()->prepare("SELECT ip FROM resguardos WHERE ip = :ip");
            $consultaEquipo->bindParam(':ip',$id_ip);
            $consultaEquipo->execute();
            $equipo_reperido = $consultaEquipo->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($equipo_reperido) {
                echo json_encode([0,"La ip ya esta ocupada"]);
                return;
            }
            
            $consultaImpresora = $this->obtener_conexion()->prepare("SELECT ip_impresora FROM impresoras WHERE ip_impresora = :ip AND id_impresora != :id_impresora");
            $consultaImpresora->bindParam(':ip',$id_ip);
            $consultaImpresora->bindParam(':id_impresora',$id);
            $consultaImpresora->execute();
            $impresora_reperido = $consultaImpresora->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($impresora_reperido) {
                echo json_encode([0,"La ip ya esta ocupada"]);
                return;
            }

            $actualizacion = $this->obtener_conexion()->prepare("UPDATE impresoras 
            SET marca = :marca, modelo = :modelo, n_serie = :n_serie, ip_impresora = :ip_impresora,
                area = :area, departamento = :departamento, nodo = :nodo
            WHERE id_impresora = :id_impresora");
            
            $actualizacion->bindParam(':marca',$marca);
            $actualizacion->bindParam(':modelo',$modelo);
            $actualizacion->bindParam(':n_serie',$n_serie);
            $actualizacion->bindParam(':ip_impresora',$id_ip);
            $actualizacion->bindParam(':area',$area);
            $actualizacion->bindParam(':departamento',$departamento); 
            $actualizacion->bindParam(':nodo',$nodo);
            $actualizacion->bindParam(':id_impresora',$id);
            $actualizacion->execute();
            $this->cerrar_conexion();

            if ($actualizacion) {
                
                if ($ip_actual['ip_impresora'] != $id_ip) {
                    $cambiarDisponibleIp = $this->obtener_conexion()->prepare("UPDATE ips 
                        SET disponible = 2 
                        WHERE id_ip = :id_ip");
                    
                    $cambiarDisponibleIp->bindParam(':id_ip',$id_ip);
                    $cambiarDisponibleIp->execute();
                    $this->cerrar_conexion();
                    
                    $cambiarIpActual = $this->obtener_conexion()->prepare("UPDATE ips 
                        SET disponible = 1
                        WHERE id_ip = :id_ip");
                    
                    $cambiarIpActual->bindParam(':id_ip',$ip_actual['ip_impresora']);
                    $cambiarIpActual->execute();
                    $this->cerrar_conexion();
                }

                echo json_encode([1,"Informacion de la impresora modificada"]);
            } else {
                echo json_encode([0,"Informacion NO modificada"]);
            }
        }
    }

    public function dar_baja_usuario() {
        $id_usuario = $_POST['id_usuario'];
        $id_resguardo = $_POST['id_resguardo'];
        $ip = $_POST['ip'];
        $id_ip = $_POST['id_ip'];
        $descripcion = $_POST['descripcion'];
        
        if (empty($descripcion)) {
            echo json_encode([0,"Ingresa el motivo de la baja"]);
        }else if($ip == 'null'){
            echo json_encode([0,"El equipo de computo no cuenta con una ip"]);
        } else {
            $actualizacion = $this->obtener_conexion()->prepare("UPDATE usuarios 
            SET baja = 1, descripcion_baja = :descripcion 
            WHERE id_usuario = :id_usuario");
            
            $actualizacion->bindParam(':descripcion',$descripcion);
            $actualizacion->bindParam(':id_usuario',$id_usuario);
            $actualizacion->execute();
            $this->cerrar_conexion();

            if ($actualizacion) {
                $actualizacionResguardo = $this->obtener_conexion()->prepare("UPDATE resguardos 
                SET ip = NULL, baja = 1, ip_ultimo_registro = :ip 
                WHERE id_resguardo = :id_resguardo");
                
                $actualizacionResguardo->bindParam(':ip',$ip);
                $actualizacionResguardo->bindParam(':id_resguardo',$id_resguardo);
                $actualizacionResguardo->execute();
                $this->cerrar_conexion();

                if ($actualizacionResguardo) {
                    $actualizacionIp = $this->obtener_conexion()->prepare("UPDATE ips 
                    SET disponible = 1
                    WHERE id_ip = :id_ip");
                    
                    $actualizacionIp->bindParam(':id_ip',$id_ip);
                    $actualizacionIp->execute();
                    $this->cerrar_conexion();

                    if ($actualizacionIp) {
                        echo json_encode([1,"Usuario de baja correctamente"]);
                    }else {
                        echo json_encode([0,"No se pudo dar de baja"]);
                    }
                }else {
                    echo json_encode([0,"No se pudo dar de baja"]);
                }
            }else {
                echo json_encode([0,"No se pudo dar de baja"]);
            }
        }
    }
}

$consulta = new Home();
$metodo = $_POST['metodo'];
$consulta->$metodo();
?>