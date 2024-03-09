<?php
class EntradaModel implements CRUDable {
    
    public function read($obj = null) {
        $db = new DataBase('select');
        $query = "SELECT * FROM tbl_entrada";
        $result = $db::executarSQL($query);
        
        return $this->transformarResultat($result);
    }
    
    public function create($obj) {
        $db = new DataBase('insert');
        $query = "INSERT INTO tbl_entrada (esdeveniment_id, data_id, loc_id, zona_id, pagament_id, id, fila, butaca, dni) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $parametres = [$obj->esdeveniment_id, $obj->data_id, $obj->loc_id, $obj->zona_id, $obj->pagament_id, $obj->id, $obj->fila, $obj->butaca, $obj->dni];
        
        $result = $db::executarSQL($query, $parametres);
        
        return $result !== false;
    }
    
    public function update($obj) {
        $db = new DataBase('update');
        $query = "UPDATE tbl_entrada SET esdeveniment_id = ?, data_id = ?, loc_id = ?, zona_id = ?, pagament_id = ?, fila = ?, butaca = ?, dni = ? WHERE id = ?";
        $parametres = [$obj->esdeveniment_id, $obj->data_id, $obj->loc_id, $obj->zona_id, $obj->pagament_id, $obj->fila, $obj->butaca, $obj->dni, $obj->id];
        
        $result = $db::executarSQL($query, $parametres);
        
        return $result !== false;
    }
    
    public function delete($obj) {
        $db = new DataBase('delete');
        
        // Eliminar la entrada
        $queryEntrada = "DELETE FROM tbl_entrada WHERE id = ?";
        $parametresEntrada = [$obj->id];
        $resultEntrada = $db::executarSQL($queryEntrada, $parametresEntrada);
        
        return $resultEntrada !== false;
    }
    
    public function getById($obj) {
        $db = new DataBase('select');
        $query = "SELECT * FROM tbl_entrada WHERE id = ?";
        $result = $db::executarSQL($query, [$obj->id]);
        
        return (!empty($result)) ? $this->crearEntradaDesdeFila($result[0]) : null;
    }
    
    // Transformar obj
    private function transformarResultat($result) {
        $entrades = [];
        foreach ($result as $row) {
            $entrades[] = $this->crearEntradaDesdeFila($row);
        }
        
        return $entrades;
    }
    
    private function crearEntradaDesdeFila($fila) {
        return new Entrada(
            $fila['esdeveniment_id'],
            $fila['data_id'],
            $fila['loc_id'],
            $fila['zona_id'],
            $fila['pagament_id'],
            $fila['id'],
            $fila['fila'],
            $fila['butaca'],
            $fila['dni']
            );
    }
}
?>