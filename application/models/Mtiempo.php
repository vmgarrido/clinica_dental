<?php

class Mtiempo extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }
    
    public function getDiasActivos($joranada){
        $query = $this->db->query("SELECT d.id_dia, d.nombre_dia 
                                    FROM dias d 
                                    INNER JOIN dias_horario dh ON d.id_dia = dh.id_dia 
                                    INNER JOIN horarios_trabajo ht ON dh.id_horario = ht.id_horario 
                                    WHERE ht.id_horario = $joranada 
                                    ORDER BY d.num_dia ");
        
        $options = '';
            
        foreach ($query->result() as $row){
            $options .= '<option value="'.$row->id_dia.'">'.$row->nombre_dia.'</option>';
        }
        
        return $options;
    }
    
    public function getHorarios(){
        date_default_timezone_set("Chile/Continental");
        $hoy = date("Y-m-d");
        $query1 = $this->db->query("SELECT ht.id_horario, ht.fecha_inicio 
                        FROM horarios_trabajo ht 
                        WHERE (ht.fecha_inicio <= '$hoy') 
                        AND (SELECT '$hoy' < ht.fecha_fin OR ht.fecha_fin IS NULL) 
                        AND ht.activo_h = TRUE 
                        ORDER BY ht.fecha_inicio ASC");
        $options = '';
            
        foreach ($query1->result() as $row){
            $options .= '<option value="'.$row->id_horario.'">Jornada actual - '.$row->fecha_inicio.'</option>';
        }
        
        $query2 = $this->db->query("SELECT ht.id_horario, ht.fecha_inicio 
                    FROM horarios_trabajo ht 
                    WHERE (ht.fecha_inicio > '$hoy') 
                    AND (SELECT '$hoy' < ht.fecha_fin OR ht.fecha_fin IS NULL) 
                    AND ht.activo_h = TRUE 
                    ORDER BY ht.fecha_inicio ASC");
        
        foreach ($query2->result() as $row){
            $options .= '<option value="'.$row->id_horario.'">Nueva jornada - '.$row->fecha_inicio.'</option>';
        }
        
        return $options;
        
    }
    
    public function getBloques1($jornada, $dia){
        
        $query = $this->db->query("SELECT dh.hora_inicio, dh.hora_fin, ht.duracion_bloque 
                                    FROM horarios_trabajo ht 
                                    INNER JOIN dias_horario dh ON ht.id_horario = dh.id_horario 
                                    WHERE ht.id_horario = $jornada AND dh.id_dia = $dia LIMIT 1");
        
        foreach ($query->result() as $row){
            $hora_inicio = date("H:i", strtotime("$row->hora_inicio"));
            $hora_fin = date("H:i", strtotime("$row->hora_fin"));
            $duracion = $row->duracion_bloque;
        }
        
        

        $fila = '';
        while ($hora_inicio < $hora_fin){
            $bloque = $hora_inicio;
            $hora_inicio = date("H:i", strtotime ( '+'.$duracion.' minute' , strtotime ( $hora_inicio ) )) ;
            

            if($hora_inicio <= $hora_fin){
                $fila .= '<option value="'.$bloque.'">'.$bloque.'</option>';
            }
        }
        
        return $fila;
        
    }
    
    public function getBloques2($jornada, $dia, $hi){
        
        $query = $this->db->query("SELECT dh.hora_inicio, dh.hora_fin, ht.duracion_bloque 
                                    FROM horarios_trabajo ht 
                                    INNER JOIN dias_horario dh ON ht.id_horario = dh.id_horario 
                                    WHERE ht.id_horario = $jornada AND dh.id_dia = $dia LIMIT 1");
        
        foreach ($query->result() as $row){
            $hora_inicio = date("H:i", strtotime("$hi"));
            $hora_fin = date("H:i", strtotime("$row->hora_fin"));
            $duracion = $row->duracion_bloque;
        }
        
        

        $fila = '';
        while ($hora_inicio < $hora_fin){
            $bloque = $hora_inicio;
            $hora_inicio = date("H:i", strtotime ( '+'.$duracion.' minute' , strtotime ( $hora_inicio ) )) ;
            

            if($hora_inicio <= $hora_fin){
                $fila .= '<option value="'.$hora_inicio.'">'.$hora_inicio.'</option>';
            }
        }
        
        return $fila;
        
    }
    
    public function getTresSemanas(){
        date_default_timezone_set("Chile/Continental");
        $date = new DateTime();
        $date->format('Y-m-d');

        if($this->getDia($date->format('Y-m-d')) == "Domingo"){
            $date->modify('next monday');
            $option = '<option value="'.$date->format('Y-m-d').'">Semana Actual</option>';
        } else {
            $option = '<option value="'.$date->format('Y-m-d').'">Semana Actual</option>';
        }
        
        for($i=2; $i<=4; $i++){
            $date->modify('next monday');
            $option .= '<option value="'.$date->format('Y-m-d').'">Semana '.$i.'</option>';
        }
        
        return $option;
    }
    
    private function getDia($fecha){
        

        $dias = array('', 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado', 'Domingo');

        $fecha = $dias[date('N', strtotime($fecha))];
        
        return $fecha;

        
    }
}