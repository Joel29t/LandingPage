<?php

class RegistrationView
{
    public static function showRegistrationForm($data=null, $errors=null)
    {

        echo "<!DOCTYPE html>";
        include 'templates/head.tmp.php';
        include 'templates/header.tmp.php';
        include 'templates/registerformbody.tmp.php';
        echo "</html>";
    }
}