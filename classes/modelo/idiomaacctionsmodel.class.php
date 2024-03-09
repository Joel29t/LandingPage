<?php

class IdiomaAcctionsModel
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
    
    
    public function createLanguage(Idioma $idioma)
    {
        try {
            $this->conn->beginTransaction();
            
            $iso = $idioma->getIso();
            $imatge = $idioma->getImatge();
            $actiu = $idioma->getActiu();
            $traduccions = $idioma->getTraduccions();
            
            // Insertar en tbl_idiomes
            $queryIdiomes = "INSERT INTO tbl_idiomes (iso, imatge, actiu) VALUES (:iso, :imatge, :actiu)";
            $statementIdiomes = $this->conn->prepare($queryIdiomes);
            $statementIdiomes->bindParam(':iso', $iso, PDO::PARAM_STR);
            $statementIdiomes->bindParam(':imatge', $imatge, PDO::PARAM_STR);
            $statementIdiomes->bindParam(':actiu', $actiu, PDO::PARAM_STR);
            $statementIdiomes->execute();
            
            // Obtener el ID del idioma recién insertado
            $idiomaId = $this->conn->lastInsertId();
            
            foreach ($traduccions as $traduccion) {
                $variable = $traduccion->getVariable();
                $valor = $traduccion->getValor();
                
                $queryTraduccions = "INSERT INTO tbl_traduccions (variable, idioma_id, valor) VALUES (:variable, :idioma_id, :valor)";
                $statementTraduccions = $this->conn->prepare($queryTraduccions);
                $statementTraduccions->bindParam(':variable', $variable, PDO::PARAM_STR);
                $statementTraduccions->bindParam(':idioma_id', $idiomaId, PDO::PARAM_INT);
                $statementTraduccions->bindParam(':valor', $valor, PDO::PARAM_STR);
                $statementTraduccions->execute();
            }
            
            // Obtener todas las lenguas existentes
            $queryAllLanguages = "SELECT iso, id FROM tbl_idiomes";
            $statementAllLanguages = $this->conn->prepare($queryAllLanguages);
            $statementAllLanguages->execute();
            $allLanguages = $statementAllLanguages->fetchAll(PDO::FETCH_ASSOC);
            
            // Insertar traducciones vacías para cada idioma existente
            foreach ($allLanguages as $lang) {
                $currentIso = $lang['iso'];
                $currentId = $lang['id'];
                
                $queryTraduccions = "INSERT INTO tbl_traduccions (variable, idioma_id, valor) VALUES (:variable, :idioma_id, :valor)";
                $statementTraduccions = $this->conn->prepare($queryTraduccions);
                $statementTraduccions->bindParam(':variable', $iso, PDO::PARAM_STR); // Variable es el ISO del nuevo idioma
                $statementTraduccions->bindParam(':idioma_id', $currentId, PDO::PARAM_INT);
                $statementTraduccions->bindValue(':valor', ''); // Valor inicialmente vacío
                $statementTraduccions->execute();
            }
            
            $this->conn->commit();
        } catch (Exception $e) {
            $this->conn->rollBack();
            throw new Exception("Error al crear el idioma: " . $e->getMessage());
        }
    }
    
    public function insertTraduccio($variable, $idiomaId, $valor)
    {
        try {
            $queryTraduccions = "INSERT INTO tbl_traduccions (variable, idioma_id, valor) VALUES (:variable, :idioma_id, :valor)";
            $statementTraduccions = $this->conn->prepare($queryTraduccions);
            $statementTraduccions->bindParam(':variable', $variable, PDO::PARAM_STR);
            $statementTraduccions->bindParam(':idioma_id', $idiomaId, PDO::PARAM_INT);
            $statementTraduccions->bindParam(':valor', $valor, PDO::PARAM_STR);
            $statementTraduccions->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al insertar traducción en la base de datos: " . $e->getMessage());
        }
    }
    
   
  
    
    public function getTraducciones(Idioma $idioma)
    {
        $idiomaId = $idioma->getId();
        $query = "SELECT * FROM tbl_traduccions WHERE idioma_id = :idioma_id";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':idioma_id', $idiomaId, PDO::PARAM_INT);
        $statement->execute();
        
        $traducciones = [];
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $traduccionData) {
            $traduccion = new Traduccio($traduccionData['variable'], $traduccionData['valor']);
            $traducciones[] = $traduccion;
        }
        
        return $traducciones;
    }
   
    public function getLanguagesByLanguageId(Idioma $idioma)
    {
        $languageId = $idioma->getId();
        $query = "SELECT * FROM tbl_traduccions WHERE idioma_id = :idioma_id";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':idioma_id', $languageId, PDO::PARAM_INT);
        $statement->execute();
        
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function updateLanguage(Idioma $idioma)
    {
      
        try {
            $this->conn->beginTransaction();
            
            $iso = $idioma->getIso();
            $imatge = $idioma->getImatge();
            $actiu = $idioma->getActiu();
            $traduccions = $idioma->getTraduccions();
            
            $idiomaId = $idioma->getId();
            
            $query = "UPDATE tbl_idiomes SET imatge = :imatge, actiu = :actiu WHERE id = :idioma_id";
            $statement = $this->conn->prepare($query);
            $statement->bindParam(':imatge', $imatge, PDO::PARAM_STR);
            $statement->bindParam(':actiu', $actiu, PDO::PARAM_STR);
            $statement->bindParam(':idioma_id', $idiomaId, PDO::PARAM_INT);
            $statement->execute();
            
            foreach ($traduccions as $traduccion) {
                $variable = $traduccion->getVariable();
                $valor = $traduccion->getValor();

                $query = "UPDATE tbl_traduccions SET valor = :valor WHERE idioma_id = :idioma_id AND variable = :variable";
                $statement = $this->conn->prepare($query);
                $statement->bindParam(':valor', $valor, PDO::PARAM_STR);
                $statement->bindParam(':idioma_id', $idiomaId, PDO::PARAM_INT);
                $statement->bindParam(':variable', $variable, PDO::PARAM_STR);
                $statement->execute();
            }
             
            
            $this->conn->commit();
        } catch (Exception $e) {
            $this->conn->rollBack();
            throw new Exception("Error al actualizar el idioma: " . $e->getMessage());
        }
    }

    
    public function deleteLanguageByIso(Idioma $idioma)
    {
        try {
            $this->conn->beginTransaction();
            
            $iso = $idioma->getIso();
            $idiomaModel=new IdiomaModel();
            $idiomaId = $idiomaModel->getIdByIso($idioma);

            
            $this->deleteTranslationsByLanguageId($idiomaId);
            $this->deleteTranslationsByIsoFromTraduccions($iso);
            $this->deleteLanguageFromIdiomes($idiomaId);
            
            $this->conn->commit();
        } catch (Exception $e) {
            $this->conn->rollBack();
            throw new Exception("Error al eliminar el idioma: " . $e->getMessage());
        }
    }

    
    private function deleteTranslationsByIsoFromTraduccions($iso)
    {
        $query = "DELETE FROM tbl_traduccions WHERE variable = :iso";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':iso', $iso, PDO::PARAM_STR);
        $statement->execute();
    }
    
    private function deleteTranslationsByLanguageId($languageId)
    {
        $query = "DELETE FROM tbl_traduccions WHERE idioma_id = :idioma_id";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':idioma_id', $languageId, PDO::PARAM_INT);
        $statement->execute();
    }
    
    private function deleteLanguageFromIdiomes($idiomaId)
    {
        $query = "DELETE FROM tbl_idiomes WHERE id = :idioma_id";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':idioma_id', $idiomaId, PDO::PARAM_INT);
        $statement->execute();
    }
}
?>
