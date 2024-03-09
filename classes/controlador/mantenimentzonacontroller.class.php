<?php

class MantenimentZonaController extends Controlador
{

    public function __construct()
    {}

    public function showMantenimentZona()
    {
        $zonaModel = new ZonaModel();
        $ObjectArray = $zonaModel->read();

        $view = new MantenimentZonaView();
        $view->showMantenimentZona($ObjectArray);
    }

    public function obtainObject()
    {
        $zona = new ZonaModel();
        $ObjectArray = $zona->read();
        return $ObjectArray;
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
            $errors = array();
            $data = array();

            $descripcio = $this->sanitizeInput($_POST['descripcio']);

            $ObjectArray = $this->obtainObject();

            $errors['descripcio'] = $this->validateDescripcio($descripcio, $data);

            if (empty(array_filter($errors, function ($value) {
                return $value !== null;
            }))) {
                $newZona = new Zona(null, $descripcio);

                $zonaModel = new ZonaModel();
                $result = $zonaModel->create($newZona);

                if ($result) {
                    $ObjectArray = $this->obtainObject();
                    $view = new MantenimentZonaView();
                    $view->showMantenimentZona($ObjectArray, $data, $errors);
                } else {
                    throw new Exception("Error adding zona to the database.");
                }
            } else {
                $view = new MantenimentZonaView();
                $view->showMantenimentZona($ObjectArray, $data, $errors);
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
                $newZona = new Zona($id, null);

                $zonaModel = new ZonaModel();
                $result = (array) $zonaModel->getById($newZona);

                if ($result) {
                    $view = new MantenimentZonaView();
                    $view->showMantenimentZona($ObjectArray, $data, $errors, $result, false);
                } else {
                    throw new Exception("Error updating zona from the database.");
                }
            } else {
                $view = new MantenimentZonaView();
                $view->showMantenimentZona($ObjectArray, $data, $errors, null, false);
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
            $descripcio = $this->sanitizeInput($_POST['descripcio']);

            $ObjectArray = $this->obtainObject();

            $errors['id'] = $this->validateSelectOption($id, 'id', $ObjectArray, $data);
            $errors['descripcio'] = $this->validateDescripcio($descripcio, $data);

            if (empty(array_filter($errors, function ($value) {
                return $value !== null;
            }))) {
                $newZona = new Zona($id, $descripcio);

                $zonaModel = new ZonaModel();
                $result = $zonaModel->update($newZona);

                if ($result) {
                    $ObjectArray = $this->obtainObject();
                    $view = new MantenimentZonaView();
                    $view->showMantenimentZona($ObjectArray, $data, $errors, null, false);
                } else {
                    throw new Exception("Error updating zona in the database.");
                }
            } else {
                $view = new MantenimentZonaView();
                $view->showMantenimentZona($ObjectArray, $data, $errors, null, false);
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
                $newZona = new Zona($id, null);

                $zonaModel = new ZonaModel();
                $result = $zonaModel->delete($newZona);

                if ($result) {
                    $ObjectArray = $this->obtainObject();
                    $view = new MantenimentZonaView();
                    $view->showMantenimentZona($ObjectArray);
                } else {
                    throw new Exception("Error deleting zona from the database.");
                }
            } else {
                $view = new MantenimentZonaView();
                $view->showMantenimentZona($ObjectArray, $data, $errors);
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

    public function validateDescripcio($input, &$data)
    {
        if (strlen($input) <= 30) {
            $data['descripcio'] = $input;
            return null;
        }
        
        return "La descripción debe tener 30 caracteres o menos.";
    }
    

}

?>