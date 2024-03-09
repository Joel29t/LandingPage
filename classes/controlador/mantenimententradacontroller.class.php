<?php

class MantenimentEntradaController extends Controlador
{

    public function __construct()
    {}

    public function showMantenimentEntrada()
    {
        $ObjectArray = $this->obtainObject();
        $selectOptions = $this->obtainSelectOptions();

        $view = new MantenimentEntradaView();
        $view->showMantenimentEntrada($ObjectArray, $selectOptions);
    }

    public function obtainObject()
    {
        $entr = new EntradaModel();
        $ObjectArray = $entr->read();
        return $ObjectArray;
    }
    
    public function obtainSelectOptions()
    {
        $esdevModel = new EsdevenimentModel();
        $ObjectEsdevArray = $esdevModel->read();
        
        $dataModel = new DataModel();
        $ObjectDataArray = $dataModel->read();
        
        $locModel = new LocalitzacioModel();
        $ObjectLocArray = $locModel->read();
        
        $zonaModel = new ZonaModel();
        $ObjectZonaArray = $zonaModel->read();
        
        $pagamentModel = new PagamentModel();
        $ObjectPagamentArray = $pagamentModel->read();
        
        $selectOptions = [
            'esdeveniment_id' => $this->getObjectIdArray($ObjectEsdevArray),
            'data_id' => $this->getObjectIdArray($ObjectDataArray),
            'loc_id' => $this->getObjectIdArray($ObjectLocArray),
            'zona_id' => $this->getObjectIdArray($ObjectZonaArray),
            'pagament_id' => $this->getObjectIdArray($ObjectPagamentArray)
        ];
        
        return $selectOptions;
    }
    
    private function getObjectIdArray($objectArray)
    {
        $idArray = [];
        foreach ($objectArray as $object) {
            $idArray[] = $object->id;
        }
        return $idArray;
    }
    

