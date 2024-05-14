<?php
include './repositorio-sql.php';
$conn = getOpenCon();
$funciones = new Funciones($conn);
function mostrarMenu()
{
  echo "Menu:\n";
  echo "1. Mostrar tareas\n";
  echo "2. Insertar nueva tarea\n";
  echo "3. Completar tarea\n";
  echo "4. Borrar tarea\n";
  echo "5. Salir \n";
  echo "Seleccione una opcion: ";
}

echo "Ingresar nombre de usuario: ";
$nombreUsuario = trim(fgets(STDIN));
echo "Ingresar su contraseña: ";
$pass = trim(fgets(STDIN));
$usuario = $funciones->login($conn, $nombreUsuario, $pass);

if (is_string($usuario)) {
  echo $usuario . "\n";
  return false;
}
var_dump($usuario);

echo $usuario['name'] . "\n";
$flag = true;
while ($flag) {
  $opcion = trim(fgets(STDIN));
  switch ($opcion) {
    case 'list':
      $funciones->mostrarTareas($conn, $usuario);
      break;

    default:
      # code...
      break;
  }
}
