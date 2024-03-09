<?php

class EmailverificationView
{

    public static function showEmailverification($lastId)
    {
        echo "<!DOCTYPE html>";
        include 'templates/head.tmp.php';
        include 'templates/header.tmp.php';
        include 'templates/emailverificationbody.tmp.php';
        echo "</html>";
    }
}
