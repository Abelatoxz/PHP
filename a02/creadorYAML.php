<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

if (file_exists('./configuracion.yml')) {
  echo "El archivo de configuracion existe\n";
  exit();
}
// Solicitar al usuario el tipo de almacenamiento
echo "Selecciona el tipo de almacenamiento (sqlite, mariadb): ";
$storageType = readline();

$configuracion = [];

if ($storageType == 'sqlite') {
  // Solicitar al usuario el nombre de la base de datos SQLite
  echo "Nombre de la base de datos SQLite: ";
  $configuracion['Main']['storage-type'] = $storageType;
  $configuracion['SQLite']['db'] = "archivo.sqlite";
} elseif ($storageType == 'mariadb') {
  // Solicitar al usuario las credenciales de MariaDB
  echo "Host: ";
  $host = readline();
  echo "Database: ";
  $db = readline();
  echo "User: ";
  $user = readline();
  echo "Password: ";
  $password = readline();
  echo "Port: ";
  $port = readline();

  $configuracion['Main']['storage-type'] = $storageType;
  $configuracion['MariaDB'] = [
    'host' => $host,
    'db' => $db,
    'user' => $user,
    'password' => $password,
    'port' => $port,
  ];
}

// Guardar la configuración en un archivo YAML
$rutaArchivoYAML = 'configuracion.yml';
$yaml = Yaml::dump($configuracion);
file_put_contents($rutaArchivoYAML, $yaml);

echo "¡Configuración guardada en $rutaArchivoYAML!\n";
