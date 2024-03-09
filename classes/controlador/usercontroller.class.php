<?php

class UserController extends Controlador
{

    public function showLoginForm()
    {
                LoginView::showLoginForm();
    }

    public function showRegistrationForm()
    {
        RegistrationView::showRegistrationForm();
    }

    public function register()
    {
               $errors = array();
        $data = array();

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['Registrar'])) {
            $email = $this->sanitizeInput($_POST['email']);
            $password = $this->sanitizeInput($_POST['password']);
            $tipusIdent = $this->sanitizeInput($_POST['tipusIdent']);
            $numeroIdent = $this->sanitizeInput($_POST['numeroIdent']);
            $nom = $this->sanitizeInput($_POST['nombre']);
            $cognoms = $this->sanitizeInput($_POST['apellidos']);
            $sexe = $this->sanitizeInput($_POST['sexo']);
            $naixement = $this->sanitizeInput($_POST['fecha_nacimiento']);
            $adreca = $this->sanitizeInput($_POST['direccion']);
            $codiPostal = $this->sanitizeInput($_POST['codigo_postal']);
            $poblacio = $this->sanitizeInput($_POST['poblacion']);
            $provincia = $this->sanitizeInput($_POST['provincia']);
            $telefon = $this->sanitizeInput($_POST['telefono']);

            $errors['email'] = $this->validateEmail($email, $data);
            $errors['password'] = $this->validatePassword($password, "password", 6, 20, $data);
            $errors['tipusIdent'] = $this->validateText($tipusIdent, "tipusIdent", 3, 4, $data);
            $errors['numeroIdent'] = $this->validateNumeroIdent($numeroIdent, "numeroIdent", 1, 20, $data);
            $errors['nom'] = $this->validateText($nom, "nom", 3, 80, $data);
            $errors['cognoms'] = $this->validateText($cognoms, "cognoms", 3, 80, $data);
            $errors['sexe'] = $this->validateText($sexe, "sexe", 1, 5, $data);
            $errors['naixement'] = $this->validateNaixement($naixement, "naixement", $data);
            $errors['adreca'] = $this->validateText($adreca, "adreca", 0, 255, $data);
            $errors['codigo_postal'] = $this->validateCodigoPostal($codiPostal, $data);
            $errors['poblacio'] = $this->validateText($poblacio, "poblacio", 0, 80, $data);
            $errors['provincia'] = $this->validateProvincia($provincia, $data);
            $errors['telefon'] = $this->validatePhoneNumber($telefon, "telefon", $data);

            if (empty(array_filter($errors, function ($value) {
                return $value !== null;
            }))) {
                $this->validateImageFile($_FILES, $errors);
                if (! empty($errors['imagen'])) {
                    RegistrationView::showRegistrationForm($data, $errors);
                } else {
                    $horaEnMs = round(microtime(true) * 1000);

                    $imatge = "img/{$horaEnMs}.png";

                    $status = 0;

                    $userAgent = $_SERVER['HTTP_USER_AGENT'];

                    if (preg_match('/\((.*?)\)/', $userAgent, $matches)) {
                        $browserInfo = explode(';', $matches[1]);
                        $plataforma = isset($browserInfo[1]) ? trim($browserInfo[1]) : 'Desconocido';
                    } else {
                        $plataforma = 'Desconocido';
                    }
                    
                    $browserPattern = '/(?:Chrome|Firefox|Safari|Edge|Opera)\/([0-9.]+)/i';
                    
                    if (preg_match($browserPattern, $userAgent, $browserMatches)) {
                        $navegador = $browserMatches[0];
                    } else {
                        $navegador = 'Desconocido';
                    }
                    
                    
                    $rutaImagenGuardada = __DIR__ . "/../../{$imatge}";

                    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaImagenGuardada)) {

                        $user = new User($data['email'], $data['password'], $data['tipusIdent'], $data['numeroIdent'], $data['nom'], $data['cognoms'], $data['sexe'], $data['naixement'], $data['adreca'], $data['codigo_postal'], $data['poblacio'], $data['provincia'], $data['telefon'], $horaEnMs, $status, $navegador, $plataforma);
                        $userModel = new UserModel();
                        $lastId = $userModel->create($user);

                        if (! $lastId) {
                            $errors['email'] = "El correo electrónico ya existe. Por favor, use otro correo electrónico.";
                             RegistrationView::showRegistrationForm($data, $errors);
                        } else {
                            EmailVerificationController::showEmailVerification($lastId);
                        }
                    } else {
                        throw new Exception("Error al guardar la imagen. Error: " . $_FILES["imagen"]["error"]);
                    }
                }
            } else {
                RegistrationView::showRegistrationForm($data, $errors);
            }
        }
    }

    public function login()
    {
               if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $errors = array();
            $data = array();

            $email = $this->sanitizeInput($_POST['username']);
            $password = $this->sanitizeInput($_POST['password']);

            $errors['email'] = $this->validateEmail($email, $data);
            $errors['password'] = $this->validatePassword($password, "password", 6, 20, $data);

            if (empty(array_filter($errors, function ($value) {
                return $value !== null;
            }))) {
                $user = new User($email, $password);

                $userModel = new UserModel();
                $userData = $userModel->read($user);

                if ($userData) {
                    
                    $userModel->updateDarrerAcces($user);
                    
                    $_SESSION['user_data'] = $userData;

                    header("Location: index.php");
                    die();
                } else {
                    $errors['email']="El email proporcionado no corresponde con la contraseña dada";
                    LoginView::showLoginForm($data, $errors);
                }
            } else {
                LoginView::showLoginForm($data, $errors);
            }
        }
    }

    public function logout()
    {
        session_destroy();

        header("Location: index.php");
        die();
    }

    public function updateStatus($userId)
    {
        $userId = isset($userId[0]) ? $userId[0] : null;

        if ($userId !== null) {
            $userModel = new UserModel();

            if (! ($userModel->update($userId))) {
                header("Location: index.php");
                die();
            } else {
                throw new Exception("Error al actualizar el estado del usuario.");
            }
        } else {
            throw new Exception("ID de usuario no proporcionado");
        }
    }

    // Validates
    function validateText($input, $fieldName, $minLength, $maxLength, &$data)
    {
        if ($minLength == 0 && empty($input)) {} else if (empty($input) || ! preg_match("/^[A-Za-zÑñáéíóú\s-]{{$minLength},{$maxLength}}$/u", $input)) {
            return "Puede contener letras, espacios y guiones, con una longitud entre $minLength y $maxLength caracteres.";
        }

        $data[$fieldName] = $input;
        return null;
    }

    function validatePassword($input, $fieldName, $minLength, $maxLength, &$data)
    {
        if (empty($input) || strlen($input) < $minLength || strlen($input) > $maxLength) {
            return "La contraseña es obligatoria y debe tener entre $minLength y $maxLength caracteres.";
        }

        $data[$fieldName] = $input;
        return null;
    }

    function validateNumeroIdent($input, $fieldName, $minLength, $maxLength, &$data)
    {
        if (empty($input) || ! preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{{$minLength},{$maxLength}}$/u", $input)) {
            return "El número de identificación es obligatorio y debe contener al menos una letra y un número, con una longitud entre $minLength y $maxLength caracteres.";
        }

        $data[$fieldName] = $input;
        return null;
    }

    function validateEmail($email, &$data)
    {
        if (empty($email) || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Email es obligatorio y debe ser una dirección de correo válida.";
        }

        $domain = substr(strrchr($email, "@"), 1);
        if (! checkdnsrr($domain, "MX")) {
            return "El dominio del correo electrónico no es válido.";
        }
        $data['email'] = $email;
        return null;
    }

    function validateNaixement($input, $fieldName, &$data)
    {
        if (empty($input) || ! preg_match("/^\d{4}-\d{2}-\d{2}$/", $input)) {
            return "La fecha de nacimiento es obligatoria y debe estar en formato YYYY-MM-DD.";
        }

        $today = date("Y-m-d");
        if ($input > $today) {
            return "La fecha de nacimiento no puede ser mayor al día de hoy.";
        }

        $data[$fieldName] = $input;
        return null;
    }
    
    function validatePhoneNumber($input, $fieldName, &$data)
    {

        $cleanedInput = str_replace([' ', '-'], '', $input);
        

        if (!empty($cleanedInput)) {

            $phonePattern = "/^\+?[0-9]{1,20}$/";
            
            if (!preg_match($phonePattern, $cleanedInput)) {
                return "El número de teléfono no es válido.";
            }
            
            $data[$fieldName] = $cleanedInput;
        } else {
         
            $data[$fieldName] = null;
        }
        
        return null;
    }
    
    function validateProvincia($provincia, &$data)
    {
        $provinciasPermitidas = [
            'Alava',
            'Albacete',
            'Alicante',
            'Almería',
            'Asturias',
            'Avila',
            'Badajoz',
            'Barcelona',
            'Burgos',
            'Cáceres',
            'Cádiz',
            'Cantabria',
            'Castellón',
            'Ciudad Real',
            'Córdoba',
            'La Coruña',
            'Cuenca',
            'Gerona',
            'Granada',
            'Guadalajara',
            'Guipúzcoa',
            'Huelva',
            'Huesca',
            'Islas Baleares',
            'Jaén',
            'León',
            'Lérida',
            'Lugo',
            'Madrid',
            'Málaga',
            'Murcia',
            'Navarra',
            'Orense',
            'Palencia',
            'Las Palmas',
            'Pontevedra',
            'La Rioja',
            'Salamanca',
            'Segovia',
            'Sevilla',
            'Soria',
            'Tarragona',
            'Santa Cruz de Tenerife',
            'Teruel',
            'Toledo',
            'Valencia',
            'Valladolid',
            'Vizcaya',
            'Zamora',
            'Zaragoza',
            ''
        ];

        if (! in_array($provincia, $provinciasPermitidas)) {
            return "La provincia seleccionada no es válida.";
        }
        $data['provincia'] = $provincia;
        return null;
    }

    function validateCodigoPostal($codigoPostal, &$data)
    {
        $codigoPostalInt = intval($codigoPostal);

        if ((strlen($codigoPostal) == 5 && $codigoPostalInt >= 1000 && $codigoPostalInt <= 52999) || strlen($codigoPostal) == 0) {
            $data['codigo_postal'] = $codigoPostal;
            return null;
        } else {
            return "El código postal ingresado no es válido.";
        }
    }

    function validateImageFile($file, &$errors)
    {
        if (! isset($file['imagen']) || ! is_uploaded_file($file['imagen']['tmp_name'])) {
            $errors['imagen'] = "No se ha seleccionado ningún archivo.";
            return;
        }

        $fileName = $file['imagen']['name'];
        $fileSize = $file['imagen']['size'];
        $fileType = $file['imagen']['type'];

        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

        $allowedExtensions = [
            'png'
        ];
        $maxFileSize = 2 * 1024 * 1024;

        if (! in_array(strtolower($fileExt), $allowedExtensions)) {
            $errors['imagen'] = "El archivo debe ser una imagen con las extensiones permitidas: " . implode(', ', $allowedExtensions);
            return;
        }

        if ($fileSize > $maxFileSize) {
            $errors['imagen'] = "El tamaño del archivo excede el límite permitido (2MB).";
            return;
        }

        $allowedMimeTypes = [
            'image/png'
        ];
        if (! in_array(strtolower($fileType), $allowedMimeTypes)) {
            $errors['imagen'] = "El tipo de archivo no es una imagen válido.";
            return;
        }
    }
}
