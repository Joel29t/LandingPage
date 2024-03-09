<?php
class ZonaModel implements CRUDable {
    
    public function read($obj = null) {
        $db = new DataBase('select');
        $query = "SELECT * FROM tbl_zona";
        $result = $db::executarSQL($query);
        
        return $this->transformarResultat($result);
    }
    
    public function create($obj) {
        $db = new DataBase('insert');
        $query = "INSERT INTO tbl_zona (descripcio) VALUES (?)";
        $parametres = [$obj->descripcio];
        
        $result = $db::executarSQL($query, $parametres);
        
        return $result !== false;
    }
    
    public function update($obj) {
        $db = new DataBase('update');
        $query = "UPDATE tbl_zona SET descripcio = ? WHERE id = ?";
        $parametres = [$obj->descripcio, $obj->id];
        
        $result = $db::executarSQL($query, $parametres);
        
        return $result !== false;
    }
    
    public function delete($obj) {
        $db = new DataBase('delete');
        
        // Verificar y eliminar entradas asociadas
//         $queryEntrades = "DELETE FROM tbl_entrada WHERE zona_id = ?";
//         $parametresEntrades = [$obj->id];
//         $resultEntrades = $db::executarSQL($queryEntrades, $parametresEntrades);
 
        // Eliminar la zona
        $queryZona = "DELETE FROM tbl_zona WHERE id = ?";
        $parametresZona = [$obj->id];
        $resultZona = $db::executarSQL($queryZona, $parametresZona);

        return $resultZona !== false;
    }
    
    public function getById(Zona $obj) {
        $db = new DataBase('select');
        $query = "SELECT * FROM tbl_zona WHERE id = ?";
        $result = $db::executarSQL($query, [$obj->id]);
        
        return (!empty($result)) ? $this->crearZonaDesdeFila($result[0]) : null;
    }
    
    // Transformar obj
    private function transformarResultat($result) {
        $zones = [];
        foreach ($result as $row) {
            $zones[] = $this->crearZonaDesdeFila($row);
        }
        
        return $zones;
    }
    
    private function crearZonaDesdeFila($fila) {
        return new Zona(
            $fila['id'],
            $fila['descripcio']
            );
    }
}
?>
