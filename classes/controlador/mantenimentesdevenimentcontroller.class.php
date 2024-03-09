<?php

class MantenimentEsdevenimentController extends Controlador
{

    public function __construct()
    {}

    public function showMantenimentEsdeveniment()
    {
        $esdevenimentModel = new EsdevenimentModel();
        $ObjectArray = $esdevenimentModel->read();

        $view = new MantenimentEsdevenimentView();
        $view->showMantenimentEsdeveniment($ObjectArray);
    }

    public function obtainObject()
    {
        $esdeveniment = new EsdevenimentModel();
        $ObjectArray = $esdeveniment->read();
        return $ObjectArray;
    }

    public function create()
    {
               if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
            $errors = array();
            $data = array();

            $titol = $this->sanitizeInput($_POST['titol']);
            $subtitol = $this->sanitizeInput($_POST['subtitol']);
            $dates = $this->sanitizeInput($_POST['dates']);

            $ObjectArray = $this->obtainObject();

            $errors['titol'] = $this->validateText($titol, 'banc', 90, $data);
            $errors['subtitol'] = $this->validateText($subtitol, 'subtitol', 0, $data);
            $errors['dates'] = $this->validateText($dates, 'dates', 50, $data);

            if (empty(array_filter($errors, function ($value) {
                return $value !== null;
            }))) {
                $imgName = $this->validateImageFile($_FILES, $errors);
                $imgName= "uploads/".$imgName;
                if (! empty($errors['imatge'])) {
                    $view = new MantenimentEsdevenimentView();
                    $view->showMantenimentEsdeveniment($ObjectArray, $data, $errors);
                } else {
                    $rutaImagenGuardada = __DIR__ . "/../../{$imgName}";

                    if (move_uploaded_file($_FILES["imatge"]["tmp_name"], $rutaImagenGuardada)) {
                        
                        $newEsdeveniment = new Esdeveniment(null, $titol, $subtitol, $dates, $imgName);

                        $esdevenimentModel = new EsdevenimentModel();
                        $result = $esdevenimentModel->create($newEsdeveniment);

                        if ($result) {
                            $ObjectArray = $this->obtainObject();
                            $view = new MantenimentEsdevenimentView();
                            $view->showMantenimentEsdeveniment($ObjectArray, $data, $errors);
                        } else {
                            throw new Exception("Error adding esdeveniment to the database.");
                        }
                    }else{
                        throw new Exception("Error al guardar la imagen. Error: " . $_FILES["imatge"]["error"]);
                    }
                }
            } else {
                $view = new MantenimentEsdevenimentView();
                $view->showMantenimentEsdeveniment($ObjectArray, $data, $errors);
            }
        } else {
            throw new Exception("Invalid request.");
        }
    }

    public function showUpdate()
    {
               if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
            $errors = array();
            $data = array();

            $id = $this->sanitizeInput($_GET['id']);
            $ObjectArray = $this->obtainObject();

            $errors['id'] = $this->validateSelectOption($id, 'id', $ObjectArray, $data);

            if ($errors['id'] === null) {
                $newEsdeveniment = new Esdeveniment($id, null, null, null, null);

                $esdevenimentModel = new EsdevenimentModel();
                $result = (array) $esdevenimentModel->getById($newEsdeveniment);

                if ($result) {
                    $view = new MantenimentEsdevenimentView();
                    $view->showMantenimentEsdeveniment($ObjectArray, $data, $errors, $result, false);
                } else {
                    throw new Exception("Error updating esdeveniment from the database.");
                }
            } else {
                $view = new MantenimentEsdevenimentView();
                $view->showMantenimentEsdeveniment($ObjectArray, $data, $errors, null, false);
            }
        } else {
            throw new Exception("Invalid request.");
        }
    }

    public function update()
    {
              if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
            $errors = array();
            $data = array();

            $id = $this->sanitizeInput($_POST['id']);
            $banc = $this->sanitizeInput($_POST['banc']);
            $ref_externa = $this->sanitizeInput($_POST['ref_externa']);
            $data_input = $this->sanitizeInput($_POST['data']);
            $estat = $this->sanitizeInput($_POST['estat']);

            $ObjectArray = $this->obtainObject();

            $errors['id'] = $this->validateSelectOption($id, 'id', $ObjectArray, $data);
            $errors['banc'] = $this->validateText($banc, 'banc', $data);
            $errors['ref_externa'] = $this->validateText($ref_externa, 'ref_externa', $data);
            $errors['data'] = $this->validateDate($data_input, $data);
            $errors['estat'] = $this->validateOption($estat, $data);

            if (empty(array_filter($errors, function ($value) {
                return $value !== null;
            }))) {
                $newEsdeveniment = new Esdeveniment($id, $banc, $ref_externa, $data_input, $estat);

                $esdevenimentModel = new EsdevenimentModel();
                $result = $esdevenimentModel->update($newEsdeveniment);

                if ($result) {
                    $ObjectArray = $this->obtainObject();
                    $view = new MantenimentEsdevenimentView();
                    $view->showMantenimentEsdeveniment($ObjectArray, $data, $errors, null, false);
                } else {
                    throw new Exception("Error updating esdeveniment in the database.");
                }
            } else {
                $view = new MantenimentEsdevenimentView();
                $view->showMantenimentEsdeveniment($ObjectArray, $data, $errors, null, false);
            }
        } else {
            throw new Exception("Invalid request.");
        }
    }

    public function delete()
    {
               if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
            $errors = array();
            $data = array();

            $id = $this->sanitizeInput($_GET['id']);

            $ObjectArray = $this->obtainObject();

            $errors['id'] = $this->validateSelectOption($id, 'id', $ObjectArray, $data);

            if ($errors['id'] === null) {
                $newEsdeveniment = new Esdeveniment($id, null, null, null, null);

                $esdevenimentModel = new EsdevenimentModel();
                $result = $esdevenimentModel->delete($newEsdeveniment);

                if ($result) {
                    $ObjectArray = $this->obtainObject();
                    $view = new MantenimentEsdevenimentView();
                    $view->showMantenimentEsdeveniment($ObjectArray);
                } else {
                    throw new Exception("Error deleting esdeveniment from the database.");
                }
            } else {
                $view = new MantenimentEsdevenimentView();
                $view->showMantenimentEsdeveniment($ObjectArray, $data, $errors);
            }
        } else {
            throw new Exception("Invalid request.");
        }
    }

    // Funciones de validación
    function validateSelectOption($input, $fieldName, $objectArray, &$data)
    {
        $values = array_column($objectArray, $fieldName);

        if (! in_array($input, $values)) {
            return "Opción no válida";
        }

        $data[$fieldName] = $input;
        return null;
    }

    function validateNotSelectOption($input, $fieldName, $objectArray, &$data)
    {
        $values = array_column($objectArray, $fieldName);

        if (in_array($input, $values) || empty($input)) {
            return "Opción no válida";
        }

        $data[$fieldName] = $input;
        return null;
    }

    public function validateText($input, $fileName, $limit, &$data)
    {
        if (strlen($input) <= $limit || $limit == 0) {
            $data[$fileName] = $input;
            return null;
        }

        return "Debe tener " . $limit . " caracteres o menos.";
    }

    function validateImageFile($file, &$errors)
    {
        if (! isset($file['imatge']) || ! is_uploaded_file($file['imatge']['tmp_name'])) {
            $errors['imatge'] = "No se ha seleccionado ningún archivo.";
            return;
        }

        return $file['imatge']['name'];
    }
}

?>