<?php

class User
{
    private $email;
    private $password;
    private $tipusIdent;
    private $numeroIdent;
    private $nombre;
    private $apellidos;
    private $sexo;
    private $fechaNacimiento;
    private $direccion;
    private $codigoPostal;
    private $poblacion;
    private $provincia;
    private $telefono;
    private $horaEnMs;
    private $status;
    private $navegador;
    private $plataforma;

    public function __construct(
        $email,
        $password,
        $tipusIdent=null,
        $numeroIdent=null,
        $nombre=null,
        $apellidos=null,
        $sexo=null,
        $fechaNacimiento=null,
        $direccion=null,
        $codigoPostal=null,
        $poblacion=null,
        $provincia=null,
        $telefono=null,
        $horaEnMs=null,
        $status=null,
        $navegador=null,
        $plataforma=null
        ) {
            $this->email = $email;
            $this->password = $password;
            $this->tipusIdent = $tipusIdent;
            $this->numeroIdent = $numeroIdent;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->sexo = $sexo;
            $this->fechaNacimiento = $fechaNacimiento;
            $this->direccion = $direccion;
            $this->codigoPostal = $codigoPostal;
            $this->poblacion = $poblacion;
            $this->provincia = $provincia;
            $this->telefono = $telefono;
            $this->horaEnMs = $horaEnMs;
            $this->status = $status;
            $this->navegador = $navegador;
            $this->plataforma = $plataforma;
    }
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * @return mixed
     */
    public function getTipusIdent()
    {
        return $this->tipusIdent;
    }
    
    /**
     * @return mixed
     */
    public function getNumeroIdent()
    {
        return $this->numeroIdent;
    }
    
    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    
    /**
     * @return mixed
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }
    
    /**
     * @return mixed
     */
    public function getSexo()
    {
        return $this->sexo;
    }
    
    /**
     * @return mixed
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }
    
    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }
    
    /**
     * @return mixed
     */
    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }
    
    /**
     * @return mixed
     */
    public function getPoblacion()
    {
        return $this->poblacion;
    }
    
    /**
     * @return mixed
     */
    public function getProvincia()
    {
        return $this->provincia;
    }
    
    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }
    
    /**
     * @return mixed
     */
    public function getHoraEnMs()
    {
        return $this->horaEnMs;
    }
    
    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * @return mixed
     */
    public function getNavegador()
    {
        return $this->navegador;
    }
    
    /**
     * @return mixed
     */
    public function getPlataforma()
    {
        return $this->plataforma;
    }
    
    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    /**
     * @param mixed $tipusIdent
     */
    public function setTipusIdent($tipusIdent)
    {
        $this->tipusIdent = $tipusIdent;
    }
    
    /**
     * @param mixed $numeroIdent
     */
    public function setNumeroIdent($numeroIdent)
    {
        $this->numeroIdent = $numeroIdent;
    }
    
    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    
    /**
     * @param mixed $apellidos
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }
    
    /**
     * @param mixed $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }
    
    /**
     * @param mixed $fechaNacimiento
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }
    
    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }
    
    /**
     * @param mixed $codigoPostal
     */
    public function setCodigoPostal($codigoPostal)
    {
        $this->codigoPostal = $codigoPostal;
    }
    
    /**
     * @param mixed $poblacion
     */
    public function setPoblacion($poblacion)
    {
        $this->poblacion = $poblacion;
    }
    
    /**
     * @param mixed $provincia
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    }
    
    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }
    
    /**
     * @param mixed $horaEnMs
     */
    public function setHoraEnMs($horaEnMs)
    {
        $this->horaEnMs = $horaEnMs;
    }
    
    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
    
    /**
     * @param mixed $navegador
     */
    public function setNavegador($navegador)
    {
        $this->navegador = $navegador;
    }
    
    /**
     * @param mixed $plataforma
     */
    public function setPlataforma($plataforma)
    {
        $this->plataforma = $plataforma;
    }


}