<?php

class Mhorarios extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }

    private function convertFecha($fecha){
        if($fecha == null){
            return null;
        }
        date_default_timezone_set("Chile/Continental");
        $timestamp = strtotime($fecha);
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        $dia = date('d', $timestamp); 
        $mes = date('m', $timestamp) - 1;
        $year = date('Y', $timestamp);

        $fecha = "$dia - " . $meses[$mes] . " - $year";
        return $fecha;
    }

    public function getHorarioActual(){

        date_default_timezone_set("Chile/Continental");
        $hoy = date("Y-m-d");

        $queryHorario = $this->db->query("SELECT id_horario, duracion_bloque, hora_inicio, hora_fin, fecha_inicio, fecha_fin 
                        FROM horarios_trabajo  
                        WHERE activo_h = TRUE AND fecha_inicio <= '$hoy' AND 
                        (fecha_fin > '$hoy' OR fecha_fin IS NULL)");
        
        foreach ($queryHorario->result() as $row){
            $jornada = $row->id_horario;
            $duracion = $row->duracion_bloque;
            
            $fecha_inicio = $this->convertFecha($row->fecha_inicio);
            $fecha_fin = $this->convertFecha($row->fecha_fin);
            $hora_inicio = $row->hora_inicio;
            $hora_fin = $row->hora_fin;
        }

        $queryDias = $this->db->query("SELECT d.id_dia, d.nombre_dia, dh.hora_inicio, dh.hora_fin, dh.activo_dia 
        FROM dias d 
        INNER JOIN dias_horario dh ON d.id_dia = dh.id_dia 
        WHERE dh.id_horario = $jornada 
        ORDER BY d.num_dia ");

        $fila = '';
        foreach ($queryDias->result() as $row){
            $fila .= '<tr>';
            $fila .= '<td>'.$row->nombre_dia.'</td>';

            if($row->activo_dia == "t"){
                $fila .= '<td><button type="button" class="btn btn-danger desactivar" onclick="desactivarDia(\''.$row->nombre_dia.'\', '.$jornada.', '.$row->id_dia.');" >Desactivar</button></td>';
            } else {
                $fila .= '<td><button type="button" class="btn btn-primary activar" onclick="activarDia(\''.$row->nombre_dia.'\', '.$jornada.', '.$row->id_dia.');" >Activar</button></td>';
            }

            $fila .= '<td><input type="text" class="form-control hora-inicio-actual" value="'.date("H:i", strtotime("$row->hora_inicio")).'" readonly></td>';
            $fila .= '<td><input type="text" class="form-control hora-fin-actual" value="'.date("H:i", strtotime("$row->hora_fin")).'" readonly></td>';
            $fila .= '</tr>';
        }

        $arr = array(
            "fecha_inicio" => $fecha_inicio,
            "fecha_fin" => $fecha_fin,
            "hora_inicio" => date("H:i", strtotime("$hora_inicio")),
            "hora_fin" => date("H:i", strtotime("$hora_fin")),
            "duracion" => $duracion.' minutos',
            "body" => $fila
        );
        return json_encode($arr);

    }
    
    public function insertarHorario($param){
        $this->db->where(array("fecha_fin"=>NULL, "activo_h"=>TRUE));
        $this->db->update("horarios_trabajo", array("fecha_fin"=>$param['fecha_inicio']));
        
        $this->db->insert("horarios_trabajo", $param);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    
    public function insertarDias($insert_id, $dias, $hora_inicio, $hora_fin){
        
        $i = 0;
        $flag = true;
        
        for($i=1; $i<=6; $i++){
            if(!empty($hora_inicio[$i]) && !empty($hora_fin[$i])){
                $campos = array(
                    "id_horario" => $insert_id,
                    "id_dia" => $dias[$i],
                    "hora_inicio" => $hora_inicio[$i],
                    "hora_fin" => $hora_fin[$i],
                    "activo_dia" => TRUE
                );
                
                $this->db->insert("dias_horario", $campos);
                
                if($this->db->affected_rows() != 1){
                    $flag = false;
                    break;
                }
            }
        }
        
        if($flag){
            return true;
        } else {
            return false;
        }
        
    }

    public function desactivarDia($id_dia, $id_horario){
        $campos = array("activo_dia"=>FALSE);
        $arrWhere = array("id_horario"=>$id_horario, "id_dia"=>$id_dia);
        $this->db->where($arrWhere);
        $this->db->update("dias_horario",$campos);

        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }

    public function activarDia($id_dia, $id_horario){
        $campos = array("activo_dia"=>TRUE);
        $arrWhere = array("id_horario"=>$id_horario, "id_dia"=>$id_dia);
        $this->db->where($arrWhere);
        $this->db->update("dias_horario",$campos);

        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }

    public function evalHorario(){
        date_default_timezone_set("Chile/Continental");
        $hoy = date("Y-m-d");

        $query = $this->db->query("SELECT * 
        FROM horarios_trabajo  
        WHERE fecha_inicio >= '$hoy' AND fecha_fin IS NULL AND activo_h = TRUE");

        return $query->num_rows();
    }

    public function getHorarioNuevo(){
        date_default_timezone_set("Chile/Continental");
        $hoy = date("Y-m-d");

        $queryHorario = $this->db->query("SELECT id_horario, duracion_bloque, hora_inicio, hora_fin, fecha_inicio 
                                        FROM horarios_trabajo  
                                        WHERE activo_h = TRUE AND fecha_inicio > '$hoy' 
                                        AND fecha_fin IS NULL AND activo_h = TRUE");
        
        if($queryHorario->num_rows() == 0){
            return null;
        }

        foreach ($queryHorario->result() as $row){
            $jornada = $row->id_horario;
            $duracion = $row->duracion_bloque;
            
            $fecha_inicio = $this->convertFecha($row->fecha_inicio);
            $hora_inicio = $row->hora_inicio;
            $hora_fin = $row->hora_fin;
        }

        $queryDias = $this->db->query("SELECT d.id_dia, d.nombre_dia, dh.hora_inicio, dh.hora_fin, dh.activo_dia 
        FROM dias d 
        INNER JOIN dias_horario dh ON d.id_dia = dh.id_dia 
        WHERE dh.id_horario = $jornada 
        ORDER BY d.num_dia ");

        $fila = '';
        foreach ($queryDias->result() as $row){
            $fila .= '<tr>';
            $fila .= '<td>'.$row->nombre_dia.'</td>';

            if($row->activo_dia == "t"){
                $fila .= '<td><button type="button" class="btn btn-danger desactivar" onclick="desactivarDia(\''.$row->nombre_dia.'\', '.$jornada.', '.$row->id_dia.');" >Desactivar</button></td>';
            } else {
                $fila .= '<td><button type="button" class="btn btn-primary activar" onclick="activarDia(\''.$row->nombre_dia.'\', '.$jornada.', '.$row->id_dia.');" >Activar</button></td>';
            }

            $fila .= '<td><input type="text" class="form-control hora-inicio-actual" value="'.date("H:i", strtotime("$row->hora_inicio")).'" readonly></td>';
            $fila .= '<td><input type="text" class="form-control hora-fin-actual" value="'.date("H:i", strtotime("$row->hora_fin")).'" readonly></td>';
            $fila .= '</tr>';
        }

        $arr = array(
            "id_horario" => $jornada,
            "fecha_inicio" => $fecha_inicio,
            "hora_inicio" => date("H:i", strtotime("$hora_inicio")),
            "hora_fin" => date("H:i", strtotime("$hora_fin")),
            "duracion" => $duracion.' minutos',
            "body" => $fila
        );
        return json_encode($arr);
    }

    public function desactivarHorarioNuevo($id){

        $query1 = $this->db->query("SELECT fecha_inicio FROM horarios_trabajo WHERE id_horario = $id");
        $r = $query1->row();
        $fecha = $r->fecha_inicio;

        $this->db->where("id_horario", $id);
        $this->db->update("horarios_trabajo", array("activo_h" => FALSE));

        
        $this->db->where("fecha_fin", $fecha);
        $this->db->update("horarios_trabajo", array("fecha_fin"=>NULL, "activo_h"=>TRUE));

        return "1";
    }
}