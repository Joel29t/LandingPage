<?php

class DataModel implements CRUDable {
    
    public function read($obj = null) {
        $db = new DataBase('select');
        $query = "SELECT * FROM tbl_data";
        $result = $db::executarSQL($query);
        
        return $this->transformarResultat($result);
    }
    
    public function create($obj) {
        $db = new DataBase('insert');
        $query = "INSERT INTO tbl_data (data, hora) VALUES (?, ?)";
        $parametres = [$obj->data, $obj->hora];
        
        $result = $db::executarSQL($query, $parametres);
        
        return $result !== false;
    }
    
    public function update($obj) {
        $db = new DataBase('update');
        $query = "UPDATE tbl_data SET data = ?, hora = ? WHERE id = ?";
        $parametres = [$obj->data, $obj->hora, $obj->id];
        
        $result = $db::executarSQL($query, $parametres);
        
        return $result !== false;
    }
    
    public function delete($obj) {
        $db = new DataBase('delete');
        
        // Eliminar entradas asociadas en tbl_entrada
//         $queryEntrades = "DELETE FROM tbl_entrada WHERE data_id = ?";
//         $parametresEntrades = [$obj->id];
//         $resultEntrades = $db::executarSQL($queryEntrades, $parametresEntrades);
        
        // Eliminar entradas asociadas en rel_concerts
//         $queryRelConcerts = "DELETE FROM rel_concerts WHERE data_id = ?";
//         $parametresRelConcerts = [$obj->id];
//         $resultRelConcerts = $db::executarSQL($queryRelConcerts, $parametresRelConcerts);
        
        // Eliminar la data
        $queryData = "DELETE FROM tbl_data WHERE id = ?";
        $parametresData = [$obj->id];
        $resultData = $db::executarSQL($queryData, $parametresData);
        
        return $resultData !== false;
    }
    
    public function getById(Data $obj) {
        $db = new DataBase('select');
        $query = "SELECT * FROM tbl_data WHERE id = ?";
        $result = $db::executarSQL($query, [$obj->id]);
        
        return (!empty($result)) ? $this->crearDataDesdeFila($result[0]) : null;
    }
    
    // Transformar obj
    private function transformarResultat($result) {
        $dades = [];
        foreach ($result as $row) {
            $dades[] = $this->crearDataDesdeFila($row);
        }
        
        return $dades;
    }
    
    private function crearDataDesdeFila($fila) {
        return new Data(
            $fila['id'],
            $fila['data'],
            $fila['hora']
            );
    }
}

?>
