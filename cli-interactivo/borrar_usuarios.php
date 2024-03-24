<?php
include './database.php';
$conn = OpenCon();
$user = readline("Dime el usuario que quieres borrar");
$sure = readline("Seguro que quieres borrarlo?");
$sql = "DELETE FROM users where  name = '$user'";
if ($sure = "Si") {
  if (mysqli_query($conn,$sql)) {
    echo "Se borro correctamente";
  }else {
    echo "No se borro";
  }
}


?>
