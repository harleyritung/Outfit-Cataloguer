<?php
define ('SITE_ROOT', realpath(dirname(__FILE__)));

$file = SITE_ROOT . '/images/phpddAWov';
$type = 'image/jpeg';
header('Content-Type:' .$type);
header('Content-Length: ' . filesize($file));
readfile($file);
// $img = file_get_contents($file);
// echo "<img src='$img' >";