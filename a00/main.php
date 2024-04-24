<?php
include './repositorio-sql.php';
if (PHP_SAPI != 'cli') {
  echo "Este script debe ejecutarse desde la línea de comandos (CLI).";
  exit(1);
}

$conn = getOpenCon();
var_dump($user = login($conn));

$n2 = true;
while ($n2) {
  //echo chr(27) . chr(91) . 'H' . chr(27) . chr(91) . 'J';
  echo "Opción 0: Salir del Task-Management\n";
  echo "Opción 1: Insertar Tarea\n";
  echo "Opción 2: Ver Tareas\n";
  echo "Opción 3: Borrar Tarea\n";
  echo "Opción 4: Marcar Tarea como Completada\n";
  $n1 = readline("¿Qué quieres hacer?\n");
  switch ($n1) {
    case '0':
      $n2 = false;
      break;
    case '1':
      $titulo = readline("Titulo de la tarea: ");
      $desc = readline("Descripcion de la tarea: ");
      $msg = insertarTarea($conn, $user, $titulo, $desc);
      echo $msg;
      break;
    case '2':
      mostrarTareas($conn, $user);
      sleep(5);
      break;
    case '3':
      $id_tarea = readline("Id de la tarea: ");
      borrarTarea($conn, $user, $id_tarea);
      break;
    case '4':
      $id_tarea = readline("Id de la tarea: ");
      completaTarea($conn, $user, $id_tarea);
      break;
    default:
      $n2 = false;
      break;
  }
}
