<?php

require_once "db.php";

class Usuarios extends Conexion{

  public function consulta($action){

    switch ($action) {
      case 'index':
        $consulta = Conexion::query("SELECT * FROM usuarios");
        break;
      case 'insert':
        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];

        $consulta = Conexion::query("INSERT INTO usuarios (nombre,correo,telefono) VALUES (:nombre,:correo,:telefono)", ['nombre'=>$nombre,'correo'=>$correo,'telefono'=>$telefono]);
        break;
      case 'update':
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];

        $consulta = Conexion::query("UPDATE usuarios SET nombre=:nombre,correo=:correo,telefono=:telefono WHERE id=:id", ['nombre'=>$nombre,'correo'=>$correo,'telefono'=>$telefono,'id'=>$id]);
        break;

      case 'delete':
        $consulta = Conexion::query("DELETE FROM usuarios WHERE id=:id",['id'=>'']);
        break;

      default:
        break;
    }
    echo json_encode($consulta);
  }
}

if(isset($_GET["action"])){
  $usuarios = Usuarios::consulta($_GET["action"]);
}
