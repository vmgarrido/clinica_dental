<?php

class Mdisponibilidad extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }
    
    public function getDisponibilidad($jornada, $id_dia){
        
        $queryHoras = $this->db->query("SELECT d.hora_inicio, d.hora_fin, h.duracion_bloque  
                                        FROM dias_horario d 
                                        INNER JOIN horarios_trabajo h ON d.id_horario = h.id_horario 
                                        WHERE d.id_horario = $jornada AND d.id_dia = $id_dia;");
        
        $hora_inicio_dia; $hora_fin_dia;
        foreach ($queryHoras->result() as $row){
            $hora_inicio_dia = date("H:i", strtotime("$row->hora_inicio"));
            $hora_fin_dia = date("H:i", strtotime("$row->hora_fin"));
            $duracion = $row->duracion_bloque;
        }
        
        $queryBox = $this->db->query("SELECT * FROM boxes WHERE activo_box = TRUE ORDER BY num_box");

        $arrFinal = array();
        
        $arrBox = array();
        $headTable = '<th class="info">Bloques</th>';
        foreach ($queryBox->result() as $row){
            $arrBox[] = array("idBox"=>$row->id_box, "numBox"=>$row->num_box);
            $headTable .= '<th class="info">Box '.$row->num_box.'</th>';
        }

        $hora_inicio = date("H:i", strtotime("$hora_inicio_dia"));
        $hora_fin = date("H:i", strtotime("$hora_fin_dia"));

        $fila = '';
        while ($hora_inicio < $hora_fin){
            $bloque1 = $hora_inicio;
            $hora_inicio = date("H:i", strtotime ( '+'.(int)$duracion.' minute' , strtotime ( $hora_inicio ) )) ;
            

            $fila .='<tr>';
            if($hora_inicio <= $hora_fin){
                
                $fila .= '<td class="warning">'.$bloque1.' - '.$hora_inicio.'</td>';
                
                foreach ($arrBox as $row)
                {
                    $id_box = $row['idBox'];
                    
                    $queryCeldas = $this->db->query("SELECT u.rut_u || ' - ' || u.dv_u AS rut, u.nombre_u || ' ' || u.apellidop_u || ' ' || u.apellidom_u AS nombre
                    FROM disponibilidad disp 
                    INNER JOIN dias d ON disp.id_dia = d.id_dia 
                    INNER JOIN boxes bx ON disp.id_box = bx.id_box 
                    INNER JOIN dentistas de ON disp.id_dent = de.id_dent
                    INNER JOIN usuarios u ON de.rut_u = u.rut_u 
                    WHERE d.id_dia = $id_dia AND bx.id_box = $id_box 
                    AND (SELECT '$bloque1' BETWEEN disp.hora_inicio AND disp.hora_fin) 
                    AND (SELECT '$hora_inicio' BETWEEN disp.hora_inicio AND disp.hora_fin) 
                    AND de.activo_dent = TRUE AND de.id_especialidad IS NOT NULL AND disp.id_horario = $jornada 
                    AND disp.activo_disp = TRUE AND disp.conflicto_box = FALSE AND disp.conflicto_dia = FALSE");
                    
                    if($queryCeldas->num_rows() == 0){
                        $fila .= '<td class="primary">Libre</td>';
                    } else {
                        foreach ($queryCeldas->result() as $row2){
                            $fila .= '<td class="danger">'.$row2->rut.'<br>'.$row2->nombre.'</td>';
                        }
                    }
                }
            }
            $fila .= '</tr>';
        }
        
        
        
        $arrFinal = array("head"=>$headTable, "body"=>$fila);
        
        return $arrFinal;
    }
    
    public function getDisponibilidadDent($jornada, $id_dia, $rut_c){
        
        $queryHoras = $this->db->query("SELECT d.hora_inicio, d.hora_fin, h.duracion_bloque  
                                        FROM dias_horario d 
                                        INNER JOIN horarios_trabajo h ON d.id_horario = h.id_horario 
                                        WHERE d.id_horario = $jornada AND d.id_dia = $id_dia;");
        
        $hora_inicio_dia; $hora_fin_dia;
        foreach ($queryHoras->result() as $row){
            $hora_inicio_dia = date("H:i", strtotime("$row->hora_inicio"));
            $hora_fin_dia = date("H:i", strtotime("$row->hora_fin"));
            $duracion = $row->duracion_bloque;
        }
        
        $queryBox = $this->db->query("SELECT * FROM boxes WHERE activo_box = TRUE ORDER BY num_box");

        $arrFinal = array();
        
        $arrBox = array();
        $headTable = '<th class="info">Bloques</th>';
        foreach ($queryBox->result() as $row){
            $arrBox[] = array("idBox"=>$row->id_box, "numBox"=>$row->num_box);
            $headTable .= '<th class="info">Box '.$row->num_box.'</th>';
        }

        $hora_inicio = date("H:i", strtotime("$hora_inicio_dia"));
        $hora_fin = date("H:i", strtotime("$hora_fin_dia"));

        $fila = '';
        while ($hora_inicio < $hora_fin){
            $bloque1 = $hora_inicio;
            $hora_inicio = date("H:i", strtotime ( '+'.(int)$duracion.' minute' , strtotime ( $hora_inicio ) )) ;
            

            $fila .='<tr>';
            if($hora_inicio <= $hora_fin){
                
                $fila .= '<td class="warning">'.$bloque1.' - '.$hora_inicio.'</td>';
                
                foreach ($arrBox as $row)
                {
                    $id_box = $row['idBox'];
                    
                    $queryCeldas = $this->db->query("SELECT u.rut_u || ' - ' || u.dv_u AS rut, u.nombre_u || ' ' || u.apellidop_u || ' ' || u.apellidom_u AS nombre
                    FROM disponibilidad disp 
                    INNER JOIN dias d ON disp.id_dia = d.id_dia 
                    INNER JOIN boxes bx ON disp.id_box = bx.id_box 
                    INNER JOIN dentistas de ON disp.id_dent = de.id_dent
                    INNER JOIN usuarios u ON de.rut_u = u.rut_u 
                    WHERE d.id_dia = $id_dia AND bx.id_box = $id_box 
                    AND (SELECT '$bloque1' BETWEEN disp.hora_inicio AND disp.hora_fin) 
                    AND (SELECT '$hora_inicio' BETWEEN disp.hora_inicio AND disp.hora_fin) 
                    AND de.activo_dent = TRUE AND de.id_especialidad IS NOT NULL AND disp.id_horario = $jornada 
                    AND disp.activo_disp = TRUE AND disp.conflicto_box = FALSE AND disp.conflicto_dia = FALSE");
                    
                    if($queryCeldas->num_rows() == 0){
                        $fila .= '<td class="primary">Libre</td>';
                    } else {
                        foreach ($queryCeldas->result() as $row2){

                            if($row2->rut == $rut_c){
                                $fila .= '<td class="success">'.$row2->rut.'<br>'.$row2->nombre.'</td>';
                            } else {
                                $fila .= '<td class="danger">'.$row2->rut.'<br>'.$row2->nombre.'</td>';
                            }
                        }
                    }
                }
            }
            $fila .= '</tr>';
        }
        
        
        
        $arrFinal = array("head"=>$headTable, "body"=>$fila);
        
        return $arrFinal;
    }
    
    public function getDentista($rut, $dv){
        
        $query = $this->db->query("SELECT u.nombre_u || ' ' || u.apellidop_u || ' ' || u.apellidom_u AS nombre, 
                            e.nombre_esp, u.activo_u, d.activo_dent, d.id_dent, e.id_especialidad  
                            FROM usuarios u 
                            INNER JOIN dentistas d ON u.rut_u = d.rut_u 
                            INNER JOIN especialidades e ON d.id_especialidad = e.id_especialidad 
                            WHERE u.rut_u = '$rut' AND u.dv_u = '$dv'");
        
        
        return $query->row();
    }
    
    public function getListaHorario($rut, $dv, $jornada){
        
        $query = $this->db->query("SELECT d.id_disp, da.nombre_dia, d.hora_inicio, d.hora_fin, 'Box ' || bx.num_box AS box
                                    FROM disponibilidad d 
                                    INNER JOIN dias da ON d.id_dia = da.id_dia 
                                    INNER JOIN boxes bx ON d.id_box = bx.id_box 
                                    INNER JOIN dentistas dn ON d.id_dent = dn.id_dent 
                                    INNER JOIN usuarios u ON u.rut_u = dn.rut_u 
                                    WHERE u.rut_u = '$rut' AND u.dv_u = '$dv' AND d.id_horario = $jornada 
                                    AND d.activo_disp = TRUE 
                                    ORDER BY da.num_dia, d.hora_inicio");
        
        $fila = '';
        
        if($query->num_rows() == 0){
            $fila .= '<tr><td colspan="5" style="text-align: center;">No tiene disponibilidad registrada en esta jornada</td></tr>';
        } else {
            foreach ($query->result() as $row){
                $fila .= '<tr>';
                $fila .= '<td>'.$row->nombre_dia.'</td>';
                $fila .= '<td>'.date("H:i", strtotime("$row->hora_inicio")).'</td>';
                $fila .= '<td>'.date("H:i", strtotime("$row->hora_fin")).'</td>';
                $fila .= '<td>'.$row->box.'</td>';
                $fila .= '<td class="marcar"><button type="button" class="btn btn-danger rmv" d_id="'.$row->id_disp.'"><i class="fa fa-trash"></i></button></td>';
                $fila .= '</tr>';
            }
        }
        
        return $fila;
    }
    
    
    public function getBox(){
        $queryBox = $this->db->query("SELECT * FROM boxes WHERE activo_box = TRUE ORDER BY num_box");
        
        $fila = '';
        foreach ($queryBox->result() as $row){
            $fila .= '<option value="'.$row->id_box.'">Box '.$row->num_box.'</option>';
        }
        
        return $fila;
    }
    
    public function consultaDispOcupada($param){
        $query = $this->db->query("SELECT COUNT(*) AS valor 
                        FROM disponibilidad di 
                        WHERE (((di.hora_inicio >= '".$param['hora_inicio']."' AND di.hora_inicio < '".$param['hora_fin']."') OR (di.hora_fin > '".$param['hora_inicio']."' AND di.hora_fin <= '".$param['hora_fin']."') ) 
                        OR (SELECT '".$param['hora_inicio']."' >= di.hora_inicio AND (SELECT '".$param['hora_fin']."' <= di.hora_fin )))
                        AND di.id_dia = ".$param['id_dia']." AND di.id_box = ".$param['id_box']." AND di.id_horario = ".$param['id_horario']." 
                        AND di.activo_disp = TRUE;");
        $resp;
        foreach ($query->result() as $row){
            $resp = $row->valor;
        }
        
        return $resp;
    }
    
    public function consultaDispOcupada2($param){
        $query = $this->db->query("SELECT COUNT(*) AS valor 
            FROM disponibilidad di 
            WHERE di.id_dia = ".$param['id_dia']." AND di.id_horario = ".$param['id_horario']." 
            AND di.activo_disp = TRUE AND di.id_dent = ".$param['id_dent'].";");
        $resp;
        foreach ($query->result() as $row){
            $resp = $row->valor;
        }
        
        return $resp;
    }
    
    public function setRegistrar($param){
        $this->db->insert("disponibilidad", $param);
        
        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }

    public function removeDisponibilidad($id){
        $this->db->where("id_disp", $id);
        $this->db->update("disponibilidad", array("activo_disp" => FALSE));

        return ($this->db->affected_rows() != 1) ? "B" : "A";
    }
}