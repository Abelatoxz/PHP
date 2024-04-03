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


$options = getopt("it:d:mcn:bn:cn:h");

if (isset($options['h'])) {
  print("php index.php -m = muestra la tarea \nphp index.php -i = opcion de incertar -t = titulo -d = descripcion \nphp index.php -c = completa -n = El numero de la tarea \nphp index.php -b = borrar -n = El numero de la tarea");
}
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
  $mensaje =  borrar($conn,$id,$tarea);
  echo $mensaje;
}
?>

