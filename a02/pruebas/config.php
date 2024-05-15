<?php
function OpenConSql()
{
  $dsn = 'mysql:dbname=taskdb;host=127.0.0.1';
  $usuario = 'taskmanager';
  $contraseña = 'password';

  try {
    return new PDO($dsn, $usuario, $contraseña);
  } catch (PDOException $e) {
    // Habilitar excepciones de PD0
    echo 'Error al conectarse: ' . $e->getMessage();
  }
}
