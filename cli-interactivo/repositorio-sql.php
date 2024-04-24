<?php
function borrar($conn, $user)
{
  $id = $user['id_user'];
  $sql = "SELECT * FROM tasks WHERE user_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
    echo $row['task_id'] . " " . $row['task_name'] . "\n";
  }
  $tarea = readline("Cual quieres borrar?");
  $sql = "DELETE FROM tasks WHERE user_id = ? AND task_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $id, $tarea);
  if ($stmt->execute()) {
    echo "Borrado con éxito\n";
  } else {
    echo "No se borró\n";
  }
}

function OpenCon()
{
  $host = "127.0.0.1";
  $user = "taskmanager";
  $pass = "password";
  $db = "taskdb";
  $conn = new mysqli($host, $user, $pass, $db);

  // Verificar la conexión
  if ($conn->connect_error) {
    die("Falló la conexión a la base de datos: " . $conn->connect_error);
  }
  return $conn;
}

function insertar($conn, $user)
{
  $id = $user['id_user'];
  $titulo = readline("Dime el título de la tarea: ");
  $desc = readline("Dime la descripción de la tarea: ");
  $sql = "INSERT INTO tasks (task_name, description, user_id) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssi", $titulo, $desc, $id);
  if ($stmt->execute()) {
    echo "Conseguiste implementar la tarea\n";
  } else {
    echo "Fallo al implementar la tarea\n";
  }
}

function login($conn)
{
  $name = readline("Dime tu usuario: ");
  $pass = readline("Dame tu contraseña: ");

  if ($name == "" || $pass == "") {
    $msg = "Los campos están vacíos. Por favor, vuelve a intentarlo.\n";
    echo $msg;
    return null;
  }
  $sql = "SELECT * FROM users WHERE name = ? AND enable = 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $name);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($pass, $user['password'])) {
    return $user;
  } else {
    return null;
  }
}

function mostrar($conn, $id)
{
  $sql = "SELECT * FROM tasks WHERE user_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "ID: " . $row['task_id'] . "\n";
      echo "Titulo: " . $row['task_name'] . "\n";
      echo "Descripción: " . $row['description'] . "\n";
      echo "---------------------------------------\n";
    }
  } else {
    echo "No hay tareas para mostrar\n";
  }
}

function completa($conn, $id)
{
  mostrar($conn, $id);
  $n1 = readline("¿Qué tarea quieres marcar como completada? ");
  $sql = "UPDATE tasks SET status = 'completed' WHERE task_id = ? AND user_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $n1, $id);
  if ($stmt->execute()) {
    echo "Se completó la tarea\n";
  } else {
    echo "Error al completar la tarea\n";
  }
}

