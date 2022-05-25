<?php
include('config.php');
class Conexion extends mysqli
{

  public $db;

  function __construct()
  {
    $this->db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  }
  function __destruct()
  {
    mysqli_close($this->db);
  }
}
