<?php
class Conexion extends mysqli
{

  public $enlace;

  function __construct()
  {
    $this->enlace = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  }
  function __destruct()
  {
    mysqli_close($this->enlace);
  }
}
