<?php
session_start();
require_once '../config/conexion.php';

class Usuario extends Conexion {
    public function agregar_colaborador() {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $rfc = $_POST['rfc'];
        $rfc_corto = $_POST['rfc_corto'];
        $usuario = $_POST['usuario'];
        $pass = $_POST['pass'];
        $area = $_POST['area'];
        $tipo = $_POST['tipo'];

        if (empty($nombre) || empty($apellidos) || empty($rfc) || empty($rfc_corto) || empty($usuario) || 
            empty($pass) || empty($area) || empty($tipo)) {
            echo json_encode([0,"Campos incompletos"]);
        } else if (is_numeric($nombre) || is_numeric($apellidos)) {
            echo json_encode([0,"No puedes ingresar numeros en nombre y apellidos"]);
        } else {
            $insercion = $this->obtener_conexion()->prepare("INSERT INTO colaboradores (nombre,apellidos,rfc,rfc_corto,
                                    usuario,pass,area,administrador) 
            VALUES(:nombre,:apellidos,:rfc,:rfc_corto,:usuario,:pass,:area,:tipo)");
            
            $insercion->bindParam(':nombre',$nombre);
            $insercion->bindParam(':apellidos',$apellidos);
            $insercion->bindParam(':rfc',$rfc);
            $insercion->bindParam(':rfc_corto',$rfc_corto);
            $insercion->bindParam(':usuario',$usuario);
            $passw = password_hash($pass,PASSWORD_BCRYPT);
            $insercion->bindParam(':pass',$passw);
            $insercion->bindParam(':area',$area);
            $insercion->bindParam(':tipo',$tipo);
            $insercion->execute();
            $this->cerrar_conexion();

            if ($insercion) {
                echo json_encode([1,"Colaborador registrado"]);
            } else {
                echo json_encode([0,"Colaborador NO registrado"]);
            }
        }
    }

