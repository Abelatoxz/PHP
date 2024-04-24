<?php
include './repositorio-sql.php';
if (PHP_SAPI != 'cli') {
  echo "Este script debe ejecutarse desde la línea de comandos (CLI).";
  return false;
}

$conn = getOpenCon();
$name = readline("Dime el usuario: ");
$pass = readline("Dime la password: ");
$user = login($conn, $name, $pass);
if (is_string($user)) {
  echo $user, "\n";
  return false;
}
$flag = true;
while ($flag) {
  echo chr(27) . chr(91) . 'H' . chr(27) . chr(91) . 'J';
  echo "\nOpción 0: Salir del Task-Management\n";
  echo "Opción 1: Insertar Tarea\n";
  echo "Opción 2: Ver Tareas\n";
  echo "Opción 3: Borrar Tarea\n";
  echo "Opción 4: Marcar Tarea como Completada\n";
  $n1 = readline("¿Qué quieres hacer?\n");
  switch ($n1) {
    case '0':
      $flag = false;
      break;
    case '1':
      $titulo = readline("Titulo de la tarea: ");
      $desc = readline("Descripcion de la tarea: ");
      $msg = insertarTarea($conn, $user, $titulo, $desc);
      echo $msg;
      sleep(5);
      break;
    case '2':
      mostrarTareas($conn, $user);
      sleep(5);
      break;
    case '3':
      $id_tarea = readline("Id de la tarea: ");
      if (intval($id_tarea)) {
        borrarTarea($conn, $user, $id_tarea);
      } else {
        echo "No se puede usar letras, solo enteros\n";
      }
      sleep(5);
      break;
    case '4':
      $id_tarea = readline("Id de la tarea: ");
      if (intval($id_tarea)) {
        completaTarea($conn, $user, $id_tarea);
      } else {
        echo "No se puede usar letras, solo enteros\n";
        sleep(5);
      }
      break;
    default:
      $n2 = false;
      echo "Saliendo.... ";
      break;
  }
}
