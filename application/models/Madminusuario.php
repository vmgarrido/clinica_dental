<?php

class Madminusuario extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }
    
    public function getCargo(){
        $query = $this->db->query("SELECT * FROM cargos ORDER BY id_cargo");
        
        $options = '';
            
        foreach ($query->result() as $row){
            $options .= '<option value="'.$row->id_cargo.'">'.$row->nombre_cargo.'</option>';
        }
        
        return $options;
    }
    
    public function getEspecialidades(){
        $query = $this->db->query("SELECT * FROM especialidades WHERE activo_esp = TRUE ORDER BY id_especialidad");
        
        $options = '';
            
        foreach ($query->result() as $row){
            $options .= '<option value="'.$row->id_especialidad.'">'.$row->nombre_esp.'</option>';
        }
        
        return $options;
    }
    
    public function getUsuario($rut, $dv){
        $query = $this->db->query("SELECT u.rut_u, u.dv_u, u.nombre_u, u.apellidop_u, u.apellidom_u, u.sexo_u, u.f_nacimiento_u, u.id_comuna, u.calle_u, u.domicilio_u, 
u.dpto_u, u.email_u, u.telefono_u, u.id_cargo, u.activo_u,  
r.id_region, dn.activo_dent 
FROM usuarios u 
LEFT JOIN cargos cr ON cr.id_cargo = u.id_cargo 
INNER JOIN comunas cm ON cm.id_comuna = u.id_comuna 
INNER JOIN regiones r ON r.id_region = cm.id_region 
LEFT JOIN dentistas dn ON dn.rut_u = u.rut_u 
WHERE u.rut_u = '$rut' AND u.dv_u = '$dv'");
        
        return $query->row();
    }
    
    public function registrarUsuario($param){
        
        $this->db->insert("usuarios", $param);
        
        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }
    
    public function modificarUsuario($param, $rut){
        
        
        $this->db->where('rut_u', $rut);
        $this->db->update("usuarios", $param);
        
        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }
    
    public function desactivarUsuario($rut, $param){
        
        $this->db->where('rut_u', $rut);
        $this->db->update("usuarios", $param);
        
        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }
    
    public function activarUsuario($rut, $activo){
        
        $campos = array(
            "activo_u" => $activo
        );
        
        $this->db->where('rut_u', $rut);
        $this->db->update("usuarios", $campos);
        
        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }
}
