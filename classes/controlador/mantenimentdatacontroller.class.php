<?php

class MantenimentDataController extends Controlador
{

    public function __construct()
    {}

    public function showMantenimentData()
    {
        $dataModel = new DataModel();
        $ObjectArray = $dataModel->read();

        $view = new MantenimentDataView();
        $view->showMantenimentData($ObjectArray);
    }

    public function obtainObject()
    {
        $data = new DataModel();
        $ObjectArray = $data->read();
        return $ObjectArray;
    }

    public function create()
    {
              if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
            $errors = array();
            $data = array();

            $data_input = $this->sanitizeInput($_POST['data']);
            $hora = $this->sanitizeInput($_POST['hora']);

            $ObjectArray = $this->obtainObject();

            $errors['data'] = $this->validateDate($data_input, $data);
            $errors['hora'] = $this->validateTime($hora, $data);

            if (empty(array_filter($errors, function ($value) {
                return $value !== null;
            }))) {
                $newData = new Data(null, $data_input, $hora);

                $dataModel = new DataModel();
                $result = $dataModel->create($newData);

                if ($result) {
                    $ObjectArray = $this->obtainObject();
                    $view = new MantenimentDataView();
                    $view->showMantenimentData($ObjectArray, $data, $errors, null, true);
                } else {
                    throw new Exception("Error adding data to the database.");
                }
            } else {
                $view = new MantenimentDataView();
                $view->showMantenimentData($ObjectArray, $data, $errors, null, true);
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
                $newData = new Data($id, null, null);

                $dataModel = new DataModel();
                $result = (array) $dataModel->getById($newData);

                if ($result) {
                    $view = new MantenimentDataView();
                    $view->showMantenimentData($ObjectArray, $data, $errors, $result, false);
                } else {
                    throw new Exception("Error updating data from the database.");
                }
            } else {
                $view = new MantenimentDataView();
                $view->showMantenimentData($ObjectArray, $data, $errors, null, false);
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
            $data_input = $this->sanitizeInput($_POST['data']);
            $hora = $this->sanitizeInput($_POST['hora']);

            $ObjectArray = $this->obtainObject();

            $errors['id'] = $this->validateSelectOption($id, 'id', $ObjectArray, $data);
            $errors['data'] = $this->validateDate($data_input, $data);
            $errors['hora'] = $this->validateTime($hora, $data);

            if (empty(array_filter($errors, function ($value) {
                return $value !== null;
            }))) {
                $newData = new Data($id, $data_input, $hora);

                $dataModel = new DataModel();
                $result = $dataModel->update($newData);

                if ($result) {
                    $ObjectArray = $this->obtainObject();
                    $view = new MantenimentDataView();
                    $view->showMantenimentData($ObjectArray, $data, $errors, null, false);
                } else {
                    throw new Exception("Error updating data in the database.");
                }
            } else {
                $view = new MantenimentDataView();
                $view->showMantenimentData($ObjectArray, $data, $errors, null, false);
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
                $newData = new Data($id, null, null);

                $dataModel = new DataModel();
                $result = $dataModel->delete($newData);

                if ($result) {
                    $ObjectArray = $this->obtainObject();
                    $view = new MantenimentDataView();
                    $view->showMantenimentData($ObjectArray);
                } else {
                    throw new Exception("Error deleting data from the database.");
                }
            } else {
                $view = new MantenimentDataView();
                $view->showMantenimentData($ObjectArray, $data, $errors, true);
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

    public function validateDate($input, &$data)
    {
        $dateRegex = "/^\d{4}-\d{2}-\d{2}$/";

        if (preg_match($dateRegex, $input) && strtotime(date("Y-m-d")) <= strtotime($input)) {
            $data['data'] = $input;
            return null;
        }

        return "Fecha no válida";
    }

    public function validateTime($input, &$data)
    {
        $timeRegex = "/^\d{2}:\d{2}$/";

        if (preg_match($timeRegex, $input)) {
            $data['hora'] = $input;
            return null;
        }

        return "Hora no válida";
    }
}

?>