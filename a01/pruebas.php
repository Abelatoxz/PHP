<?php
# code..0
$si = getopt('p:o');
$command = $si['p'];
print_r($si);
switch ($command) {
  case 'hola':
    echo "Hola";
    break;
}
