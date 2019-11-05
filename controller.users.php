<?php

require_once "db.php";

class Usuarios extends Conexion{

  public function consulta($action){
    switch ($action) {
      case 'index':
        $consulta = Conexion::query("SELECT * FROM usuarios");
        break;

      case 'insert':
        $consulta = Conexion::query("INSERT INTO usuarios (nombre,correo,telefono) VALUES (:nombre,:correo,:telefono)", ['nombre'=>'','correo'=>'','telefono'=>'']);
        break;

      case 'update':
        $consulta = Conexion::query("UPDATE usuarios SET nombre=:nombre,correo=:correo,telefono=:telefono", ['nombre'=>'','correo'=>'','telefono'=>'']);
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
