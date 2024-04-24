<?php
include './repositorio-sql.php';
$conn = OpenCon();
$user = readline("Dime un nombre:");
$surname = readline("Dime tu apellido:");
$email = readline("Dime tu correo:");
$pass = readline("Dime la contraseña:");
$hash = password_hash($pass, PASSWORD_DEFAULT);
$sql = "INSERT INTO users (name,surname1,email,password) VALUES('$user','$surname','$email','$hash')";
if (mysqli_query($conn, $sql)) {
  echo "Has creado un usuario";
} else {
  echo "No se creo un usuario";
}
