<?php
// Register the autoloader
spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

session_start();

// Parse the query string for command
$command = "login";
if (isset($_GET["command"])) {
    $command = $_GET["command"];
}

// Instantiate the controller and run
$controller = new OutfitController($command);
$controller->run();