    public function create()
    {
       
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {

            $errors = array();
            $data = array();

            $esdeveniment_id = $this->sanitizeInput($_POST['esdeveniment_id']);
            $data_id = $this->sanitizeInput($_POST['data_id']);
            $loc_id = $this->sanitizeInput($_POST['loc_id']);
            $zona_id = $this->sanitizeInput($_POST['zona_id']);
            $pagament_id = $this->sanitizeInput($_POST['pagament_id']);
            $id = $this->sanitizeInput($_POST['id']);
            $fila = $this->sanitizeInput($_POST['fila']);
            $butaca = $this->sanitizeInput($_POST['butaca']);
            $dni = $this->sanitizeInput($_POST['dni']);

            $ObjectArray = $this->obtainObject();
            $selectOptions = $this->obtainSelectOptions();
            
            $errors['esdeveniment_id'] = $this->validateSelectOption($esdeveniment_id, 'esdeveniment_id', $selectOptions, $data);
            $errors['data_id'] = $this->validateSelectOption($data_id, 'data_id', $selectOptions, $data);
            $errors['loc_id'] = $this->validateSelectOption($loc_id, 'loc_id', $selectOptions, $data);
            $errors['zona_id'] = $this->validateSelectOption($zona_id, 'zona_id', $selectOptions, $data);
            $errors['pagament_id'] = $this->validateSelectOption($pagament_id, 'pagament_id', $selectOptions, $data);
            $errors['id'] = $this->validateNotId($id, 'id', $ObjectArray, $data);
            $errors['fila'] = $this->validateFila($fila, $data);
            $errors['butaca'] = $this->validateButaca($butaca, $data);
            $errors['dni'] = $this->validateDNI($dni, $data);

            if (empty(array_filter($errors, function ($value) {
                return $value !== null;
            }))) {
                $newEntrada = new Entrada($esdeveniment_id, $data_id, $loc_id, $zona_id, $pagament_id, $id, $fila, $butaca, $data['dni']);

                $entradaModel = new EntradaModel();

                $result = $entradaModel->create($newEntrada);

                if ($result) {
                    $ObjectArray = $this->obtainObject();
                    $selectOptions = $this->obtainSelectOptions();
                    $view = new MantenimentEntradaView();
                    $view->showMantenimentEntrada($ObjectArray, $selectOptions, $data, $errors, null, true);
                } else {
                    throw new Exception("Error adding entry to the database.");
                }
            } else {
                $selectOptions = $this->obtainSelectOptions();
                $view = new MantenimentEntradaView();
                $view->showMantenimentEntrada($ObjectArray, $selectOptions,  $data, $errors, null, true);
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

            $errors['id'] = $this->validateId($id, 'id', $ObjectArray, $data);

            if ($errors['id'] === null) {
                $newEntrada = new Entrada(null, null, null, null, null, $id, null, null, null);

                $entradaModel = new EntradaModel();
                $result = (array) $entradaModel->getById($newEntrada);
               
                if ($result) {
                    $selectOptions = $this->obtainSelectOptions();
                    $view = new MantenimentEntradaView();
                    $view->showMantenimentEntrada($ObjectArray, $selectOptions, $data, $errors, $result, false);
                } else {
                    throw new Exception("Error updating entry from the database.");
                }
            } else {
                $selectOptions = $this->obtainSelectOptions();
                $view = new MantenimentEntradaView();
                $view->showMantenimentEntrada($ObjectArray, $selectOptions, $data, $errors, null, false);
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

            $esdeveniment_id = $this->sanitizeInput($_POST['esdeveniment_id']);
            $data_id = $this->sanitizeInput($_POST['data_id']);
            $loc_id = $this->sanitizeInput($_POST['loc_id']);
            $zona_id = $this->sanitizeInput($_POST['zona_id']);
            $pagament_id = $this->sanitizeInput($_POST['pagament_id']);
            $id = $this->sanitizeInput($_POST['id']);
            $fila = $this->sanitizeInput($_POST['fila']);
            $butaca = $this->sanitizeInput($_POST['butaca']);
            $dni = $this->sanitizeInput($_POST['dni']);

            $ObjectArray = $this->obtainObject();
            $selectOptions = $this->obtainSelectOptions();
            
            $errors['esdeveniment_id'] = $this->validateSelectOption($esdeveniment_id, 'esdeveniment_id', $selectOptions, $data);
            $errors['data_id'] = $this->validateSelectOption($data_id, 'data_id', $selectOptions, $data);
            $errors['loc_id'] = $this->validateSelectOption($loc_id, 'loc_id', $selectOptions, $data);
            $errors['zona_id'] = $this->validateSelectOption($zona_id, 'zona_id', $selectOptions, $data);
            $errors['pagament_id'] = $this->validateSelectOption($pagament_id, 'pagament_id', $selectOptions, $data);
            $errors['id'] = $this->validateId($id, 'id', $ObjectArray, $data);
            $errors['fila'] = $this->validateFila($fila, $data);
            $errors['butaca'] = $this->validateButaca($butaca, $data);
            $errors['dni'] = $this->validateDNI($dni, $data);

            if (empty(array_filter($errors, function ($value) {
                return $value !== null;
            }))) {
                $newEntrada = new Entrada($esdeveniment_id, $data_id, $loc_id, $zona_id, $pagament_id, $id, $fila, $butaca, $dni);
                
                $entradaModel = new EntradaModel();
                $result = $entradaModel->update($newEntrada);
                
                if ($result) {
                    $view = new MantenimentEntradaView();
                    $view->showMantenimentEntrada($ObjectArray, $selectOptions, $data, $errors, $result, false);
                } else {
                    throw new Exception("Error updating entry in the database.");
                }
            } else {
                $view = new MantenimentEntradaView();
                $view->showMantenimentEntrada($ObjectArray, $selectOptions, $data, $errors, null, false);
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

            $errors['id'] = $this->validateId($id, 'id', $ObjectArray, $data);

            if ($errors['id'] === null) {

                $newEntrada = new Entrada(null, null, null, null, null, $id, null, null, null);

                $entradaModel = new EntradaModel();
                $result = $entradaModel->delete($newEntrada);

                if ($result) {
                    $ObjectArray = $this->obtainObject();
                    $selectOptions = $this->obtainSelectOptions();
                    $view = new MantenimentEntradaView();
                    $view->showMantenimentEntrada($ObjectArray, $selectOptions, null, null, null, true);
                } else {
                    throw new Exception("Error deleting entry from the database.");
                }
            } else {
                $selectOptions = $this->obtainSelectOptions();
                $view = new MantenimentEntradaView();
                $view->showMantenimentEntrada($ObjectArray, $selectOptions, $data, $errors, null, true);
            }
        } else {
            throw new Exception("Invalid request.");
        }
    }

    // validates
    function validateSelectOption($input, $fieldName, $selectOptions, &$data)
    {
        $values = $selectOptions[$fieldName];

        if (! in_array($input, $values)) {
            return "Opción no válida";
        }
        
        $data[$fieldName] = $input;
        return null;
    }
    
    function validateId($input, $fieldName, $objectArray, &$data)
    {
       
        $values = array_column($objectArray, $fieldName);
        if (! in_array($input, $values)) {
            return "Opción no válida";
        }

        $data['id'] = $input;
        return null;
    }

    function validateNotId($input, $fieldName, $objectArray, &$data)
    {
        $values = array_column($objectArray, $fieldName);

        if (in_array($input, $values) || empty($input)) {
            return "Opción no válida";
        }

        $data['id'] = $input;
        return null;
    }
    
    function validateFila($fila, &$data){
        if ($fila<0 || $fila>30) {
            return "La fila no puede ser menor a 0 y superar 30";
        }
        $data['fila'] = $fila;
        return null;
    }

    function validateButaca($butaca, &$data){
        if ($butaca<0 || $butaca>500) {
            return "La butaca no puede ser menor a 0 y superar 500";
        }
        $data['butaca'] = $butaca;
        return null;
    }
    
    function validateDNI($dni, &$data)
    {
        $letter = substr($dni, - 1);
        $numbers = substr($dni, 0, - 1);

        if (is_numeric($numbers) && ctype_alpha($letter)) {
            if (strlen($numbers) == 8) {
                $data['dni'] = $dni;
                return null;
            }
        }
        return "El DNI no es valido";
    }
}
