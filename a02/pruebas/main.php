<?php
// Nombre del archivo
//
$nombreArchivo = ".pruebas.php";
$host = "192.168.1.136";
$usuario = "taskmanager";
$taskdb = "Base de datos";
$password = "Contraseña";
// El texto que deseas insertar en el archivo
$funcionOpenConSql = "
<?php\n
function OpenConSql()
{
  \$dsn = 'mysql:dbname=$taskdb;host=$host';
  \$usuario = '$usuario';
  \$contraseña = '$password';

  try {
    return new PDO(\$dsn, \$usuario, \$contraseña);
  } catch (PDOException \$e) {
    // Habilitar excepciones de PD0
    echo 'Error al conectarse: ' . \$e->getMessage();
  }
}
";
// Abrir el archivo para escritura (w) o para añadir al final del archivo (a)
$archivo = fopen($nombreArchivo, "w"); // Usa "w" para sobrescribir el archivo o "a" para añadir al final

// Verificar si el archivo se abrió correctamente

// Escribir el texto en el archivo
fwrite($archivo, $funcionOpenConSql);

// Cerrar el archivo
fclose($archivo);

echo "El texto se ha escrito en el archivo correctamente.";
