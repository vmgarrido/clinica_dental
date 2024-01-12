<?php

class Madmindentista extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }
    
    public function getEspecialidades(){
        $query = $this->db->query("SELECT * FROM especialidades WHERE activo_esp = TRUE ORDER BY id_especialidad");
        
        $options = '';
            
        foreach ($query->result() as $row){
            $options .= '<option value="'.$row->id_especialidad.'">'.$row->nombre_esp.'</option>';
        }
        
        return $options;
    }
    
    public function getDentista($rut, $dv){
        $query = $this->db->query("SELECT u.rut_u, u.dv_u, u.nombre_u, u.apellidop_u, u.apellidom_u, u.sexo_u, u.f_nacimiento_u, u.id_comuna, u.calle_u, u.domicilio_u, 
u.dpto_u, u.email_u, u.telefono_u, u.id_cargo, u.activo_u,  
r.id_region, dn.activo_dent, dn.id_especialidad, e.nombre_esp, e.activo_esp   
FROM usuarios u 
LEFT JOIN dentistas dn ON dn.rut_u = u.rut_u 
INNER JOIN comunas cm ON cm.id_comuna = u.id_comuna 
INNER JOIN regiones r ON r.id_region = cm.id_region 
LEFT JOIN especialidades e ON dn.id_especialidad = e.id_especialidad 
WHERE u.rut_u = '$rut' AND u.dv_u = '$dv'");
        
        return $query->row();
    }
    
    public function registrarUsuario($param){
        
        $this->db->insert("usuarios", $param);
        
        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }
    
    public function registrarDentista($rut, $especialidad){
        
        $campos = array(
            "rut_u" => $rut,
            "id_especialidad" => $especialidad,
            "activo_dent" => TRUE
        );
        
        $this->db->insert("dentistas", $campos);
        
        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }
    
    public function modificarUsuario($param, $rut){
        
        
        $this->db->where('rut_u', $rut);
        $this->db->update("usuarios", $param);
        
        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }
    
    public function modificarDentista($rut, $param2){
        
        
        $this->db->where('rut_u', $rut);
        $this->db->update("dentistas", $param2);
        
        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }
    
    public function desactivarUsuario($rut, $param){
        
        $this->db->where('rut_u', $rut);
        $this->db->update("usuarios", $param);
        
        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }
    
    public function desactivarDentista($rut, $param2){
        
        $this->db->where('rut_u', $rut);
        $this->db->update("dentistas", $param2);
        
        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }
    
    public function activarUsuario($rut, $param){
        
        $this->db->where('rut_u', $rut);
        $this->db->update("usuarios", $param);
        
        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }
    
    public function activarDentista($rut, $param2){
        
        $this->db->where('rut_u', $rut);
        $this->db->update("dentistas", $param2);
        
        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }

    
}
