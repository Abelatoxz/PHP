<?php
include './config.php';

class interacionBD
{
  private $conn;

  function __construct()
  {
    $this->conn = OpenCon();
  }

  function getOpenCon()
  {
    return $this->conn;
  }

  //Funcion de login preparada anti sqlInjection
  function login()
  {
    $name = readline("Dime tu usuario: ");
    $pass = readline("Dame tu contraseña: ");

    if ($name == "" || $pass == "") {
      $msg = "Los campos están vacíos.";
      return $msg;
    }

    $sql = "SELECT * FROM users WHERE name = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result && password_verify($pass, $result['password'])) {
      return $result;
    } else {
      return "Contraseña inválida o usuario inválido";
    }
  }

  //Funcion para mostrar tareas
  function mostrarTareas($user)
  {
    echo "\nUsuario: ", $user['name'];
    $id_user = $user['id_user'];
    $sql = "SELECT * FROM tasks WHERE user_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
      echo "\nID: ", $row['task_id'], " - Título: ", $row['task_name'], " - Estado: ", $row['status'];
    }
  }

  //Funcion para insertar tarea
  function insertarTarea($user, $titulo, $desc)
  {
    $id_user = $user['id_user'];
    $sql = "INSERT into tasks (task_name, description, user_id) VALUES (?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ssi", $titulo, $desc, $id_user);

    if ($stmt->execute()) {
      $msg = "Tarea insertada con éxito. ";
    } else {
      $msg = "No se pudo insertar la tarea.";
    }
    return $msg;
  }

  //Funcion para completar tarea
  function completaTarea($user, $tarea)
  {
    $id_user = $user['id_user'];
    $sql = "UPDATE tasks SET status = 'completed' WHERE task_id = ? AND user_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $tarea, $id_user);

    if ($stmt->execute()) {
      $msg = "La tarea se marcó como completada. ";
    } else {
      $msg = "Error al completar la tarea, contacte con su administrador";
    }
    return $msg;
  }
  public function FunctionName(Type $var = null)
  {
    # code...
  }
}
