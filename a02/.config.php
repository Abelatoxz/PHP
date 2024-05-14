<?php
function OpenCon()
{
  $dsn = 'mysql:dbname=taskdb;host=127.0.0.1';
  $usuario = 'taskmanager';
  $contraseña = 'password';

  try {
    return new PDO($dsn, $usuario, $contraseña);
  } catch (PDOException $e) {
    echo '¡Oh no! Hubo un problema al conectarse: ' . $e->getMessage();
  }
}
