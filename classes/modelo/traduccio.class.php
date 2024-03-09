<?php
class Traduccio {
    private $variable;
    private $valor;
    
    public function __construct($variable=null, $valor=null) {
        $this->variable = $variable;
        $this->valor = $valor;
    }
    
    /**
     * @return mixed
     */
    public function getVariable()
    {
        return $this->variable;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param mixed $variable
     */
    public function setVariable($variable)
    {
        $this->variable = $variable;
    }

    /**
     * @param mixed $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

   
    
    
}