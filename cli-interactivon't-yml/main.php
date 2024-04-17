<?php
// Incluir el autoload de Composer
require __DIR__ . '/vendor/autoload.php';

// Importar la clase Yaml de Symfony
use Symfony\Component\Yaml\Yaml;

// Incluir el archivo repositorio-sql.php si es necesario
require './repositorio-sql.php';

// Parsear el archivo YAML y obtener las configuraciones
$configuraciones = Yaml::parseFile('./conf.yaml');

// Verificar si se cargaron correctamente las configuraciones
if ($configuraciones === null) {
    echo "Error al cargar las configuraciones desde el archivo YAML.";
    exit;
}

// Inicializar un array vacío llamado $configuracion
$configuracion = [];

// Recorrer el array $configuraciones y llenar el array $configuracion
foreach ($configuraciones as $key => $value) {
  $configuracion[] = $value;
}

// Verificar si la primera configuración es "sql"
$count = 0;
if (strtolower($configuracion[0]) == "sql") {
  $count = 1;
}

// Imprimir el array $configuracion para verificar
// Suponiendo que $configuracion[1] es un array asociativo

// Acceder a los elementos del array asociativo $configuracion[1]
$host = $configuracion[1]['host'];
$user = $configuracion[1]['user'];
$password = $configuracion[1]['password'];
$name = $configuracion[1]['name'];

// Imprimir los elementos

// Imprimir el segundo elemento del array $configuracion
if($conn = OpenCon($host,$user,$password,$name)){
  echo "Error en la conexion";
}
  
// Si $count es igual a 1, se ejecutará la lógica para conectar a la base de datos
if ($count == 1) {

    mostrar($conn,1);
}

// Ahora puedes utilizar las configuraciones en tu script según sea necesario
?>

