<?php
class MantenimentLocalitzacioController extends Controlador
{

    public function __construct()
    {}

    public function showMantenimentLocalitzacio()
    {
        $localitzacioModel = new LocalitzacioModel();
        $ObjectArray = $localitzacioModel->read();

               $view = new MantenimentLocalitzacioView();
        $view->showMantenimentLocalitzacio($ObjectArray);
    }

    public function obtainObject()
    {
        $localitzacio = new LocalitzacioModel();
        $ObjectArray = $localitzacio->read();
        return $ObjectArray;
    }

    public function create()
    {
           
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
            $errors = array();
            $data = array();

            $lloc = $this->sanitizeInput($_POST['lloc']);
            $adreca = $this->sanitizeInput($_POST['adreca']);
            $localitat = $this->sanitizeInput($_POST['localitat']);

            $ObjectArray = $this->obtainObject();

            $errors['lloc'] = $this->validateText($lloc, 'lloc', $data);
            $errors['adreca'] = $this->validateText($adreca,'adreca', $data);
            $errors['localitat'] = $this->validateText($localitat,'localitat', $data);

            if (empty(array_filter($errors, function ($value) {
                return $value !== null;
            }))) {
                $newLocalitzacio = new Localitzacio(null, $lloc, $adreca, $localitat);

                $localitzacioModel = new LocalitzacioModel();
                $result = $localitzacioModel->create($newLocalitzacio);

                if ($result) {
                    $ObjectArray = $this->obtainObject();
                    $view = new MantenimentLocalitzacioView();
                    $view->showMantenimentLocalitzacio($ObjectArray, $data, $errors);
                } else {
                    throw new Exception("Error adding localitzacio to the database.");
                }
            } else {
                $view = new MantenimentLocalitzacioView();
                $view->showMantenimentLocalitzacio($ObjectArray, $data, $errors);
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
                $newLocalitzacio = new Localitzacio($id, null, null, null);

                $localitzacioModel = new LocalitzacioModel();
                $result = (array) $localitzacioModel->getById($newLocalitzacio);

                if ($result) {
                    $view = new MantenimentLocalitzacioView();
                    $view->showMantenimentLocalitzacio($ObjectArray, $data, $errors, $result, false);
                } else {
                    throw new Exception("Error updating localitzacio from the database.");
                }
            } else {
                $view = new MantenimentLocalitzacioView();
                $view->showMantenimentLocalitzacio($ObjectArray, $data, $errors, null, false);
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
            $lloc = $this->sanitizeInput($_POST['lloc']);
            $adreca = $this->sanitizeInput($_POST['adreca']);
            $localitat = $this->sanitizeInput($_POST['localitat']);

            $ObjectArray = $this->obtainObject();

            $errors['id'] = $this->validateSelectOption($id, 'id', $ObjectArray, $data);
            $errors['lloc'] = $this->validateText($lloc, 'lloc', $data);
            $errors['adreca'] = $this->validateText($adreca,'adreca', $data);
            $errors['localitat'] = $this->validateText($localitat,'localitat', $data);

            if (empty(array_filter($errors, function ($value) {
                return $value !== null;
            }))) {
                $newLocalitzacio = new Localitzacio($id, $lloc, $adreca, $localitat);

                $localitzacioModel = new LocalitzacioModel();
                $result = $localitzacioModel->update($newLocalitzacio);

                if ($result) {
                    $ObjectArray = $this->obtainObject();
                    $view = new MantenimentLocalitzacioView();
                    $view->showMantenimentLocalitzacio($ObjectArray, $data, $errors, null, false);
                } else {
                    throw new Exception("Error updating localitzacio in the database.");
                }
            } else {
                $view = new MantenimentLocalitzacioView();
                $view->showMantenimentLocalitzacio($ObjectArray, $data, $errors, null, false);
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
                $newLocalitzacio = new Localitzacio($id, null, null, null);

                $localitzacioModel = new LocalitzacioModel();
                $result = $localitzacioModel->delete($newLocalitzacio);

                if ($result) {
                    $ObjectArray = $this->obtainObject();
                    $view = new MantenimentLocalitzacioView();
                    $view->showMantenimentLocalitzacio($ObjectArray);
                } else {
                    throw new Exception("Error deleting localitzacio from the database.");
                }
            } else {
                $view = new MantenimentLocalitzacioView();
                $view->showMantenimentLocalitzacio($ObjectArray, $data, $errors);
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

    public function validateText($input, $fileName, &$data)
    {
        if (strlen($input) <= 90||strlen($input) > 0) {
            $data[$fileName] = $input;
            return null;
        }
        
        return "Debe tenerentre 1 y 90 caracteres.";
    }

}

?>