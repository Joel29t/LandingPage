<?php
class Esdeveniment {
    public $id;
    public $titol;
    public $subtitol;
    public $dates;
    public $imatge;
    
    public function __construct($id, $titol, $subtitol, $dates, $imatge) {
        $this->id = $id;
        $this->titol = $titol;
        $this->subtitol = $subtitol;
        $this->dates = $dates;
        $this->imatge = $imatge;
    }
}
