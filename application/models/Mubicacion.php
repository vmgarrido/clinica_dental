<?php

class Mubicacion extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }
    
    public function getRegiones(){
        $query = $this->db->query("SELECT * FROM regiones ORDER BY num_region");
        
        $options = '';
            
        foreach ($query->result() as $row){
            $options .= '<option value="'.$row->id_region.'">'.$row->nombre_region.'</option>';
        }
        
        return $options;
    }
    
    public function getComunas($id_region){
        $query = $this->db->query("SELECT c.id_comuna, c.nombre_comuna 
                    FROM comunas c 
                    INNER JOIN regiones r ON c.id_region = r.id_region 
                    WHERE r.id_region = $id_region");
        
        $options = '';
            
        foreach ($query->result() as $row){
            $options .= '<option value="'.$row->id_comuna.'">'.$row->nombre_comuna.'</option>';
        }
        
        return $options;
    }
}