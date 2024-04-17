<?php
use Symfony\Component\Yaml\Yaml;
require __DIR__ . '/vendor/autoload.php';
$value = Yaml::parseFile('./conf.yaml');
foreach ($value as $key => $value) {
  echo $value;
}
?>

