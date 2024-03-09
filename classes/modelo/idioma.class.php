<?php
class Idioma {
    private $id;
    private $iso;
    private $imatge;
    private $actiu;
    private $traduccions;
    
    public function __construct($id=null, $iso = null, $imatge = null, $actiu = null, $traduccions = null) {
        $this->id = $id;
        $this->iso = $iso;
        $this->imatge = $imatge;
        $this->actiu = $actiu;
        $this->traduccions = $traduccions;
    }
    
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIso()
    {
        return $this->iso;
    }

    /**
     * @return string
     */
    public function getImatge()
    {
        return $this->imatge;
    }

    /**
     * @return string
     */
    public function getActiu()
    {
        return $this->actiu;
    }

    /**
     * @return array
     */
    public function getTraduccions()
    {
        return $this->traduccions;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $iso
     */
    public function setIso($iso)
    {
        $this->iso = $iso;
    }

    /**
     * @param string $imatge
     */
    public function setImatge($imatge)
    {
        $this->imatge = $imatge;
    }

    /**
     * @param string $actiu
     */
    public function setActiu($actiu)
    {
        $this->actiu = $actiu;
    }

    /**
     * @param array $traduccions
     */
    public function setTraduccions($traduccions)
    {
        $this->traduccions = $traduccions;
    }

   

}