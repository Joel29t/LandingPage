<?php
class EsdevenimentModel implements CRUDable {
    
    public function read($obj = null) {
        $db = new DataBase('select');
        $query = "SELECT * FROM tbl_esdeveniment";
        $result = $db::executarSQL($query);
        
        return $this->transformarResultat($result);
    }
    
    public function create($obj) {
        $db = new DataBase('insert');
        $query = "INSERT INTO tbl_esdeveniment (titol, subtitol, dates, imatge) VALUES (?, ?, ?, ?)";
        $parametres = [$obj->titol, $obj->subtitol, $obj->dates, $obj->imatge];
        
        $result = $db::executarSQL($query, $parametres);
        
        return $result !== false;
    }
    
    public function update($obj) {
        $db = new DataBase('update');
        $query = "UPDATE tbl_esdeveniment SET titol = ?, subtitol = ?, dates = ?, imatge = ? WHERE id = ?";
        $parametres = [$obj->titol, $obj->subtitol, $obj->dates, $obj->imatge, $obj->id];
        
        $result = $db::executarSQL($query, $parametres);
         
        return $result !== false;
    }
    
    public function delete($obj) {
        $db = new DataBase('delete');
        
        // Verificar y eliminar entradas asociadas
//         $queryEntrades = "DELETE FROM tbl_entrada WHERE esdeveniment_id = ?";
//         $parametresEntrades = [$obj->id];
//         $resultEntrades = $db::executarSQL($queryEntrades, $parametresEntrades);
        
        // Verificar y eliminar entradas asociadas en rel_concerts
//         $queryRelConcerts = "DELETE FROM rel_concerts WHERE esdeveniment_id = ?";
//         $parametresRelConcerts = [$obj->id];
//         $resultRelConcerts = $db::executarSQL($queryRelConcerts, $parametresRelConcerts);
        
        // Verificar y eliminar el esdeveniment
        $queryEsdeveniment = "DELETE FROM tbl_esdeveniment WHERE id = ?";
        $parametresEsdeveniment = [$obj->id];
        $resultEsdeveniment = $db::executarSQL($queryEsdeveniment, $parametresEsdeveniment);
        
        return $resultEsdeveniment !== false;
    }

    
    public function getById($obj) {
        $db = new DataBase('select');
        $query = "SELECT * FROM tbl_esdeveniment WHERE id = ?";
        $result = $db::executarSQL($query, [$obj->id]);
        
        return (!empty($result)) ? $this->crearEsdevenimentDesdeFila($result[0]) : null;
    }
    
    
    // transformar obj
    private function transformarResultat($result) {
        $esdeveniments = [];
        foreach ($result as $row) {
            $esdeveniments[] = $this->crearEsdevenimentDesdeFila($row);
        }
        
        return $esdeveniments;
    }
    
    private function crearEsdevenimentDesdeFila($fila) {
        return new Esdeveniment(
            $fila['id'],
            $fila['titol'],
            $fila['subtitol'],
            $fila['dates'],
            $fila['imatge']
            );
    }
}
