<?php
// Verifica si se pasaron argumentos desde la línea de comandos
if ($argc > 1) {
  echo "Número de argumentos pasados: " . $argc . "\n";

  // Imprime todos los argumentos pasados
  echo "Argumentos pasados:\n";
  for ($i = 0; $i < $argc; $i++) {
    echo $i . ": " . $argv[$i] . "\n";
  }
} else {
  echo "No se pasaron argumentos desde la línea de comandos.\n";
}
