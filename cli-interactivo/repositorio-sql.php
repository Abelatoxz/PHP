<?php
function borrar($conn,$user){

$id = $user['id_user'];
$sql = "SELECT * from tasks where user_id = '$id'";
$val = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_assoc($val)) {
  echo $row['task_id'] . $row['task_name'] . "\n";
}

$tarea = readline("Cual quieres borrar?");
$sql = "DELETE from tasks where user_id ='$id' and task_id = '$tarea' ";
if (mysqli_query($conn,$sql)) {
  echo "Borrado con exito";
}else {
  echo "No se borro";
}
}
//--------------------------------------------------------------------------------
function OpenCon() {
  $host = "127.0.0.1";
  $user = "taskmanager";
  $pass = "password";
  $db = "taskdb";
  $conn = new mysqli($host,$user,$pass,$db);
  return $conn;
}
//--------------------------------------------------------------------------------
function insertar($conn,$user){
  $id = $user['id_user'];
  $titulo = readline("Dime el titulo de la tarea");
  $desc = readline("Dime la descripcion de la tarea");
  $sql = "insert into tasks(task_name,description,user_id) VALUES('$titulo','$desc','$id')";
  if (mysqli_query($conn,$sql)) {
    echo "Conseguiste implementar la tarea";
  }else {
    echo "Fallo";
  }
}





function login($conn){
    $name = readline("Dime tu usuario: ");
    $pass = readline("Dame tu contraseña: ");
    
    if ($name == "" || $pass == "") {
        $msg = "Los campos están vacíos. Por favor, vuelve a intentarlo.";
        echo $msg;
        return; 
    }
    $sql = "SELECT * FROM users WHERE name = '$name'";
    $query = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($pass, $user['password'])) {
        return $user;
    } else {
      return Null;
    }
}



function mostrar($conn,$login){

  echo "\n",$login['name'];
  $so = $login['id_user'];
  $sql = "SELECT * FROM tasks where user_id = '$so'";
  $val = mysqli_query($conn,$sql);
  while ($row = mysqli_fetch_assoc($val)) {
    foreach ($row as $key => $value) {
      echo $key . $value . "\n";
    }
    echo "---------------------------------------\n";
  }
}


function completa($conn,$user){

$id = $user['id_user'];
$sql = "SELECT * FROM tasks";
$val = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_assoc($val)) {
  echo "ID: " . $row['task_id'] . "Titulo: " . $row['task_name'] . "Estado: ". $row['status'] ."\n";
  # code...
}


$n1 = readline("Que quieres modificar?");
 



$sql = "UPDATE tasks set status = 'completed' where task_id = '$n1' and user_id = '$id'";
  if (mysqli_query($conn,$sql)) {
    echo "Se cambio";
}else {
  echo "Error";
}
}
?>