    public function obtener_informacion_actualizar() {
        $consulta = $this->obtener_conexion()->prepare("SELECT * FROM colaboradores WHERE id_colaborador = :usuario_id");
        $consulta->bindParam(':usuario_id',$_SESSION['usuario']['id_colaborador']);
        $consulta->execute();
        $datos = $consulta->fetch(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        echo json_encode($datos);
    }

    public function actualizar_informacion(){
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $rfc = $_POST['rfc'];
        $rfc_corto = $_POST['rfc_corto'];
        $usuario = $_POST['usuario'];
        $pass = $_POST['pass'];
        $area = $_POST['area'];

        if (empty($nombre) || empty($apellidos) || empty($rfc) || empty($rfc_corto) || empty($usuario) || empty($area)) {
            echo json_encode([0,"Campos incompletos"]);
        } else if (is_numeric($nombre) || is_numeric($apellidos)) {
            echo json_encode([0,"No puedes ingresar numeros en nombre y apellidos"]);
        } else {
            if (empty($pass)) {

                $actualizacion = $this->obtener_conexion()->prepare("UPDATE colaboradores 
                SET nombre = :nombre, apellidos = :apellidos, rfc = :rfc, rfc_corto = :rfc_corto, usuario = :usuario,
                    area = :area WHERE id_colaborador = :usuario_id");
                
                $actualizacion->bindParam(':nombre',$nombre);
                $actualizacion->bindParam(':apellidos',$apellidos);
                $actualizacion->bindParam(':rfc',$rfc);
                $actualizacion->bindParam(':rfc_corto',$rfc_corto);
                $actualizacion->bindParam(':usuario',$usuario);
                $actualizacion->bindParam(':area',$area);
                $actualizacion->bindParam(':usuario_id',$_SESSION['usuario']['id_colaborador']);
                $actualizacion->execute();
                $this->cerrar_conexion();
    
                echo json_encode([1,"Actualizacion correcta","Tu session se cerrara para que ingreses de nuevo tus datos"]);
                
            }else {
                $actualizacion = $this->obtener_conexion()->prepare("UPDATE colaboradores 
                SET nombre = :nombre, apellidos = :apellidos, rfc = :rfc, rfc_corto = :rfc_corto, usuario = :usuario,
                    pass = :pass, area = :area WHERE id_colaborador = :usuario_id");
                
                $actualizacion->bindParam(':nombre',$nombre);
                $actualizacion->bindParam(':apellidos',$apellidos);
                $actualizacion->bindParam(':rfc',$rfc);
                $actualizacion->bindParam(':rfc_corto',$rfc_corto);
                $actualizacion->bindParam(':usuario',$usuario);
                $passw = password_hash($pass,PASSWORD_BCRYPT);
                $actualizacion->bindParam(':pass',$passw);
                $actualizacion->bindParam(':area',$area);
                $actualizacion->bindParam(':usuario_id',$_SESSION['usuario']['id_colaborador']);
                $actualizacion->execute();
                $this->cerrar_conexion();
    
                echo json_encode([1,"Actualizacion correcta","Tu session se cerrara para que ingreses de nuevo tus datos"]);
            }
        }
    }

    public function obtener_datos_colaboradores(){
        $consulta = $this->obtener_conexion()->prepare("SELECT 
                colaboradores.*, 
                areas.*
            FROM 
                colaboradores
            INNER JOIN 
                areas 
            ON 
                colaboradores.area = areas.id_area
            WHERE 
                colaboradores.id_colaborador != :id_colaborador;

        ");
        $consulta->bindParam(':id_colaborador',$_SESSION['usuario']['id_colaborador']);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        echo json_encode($datos);
    }

    public function editar_informacion_colaborador(){
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $rfc = $_POST['rfc'];
        $rfc_corto = $_POST['rfc_corto'];
        $usuario = $_POST['usuario'];
        $pass = $_POST['pass'];
        $area = $_POST['area'];
        $administrador = $_POST['tipo'];

        if (empty($nombre) || empty($apellidos) || empty($rfc) || empty($rfc_corto) || empty($usuario) || empty($area)) {
            echo json_encode([0,"Campos incompletos"]);
        } else if (is_numeric($nombre) || is_numeric($apellidos)) {
            echo json_encode([0,"No puedes ingresar numeros en nombre y apellidos"]);
        } else {
            if (empty($pass)) {

                $actualizacion = $this->obtener_conexion()->prepare("UPDATE colaboradores 
                SET nombre = :nombre, apellidos = :apellidos, rfc = :rfc, rfc_corto = :rfc_corto, usuario = :usuario,
                    area = :area, administrador = :administrador WHERE id_colaborador = :usuario_id");
                
                $actualizacion->bindParam(':nombre',$nombre);
                $actualizacion->bindParam(':apellidos',$apellidos);
                $actualizacion->bindParam(':rfc',$rfc);
                $actualizacion->bindParam(':rfc_corto',$rfc_corto);
                $actualizacion->bindParam(':usuario',$usuario);
                $actualizacion->bindParam(':area',$area);
                $actualizacion->bindParam(':administrador',$administrador);
                $actualizacion->bindParam(':usuario_id',$id);
                $actualizacion->execute();
                $this->cerrar_conexion();
                
                echo json_encode([1,"Datos Actualizados"]);
                
            }else {
                $actualizacion = $this->obtener_conexion()->prepare("UPDATE colaboradores 
                SET nombre = :nombre, apellidos = :apellidos, rfc = :rfc, rfc_corto = :rfc_corto, usuario = :usuario,
                    pass = :pass, area = :area, administrador = :administrador WHERE id_colaborador = :usuario_id");
                
                $actualizacion->bindParam(':nombre',$nombre);
                $actualizacion->bindParam(':apellidos',$apellidos);
                $actualizacion->bindParam(':rfc',$rfc);
                $actualizacion->bindParam(':rfc_corto',$rfc_corto);
                $actualizacion->bindParam(':usuario',$usuario);
                $passw = password_hash($pass,PASSWORD_BCRYPT);
                $actualizacion->bindParam(':pass',$passw);
                $actualizacion->bindParam(':area',$area);
                $actualizacion->bindParam(':administrador',$administrador);
                $actualizacion->bindParam(':usuario_id',$id);
                $actualizacion->execute();
                $this->cerrar_conexion();
    
                echo json_encode([1,"Datos actualizados"]);
            }
        }

    }

    public function eliminar_colaborador() {
        $id = $_POST['id'];

        $eliminar = $this->obtener_conexion()->prepare("DELETE FROM colaboradores WHERE id_colaborador = :id");
        $eliminar->bindParam(':id',$id);
        $eliminar->execute();
        $this->cerrar_conexion();
        if ($eliminar) {
            echo json_encode([1,'Colaborador eliminado correctamente']);
        } else {
            echo json_encode([0,'Error al eliminar']);
        }
    }
}

$consulta = new Usuario();
$metodo = $_POST['metodo'];
$consulta->$metodo();
?>