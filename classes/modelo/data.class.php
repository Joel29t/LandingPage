<?php
class Data {
    public $id;
    public $data;
    public $hora;
    
    public function __construct($id, $data, $hora) {
        $this->id = $id;
        $this->data = $data;
        $this->hora = $hora;
    }
}
?>