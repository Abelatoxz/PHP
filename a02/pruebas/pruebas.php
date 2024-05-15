
<?php

function OpenConSql()
{
  $dsn = 'mysql:dbname=Base de datos;host=192.168.1.136';
  $usuario = 'taskmanager';
  $contraseña = 'Contraseña';

  try {
    return new PDO($dsn, $usuario, $contraseña);
  } catch (PDOException $e) {
    // Habilitar excepciones de PD0
    echo 'Error al conectarse: ' . $e->getMessage();
  }
}
