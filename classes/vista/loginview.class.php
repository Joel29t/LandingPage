<?php


class LoginView
{
    public static function showLoginForm($data=null, $errors=null)
    {
  
        echo "<!DOCTYPE html>";
        include 'templates/head.tmp.php';
        include 'templates/header.tmp.php';
        include 'templates/loginformbody.tmp.php';
        echo "</html>";
    }
}
