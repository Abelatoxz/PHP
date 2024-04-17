<?php
use Symfony\Component\Yaml\Yaml;
require __DIR__ . '/vendor/autoload.php';
$value = Yaml::parseFile('./conf.yaml');
print_r ($value);
?>

