<?php
class Localitzacio {
    public $id;
    public $lloc;
    public $adreca;
    public $localitat;
    
    public function __construct($id, $lloc, $adreca, $localitat) {
        $this->id = $id;
        $this->lloc = $lloc;
        $this->adreca = $adreca;
        $this->localitat = $localitat;
    }
    
}
?>
