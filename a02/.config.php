<?php
require_once 'vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

function OpenConSql()
{

  // Ruta al archivo YAML
  $rutaArchivoYAML = './configuracion.yml';

  // Cargar el contenido del archivo YAML
  $contenidoYAML = file_get_contents($rutaArchivoYAML);

  // Convertir el contenido YAML a un array asociativo
  $configuracion = Yaml::parse($contenidoYAML);

  // Acceder a los valores del array asociativo
  $host = $configuracion['MariaDB']['host'];
  $db = $configuracion['MariaDB']['db'];
  $user = $configuracion['MariaDB']['user'];
  $password = $configuracion['MariaDB']['password'];
  $port = $configuracion['MariaDB']['port']; {
    $dsn = "mysql:dbname=$db;host=$host;port=$port";
    $usuario = "$user";
    $contraseña = "$password";

    try {
      return new PDO($dsn, $usuario, $contraseña);
    } catch (PDOException $e) {
      // Habilitar excepciones de PD0
      echo 'Error al conectarse: ' . $e->getMessage();
    }
  }
}
