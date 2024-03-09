<?php

class HomeView
{

    public static function show()
    {
        $idiomaController = new IdiomaController();
        
        $idioma = $idiomaController->index($_GET['Home/show/lang']);
         echo "<!DOCTYPE html>";
        include 'templates/head.tmp.php';
        include 'templates/header.tmp.php';
        include 'templates/body.tmp.php';
        echo "</html>";
    }
}
