<?php
include './.config.php';

function getOpenCon()
{
  return OpenCon();
}

function login($conn, $name, $pass)
{
  if ($name == "" || $pass == "") {
    return "Usuario o contraseña vacíos";
  } else {
    $sql = "SELECT * FROM users WHERE name = :name";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($pass, $user['password'])) {
      return $user;
    } else {
      return "Contraseña inválida o usuario inválido";
    }
  }
}

function mostrarTareas($conn, $user)
{
  $Tareas = [];
  $id_user = $user['id_user'];
  $sql = "SELECT * FROM tasks WHERE user_id = :id_user";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id_user', $id_user);
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $Tareas[] = array('ID' => $row['task_id'], 'Titulo' => $row['task_name'], 'Descripcion' => $row['description'], 'Estado' => $row['status']);
  }
  return $Tareas;
}

function insertarTarea($conn, $user, $titulo, $desc)
{
  $id_user = $user['id_user'];
  $sql = "INSERT INTO tasks (task_name, description, user_id) VALUES (:titulo, :desc, :id_user)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':titulo', $titulo);
  $stmt->bindParam(':desc', $desc);
  $stmt->bindParam(':id_user', $id_user);
  if ($stmt->execute()) {
    $msg = "Tarea insertada con éxito. ";
  } else {
    $msg = "No se pudo insertar la tarea.";
  }
  return $msg;
}

function completaTarea($conn, $user, $tarea)
{
  $id_user = $user['id_user'];
  $sql = "UPDATE tasks SET status = 'completed' WHERE task_id = :tarea AND user_id = :id_user";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':tarea', $tarea);
  $stmt->bindParam(':id_user', $id_user);
  if ($stmt->execute()) {
    $msg = "La tarea se marcó como completada. ";
  } else {
    $msg = "Error al completar la tarea, contacte con su administrador";
  }
  return $msg;
}

function borrarTarea($conn, $user, $tarea)
{
  $id = $user['id_user'];
  $sql = "DELETE FROM tasks WHERE user_id = :id AND task_id = :tarea";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->bindParam(':tarea', $tarea);
  if ($stmt->execute()) {
    $msg = "Tarea borrada con éxito.";
  } else {
    $msg = "No se pudo borrar la tarea.";
  }
  return $msg;
}
function crearUsuario($conn, $name, $surname, $email, $password)
{
  // Verificar que los campos no estén vacíos
  if ($name == "" || $surname == "" || $email == "" || $password == "") {
    return "Todos los campos son obligatorios.";
  }

  // Verificar si el usuario ya existe
  $sql = "SELECT COUNT(*) AS count FROM users WHERE email = :email";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($result['count'] > 0) {
    return "El correo electrónico ya está registrado.";
  }

  // Hash de la contraseña
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Insertar el nuevo usuario en la base de datos
  $sql = "INSERT INTO users (name, surname1, email, password) VALUES (:name, :surname, :email, :password)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':surname', $surname);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':password', $hashedPassword);
  if ($stmt->execute()) {
    return "Usuario creado con éxito.";
  } else {
    return "Error al crear el usuario.";
  }
}
