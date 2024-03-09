<?php
class PagamentModel implements CRUDable {
    
    public function read($obj = null) {
        $db = new DataBase('select');
        $query = "SELECT * FROM tbl_pagament";
        $result = $db::executarSQL($query);
        
        return $this->transformarResultat($result);
    }
    
    public function create($obj) {
        $db = new DataBase('insert');
        $query = "INSERT INTO tbl_pagament (banc, ref_externa, data, estat) VALUES (?, ?, ?, ?)";
        $parametres = [$obj->banc, $obj->ref_externa, $obj->data, $obj->estat];
        
        $result = $db::executarSQL($query, $parametres);
        
        return $result !== false;
    }
    
    public function update($obj) {
        $db = new DataBase('update');
        $query = "UPDATE tbl_pagament SET banc = ?, ref_externa = ?, data = ?, estat = ? WHERE id = ?";
        $parametres = [$obj->banc, $obj->ref_externa, $obj->data, $obj->estat, $obj->id];
        
        $result = $db::executarSQL($query, $parametres);
        
        return $result !== false;
    }
    
    public function delete($obj) {
        $db = new DataBase('delete');
        
        // Verificar y eliminar entradas asociadas
//         $queryEntradas = "DELETE FROM tbl_entrada WHERE pagament_id = ?";
//         $parametresEntradas = [$obj->id];
//         $resultEntradas = $db::executarSQL($queryEntradas, $parametresEntradas);
        
        // Verificar y eliminar el pago
        $queryPagament = "DELETE FROM tbl_pagament WHERE id = ?";
        $parametresPagament = [$obj->id];
        $resultPagament = $db::executarSQL($queryPagament, $parametresPagament);
        
        return $resultPagament !== false;
    }
    
    
    public function getById(Pagament $obj) {
        $db = new DataBase('select');
        $query = "SELECT * FROM tbl_pagament WHERE id = ?";
        $result = $db::executarSQL($query, [$obj->id]);
        
        return (!empty($result)) ? $this->crearPagamentDesdeFila($result[0]) : null;
    }
    
    private function transformarResultat($result) {
        $pagaments = [];
        foreach ($result as $row) {
            $pagaments[] = $this->crearPagamentDesdeFila($row);
        }
        
        return $pagaments;
    }
    
    private function crearPagamentDesdeFila($fila) {
        return new Pagament(
            $fila['id'],
            $fila['banc'],
            $fila['ref_externa'],
            $fila['data'],
            $fila['estat']
            );
    }
}