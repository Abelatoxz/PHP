<?php
function borrar($conn,$id,$tarea){
$idc = intval($tarea);
$sql = "DELETE from tasks where user_id ='$id' and task_id = '$idc' ";
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
function insertar($conn,$id,$titulo,$desc){
  $sql = "insert into tasks(task_name,description,user_id) VALUES('$titulo','$desc','$id')";
  if (mysqli_query($conn,$sql)) {
    return null;
  }else {
    return null;
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



function mostrar($conn,$so){

  $sql = "SELECT * FROM tasks where user_id = '$so'";
  $val = mysqli_query($conn,$sql);
  while ($row = mysqli_fetch_assoc($val)) {
    foreach ($row as $key => $value) {
      echo $key . $value . "\n";
    }
    echo "---------------------------------------\n";
  }
}


function completa($conn,$id,$n1){
$sql = "UPDATE tasks set status = 'completed' where task_id = '$n1' and user_id = '$id'";
if (mysqli_query($conn,$sql)) {
  $lenguaje = "Se completo la tarea";
  return $lenguaje;
}else {
  echo "Fallo";
}
}
?>
