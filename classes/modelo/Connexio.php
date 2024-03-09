<?php

class Connexio extends Singleton
{
    private static $server;
    private static $sgbd;
    private static $dbname;
    private static $user;
    private static $password;
    
    public function __construct($action)
    {
        include 'classes/config/dataBaseData.php';
        
        self::$sgbd = $sgbd;
        self::$dbname = $dbname;
        self::$server = ini_get('mysqli.default_host');
        
        $allowedActions = ['delete', 'insert', 'update', 'select'];
        
        if (!in_array($action, $allowedActions)) {
            throw new Exception("Acción no válida. Solo se permiten 'delete', 'insert', 'update' y 'select'.");
        }
        
        self::setCredentials($action, $selectUser, $selectPassword);
    }
    
    private static function setCredentials($action, $selectUser, $selectPassword)
    {
        if ($action === 'select') {
            self::$user = $selectUser;
            self::$password = $selectPassword;
        } else {
            self::$user = ini_get('mysqli.default_user');
            self::$password = ini_get('mysqli.default_pw');
        }
    }
    
    public static function getSgbd()
    {
        return self::$sgbd;
    }
    
    public static function getDbname()
    {
        return self::$dbname;
    }
    
    public static function getServer()
    {
        return self::$server;
    }
    
    public static function getUser()
    {
        return self::$user;
    }
    
    public static function getPassword()
    {
        return self::$password;
    }
}

?>
