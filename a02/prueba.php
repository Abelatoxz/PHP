<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

// Ruta al archivo YAML
$rutaArchivoYAML = 'archivo.yml';

// Cargar el contenido del archivo YAML
$contenidoYAML = file_get_contents($rutaArchivoYAML);

// Convertir el contenido YAML a un array asociativo
$configuracion = Yaml::parse($contenidoYAML);

// Acceder a los valores del array asociativo
$storageType = $configuracion['Main']['storage-type'];
if ($storageType == 'csv') {
  echo "csv\n";
  exit(1);
}
$host = $configuracion['MariaDB']['host'];
$db = $configuracion['MariaDB']['db'];
$user = $configuracion['MariaDB']['user'];
$password = $configuracion['MariaDB']['password'];
$port = $configuracion['MariaDB']['port'];

// Mostrar los valores
echo "Storage Type: $storageType\n";
echo "Host: $host\n";
echo "Database: $db\n";
echo "User: $user\n";
echo "Password: $password\n";
echo "Port: $port\n";
