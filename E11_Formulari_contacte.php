<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = array();
    $data = array();

    if (isset($_POST['name'])) {
        $name = sanitizeInput($_POST['name']);
        if (empty($name) || ! preg_match("/^([A-Za-zÑñáéíóú\s-]{3,80})$/u", $name) || preg_match("/\d/", $name)) {
            $errors['name'] = "El campo Nombre y Apellidos es obligatorio y puede contener letras, espacios y guiones, con una longitud entre 3 y 80 caracteres.";
        } else {
            $data['name'] = $name;
        }
    }

    if (isset($_POST['email'])) {
        $email = sanitizeInput($_POST['email']);
        if (empty($email) || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "El campo Email es obligatorio y debe ser una dirección de correo válida.";
        } else {
            $domain = substr(strrchr($email, "@"), 1);
            if (! checkdnsrr($domain, "MX")) {
                $errors['email_domain'] = "El dominio del correo electrónico no es válido.";
            } else {
                $data['email'] = $email;
            }
        }
    }

    if (isset($_POST['message'])) {
        $message = sanitizeInput($_POST['message']);
        if (empty($message) || ! preg_match("/^[\p{L}\d\s.,!?-]{4,500}$/u", $message)) {
            $errors['message'] = "El campo Mensaje es obligatorio y puede contener letras, dígitos, espacios, comas, puntos, signos de exclamación, signos de interrogación y guiones, con una longitud entre 4 y 500 caracteres.";
        } else {
            $data['message'] = $message;
        }
    }

 
    if (empty($errors)) {
        $contactXml = sprintf('<contact><name>%s</name><email>%s</email><message>%s</message><date>%s</date></contact>', $data['name'], $data['email'], $data['message'], date('Y-m-d H:i:s'));

    
        $existingXml = file_get_contents('docs/contact_info.xml');
        if (empty($existingXml)) {
            $existingXml = '<contactos></contactos>';
        }

       
        $xml = substr($existingXml, 0, - 12) . $contactXml . '</contactos>';
       
        file_put_contents('docs/contact_info.xml', $xml);

        $guardados = "Datos guardados correctamente en contact_info.xml.";
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
<?php include 'templates/formulariBody.tmp.php';?>
</html>
