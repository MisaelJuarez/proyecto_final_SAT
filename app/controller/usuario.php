<?php
session_start();
require_once '../config/conexion.php';

use PHPMailer\PHPMailer\PHPMailer; // -- copiar
use PHPMailer\PHPMailer\Exception; // -- copiar
use PHPMailer\PHPMailer\SMTP; // -- copiar

require 'PHPMailer/Exception.php'; // -- copiar
require 'PHPMailer/PHPMailer.php'; // -- copiar
require 'PHPMailer/SMTP.php'; // -- copiar

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
        $correo = $_POST['correo'];

        if (empty($nombre) || empty($apellidos) || empty($rfc) || empty($rfc_corto) || empty($usuario) || 
            empty($pass) || empty($area) || empty($tipo) || empty($correo)) {
            echo json_encode([0,"Campos incompletos"]);
        } else if (is_numeric($nombre) || is_numeric($apellidos)) {
            echo json_encode([0,"No puedes ingresar numeros en nombre y apellidos"]);
        } else {

            $consultaRfc = $this->obtener_conexion()->prepare("SELECT rfc FROM colaboradores WHERE rfc = :rfc");
            $consultaRfc->bindParam(':rfc',$rfc);
            $consultaRfc->execute();
            $rfc_reperido = $consultaRfc->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($rfc_reperido) {
                echo json_encode([0,"El rfc ya ha sido registrado"]);
                return;
            }

            $consultaRfcCorto = $this->obtener_conexion()->prepare("SELECT rfc_corto FROM colaboradores WHERE rfc_corto = :rfc");
            $consultaRfcCorto->bindParam(':rfc',$rfc_corto);
            $consultaRfcCorto->execute();
            $rfcCorto_reperido = $consultaRfcCorto->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($rfcCorto_reperido) {
                echo json_encode([0,"El rfc ya ha sido registrado"]);
                return;
            }
            
            $consultaUsuario = $this->obtener_conexion()->prepare("SELECT usuario FROM colaboradores WHERE usuario = :usuario");
            $consultaUsuario->bindParam(':usuario',$usuario);
            $consultaUsuario->execute();
            $rfc_reperido = $consultaUsuario->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($rfc_reperido) {
                echo json_encode([0,"El nombre de usuario ya ha sido registrado"]);
                return;
            }
            
            $consultaCorreo = $this->obtener_conexion()->prepare("SELECT correo FROM colaboradores WHERE correo = :correo");
            $consultaCorreo->bindParam(':correo',$correo);
            $consultaCorreo->execute();
            $rfc_reperido = $consultaCorreo->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($rfc_reperido) {
                echo json_encode([0,"El correo ya ha sido registrado"]);
                return;
            }

            $insercion = $this->obtener_conexion()->prepare("INSERT INTO colaboradores (nombre,apellidos,rfc,rfc_corto,
                                    usuario,pass,area,administrador,correo) 
            VALUES(:nombre,:apellidos,:rfc,:rfc_corto,:usuario,:pass,:area,:tipo,:correo)");
            
            $insercion->bindParam(':nombre',$nombre);
            $insercion->bindParam(':apellidos',$apellidos);
            $insercion->bindParam(':rfc',$rfc);
            $insercion->bindParam(':rfc_corto',$rfc_corto);
            $insercion->bindParam(':usuario',$usuario);
            $passw = password_hash($pass,PASSWORD_BCRYPT);
            $insercion->bindParam(':pass',$passw);
            $insercion->bindParam(':area',$area);
            $insercion->bindParam(':tipo',$tipo);
            $insercion->bindParam(':correo',$correo);
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
        $correo = $_POST['correo'];

        if (empty($nombre) || empty($apellidos) || empty($rfc) || empty($rfc_corto) || empty($usuario) || empty($area) || empty($correo)) {
            echo json_encode([0,"Campos incompletos"]);
        } else if (is_numeric($nombre) || is_numeric($apellidos)) {
            echo json_encode([0,"No puedes ingresar numeros en nombre y apellidos"]);
        } else {

            $consultaRfc = $this->obtener_conexion()->prepare("SELECT rfc FROM colaboradores WHERE rfc = :rfc AND id_colaborador != :id");
            $consultaRfc->bindParam(':rfc',$rfc);
            $consultaRfc->bindParam(':id',$id);
            $consultaRfc->execute();
            $rfc_reperido = $consultaRfc->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($rfc_reperido) {
                echo json_encode([0,"El rfc ya ha sido registrado"]);
                return;
            }
            
            $consultaRfcCorto = $this->obtener_conexion()->prepare("SELECT rfc_corto FROM colaboradores WHERE rfc_corto = :rfc AND id_colaborador != :id");
            $consultaRfcCorto->bindParam(':rfc',$rfc_corto);
            $consultaRfcCorto->bindParam(':id',$_SESSION['usuario']['id_colaborador']);
            $consultaRfcCorto->execute();
            $rfcCorto_reperido = $consultaRfcCorto->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($rfcCorto_reperido) {
                echo json_encode([0,"El rfc ya ha sido registrado"]);
                return;
            }
            
            $consultaUsuario = $this->obtener_conexion()->prepare("SELECT usuario FROM colaboradores WHERE usuario = :usuario AND id_colaborador != :id");
            $consultaUsuario->bindParam(':usuario',$usuario);
            $consultaUsuario->bindParam(':id',$_SESSION['usuario']['id_colaborador']);
            $consultaUsuario->execute();
            $rfc_reperido = $consultaUsuario->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($rfc_reperido) {
                echo json_encode([0,"El nombre de usuario ya ha sido registrado"]);
                return;
            }
            
            $consultaCorreo = $this->obtener_conexion()->prepare("SELECT correo FROM colaboradores WHERE correo = :correo AND id_colaborador != :id");
            $consultaCorreo->bindParam(':correo',$correo);
            $consultaCorreo->bindParam(':id',$_SESSION['usuario']['id_colaborador']);
            $consultaCorreo->execute();
            $rfc_reperido = $consultaCorreo->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($rfc_reperido) {
                echo json_encode([0,"El correo ya ha sido registrado"]);
                return;
            }


            if (empty($pass)) {
                $actualizacion = $this->obtener_conexion()->prepare("UPDATE colaboradores 
                SET nombre = :nombre, apellidos = :apellidos, rfc = :rfc, rfc_corto = :rfc_corto, usuario = :usuario,
                area = :area, correo = :correo
                WHERE id_colaborador = :usuario_id");
                
                $actualizacion->bindParam(':nombre',$nombre);
                $actualizacion->bindParam(':apellidos',$apellidos);
                $actualizacion->bindParam(':rfc',$rfc);
                $actualizacion->bindParam(':rfc_corto',$rfc_corto);
                $actualizacion->bindParam(':usuario',$usuario);
                $actualizacion->bindParam(':area',$area);
                $actualizacion->bindParam(':correo',$correo);
                $actualizacion->bindParam(':usuario_id',$_SESSION['usuario']['id_colaborador']);
                $actualizacion->execute();
                $this->cerrar_conexion();
    
                echo json_encode([1,"Actualizacion correcta","Tu session se cerrara para que ingreses de nuevo tus datos"]);
                
            }else {
                $actualizacion = $this->obtener_conexion()->prepare("UPDATE colaboradores 
                SET nombre = :nombre, apellidos = :apellidos, rfc = :rfc, rfc_corto = :rfc_corto, usuario = :usuario,
                pass = :pass, area = :area, correo = :correo 
                WHERE id_colaborador = :usuario_id");
                
                $actualizacion->bindParam(':nombre',$nombre);
                $actualizacion->bindParam(':apellidos',$apellidos);
                $actualizacion->bindParam(':rfc',$rfc);
                $actualizacion->bindParam(':rfc_corto',$rfc_corto);
                $actualizacion->bindParam(':usuario',$usuario);
                $passw = password_hash($pass,PASSWORD_BCRYPT);
                $actualizacion->bindParam(':pass',$passw);
                $actualizacion->bindParam(':area',$area);
                $actualizacion->bindParam(':correo',$correo);
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
        $correo = $_POST['correo'];

        if (empty($nombre) || empty($apellidos) || empty($rfc) || empty($rfc_corto) || empty($usuario) || empty($area) || empty($correo)) {
            echo json_encode([0,"Campos incompletos"]);
        } else if (is_numeric($nombre) || is_numeric($apellidos)) {
            echo json_encode([0,"No puedes ingresar numeros en nombre y apellidos"]);
        } else {

            $consultaRfc = $this->obtener_conexion()->prepare("SELECT rfc FROM colaboradores WHERE rfc = :rfc AND id_colaborador != :id");
            $consultaRfc->bindParam(':rfc',$rfc);
            $consultaRfc->bindParam(':id',$id);
            $consultaRfc->execute();
            $rfc_reperido = $consultaRfc->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($rfc_reperido) {
                echo json_encode([0,"El rfc ya ha sido registrado"]);
                return;
            }

            $consultaRfcCorto = $this->obtener_conexion()->prepare("SELECT rfc_corto FROM colaboradores WHERE rfc_corto = :rfc AND id_colaborador != :id");
            $consultaRfcCorto->bindParam(':rfc',$rfc_corto);
            $consultaRfcCorto->bindParam(':id',$id);
            $consultaRfcCorto->execute();
            $rfcCorto_reperido = $consultaRfcCorto->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($rfcCorto_reperido) {
                echo json_encode([0,"El rfc ya ha sido registrado"]);
                return;
            }
            
            $consultaUsuario = $this->obtener_conexion()->prepare("SELECT usuario FROM colaboradores WHERE usuario = :usuario AND id_colaborador != :id");
            $consultaUsuario->bindParam(':usuario',$usuario);
            $consultaUsuario->bindParam(':id',$id);
            $consultaUsuario->execute();
            $rfc_reperido = $consultaUsuario->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($rfc_reperido) {
                echo json_encode([0,"El nombre de usuario ya ha sido registrado"]);
                return;
            }
            
            $consultaCorreo = $this->obtener_conexion()->prepare("SELECT correo FROM colaboradores WHERE correo = :correo AND id_colaborador != :id");
            $consultaCorreo->bindParam(':correo',$correo);
            $consultaCorreo->bindParam(':id',$id);
            $consultaCorreo->execute();
            $rfc_reperido = $consultaCorreo->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            
            if ($rfc_reperido) {
                echo json_encode([0,"El correo ya ha sido registrado"]);
                return;
            }

            if (empty($pass)) {

                $actualizacion = $this->obtener_conexion()->prepare("UPDATE colaboradores 
                SET nombre = :nombre, apellidos = :apellidos, rfc = :rfc, rfc_corto = :rfc_corto, usuario = :usuario,
                    area = :area, administrador = :administrador, correo = :correo 
                    WHERE id_colaborador = :usuario_id");
                
                $actualizacion->bindParam(':nombre',$nombre);
                $actualizacion->bindParam(':apellidos',$apellidos);
                $actualizacion->bindParam(':rfc',$rfc);
                $actualizacion->bindParam(':rfc_corto',$rfc_corto);
                $actualizacion->bindParam(':usuario',$usuario);
                $actualizacion->bindParam(':area',$area);
                $actualizacion->bindParam(':administrador',$administrador);
                $actualizacion->bindParam(':correo',$correo);
                $actualizacion->bindParam(':usuario_id',$id);
                $actualizacion->execute();
                $this->cerrar_conexion();
                
                echo json_encode([1,"Datos Actualizados"]);
                
            }else {
                $actualizacion = $this->obtener_conexion()->prepare("UPDATE colaboradores 
                SET nombre = :nombre, apellidos = :apellidos, rfc = :rfc, rfc_corto = :rfc_corto, usuario = :usuario,
                pass = :pass, area = :area, administrador = :administrador, correo = :correo  
                WHERE id_colaborador = :usuario_id");
                
                $actualizacion->bindParam(':nombre',$nombre);
                $actualizacion->bindParam(':apellidos',$apellidos);
                $actualizacion->bindParam(':rfc',$rfc);
                $actualizacion->bindParam(':rfc_corto',$rfc_corto);
                $actualizacion->bindParam(':usuario',$usuario);
                $passw = password_hash($pass,PASSWORD_BCRYPT);
                $actualizacion->bindParam(':pass',$passw);
                $actualizacion->bindParam(':area',$area);
                $actualizacion->bindParam(':administrador',$administrador);
                $actualizacion->bindParam(':correo',$correo);
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