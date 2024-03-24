<?php
include './repositorio-sql.php';

$file = 'datos_usuario.txt';


$json = file_get_contents($file);


$conn = OpenCon();
if ($json == null) {
    $user = login($conn);

    
    if ($user == "") {
        echo "No hay datos de usuario disponibles";
        return false;
    }

    
    $datos_usuario_json = json_encode($user);
    file_put_contents($file, $datos_usuario_json);
}


$usuario = json_decode($json, true);


$id = $usuario['id_user'];


$options = getopt("it:d:mcn:bn:cn:");


if (isset($options['i'], $options['t'], $options['d'])) {
    $titulo = $options['t'];
    $desc = $options['d'];
    insertar($conn, $id, $titulo, $desc);
} 
    
if (isset($options['m'])){
  mostrar($conn,$id);
}
if (isset($options['c'])) {
  $n1 = $options['n'];
  completa($conn,$id,$n1);
}
if (isset($options['b'])) {
  $tarea = $options['n'];
  borrar($conn,$id,$tarea);
}
if (isset($options['c']))
  $id = $options['n'];
  completa($conn,$id,$id)
?>

