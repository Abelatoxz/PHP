<?php
$options = getopt("abc:d:");

if (empty($options)) {
    // No se proporcionaron opciones válidas
    echo "Error: No se proporcionaron opciones válidas. Uso: php script.php -a -b -c valor -d valor\n";
    exit(1);
}

foreach ($options as $option => $value) {
    switch ($option) {
        case 'a':
            echo "Opción 'a' está presente\n";
            break;
        case 'b':
            echo "Opción 'b' está presente\n";
            break;
        case 'c':
            echo "Opción 'c' está presente con el valor: $value\n";
            break;
        case 'd':
            echo "Opción 'd' está presente con el valor: $value\n";
            break;
        default:
            echo "Opción no reconocida: $option\n";
            break;
    }
}
?>

