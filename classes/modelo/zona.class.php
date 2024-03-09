<?php
class Zona {
    public $id;
    public $descripcio;
    
    public function __construct($id, $descripcio) {
        $this->id = $id;
        $this->descripcio = $descripcio;
    }
}
?>
