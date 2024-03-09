<?php
class Entrada {
    public $esdeveniment_id;
    public $data_id;
    public $loc_id;
    public $zona_id;
    public $pagament_id;
    
    public $id;
    public $fila;
    public $butaca;
    public $dni;
    

    
    public function __construct($esdeveniment_id, $data_id, $loc_id, $zona_id, $pagament_id, $id, $fila, $butaca, $dni) {
        $this->esdeveniment_id = $esdeveniment_id;
        $this->data_id = $data_id;
        $this->loc_id = $loc_id;
        $this->zona_id = $zona_id;
        $this->pagament_id = $pagament_id;
        $this->id = $id;
        $this->fila = $fila;
        $this->butaca = $butaca;
        $this->dni = $dni;
        
   
    }
}