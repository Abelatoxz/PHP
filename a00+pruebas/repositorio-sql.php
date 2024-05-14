<?php
include './.config.php';
function getOpenCon()
{
  $conn = OpenCon();
  return $conn;
}

class Funciones
{
  public $conn;
  public function __constructor($conn)
  {
    $this->$conn = $conn;
  }
  //Funcion de login preparada anti sqlInjection
  function login($conn, $name, $pass)
  {
    if ($name == "" || $pass == "") {
      $user =  "Usuario o contraseña vacios";
    } else {
      $sql = "SELECT * FROM users WHERE name = '$name'";
      $query = mysqli_query($conn, $sql);
      $user = mysqli_fetch_assoc($query);
      if ($user && password_verify($pass, $user['password'])) {
        $user = $user;
      } else {
        $user = "Contraseña invalida o usuario invalidos";
      }
    }
    return $user;
  }

  //Funcion para mostrar tareas
  function mostrarTareas($conn, $user)
  {
    echo "\nUsuario: ", $user['name'];
    $id_user = $user['id_user'];
    $sql = "SELECT * FROM tasks WHERE user_id = '$id_user'";
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
      echo "\nID: ", $row['task_id'], " - Título: ", $row['task_name'], " - Descripcion: ", $row['description'], " - Estado: ", $row['status'];
    }
  }
  //Funcion para borrar tareas
  function insertarTarea($conn, $user, $titulo, $desc)
  {
    $id_user = $user['id_user'];
    $sql = "INSERT INTO tasks (task_name, description, user_id) VALUES ('$titulo','$desc','$id_user')";
    if (mysqli_query($conn, $sql)) {
      $msg = "Tarea insertada con exito. ";
    } else {
      $msg = "No se pudo insertar la tarea.";
    }
    return $msg;
  }
  //Funcion para completar la tarea
  function completaTarea($conn, $user, $tarea)
  {
    $id_user = $user['id_user'];
    $sql = "UPDATE tasks SET status = 'completed' WHERE task_id = '$tarea' AND user_id = '$id_user'";
    if (mysqli_query($conn, $sql)) {
      $msg = "La tarea se marcó como completada. ";
    } else {
      $msg = "Error al completar la tarea, contacte con su administrador";
    }
    return $msg;
  }
  //funcion borrar la tarea
  function borrarTarea($conn, $user, $tarea)
  {
    $id = $user['id_user'];
    $sql = "DELETE FROM tasks WHERE user_id ='$id' AND task_id = '$tarea'";
    if (mysqli_query($conn, $sql)) {
      $msg = "Tarea borrada con éxito.";
    } else {
      $msg = "No se pudo borrar la tarea.";
    }
    return $msg;
  }
}
