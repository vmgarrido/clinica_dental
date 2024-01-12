<?php

class Madminpaciente extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }
    
    // cargar regiones comunas tipo_paciente e isapres
    
    
    public function getTipoPaciente(){
        $query = $this->db->query("SELECT * FROM tipo_pacientes WHERE activo_tipo = TRUE");
        
        $options = '';
            
        foreach ($query->result() as $row){
            $options .= '<option value="'.$row->id_tp.'">'.$row->tipo.'</option>';
        }
        
        return $options;
    }
    
    public function getIsapres($id_tp){
        $query = $this->db->query("SELECT * FROM isapres WHERE id_tp = $id_tp AND activo_isapre = TRUE");
        
        $options = '';
            
        foreach ($query->result() as $row){
            $options .= '<option value="'.$row->id_isapre.'">'.$row->isapre.'</option>';
        }
        
        return $options;
    }
    // fin cargar regiones comunas tipo_paciente e isapres
    
    public function getPaciente($rut, $dv){
        $query = $this->db->query("SELECT p.rut_p, p.dv_p, p.nombre_p, p.apellidop_p, p.apellidom_p, p.sexo_p, 
                    p.f_nacimiento_p, r.id_region, c.id_comuna, p.calle_p, p.domicilio_p, p.dpto_p, 
                    p.telefono_p, p.activo_p, p.id_tp, p.id_isapre, 
                    tp.tipo, tp.activo_tipo, i.isapre, i.activo_isapre 
                    FROM pacientes p 
                    INNER JOIN comunas c ON p.id_comuna = c.id_comuna 
                    INNER JOIN regiones r ON c.id_region = r.id_region 
                    INNER JOIN tipo_pacientes tp ON p.id_tp = tp.id_tp 
                    LEFT JOIN isapres i ON p.id_isapre = i.id_isapre 
                    WHERE p.rut_p = '$rut' AND p.dv_p = '$dv'");
        
        return $query->row();
    }
    
    public function registrarPaciente($param){
        $campos = array(
            "rut_p" => $param['rut_p'],
            "dv_p" => $param['dv_p'],
            "nombre_p" => $param['nombre_p'],
            "apellidop_p" => $param['apellidop_p'],
            "apellidom_p" => $param['apellidom_p'],
            "sexo_p" => $param['sexo_p'],
            "f_nacimiento_p" => $param['f_nacimiento_p'],
            "id_comuna" => $param['id_comuna'],
            "calle_p" => $param['calle_p'],
            "domicilio_p" => $param['domicilio_p'],
            "dpto_p" => $param['dpto_p'],
            "telefono_p" => $param['telefono_p'],
            "id_tp" => $param['id_tp'],
            "id_isapre" => $param['id_isapre'],
            "activo_p" => $param['activo_p']
            
        );
        
        $this->db->insert("pacientes", $campos);
        
        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }
    
    public function modificarPaciente($param, $rut, $dv){
        $campos = array(
            "nombre_p" => $param['nombre_p'],
            "apellidop_p" => $param['apellidop_p'],
            "apellidom_p" => $param['apellidom_p'],
            "sexo_p" => $param['sexo_p'],
            "f_nacimiento_p" => $param['f_nacimiento_p'],
            "id_comuna" => $param['id_comuna'],
            "calle_p" => $param['calle_p'],
            "domicilio_p" => $param['domicilio_p'],
            "dpto_p" => $param['dpto_p'],
            "telefono_p" => $param['telefono_p'],
            "id_tp" => $param['id_tp'],
            "id_isapre" => $param['id_isapre']
        );
        
        $this->db->where('rut_p', $rut);
        $this->db->update("pacientes", $campos);
        
        
        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }
    
    public function desactivarPaciente($param, $rut){
        $campos = array(
            "activo_p" => $param['activo_p']
        );
        
        $this->db->where('rut_p', $rut);
        $this->db->update("pacientes", $campos);
        
        
        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }
    
    public function activarPaciente($param, $rut){
        $campos = array(
            "activo_p" => $param['activo_p']
        );
        
        $this->db->where('rut_p', $rut);
        $this->db->update("pacientes", $campos);
        
        
        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }
}
