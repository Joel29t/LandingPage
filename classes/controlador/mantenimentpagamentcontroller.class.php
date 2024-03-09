<?php

class MantenimentPagamentController extends Controlador
{
    
    public function __construct()
    {}
    
    public function showMantenimentPagament()
    {
        $pagamentModel = new PagamentModel();
        $ObjectArray = $pagamentModel->read();

        
        $view = new MantenimentPagamentView();
        $view->showMantenimentPagament($ObjectArray);
    }
    
    public function obtainObject()
    {
        $pagament = new PagamentModel();
        $ObjectArray = $pagament->read();
        return $ObjectArray;
    }
    
    public function create()
    {
              if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
            $errors = array();
            $data = array();
            
            $banc = $this->sanitizeInput($_POST['banc']);
            $ref_externa = $this->sanitizeInput($_POST['ref_externa']);
            $data_input = $this->sanitizeInput($_POST['data']);
            $estat = $this->sanitizeInput($_POST['estat']);
            
            $ObjectArray = $this->obtainObject();
            
            $errors['banc'] = $this->validateText($banc, 'banc', $data);
            $errors['ref_externa'] = $this->validateText($ref_externa, 'ref_externa', $data);
            $errors['data'] = $this->validateDate($data_input, $data);
            $errors['estat'] = $this->validateOption($estat, $data);
            
            if (empty(array_filter($errors, function ($value) {
                return $value !== null;
            }))) {
                $newPagament = new Pagament(null, $banc, $ref_externa, $data, $estat);
                
                $pagamentModel = new PagamentModel();
                $result = $pagamentModel->create($newPagament);
                
                if ($result) {
                    $ObjectArray = $this->obtainObject();
                    $view = new MantenimentPagamentView();
                    $view->showMantenimentPagament($ObjectArray, $data, $errors);
                } else {
                    throw new Exception("Error adding pagament to the database.");
                }
            } else {
                $view = new MantenimentPagamentView();
                $view->showMantenimentPagament($ObjectArray, $data, $errors);
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
                $newPagament = new Pagament($id, null, null, null, null);
                
                $pagamentModel = new PagamentModel();
                $result = (array) $pagamentModel->getById($newPagament);
                
                if ($result) {
                    $view = new MantenimentPagamentView();
                    $view->showMantenimentPagament($ObjectArray, $data, $errors, $result, false);
                } else {
                    throw new Exception("Error updating pagament from the database.");
                }
            } else {
                $view = new MantenimentPagamentView();
                $view->showMantenimentPagament($ObjectArray, $data, $errors, null, false);
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
                $newPagament = new Pagament($id, $banc, $ref_externa, $data_input, $estat);
                
                $pagamentModel = new PagamentModel();
                $result = $pagamentModel->update($newPagament);
                
                if ($result) {
                    $ObjectArray = $this->obtainObject();
                    $view = new MantenimentPagamentView();
                    $view->showMantenimentPagament($ObjectArray, $data, $errors, null, false);
                } else {
                    throw new Exception("Error updating pagament in the database.");
                }
            } else {
                $view = new MantenimentPagamentView();
                $view->showMantenimentPagament($ObjectArray, $data, $errors, null, false);
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
                $newPagament = new Pagament($id, null, null, null, null);
                
                $pagamentModel = new PagamentModel();
                $result = $pagamentModel->delete($newPagament);
                
                if ($result) {
                    $ObjectArray = $this->obtainObject();
                    $view = new MantenimentPagamentView();
                    $view->showMantenimentPagament($ObjectArray);
                } else {
                    throw new Exception("Error deleting pagament from the database.");
                }
            } else {
                $view = new MantenimentPagamentView();
                $view->showMantenimentPagament($ObjectArray, $data, $errors);
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
        if (strlen($input) <= 90) {
            $data[$fileName] = $input;
            return null;
        }
        
        return "Debe tener 90 caracteres o menos.";
    }
    
    public function validateDate($input, &$data)
    {
        $dateRegex = "/^\d{2}\/\d{2}\/\d{4}$/";
        
        if (preg_match($dateRegex, $input)) {
            $formattedDate = date("d-m-Y", strtotime(str_replace("/", "-", $input)));
            
            if ($formattedDate && strtotime($formattedDate) <= strtotime(date("Y-m-d"))) {
                $data['data'] = $formattedDate;
                return null;
            }
        }
        
        return "Fecha no válida";
    }
    
    
    function validateOption($input, &$data)
    {
        $values = ['CONFIRMAT', 'PENDENT', 'WEB'];
        
        if (! in_array($input, $values)) {
            return "Opción no válida";
        }
        
        $data['estat'] = $input;
        return null;
    }
    
}

?>