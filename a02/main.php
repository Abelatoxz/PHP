<?php
include './repositorio-sqli.php';

// Comprobamos que el script esté siendo ejecutado desde el CLI
if (php_sapi_name() !== 'cli') {
  echo "Este script sólo puede ser ejecutado desde la línea de comandos (CLI).\n";
  exit(1);
}

function Ayuda()
{
  $Ayuda =  "Uso: php main.php -u [Usuario] -p [Contraseña] -c [comando] -t [título] -d [descripción]\n  Comandos conocidos:\n  -c add: Agregar una nueva tarea\n  -c list: Listar todas las tareas del usuario\n  -c complete: Marcar una tarea como completada\n  -c delete: Eliminar una tarea\n  -c create: Crear un nuevo usuario\n";
  return $Ayuda;
}

$options = getopt("u:c:t:d:hn:s:e:p:i:");

// Validación del número de parámetros
if ($argc < 2 || isset($options['h'])) {
  echo Ayuda();
  exit(1);
}
if (empty($options['c'])) {
  echo Ayuda();

  exit(1);
}
if (empty($options['u'])) {
  echo Ayuda();
  exit(1);
}
if (empty($options['p'])) {
  echo Ayuda();
  exit(1);
}

$conn = getOpenCon();
$user = login($conn, $options['u'], $options['p']);

if (!is_array($user)) {
  echo ($user) . "\n";
  exit(1);
}

$command = $options['c'];

switch ($command) {
  case 'add':
    if (!isset($options['t']) || !isset($options['d'])) {
      echo "Sintaxis incorrecta. Uso: php main.php -u [Usuario] -p [Contraseña] -c add -t [título] -d [descripción]\n";
      exit(1);
    }
    $titulo = $options['t'];
    $desc = $options['d'];
    echo insertarTarea($conn, $user, $titulo, $desc);
    echo "\n";
    break;
  case 'list':
    $Listas = array(mostrarTareas($conn, $user));
    foreach ($Listas as $vale) {
      foreach ($vale as $elemento) {
        echo "La id: " . $elemento['ID'] . "| El titulo: " . $elemento['Titulo'] . " | La descripción es: " . $elemento['Descripcion'] . " |  El estado es:  " . $elemento['Estado'] . "\n";
      }
    }
    echo "\n";
    break;
  case 'complete':
    if (!isset($options['i'])) {
      echo "Sintaxis incorrecta. Uso: php main.php -u [Usuario] -p [Contraseña] -c complete -i [identificador]\n";
      exit(1);
    }
    $tarea = $options['i'];
    echo completaTarea($conn, $user, $tarea);
    echo "\n";
    break;
  case 'delete':
    if (!isset($options['i'])) {
      echo "Sintaxis incorrecta. Uso: php main.php -u [Usuario] -p [Contraseña] -c delete -i [identificador]\n";
      exit(1);
    }
    $tarea = $options['i'];
    echo borrarTarea($conn, $user, $tarea);
    echo "\n";
    break;
  case 'create':
    if (!isset($options['n']) || !isset($options['s']) || !isset($options['e']) || !isset($options['p'])) {
      echo "Sintaxis incorrecta. Uso: php main.php -c create -n [Nombre] -s [Apellido] -e [Correo electrónico] -p [Contraseña]\n";
      exit(1);
    }
    $name = $options['n'];
    $surname = $options['s'];
    $email = $options['e'];
    $password = $options['p'];
    echo crearUsuario($conn, $name, $surname, $email, $password);
    echo "\n";
    break;
  default:
    echo Ayuda();
    break;
}

die();
