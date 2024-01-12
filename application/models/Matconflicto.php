<?php

class Matconflicto extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }

    private function convertFecha($fecha){
        date_default_timezone_set("Chile/Continental");
        $timestamp = strtotime($fecha);
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        $dia = date('d', $timestamp); 
        $mes = date('m', $timestamp) - 1;
        $year = date('Y', $timestamp);

        $fecha = "$dia - " . $meses[$mes] . " - $year";
        return $fecha;
    }

    public function getHoras(){
    	$query = $this->db->query("SELECT ag.fecha, ag.hora_inicio, ag.hora_fin, pa.rut_p ||'-'|| pa.dv_p AS rut_p, 
			pa.nombre_p ||' '|| pa.apellidop_p ||' '|| pa.apellidom_p AS nombre_p, 
			pa.telefono_p, u.nombre_u ||' '|| u.apellidop_u ||' '|| u.apellidom_u AS nombre_u, 
			esp.nombre_esp, trt.tratamiento, bx.num_box, di.nombre_dia, 
			ag.conflicto_box, ag.conflicto_dia, ag.conflicto_dent, ag.conflicto_trt, 
			ag.conflicto_esp, ag.conflicto_at, ag.conflicto_disp, ag.conflicto_horario 
			FROM agenda ag 
			INNER JOIN pacientes pa ON ag.rut_p = pa.rut_p 
			INNER JOIN dentistas dent ON ag.id_dent = dent.id_dent 
			INNER JOIN usuarios u ON dent.rut_u = u.rut_u 
			INNER JOIN especialidades esp ON ag.id_especialidad = esp.id_especialidad 
			INNER JOIN tratamientos trt ON ag.id_trt = trt.id_trt 
			INNER JOIN boxes bx ON ag.id_box = bx.id_box 
			INNER JOIN dias di ON ag.id_dia = di.id_dia 
			WHERE (ag.conflicto_dia = TRUE OR ag.conflicto_at = TRUE 
			OR ag.conflicto_box = TRUE OR ag.conflicto_dent = TRUE 
			OR ag.conflicto_disp = TRUE OR ag.conflicto_esp = TRUE 
			OR ag.conflicto_horario = TRUE OR ag.conflicto_trt = TRUE) 
			AND ag.atendida = FALSE AND ag.activo_ag = TRUE 
			ORDER BY ag.fecha, ag.hora_inicio");
            
        $filas = '';
        foreach ($query->result() as $row){
            $fecha = $this->convertFecha($row->fecha);
            $bloque = date("H:i", strtotime("$row->hora_inicio")).' - '.date("H:i", strtotime("$row->hora_fin"));
            $rut_p = $row->rut_p;
            $nombre_p = $row->nombre_p;
            $telefono_p = $row->telefono_p;
            $dentista = $row->nombre_u;
            $especialidad = $row->nombre_esp;
            $tratamiento = $row->tratamiento;

            $conflictos = '';

            if($row->conflicto_box == "t"){
            	$conflictos .= 'Box '.$row->num_box.'<br>';
            }
            if($row->conflicto_dia == "t"){
            	$conflictos .= 'Día '.$row->nombre_dia.'<br>';
            }
            if($row->conflicto_dent == "t"){
            	$conflictos .= 'Dentista<br>';
            }
            if($row->conflicto_trt == "t"){
            	$conflictos .= 'Tratamiento<br>';
            }
            if($row->conflicto_esp == "t"){
            	$conflictos .= 'Especialidad<br>';
            }
            if($row->conflicto_at == "t"){
            	$conflictos .= 'Atención<br>';
            }
            if($row->conflicto_disp == "t"){
            	$conflictos .= 'Disponibilidad<br>';
            }
            if($row->conflicto_horario == "t"){
            	$conflictos .= 'Horario/Jornada';
            }
            
            $cambiar = '<button type="button" class="btn btn-success btn2" onclick="cambiar();" atencion="10"><i class="fa fa-edit menu-icon"></i></button>';
            
            $eliminar = '<button type="button" class="btn btn-danger btn2" atencion="10"><i class="fa fa-trash menu-icon"></i></button>';
            
            
            $filas .='<tr>';
           	$filas .='<td width="150px">'.$fecha.'</td>';
           	$filas .='<td width="100px">'.$bloque.'</td>';
           	$filas .='<td width="120px">'.$rut_p.'</td>';
           	$filas .='<td width="170px">'.$nombre_p.'</td>';
           	$filas .='<td width="120px">'.$telefono_p.'</td>';
           	$filas .='<td width="170px">'.$dentista.'</td>';
           	$filas .='<td width="120px">'.$especialidad.'</td>';
           	$filas .='<td width="150px">'.$tratamiento.'</td>';
           	$filas .='<td width="120px">'.$conflictos.'</td>';
           	$filas .='<td width="100px">'.$cambiar.' '.$eliminar.'</td>';
           	$filas .='</tr>';
        }
        
        
        return $filas;
    }

}