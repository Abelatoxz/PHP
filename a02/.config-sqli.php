<?php
//conexion sqlite
function OpenConSqli()
{
  $sqliteFile = './taskdb.sqlite';

  try {
    $conn = new PDO('sqlite:' . $sqliteFile);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
  } catch (PDOException $e) {
    echo "Error al conectar con la base de datos: " . $e->getMessage();
    exit(1);
  }
}
