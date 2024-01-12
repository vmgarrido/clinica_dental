<?php

class Mregistraratencion extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }
    
    private function numDay($fecha){
        

        $dias = array('', 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado', 'Domingo');

        $fecha = $dias[date('N', strtotime($fecha))];

        switch ($fecha) {
            case "Lunes":
                $res = 1;
                break;
            case "Martes":
                $res = 2;
                break;
            case "Miercoles":
                $res = 3;
                break;
            case "Jueves":
                $res = 4;
                break;
            case "Viernes":
                $res = 5;
                break;
            case "Sabado":
                $res = 6;
                break;
        }
        
        return $res;

        
    }
    
    private function newDate($newDay, $date){
        
        switch ($newDay) {
            case "1":
                $res = $date->modify('next monday');
                break;
            case "2":
                $res = $date->modify('next tuesday');
                break;
            case "3":
                $res = $date->modify('next Wednesday');
                break;
            case "4":
                $res = $date->modify('next Thursday');
                break;
            case "5":
                $res = $date->modify('next friday');
                break;
            case "6":
                $res = $date->modify('next saturday');
                break;
        }
        
        return $res;
        
    }
    
    
    public function cargarAgenda($id_esp, $id_dent, $semana){

        //----------------- Inicio get id horario
        $queryHorario = $this->db->query("SELECT id_horario, duracion_bloque 
                        FROM horarios_trabajo ht 
                        WHERE activo_h = TRUE AND fecha_inicio <= '$semana' AND 
                        (fecha_fin > '$semana' OR fecha_fin IS NULL)");
        
        
        foreach ($queryHorario->result() as $row){
            $jornada = $row->id_horario;
            $duracion = $row->duracion_bloque;
        }
        //----------------- Inicio fin id horario
        
        
        //----------------- Inicio comprobar disponibilidad existente
        $queryDisp = $this->db->query("SELECT COUNT(*) AS cuenta
                        FROM disponibilidad 
                        WHERE activo_disp = TRUE 
                        AND id_horario = $jornada AND id_dent = $id_dent AND id_especialidad = $id_esp 
                        AND conflicto_dia = FALSE AND conflicto_box = FALSE");
        
        
        foreach ($queryDisp->result() as $row){
            $cuenta = $row->cuenta;
        }
        
        if ($cuenta == "0"){
            $arrFinal = array("head"=>"", "body"=>"No tiene disponibilidad registrada", "jornada"=>$jornada);
            return $arrFinal;
        }

        //----------------- Fin comprobar disponibilidad existente
        
        // Array final para retornar
        $arrFinal = array();
        
        
        //----------------- Inicio obtener días
        date_default_timezone_set("Chile/Continental");
        $date = new DateTime($semana);
        
        $day = $this->numDay($date->format('Y-m-d'));
        
        $queryDias = $this->db->query("SELECT da.id_dia, da.nombre_dia, da.num_dia 
                        FROM disponibilidad d 
                        INNER JOIN dias da ON d.id_dia = da.id_dia 
                        WHERE d.id_dent = $id_dent AND d.id_horario = $jornada AND da.num_dia >= $day 
                        AND d.activo_disp = TRUE 
                        GROUP BY da.id_dia 
                        ORDER BY da.num_dia");
        
        $arrDias = array();
        $headTable = '<th class="info">Bloques</th>';
        
        $flag = false;
        $date22 = null;
        //$date22 = new DateTime('2018-05-03');
        foreach ($queryDias->result() as $row){
            
            $newDay = (int)$row->num_dia;
            
            if($day > 1 && $newDay == 1){
                $flag = true;
                break;
            }
            
            if($newDay != $day){
                $date = $this->newDate($newDay, $date);
            }
            
            
            if($date22 != null && ($date->format('Y-m-d') > $date22->format('Y-m-d')) ){
                break;
            }

            $arrDias[] = array("idDia"=>$row->id_dia, "dia"=>$row->nombre_dia, "fecha"=>$date->format('Y-m-d'));
            $headTable .= '<th class="info">'.$row->nombre_dia.'<br>'.$this->convertFecha($date->format('Y-m-d')).'</th>';
        }
        
        if($flag){
            return "10";
        }
        //----------------- Fin obtener días
        
        //----------------- Inicio obtener hora minima y maxima
        $queryHoras = $this->db->query("SELECT MIN(d.hora_inicio), MAX(d.hora_fin) 
                        FROM disponibilidad d 
                        INNER JOIN dias da ON d.id_dia = da.id_dia 
                        WHERE d.id_dent = $id_dent AND d.id_horario = $jornada ");
        
        
        foreach ($queryHoras->result() as $row){
            $hora_inicio = date("H:i", strtotime("$row->min"));
            $hora_fin = date("H:i", strtotime("$row->max"));

            $flagg = true;
        }
        
        //----------------- Fin obtener hora minima y maxima
        
        
        
        // Inicio cargar cuerpo de la tabla Agenda
        $fila = '';
        $columna = 0;
        while ($hora_inicio < $hora_fin){
            $bloque1 = $hora_inicio;
            $hora_inicio = date("H:i", strtotime ( '+'.$duracion.' minute' , strtotime ( $hora_inicio ) )) ;
            

            $fila .='<tr>';
            $fila2 = 0;
            
            $columna++;
            if($hora_inicio <= $hora_fin){
                
                $fila .= '<td class="warning" hora_inicio="'.$bloque1.'" hora_fin="'.$hora_inicio.'" columna="'.$columna.', 0">'.$bloque1.' - '.$hora_inicio.'</td>';
                
                foreach ($arrDias as $row)
                {

                    $fila2++;
                    $id_dia = $row['idDia'];
                    
                    $queryCeldas = $this->db->query("SELECT disp.id_disp, bx.num_box, bx.id_box 
                        FROM disponibilidad disp 
                        INNER JOIN dias d ON disp.id_dia = d.id_dia 
                        INNER JOIN boxes bx ON disp.id_box = bx.id_box 
                        INNER JOIN dentistas de ON disp.id_dent = de.id_dent
                        INNER JOIN usuarios u ON de.rut_u = u.rut_u 
                        WHERE d.id_dia = $id_dia 
                        AND (SELECT '$bloque1' BETWEEN disp.hora_inicio AND disp.hora_fin) 
                        AND (SELECT '$hora_inicio' BETWEEN disp.hora_inicio AND disp.hora_fin) 
                        AND disp.id_dent = $id_dent AND de.id_especialidad = $id_esp AND disp.id_horario = $jornada 
                        AND disp.activo_disp = TRUE");
                    
                    if($queryCeldas->num_rows() == 0){
                        $fila .= '<td class="no-trabaja" estado="no" columna="'.$columna.'" fila="'.$fila2.'"></td>';
                    } else {
                        foreach ($queryCeldas->result() as $row2){
                            $id_box = $row2->id_box;
                            $id_disp = $row2->id_disp;
                        }
                        
                        $fila .= $this->queryAtenciones($bloque1, $hora_inicio, $row['fecha'], $id_dia, $id_box, $id_dent, $id_esp, $jornada, $columna, $fila2, $row['dia'], $id_disp);
                    }
                }
            }
            $fila .= '</tr>';
        }
        // Fin cargar cuerpo de la tabla Agenda
        
        $arrFinal = array("head"=>$headTable, "body"=>$fila, "jornada"=>$jornada);
        
        return $arrFinal;
        
    }
    
    private function queryAtenciones($hora_inicio, $hora_fin, $fecha, $dia, $box, $id_dent, $id_esp, $jornada, $columna, $fila2, $nomDia, $id_disp){
        $query = $this->db->query("SELECT pa.rut_p ||' - '|| pa.dv_p AS rut, pa.nombre_p ||' '|| pa.apellidop_p ||' '|| pa.apellidom_p AS nombre 
        FROM agenda ag 
        INNER JOIN pacientes pa ON ag.rut_p = pa.rut_p 
        WHERE 
        ag.id_horario = $jornada 
        AND ag.id_dent = $id_dent 
        AND ag.id_especialidad = $id_esp 
        AND fecha = '$fecha' 
        AND ag.id_dia = $dia 
        AND ag.id_box = $box 
        AND  ag.conflicto_box = FALSE AND ag.conflicto_dent = FALSE AND ag.conflicto_dia = FALSE 
        AND ag.conflicto_trt = FALSE AND ag.conflicto_esp = FALSE 
        AND ag.activo_ag = TRUE 
        AND (SELECT '$hora_inicio' BETWEEN ag.hora_inicio AND ag.hora_fin) 
        AND (SELECT '$hora_fin' BETWEEN ag.hora_inicio AND ag.hora_fin) LIMIT 1");
        
        if($query->num_rows() == 0){
            return '<td class="primary libre" fecha="'.$fecha.'" fecha2="'.$nomDia.' '.$this->convertFecha($fecha).'" id_dia="'.$dia.'" estado="libre" columna="'.$columna.'" fila="'.$fila2.'" id_disp="'.$id_disp.'" id_box="'.$box.'">Libre</td>';
        } else {
            foreach($query->result() as $row){
                $resp = $row->rut.'<br>'.$row->nombre;
            }
            return '<td class="info ocupada" estado="ocupada" columna="'.$columna.'" fila="'.$fila2.'">'.$resp.'</td>';
        }
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
    
    public function setAgenda($param){
        $this->db->insert("agenda", $param);
        
        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }
    
}