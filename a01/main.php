<?php
include './repositorio-sql.php';

// Comprobamos que el script esté siendo ejecutado desde el CLI
if (php_sapi_name() !== 'cli') {
  echo "Este script sólo puede ser ejecutado desde la línea de comandos (CLI).\n";
  exit(1);
}

$options = getopt("u:c:t:d:h");

// Validación del número de parámetros
if ($argc < 2 || isset($options['h'])) {
  echo "Uso: php main.php -u [id_usuario] -c [comando] -t [título] -d [descripción]\n";
  echo "Comandos conocidos:\n";
  echo "  -c add: Agregar una nueva tarea\n";
  echo "  -c list: Listar todas las tareas del usuario\n";
  echo "  -c complete: Marcar una tarea como completada\n";
  echo "  -c delete: Eliminar una tarea\n";
  exit(1);
}

$conn = getOpenCon();
$user = login($conn);
$userId = $options['u'];
$command = $options['c'];

switch ($command) {
  case 'add':
    if (!isset($options['t']) || !isset($options['d'])) {
      echo "Sintaxis incorrecta. Uso: php main.php -u [id_usuario] -c add -t [título] -d [descripción]\n";
      exit(1);
    }
    $titulo = $options['t'];
    $desc = $options['d'];
    echo insertarTarea($conn, $user, $titulo, $desc);
    echo "\n";
    break;
  case 'list':
    mostrarTareas($conn, $user);
    echo "\n";
    break;
  case 'complete':
    if (!isset($options['i'])) {
      echo "Sintaxis incorrecta. Uso: php main.php -u [id_usuario] -c complete -i [identificador]\n";
      exit(1);
    }
    $tarea = $options['i'];
    echo completaTarea($conn, $user, $tarea);
    echo "\n";
    break;
  case 'delete':
    if (!isset($options['i'])) {
      echo "Sintaxis incorrecta. Uso: php main.php -u [id_usuario] -c delete -i [identificador]\n";
      exit(1);
    }
    $tarea = $options['i'];
    echo borrarTarea($conn, $user, $tarea);
    echo "\n";
    break;
  default:
    echo "Comando desconocido: $command\n";
    echo "Comandos conocidos:\n";
    echo "  -c add: Agregar una nueva tarea\n";
    echo "  -c list: Listar todas las tareas del usuario\n";
    echo "  -c complete: Marcar una tarea como completada\n";
    echo "  -c delete: Eliminar una tarea\n";
    break;
}

$conn->close();

