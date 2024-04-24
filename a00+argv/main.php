<?php
include './repositorio-sql.php';

// Comprobamos que el script esté siendo ejecutado desde el CLI
if (php_sapi_name() !== 'cli') {
  echo "Este script sólo puede ser ejecutado desde la línea de comandos (CLI).\n";
  exit(1);
}

// Validación del número de parámetros
if ($argc < 3) {
  echo "Uso: php main.php [id_usuario] [comando] [argumentos]\n";
  echo "Comandos conocidos:\n";
  echo "  add: Agregar una nueva tarea\n";
  echo "  list: Listar todas las tareas del usuario\n";
  echo "  complete: Marcar una tarea como completada\n";
  echo "  delete: Eliminar una tarea\n";
  exit(1);
}

$conn = getOpenCon();
$user = login($conn);
$userId = $argv[1];
$command = $argv[2];

switch ($command) {
  case 'add':
    if ($argc <= 4) {
      echo "Sintaxis incorrecta. Uso: php main.php [id_usuario] add [título] [descripción]\n";
      exit(1);
    }
    $titulo = $argv[3];
    $desc = $argv[4];
    echo insertarTarea($conn, $user, $titulo, $desc);
    echo "\n";
    break;
  case 'list':
    mostrarTareas($conn, $user);
    echo "\n";
    break;
  case 'complete':
    if ($argc < 4) {
      echo "Sintaxis incorrecta. Uso: php main.php [id_usuario] complete [identificador]\n";
      exit(1);
    }
    $tarea = $argv[3];
    echo completaTarea($conn, $user, $tarea);
    echo "\n";
    break;
  case 'delete':
    if ($argc < 4) {
      echo "Sintaxis incorrecta. Uso: php main.php [id_usuario] delete [identificador]\n";
      exit(1);
    }
    $tarea = $argv[3];
    echo borrarTarea($conn, $user, $tarea);
    echo "\n";
    break;
  default:
    echo "Comando desconocido: $command\n";
    echo "Comandos conocidos:\n";
    echo "  add: Agregar una nueva tarea\n";
    echo "  list: Listar todas las tareas del usuario\n";
    echo "  complete: Marcar una tarea como completada\n";
    echo "  delete: Eliminar una tarea\n";
    break;
}

$conn->close();
