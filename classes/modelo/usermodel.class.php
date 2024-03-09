<?php

class UserModel implements CRUDable
{
    private $db;
    
    public function __construct()
    {
       
    }
    public function connect($action) {
        $server = "localhost";
        $dbname = "myweb";
        
        $usuarios = [
            'select' => 'usr_consulta',
            'insert' => 'usr_generic',
            'update' => 'usr_generic'
        ];
        
        $contrasenas = [
            'select' => '2024@Thos',
            'insert' => '2024@Thos',
            'update' => '2024@Thos'
        ];
        
        if (!isset($usuarios[$action]) || !isset($contrasenas[$action])) {
            throw new Exception("Acción no válida");
        }
        
        $user = $usuarios[$action];
        $password = $contrasenas[$action];
        
        $this->db = new mysqli($server, $user, $password, $dbname);
        
        if ($this->db->connect_error) {
            throw new Exception("La conexión ha fallado, error número " . $this->db->connect_errno . ": " . $this->db->connect_error);
        }
    }
    
    
    public function create($user)
    {
        if ($this->emailExists($user->getEmail())) {
            return false;
        }
        
        $this->connect('insert');
        
        $email = $user->getEmail();
        $password = $user->getPassword();
        $tipusIdent = $user->getTipusIdent();
        $numeroIdent = $user->getNumeroIdent();
        $nom = $user->getNombre();  
        $cognoms = $user->getApellidos();  
        $sexe = $user->getSexo();
        $naixement = $user->getFechaNacimiento(); 
        $adreca = $user->getDireccion(); 
        $codiPostal = $user->getCodigoPostal(); 
        $poblacio = $user->getPoblacion();  
        $provincia = $user->getProvincia();
        $telefon = $user->getTelefono();
        $imatge = $user->getHoraEnMs();  
        $status = $user->getStatus();
        $navegador = $user->getNavegador();
        $plataforma = $user->getPlataforma();
        
        $stmt = $this->db->prepare("INSERT INTO tbl_usuaris (email, password, tipusIdent, numeroIdent, nom, cognoms, sexe, naixement, adreca, codiPostal, poblacio, provincia, telefon, imatge, status, navegador, plataforma) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Forma 1: Repetir bind_param("s", $valor) n veces
        
        // No funciona aquesta manera
//         $stmt->bind_param('s', $email);
//         $stmt->bind_param('s', $password);
//         $stmt->bind_param('s', $tipusIdent);
//         $stmt->bind_param('s', $numeroIdent);
//         $stmt->bind_param('s', $nom);
//         $stmt->bind_param('s', $cognoms);
//         $stmt->bind_param('s', $sexe);
//         $stmt->bind_param('s', $naixement);
//         $stmt->bind_param('s', $adreca);
//         $stmt->bind_param('s', $codiPostal);
//         $stmt->bind_param('s', $poblacio);
//         $stmt->bind_param('s', $provincia);
//         $stmt->bind_param('s', $telefon);
//         $stmt->bind_param('s', $imatge);
//         $stmt->bind_param('s', $status);
//         $stmt->bind_param('s', $navegador);
//         $stmt->bind_param('s', $plataforma);
//         $stmt->execute();
        
      
         // Forma 2: Un solo bind_param con múltiples parámetros
         $stmt->bind_param('sssssssssssssssss', $email, $password, $tipusIdent, $numeroIdent, $nom, $cognoms, $sexe, $naixement, $adreca, $codiPostal, $poblacio, $provincia, $telefon, $imatge, $status, $navegador, $plataforma);
         $stmt->execute();
              
      
         // Forma 3: Utilizar un array con call_user_func_array
//         $params = [$email, $password, $tipusIdent, $numeroIdent, $nom, $cognoms, $sexe, $naixement, $adreca, $codiPostal, $poblacio, $provincia, $telefon, $imatge, $status, $navegador, $plataforma];
//         $types = str_repeat('s', count($params));
        
//         $refs = [];
//         foreach ($params as $key => $value) {
//             $refs[$key] = &$params[$key];
//         }

//         array_unshift($refs, $types);
        
//         call_user_func_array([$stmt, 'bind_param'], $refs);
        
//         $stmt->execute();
        
   
         // Forma 4: Utilizar la función call_user_func_array
 
//         $params = [$email, $password, $tipusIdent, $numeroIdent, $nom, $cognoms, $sexe, $naixement, $adreca, $codiPostal, $poblacio, $provincia, $telefon, $imatge, $status, $navegador, $plataforma];
//         $types = str_repeat('s', count($params));
        
//         array_unshift($params, $types);
        
//         call_user_func_array([$stmt, 'bind_param'], $this->refValues($params));
//         $stmt->execute();


         // Forma 5: Pasando parámetros directamente a execute
//          $stmt->execute([$email, $password, $tipusIdent, $numeroIdent, $nom, $cognoms, $sexe, $naixement, $adreca, $codiPostal, $poblacio, $provincia, $telefon, $imatge, $status, $navegador, $plataforma]);
      
        
        $last_id = mysqli_insert_id($this->db);
        
        if ($stmt->error) {
            throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
        }

        $stmt->close();
        return $last_id;
    }
    private function refValues($arr) {
        $refs = [];
        foreach ($arr as $key => $value) {
            $refs[$key] = &$arr[$key];
        }
        return $refs;
    }
    private function emailExists($email)
    {
        $this->connect('select');
        
        $stmt = $this->db->prepare("SELECT id FROM tbl_usuaris WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        $stmt->close();
        
        return ($user !== null);
    }
    
    public function read($user)
    {
        $this->connect('select');
        
        $email = $user->getEmail();
        $password = $user->getPassword();
        
        $stmt = $this->db->prepare("SELECT * FROM tbl_usuaris WHERE email = ? and password = ?");
        $stmt->bind_param('ss', $email, $password);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        $stmt->close();
        
        if ($user) {   
             return $user;
        }

        return false;
    }
    
    public function update($userId){
        $this->connect('update');
       
        $stmt =  $this->db->prepare("UPDATE tbl_usuaris SET status = 1 WHERE id = ?");

        $stmt->bind_param('i', $userId);
        
        $stmt->execute();
        
        if ($stmt->error) {
            throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
        }
        
        $stmt->close();
    }
    
    public function updateDarrerAcces($user){
        $this->connect('update');
        
        $email = $user->getEmail();
        
        date_default_timezone_set('Europe/Madrid');
        
        $date = date("Y-m-d H:i:s");
        
        $stmt =  $this->db->prepare("UPDATE tbl_usuaris SET dataDarrerAcces = ? WHERE email = ?");
        
        $stmt->bind_param('ss', $date, $email);
        
        $stmt->execute();
        
        if ($stmt->error) {
            throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
        }
        
        $stmt->close();
    }
    
    public function delete($user){}
}
