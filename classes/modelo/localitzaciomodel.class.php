<?php
class LocalitzacioModel implements CRUDable {
    
    public function read($obj = null) {
        $db = new DataBase('select');
        $query = "SELECT * FROM tbl_localitzacio";
        $result = $db::executarSQL($query);
        
        return $this->transformarResultat($result);
    }
    
    public function create($obj) {
        $db = new DataBase('insert');
        $query = "INSERT INTO tbl_localitzacio (lloc, adreca, localitat) VALUES (?, ?, ?)";
        $parametres = [$obj->lloc, $obj->adreca, $obj->localitat];
        
        $result = $db::executarSQL($query, $parametres);
        
        return $result !== false;
    }
    
    public function update($obj) {
        $db = new DataBase('update');
        $query = "UPDATE tbl_localitzacio SET lloc = ?, adreca = ?, localitat = ? WHERE id = ?";
        $parametres = [$obj->lloc, $obj->adreca, $obj->localitat, $obj->id];
        
        $result = $db::executarSQL($query, $parametres);
        
        return $result !== false;
    }
    
    public function delete($obj) {
        $db = new DataBase('delete');
        
        // Eliminar entradas asociadas en tbl_entrada
//         $queryEntrades = "DELETE FROM tbl_entrada WHERE loc_id = ?";
//         $parametresEntrades = [$obj->id];
//         $resultEntrades = $db::executarSQL($queryEntrades, $parametresEntrades);
        
        // Eliminar entradas asociadas en rel_concerts
//         $queryRelConcerts = "DELETE FROM rel_concerts WHERE localitzacio_id = ?";
//         $parametresRelConcerts = [$obj->id];
//         $resultRelConcerts = $db::executarSQL($queryRelConcerts, $parametresRelConcerts);
        
        // Eliminar la localitzacio
        $queryLocalitzacio = "DELETE FROM tbl_localitzacio WHERE id = ?";
        $parametresLocalitzacio = [$obj->id];
        $resultLocalitzacio = $db::executarSQL($queryLocalitzacio, $parametresLocalitzacio);
        
        return $resultLocalitzacio !== false;
    }
    
    
    public function getById(Localitzacio $obj) {
        $db = new DataBase('select');
        $query = "SELECT * FROM tbl_localitzacio WHERE id = ?";
        $result = $db::executarSQL($query, [$obj->id]);
        
        return (!empty($result)) ? $this->crearLocalitzacioDesdeFila($result[0]) : null;
    }
    
    // transformar obj
    private function transformarResultat($result) {
        $localitzacions = [];
        foreach ($result as $row) {
            $localitzacions[] = $this->crearLocalitzacioDesdeFila($row);
        }
        
        return $localitzacions;
    }
    
    private function crearLocalitzacioDesdeFila($fila) {
        return new Localitzacio(
            $fila['id'],
            $fila['lloc'],
            $fila['adreca'],
            $fila['localitat']
            );
    }
}
