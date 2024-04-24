<?php
function OpenCon()
{
  $host = "127.0.0.1";
  $user = "taskmanager";
  $pass = "password";
  $db = "taskdb";
  $conn = new mysqli($host, $user, $pass, $db);
  if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
  }
  return $conn;
}
