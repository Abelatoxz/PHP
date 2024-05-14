<?php
function OpenCon()
{
  $sqliteFile = './baseDeDatos.sqlite'; // Ruta a tu base de datos SQLite

  try {
    $conn = new PDO('sqlite:' . $sqliteFile);
    // Habilitar excepciones de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
  } catch (PDOException $e) {
    echo "Error al conectar con la base de datos: " . $e->getMessage();
    exit(1);
  }
}

