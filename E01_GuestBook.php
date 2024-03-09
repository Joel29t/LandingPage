<?php

include 'classes/GuestBook.php';

$guestBook = new GuestBook();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    $data = [];
    
    if (isset($_POST['name'])) {
        $name = sanitizeInput($_POST['name']);
        if (empty($name) || !preg_match("/^([A-Za-zÑñáéíóú\s-]{3,80})$/u", $name) || preg_match("/\d/", $name)) {
            $errors['name'] = "El campo Nombre y Apellidos es obligatorio y puede contener letras, espacios y guiones, con una longitud entre 3 y 80 caracteres.";
        } else {
            $data['name'] = $name;
        }
    }
    
    if (isset($_POST['email'])) {
        $email = sanitizeInput($_POST['email']);
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "El campo Email es obligatorio y debe ser una dirección de correo válida.";
        } else {
            $domain = substr(strrchr($email, "@"), 1);
            if (!checkdnsrr($domain, "MX")) {
                $errors['email_domain'] = "El dominio del correo electrónico no es válido.";
            } else {
                $data['email'] = $email;
            }
        }
    }
    
    if (isset($_POST['message'])) {
        $message = sanitizeInput($_POST['message']);
        $respuestasValidas = ['excelente', 'muy_bueno', 'bueno', 'regular', 'malo'];
        if (empty($message) || !in_array($message, $respuestasValidas)) {
            $errors['message'] = "Selecciona una opción válida para el campo Mensaje.";
        } else {
            $data['message'] = $message;
        }
    }
    
    if (empty($errors)) {
        $guestBook->createEntry($data['name'], $data['email'], $data['message'], date('Y-m-d H:i:s'));
    }
}

function sanitizeInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}

?>

<!DOCTYPE html>
<?php include 'templates/head.tmp.php';?>
<html lang="en">
<?php include 'templates/header.tmp.php';?>
<?php include 'templates/guestBookBody.tmp.php';?>
</html>
