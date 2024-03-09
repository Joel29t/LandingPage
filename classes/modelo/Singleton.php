<?php


class Singleton
{
   
    private static $instances = [];
    
   
    protected function __construct()
    {}
    
  
    private function __clone()
    {}
    
    
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }
    
   
    public static function getInstance(): static
    {
        $cls = static::class;
        
        return self::$instances[$cls] ??= new static();
    }
    

    public function someBusinessLogic()
    {}
}   

?>