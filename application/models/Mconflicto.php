<?php

class Mconflicto extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }

    public function setConflictoTrt($id_trt){
        date_default_timezone_set("Chile/Continental");
        $hoy = date("Y-m-d");
        $hora = date('H:i');

        $query = $this->db->query("UPDATE agenda SET conflicto_trt = TRUE, fecha_conflicto_trt = '$hoy' 
                                WHERE id_trt = $id_trt AND (fecha > '$hoy' OR (fecha = '$hoy' AND hora_inicio >= '$hora'))");


        return "1";
    }

    public function quitConflictoTrt($id_trt){
        date_default_timezone_set("Chile/Continental");
        $hoy = date("Y-m-d");
        $hora = date('H:i');

        $query = $this->db->query("UPDATE agenda SET conflicto_trt = FALSE, fecha_conflicto_trt = NULL 
                                WHERE id_trt = $id_trt AND (fecha > '$hoy' OR (fecha = '$hoy' AND hora_inicio >= '$hora'))");


        return "1";
    }

    //-- Dentista
    public function cambiarConflictoEsp($rut, $id_esp){
        date_default_timezone_set("Chile/Continental");
        $hoy = date("Y-m-d");
        $hora = date('H:i');

        $queryId = $this->db->query("SELECT id_dent 
        FROM dentistas WHERE rut_u = '$rut' AND activo_dent = TRUE;");

        $id_dent = 0;
        foreach ($queryId->result() as $row){
            $id_dent = $row->id_dent;
        }

        $queryUpdate1 = $this->db->query("UPDATE agenda SET esp_actual = $id_esp 
        WHERE ((id_especialidad <> $id_esp AND esp_actual IS NULL) 
        OR (esp_actual IS NOT NULL AND esp_actual <> $id_esp ) ) 
        AND id_dent = $id_dent 
        AND (fecha > '$hoy' OR (fecha = '$hoy' AND hora_inicio >= '$hora'));");


        $queryTrt = $this->db->query("SELECT id_trt 
                    FROM tratamientos_asignados 
                    WHERE id_especialidad = $id_esp");

        $arrTrt = array();
        foreach($queryTrt->result() as $row){
            array_push($arrTrt, $row->id_trt);
        }

        $queryTrAg = $this->db->query("SELECT id_agenda, id_trt 
        FROM agenda 
        WHERE ((id_especialidad = $id_esp AND esp_actual IS NULL) 
        OR (esp_actual IS NOT NULL AND esp_actual = $id_esp ) ) 
        AND id_dent = $id_dent 
        AND (fecha > '$hoy' OR (fecha = '$hoy' AND hora_inicio >= '$hora'));");

        if(count($arrTrt) > 0){

            foreach($queryTrAg->result() as $row){
                $id_ag = $row->id_agenda;
                $td_trt = $row->id_trt;

                if(in_array($td_trt, $arrTrt) == false){

                    $campos = array(
                        "conflicto_esp" => TRUE,
                        "fecha_conflicto_esp" => $hoy
                    );

                    $this->db->where("id_agenda", $id_ag);
                    $this->db->update("agenda", $campos);

                } else {
                    $campos = array(
                        "conflicto_esp" => FALSE,
                        "fecha_conflicto_esp" => NULL
                    );

                    $this->db->where("id_agenda", $id_ag);
                    $this->db->update("agenda", $campos);
                }

            }
            

        } else {

            foreach($queryTrAg->result() as $row){
                $id_ag = $row->id_agenda;
                $td_trt = $row->id_trt;

                $campos = array(
                    "conflicto_esp" => TRUE,
                    "fecha_conflicto_esp" => $hoy
                );

                $this->db->where("id_agenda", $id_ag);
                $this->db->update("agenda", $campos);

            }

        }

    }

    public function setDispFalse($rut){

        date_default_timezone_set("Chile/Continental");
        $hoy = date("Y-m-d");
        $hora = date('H:i');

        $queryId = $this->db->query("SELECT id_dent 
        FROM dentistas WHERE rut_u = '$rut';");

        $id_dent = 0;
        foreach ($queryId->result() as $row){
            $id_dent = $row->id_dent;
        }

        $campos = array("activo_disp"=>FALSE);
        $arrWhere = array("id_dent"=>$id_dent, "activo_disp"=>TRUE);
        $this->db->where($arrWhere);
        $this->db->update("disponibilidad",$campos);

        $queryConflicto = $this->db->query("UPDATE agenda SET conflicto_dent = TRUE, fecha_conflicto_dent = '$hoy' 
        WHERE id_dent = $id_dent 
        AND (fecha > '$hoy' OR (fecha = '$hoy' AND hora_inicio >= '$hora'));");

        return "1";
    }

    public function setConflictoDia($id_dia, $id_horario){

        date_default_timezone_set("Chile/Continental");
        $hoy = date("Y-m-d");
        $hora = date('H:i');

        $campos = array("conflicto_dia"=>TRUE, "fecha_conflicto_dia"=> $hoy);
        $arrWhere = array("id_horario"=>$id_horario, "id_dia"=>$id_dia, "activo_disp"=>TRUE);
        $this->db->where($arrWhere);
        $this->db->update("disponibilidad",$campos);


        $queryConflicto = $this->db->query("UPDATE agenda SET conflicto_dia = TRUE, fecha_conflicto_dia = '$hoy' 
        WHERE id_horario = $id_horario AND id_dia = $id_dia 
        AND (fecha > '$hoy' OR (fecha = '$hoy' AND hora_inicio >= '$hora'));");

        return "1";
    }

    public function quitConflictoDia($id_dia, $id_horario){

        date_default_timezone_set("Chile/Continental");
        $hoy = date("Y-m-d");
        $hora = date('H:i');

        $campos = array("conflicto_dia"=>FALSE, "fecha_conflicto_dia"=> NULL);
        $arrWhere = array("id_horario"=>$id_horario, "id_dia"=>$id_dia, "activo_disp"=>TRUE);
        $this->db->where($arrWhere);
        $this->db->update("disponibilidad",$campos);


        $queryConflicto = $this->db->query("UPDATE agenda SET conflicto_dia = FALSE, fecha_conflicto_dia = NULL 
        WHERE id_horario = $id_horario AND id_dia = $id_dia 
        AND (fecha > '$hoy' OR (fecha = '$hoy' AND hora_inicio >= '$hora'));");

        return "1";
    }

    public function setConflictoBox($id_box){

        date_default_timezone_set("Chile/Continental");
        $hoy = date("Y-m-d");
        $hora = date('H:i');

        $campos = array("conflicto_box"=>TRUE, "fecha_conflicto_box"=> $hoy);
        $arrWhere = array("id_box"=>$id_box, "activo_disp"=>TRUE);
        $this->db->where($arrWhere);
        $this->db->update("disponibilidad",$campos);

        $queryConflicto = $this->db->query("UPDATE agenda SET conflicto_box = TRUE, fecha_conflicto_box = '$hoy' 
        WHERE id_box = $id_box 
        AND (fecha > '$hoy' OR (fecha = '$hoy' AND hora_inicio >= '$hora'));");

        return "1";

    }

    public function quitConflictoBox($id_box){

        date_default_timezone_set("Chile/Continental");
        $hoy = date("Y-m-d");
        $hora = date('H:i');

        $campos = array("conflicto_box"=>FALSE, "fecha_conflicto_box"=> NULL);
        $arrWhere = array("id_box"=>$id_box, "activo_disp"=>TRUE);
        $this->db->where($arrWhere);
        $this->db->update("disponibilidad",$campos);

        $queryConflicto = $this->db->query("UPDATE agenda SET conflicto_box = FALSE, fecha_conflicto_box = NULL 
        WHERE id_box = $id_box 
        AND (fecha > '$hoy' OR (fecha = '$hoy' AND hora_inicio >= '$hora'));");

        return "1";

    }

    public function conflictoDisp($id){
        date_default_timezone_set("Chile/Continental");
        $hoy = date("Y-m-d");
        $hora = date('H:i');

        $queryConflicto = $this->db->query("UPDATE agenda SET conflicto_disp = TRUE, fecha_conflicto_disp = '$hoy' 
        WHERE id_disp = $id 
        AND (fecha > '$hoy' OR (fecha = '$hoy' AND hora_inicio >= '$hora'));");

        return "A";
    }

    public function setConflictoHorario($id){
        date_default_timezone_set("Chile/Continental");
        $hoy = date("Y-m-d");

        $this->db->where("id_horario", $id);
        $this->db->update("disponibilidad",array("activo_disp"=>FALSE));

        $this->db->where("id_horario", $id);
        $this->db->update("agenda", array("conflicto_horario"=>TRUE, "fecha_conflicto_horario"=>$hoy));

        return "1";
    }

}