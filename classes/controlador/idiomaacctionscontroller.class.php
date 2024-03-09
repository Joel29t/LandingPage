<?php

class IdiomaAcctionsController extends Controlador
{

    private $idiomaAcctionsModel;

    public function __construct()
    {
        $this->idiomaAcctionsModel = new IdiomaAcctionsModel();
    }

    public function showIdiomaAccions()
    {
        try {
            $iso = isset($getLang) ? $getLang : (isset($_COOKIE['lang']) ? $_COOKIE['lang'] : "gb");

            $idioma = new Idioma();
            $idioma->setIso($iso);

            $idiomaModel=new IdiomaModel();
            $idiomaId = $idiomaModel->getIdByIso($idioma);

            $idioma->setId($idiomaId);

            $translations = $this->idiomaAcctionsModel->getLanguagesByLanguageId($idioma);
            $traduccionesArray = [];

            foreach ($translations as $translation) {
                $traduccionesArray[$translation['variable']] = $translation['valor'];
            }

            $idioma->setTraduccions($traduccionesArray);

            $view = new IdiomaAcctionsView();
            $view->show($idioma);
        } catch (Exception $e) {
            throw new Exception("Error al cargar la página: " . $e->getMessage());
        }
    }

    public function update()
    {
        try {
            $iso = isset($_POST['iso']) ? $_POST['iso'] : $this->showIdiomaAccions();

            $idioma = new Idioma();
            $idioma->setIso($iso);

            $idiomaModel = new IdiomaModel();

            $idioma = $idiomaModel->getLanguage($idioma);

            $view = new IdiomaAcctionsView();
            $view->showForm($idioma, null, "update");
        } catch (Exception $e) {
            throw new Exception("Error al mostrar el formulario de actualización: " . $e->getMessage());
        }
    }

    public function updateLanguage($idioma)
    {
        try {
            $this->idiomaAcctionsModel->updateLanguage($idioma);

        } catch (Exception $e) {
            throw new Exception("Error al actualizar el idioma: " . $e->getMessage());
        }
    }

    public function processForm()
    {
        try {
            $idioma = new Idioma();  
     
            $idioma->setIso($this->sanitizeInput($_POST['iso']));
            $idioma->setImatge($_FILES["imatge"]["tmp_name"]);
            $idioma->setActiu($this->sanitizeInput($_POST['actiu']));
          
            $traduccionesArray = $_POST['traduccions'];
            $traduccionesObjetos = [];

            foreach ($traduccionesArray as $variable => $valor) {
                $variable = $this->sanitizeInput($variable);
                $valor = $this->sanitizeInput($valor);

                $traduccion = new Traduccio($variable, $valor);
                $traduccionesObjetos[] = $traduccion;
            }
          
            $idioma->setTraduccions($traduccionesObjetos);
          
            if (isset($_POST['create'])) {
                $idiomaModel = new IdiomaModel();
                $existingLanguage = $idiomaModel->getLanguage($idioma);

                if ($existingLanguage->getId() !== null) {
                    $this->showIdiomaAccions();
                } else {
                    $this->createLanguage($idioma);
                }
            } elseif (isset($_POST['update'])) {
               
                $idiomaModel = new IdiomaModel();
                $existingLanguage = $idiomaModel->getLanguage($idioma);

                if ($existingLanguage->getId() !== null) {

                    $id = $existingLanguage->getId();
                    $idioma->setId($id);

                    $this->updateLanguage($idioma);
                    $this->showIdiomaAccions();
                } else {
                    $this->showIdiomaAccions();
                }
            } else {
                throw new Exception("Acción no válida");
            }
        } catch (Exception $e) {
            throw new Exception("Error al procesar el formulario: " . $e->getMessage());
        }
    }

    public function create()
    {
        try {

            $idiomaModel = new IdiomaModel();
            $isos = $idiomaModel->getAllIso();

            $arrayIsos = [];
            foreach ($isos as $iso) {
                $arrayIsos[] = new Traduccio($iso, null);
            }

            $view = new IdiomaAcctionsView();
            $view->showForm($arrayIsos, null, "create");
        } catch (Exception $e) {
            throw new Exception("Error al mostrar el formulario de creación: " . $e->getMessage());
        }
    }

    public function createLanguage($idioma)
    {
        try {
            $errors = [];
            $this->validateText($idioma->getIso(), 'iso', 3, $errors);
            $this->validateActiu($idioma->getActiu(), $errors);

            foreach ($idioma->getTraduccions() as $i => $valor) {
                $this->validateText($valor->getVariable(), 'variable', 255, $errors);
                $this->validateText($valor->getValor(), 'valor', 255, $errors);
            }

            if (empty($errors)) {
                $this->validateImageFile($idioma->getImatge(), $errors);
                $imgName = "languages/" . $idioma->getIso().".png";

                if (empty($errors['imatge'])) {
                    $rutaImagenGuardada = __DIR__ . "/../../{$imgName}";

                    if (move_uploaded_file($idioma->getImatge(), $rutaImagenGuardada)) {
                        $idioma->setImatge($imgName);
                        $this->idiomaAcctionsModel->createLanguage($idioma);
                        $this->showIdiomaAccions();
                    }
                } else {
                    $this->showIdiomaAccions();
                }
            }
        } catch (Exception $e) {
            throw new Exception("Error al crear el idioma: " . $e->getMessage());
        }
    }

    public function delete()
    {
        try {
            $iso = isset($_POST['iso']) ? $_POST['iso'] : $this->showIdiomaAccions();

            $idioma = new Idioma();
            $idioma->setIso($iso);

            $this->idiomaAcctionsModel->deleteLanguageByIso($idioma);

            $this->showIdiomaAccions();
        } catch (Exception $e) {
            throw new Exception("Error al eliminar el idioma: " . $e->getMessage());
        }
    }

    // Validates
    public function validateText($input, $fileName, $limit, &$errors)
    {
        if (strlen($input) <= $limit || $limit == 0) {
            return;
        }
        $errors[$fileName] = "Debe tener " . $limit . " caracteres o menos.";
        return;
    }

    public function validateImageFile($file, &$errors)
    {
        if (! isset($file)) {
            $errors['imatge'] = "No se ha seleccionado ningún archivo.";
            return;
        }

        return;
    }

    public function validateActiu($actiu, &$errors)
    {
        if ($actiu != 0 && $actiu != 1) {
            $errors['actiu'] = "No es un numero entre el 1 y el 0";
            return;
        }
    }
}
