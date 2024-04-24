<?php
include './repositorio-sql.php';

if (PHP_SAPI != 'cli') {
  echo "Este script debe ejecutarse desde la línea de comandos (CLI).";
  exit(1);
}

$baseDeDatos = new interacionBD();

$user = $baseDeDatos->login();

switch (gettype($user)) {
  case 'array':
    // Si el usuario es un array, el inicio de sesión fue exitoso
    echo "Bienvenido, " . $user['name'] . "!\n";

    // Mostrar tareas
    echo "\n--- Mostrando tareas ---\n";
    $baseDeDatos->mostrarTareas($user);

    // Insertar tarea
    echo "\n--- Insertar tarea ---\n";
    $titulo = readline("Ingrese el título de la tarea: ");
    $desc = readline("Ingrese la descripción de la tarea: ");
    $mensaje = $baseDeDatos->insertarTarea($user, $titulo, $desc);
    echo $mensaje . "\n";

    // Completar tarea
    echo "\n--- Completar tarea ---\n";
    $tareaId = readline("Ingrese el ID de la tarea a completar: ");
    $mensaje = $baseDeDatos->completaTarea($user, $tareaId);
    echo $mensaje . "\n";

    // Borrar tarea
    echo "\n--- Borrar tarea ---\n";
    $tareaId = readline("Ingrese el ID de la tarea a borrar: ");
    //$mensaje = $baseDeDatos->($user, $tareaId);
    echo $mensaje . "\n";

    break;

  case 'string':
    // Si el usuario no es un array, hubo un error al iniciar sesión
    echo $user . "\n";
    break;

  default:
    // Hubo un error inesperado
    echo "Error desconocido.\n";
    break;
}
