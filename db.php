<?php

require_once "config.php";

class Conexion{
  /**
   * Variable para guardar la conexion a la base de datos
   * @var [type]
   */
  private $link;
  /**
   * Nombre del host
   * @var string
   */
  public $host;
  /**
   * Nombre de la base de datos
   * @var string
   */
  public $db;
  /**
   * Nombre de usuario de la de base de datos
   * @var string
   */
  public $user;
  /**
   * Contraseña de la base de datos
   * @var [type]
   */
  public $password;

  /**
   * Remplazar los valores por los definidos en el archivo config.php
   */
  public function __construct(){
    $this->host = DB_HOST;
    $this->db = DB_NAME;
    $this->user = DB_USER;
    $this->password = DB_PASS;
    return $this;
  }
  /**
   * Conectar a la base de datos
   * @return string La conexión a la base de datos mediante PDO
   */
  private function conectar(){
    try {
      $this->link = new PDO("mysql:host=".$this->host.";dbname=".$this->db,$this->user,$this->password);
      $this->link -> exec("set names utf8");
      return $this->link;
    } catch (\Exception $e) {
      echo 'Hubo un error: '.$e->getMessage();
    }
  }
  /**
   * Ejecutar las consultas del usuario
   * @param  string $sql consulta SQL
   * @return string     respuesta del servidor
   */
  public function query($sql){
    $db = new self();
    $link = $db->conectar();

    $query = $link->prepare($sql);
    $query->execute();
    return $query->fetchAll();
  }
}

?>
