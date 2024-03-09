<?php

class IdiomaModel
{
    private $server;
    private $sgbd;
    private $dbname;
    private $user;
    private $password;
    private $conn;
    
    public function __construct()
    {
        include 'classes/config/config.php';
        $this->server = "localhost";
        $this->sgbd = $sgbd;
        $this->dbname = $dbname;
        $this->user = $selectUser;
        $this->password = $selectPassword;
        
        $this->establecerConexion();
    }
    
    public function establecerConexion()
    {
        $dsn = "{$this->sgbd}:host={$this->server};dbname={$this->dbname}";
        
        try {
            $this->conn = new PDO($dsn, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            
            throw new Exception("Error de conexión: " . $e->getMessage());
        }
    }
    
    public function beginTransaction()
    {
        if ($this->conn) {
            $this->conn->beginTransaction();
        }
    }
    
    public function commit()
    {
        if ($this->conn) {
            $this->conn->commit();
        }
    }
    
    public function rollback()
    {
        if ($this->conn) {
            $this->conn->rollback();
        }
    }
    
    public function getAllIso()
    {
        $query = "SELECT iso FROM tbl_idiomes";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        
        $isos = $statement->fetchAll(PDO::FETCH_COLUMN);
        
        return $isos;
    }
    
    public function getLanguage($idioma)
    {
        $iso = $idioma->getIso();
        $query = "SELECT * FROM tbl_idiomes WHERE iso=:iso";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':iso', $iso, PDO::PARAM_STR);
        $statement->execute();
        
        $idiomaData = $statement->fetch(PDO::FETCH_ASSOC);
        
        $idioma = new Idioma(
            $idiomaData['id'],
            $idiomaData['iso'],
            $idiomaData['imatge'],
            $idiomaData['actiu'],
            []
            );

        $idiomaAcction =new IdiomaAcctionsModel();
        
        $traducciones = $idiomaAcction->getTraducciones($idioma);
        $idioma->setTraduccions($traducciones);
        
        return $idioma;
    }
    
    
    public function getLanguageDataByIso(Idioma $idioma)
    {
        $iso = $idioma->getIso();
        $query = "SELECT * FROM tbl_idiomes WHERE iso = :iso";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':iso', $iso, PDO::PARAM_STR);
        $statement->execute();
        
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getIdiomesActius(){
        $query = "SELECT * FROM tbl_idiomes WHERE actiu = 1";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        $idiomasActius = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $idiomasActius;
    }
    
    public function insertIdioma($idioma)
    {
        try {
            $iso = $idioma->getIso();
            $imatge = $idioma->getImatge();
            $actiu = $idioma->getActiu();
            
            $queryIdiomes = "INSERT INTO tbl_idiomes (iso, imatge, actiu) VALUES (:iso, :imatge, :actiu)";
            $statementIdiomes = $this->conn->prepare($queryIdiomes);
            $statementIdiomes->bindParam(':iso', $iso, PDO::PARAM_STR);
            $statementIdiomes->bindParam(':imatge', $imatge, PDO::PARAM_STR);
            $statementIdiomes->bindParam(':actiu', $actiu, PDO::PARAM_STR);
            $statementIdiomes->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al insertar idioma en la base de datos: " . $e->getMessage());
        }
    }
    
    public function getIdByIso(Idioma $idioma)
    {
        $iso = $idioma->getIso();
        
        $query = "SELECT id FROM tbl_idiomes WHERE iso = :iso";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':iso', $iso, PDO::PARAM_STR);
        $statement->execute();
        
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            return $result['id'];
        } else {
            throw new Exception("Idioma no encontrado para ISO: $iso");
        }
    }
    
}
