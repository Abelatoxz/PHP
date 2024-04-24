<?php
include './repositorio-sql.php';
$conn = OpenCon();

var_dump($user = login($conn));
if ($user == Null) {
  return False;
  echo "Fallo";
}
$n2 = true;
while ($n2) {
  echo chr(27) . chr(91) . 'H' . chr(27) . chr(91) . 'J';
  echo "Opcion 0: Salir del Task-Management\n";
  echo "Opcion 1: Insertar Tarea\n";
  echo "Opcion 2: Mirar Tarea   \n";
  echo "Opcion 3: Borrar Tarea  \n";
  echo "Opcion 4: Cambiar tarea a completado  \n";
  $n1 = readline("Que quieres hacer: \n");
  switch ($n1) {
    case '0':
      $n2 = false;
      break;
    case '1':
      insertar($conn, $user);
      break;
    case '2':
      mostrar($conn, $user);
      sleep(5);
      break;
    case '3':
      borrar($conn, $user);
      break;
    case '4':
      completa($conn, $user);
      break;
    default:
      $n2 = false;
      break;
  }
}
