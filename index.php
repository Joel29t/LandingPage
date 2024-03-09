<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include 'classes/config/Autoloader.php';
spl_autoload_register("Autoloader::load");
spl_autoload_register("Autoloader::newload");


try {  
    $cFront = new FrontController(); 
    $cFront->dispatch();
    
} catch (Exception $e) {
    $vError = new ErrorView();
    $vError->show($e);
}