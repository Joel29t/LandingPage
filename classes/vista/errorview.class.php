<?php

class ErrorView
{

      public function show(Exception $e)
    {
      
        $titol = "Hi ha hagut un error";
        $missatge = $e->getMessage();

        echo "<!DOCTYPE html><html lang=\"en\">";
        include "templates/head.tmp.php";
        echo "<body>";
        include "templates/header.tmp.php";

        include "templates/info_error.tmp.php";

        echo "</body></html>";
    }
}
