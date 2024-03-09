<?php
class Pagament {
    public $id;
    public $banc;
    public $ref_externa;
    public $data;
    public $estat;
    
    public function __construct($id, $banc, $ref_externa, $data, $estat) {
        $this->id = $id;
        $this->banc = $banc;
        $this->ref_externa = $ref_externa;
        $this->data = $data;
        $this->estat = $estat;
    }
}