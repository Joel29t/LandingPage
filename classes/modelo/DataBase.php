<?php

class DataBase extends Singleton
{

    private static $link;

    private static $conexion;

    public function __construct($action)
    {
        parent::__construct();
        self::$conexion = new Connexio($action);
        self::connectToDatabase();
    }

    private static function connectToDatabase()
    {
        switch (self::$conexion->getSgbd()) {
            case 'mysql':
                self::$link = new mysqli(self::$conexion->getServer(), self::$conexion->getUser(), self::$conexion->getPassword(), self::$conexion->getDbname());
                if (self::$link->connect_error) {
                    throw new Exception("Error de conexión: " . self::$link->connect_error);
                }
                break;
            case 'pgsql':
                break;
            case 'oracle':
                break;
            case 'mongodb':
                break;
            default:
                throw new Exception("SGBD no compatible.");
        }
    }

    public function __destruct()
    {
        if (self::$link) {
            self::$link->close();
        }
    }

    public static function executarSQL($sSql, $aParam = null)
    {
        if ($stmt = self::$link->prepare($sSql)) {
            if (!empty($aParam)) {
                $types = str_repeat('s', count($aParam));
                $stmt->bind_param($types, ...$aParam);
            }
            if ($stmt->execute()) {
                if ($stmt->field_count > 0) {

                    $res = $stmt->get_result();
                    $dades = $res->fetch_all(MYSQLI_ASSOC);
                } else {
                  
                    $dades = true; 
                }
            } else {
                throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
            }
            $stmt->close();
        } else {
            throw new Exception("Error en la preparación de la consulta: " . self::$link->error);
        }
        return $dades;
    }
    
    

    public static function getLink()
    {
        return self::$link;
    }

    private function __clone()
    {}
}

?>