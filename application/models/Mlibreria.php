<?php

class Mlibreria extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }
    
    public function saber_dia($nombredia) {
        $dias = array('', 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado', 'Domingo');
        $fecha = $dias[date('N', strtotime($nombredia))];
        return $fecha;
    }
    
    public function fechaSuperior($fecha){
        date_default_timezone_set("Chile/Continental");
        $hoy = date("Y-m-d");
        
        if($hoy >= $fecha){
            return false;
        } else {
            return true;
        }
    }

    public function fechaSuperior2($fecha){
        date_default_timezone_set("Chile/Continental");
        $hoy = date("Y-m-d");
        $fecha2 = new DateTime($fecha);
        
        if($fecha2->format('Y-m-d') >= $hoy){
            return "1";
        } else {
            return "0";
        }
    }

    public function validarRut($rut){
        $rut = preg_replace('/[^k0-9]/i', '', $rut);
        $dv  = substr($rut, -1);
        $numero = substr($rut, 0, strlen($rut)-1);
        $i = 2;
        $suma = 0;
        foreach(array_reverse(str_split($numero)) as $v)
        {
            if($i==8)
                $i = 2;
            $suma += $v * $i;
            ++$i;
        }
        $dvr = 11 - ($suma % 11);
        
        if($dvr == 11)
            $dvr = 0;
        if($dvr == 10)
            $dvr = 'K';
        if($dvr == strtoupper($dv))
            return "1";
        else
            return "0";
    }

    public function existeUsuario($rut, $dv, $pass){
        $query = $this->db->query("SELECT u.rut_u, u.dv_u, u.nombre_u, u.apellidop_u, u.apellidom_u, d.activo_dent, d.id_dent, ca.nombre_cargo, esp.id_especialidad FROM usuarios u 
        LEFT JOIN cargos ca ON u.id_cargo = ca.id_cargo 
        LEFT JOIN dentistas d ON u.rut_u = d.rut_u 
        LEFT JOIN especialidades esp ON d.id_especialidad = esp.id_especialidad 
        WHERE u.rut_u = '$rut' AND u.dv_u = '$dv' AND u.pass_u = '$pass' 
        AND u.activo_u = TRUE LIMIT 1;");

        if($query->num_rows() == 0){
            return "0";
        } else{
            $r = $query->row();

            $cargo = ($r->activo_dent != "t") ? $r->nombre_cargo : "Dentista";
            $id_esp = ($r->id_especialidad == NULL) ? 0 : $r->id_especialidad;
            $dent = ($r->id_dent == NULL) ? "0" : $r->id_dent;

            $s_usuario = array(
				's_rut' => $r->rut_u,
                's_dv' => $r->dv_u,
                's_nombre' => $r->nombre_u.' '.$r->apellidop_u.' '.$r->apellidom_u,
                's_cargo' => $cargo,
                's_id_dent' => $dent,
                's_id_esp' => $id_esp
                );
                
            $this->session->set_userdata($s_usuario);

            return "1";
        }
    }
}
