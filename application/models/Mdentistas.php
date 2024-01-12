<?php

class Mdentistas extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }
    
    
    public function getEspecialidades(){
        
        $query = $this->db->query("SELECT id_especialidad, nombre_esp 
                                    FROM especialidades 
                                    WHERE activo_esp = TRUE 
                                    ORDER BY nombre_esp");
        
        $option = '';
        foreach ($query->result() as $row){
            $option .='<option value="'.$row->id_especialidad.'">'.$row->nombre_esp.'</option>';
        }
        
        return $option;
        
    }
    
    public function getDentistas($id){
        $query = $this->db->query("SELECT de.id_dent, u.nombre_u ||' '|| u.apellidop_u ||' '|| u.apellidom_u AS nombre
                                FROM especialidades e 
                                INNER JOIN dentistas de ON e.id_especialidad = de.id_especialidad 
                                INNER JOIN usuarios u ON de.rut_u = u.rut_u 
                                WHERE de.activo_dent = TRUE AND e.id_especialidad = $id");
        
        $option = '';
        foreach ($query->result() as $row){
            $option .='<option value="'.$row->id_dent.'">'.$row->nombre.'</option>';
        }
        
        return $option;
    }
    
    public function getTratamientos($id){
        $query = $this->db->query("SELECT trt.id_trt, trt.tratamiento, trt.valor 
                                FROM tratamientos trt 
                                INNER JOIN tratamientos_asignados taa ON trt.id_trt = taa.id_trt 
                                WHERE taa.id_especialidad = $id AND trt.activo_trt = TRUE 
                                ORDER BY trt.tratamiento");
        
        $option = '';
        foreach ($query->result() as $row){
            $option .='<option valor="'.$row->valor.'" value="'.$row->id_trt.'">'.$row->tratamiento.'</option>';
        }
        
        return $option;
    }

    public function getAgenda($id_dent, $fecha){

        $query = $this->db->query("SELECT ag.id_agenda, pa.rut_p, pa.dv_p, pa.nombre_p, pa.apellidop_p, pa.apellidom_p, ag.hora_inicio, ag.hora_fin, trt.tratamiento 
        FROM agenda ag 
        INNER JOIN pacientes pa ON pa.rut_p = ag.rut_p 
        INNER JOIN tratamientos trt ON ag.id_trt = trt.id_trt 
        WHERE ag.conflicto_box = FALSE AND ag.conflicto_dia = FALSE 
        AND ag.conflicto_dent = FALSE AND ag.conflicto_trt = FALSE 
        AND ag.conflicto_esp = FALSE AND ag.conflicto_disp = FALSE 
        AND ag.conflicto_horario = FALSE AND ag.conflicto_at = FALSE 
        AND ag.activo_ag = TRUE AND ag.atendida = FALSE 
        AND ag.fecha = '$fecha' AND ag.id_dent = $id_dent 
        ORDER BY ag.hora_inicio;");

        if($query->num_rows() == 0){
            return $option = '<tr><td colspan="5">No se encontraron registros.</td></tr>';
        }

        $option = '';
        foreach($query->result() as $row){
            $nombre = $row->nombre_p.' '.$row->apellidop_p.' '.$row->apellidom_p;
            $trt = $row->tratamiento;
            $option .= '<tr>';
            $option .= '<td width="17%">'.date("H:i", strtotime("$row->hora_inicio")).' - '.date("H:i", strtotime("$row->hora_fin")).'</td>';
            $option .= '<td width="12%">'.$row->rut_p.' - '.$row->dv_p.'</td>';
            $option .= '<td width="30%">'.$nombre.'</td>';
            $option .= '<td width="31%">'.$trt.'</td>';
            //$option .= '<td width="10%" class="col-final"><input type="radio" onclick="check('.$row->id_agenda.', \''.$nombre.'\', \''.$trt.'\');" name="radioPaciente"></td>';
            $option .= '<td width="10%" class="col-final"><button type="button" onclick="verDatos('.$row->id_agenda.', \''.$nombre.'\', \''.$trt.'\');" class="btn btn-primary btn2 btnVer"><i class="fa fa-eye"></i></button></td>';
            $option .= '</tr>';
        }

        return $option;

    }

    public function getPaciente($id_agenda){
        $query = $this->db->query("SELECT pa.rut_p, pa.dv_p, pa.nombre_p ||' '|| pa.apellidop_p ||' '|| pa.apellidom_p AS nombre, 
        dg.diagnostico 
        FROM pacientes pa 
        INNER JOIN agenda ag ON pa.rut_p = ag.rut_p 
        LEFT JOIN historial_clinico hc ON ag.id_agenda = hc.id_agenda 
        LEFT JOIN diagnostico dg ON hc.id_hc = dg.id_hc 
        WHERE ag.id_agenda = $id_agenda LIMIT 1");

        return json_encode($query->row());
    }

    public function registrarHistorial($param){
        date_default_timezone_set("Chile/Continental");
        $param['fecha_hc'] = date("Y-m-d");

        $query = $this->db->query("SELECT hc.id_hc, trt.tratamiento, hc.nombre_pieza_d, hc.num_pieza_d, tra.id_trz, tra.id_tsn 
        FROM historial_clinico hc 
        LEFT JOIN tratamientos trt ON trt.id_trt = hc.id_trt 
        LEFT JOIN tratamientos_realizados tra ON hc.id_trz = tra.id_trz 
        WHERE id_agenda = ".$param['id_agenda']." LIMIT 1");

        if($query->num_rows() > 0){
            $r = $query->row();

            $array = array('id_hc' => $r->id_hc, "trt"=>$r->tratamiento,
                            "nom_pieza"=>$r->nombre_pieza_d, "num_pieza"=>$r->num_pieza_d,
                            "id_tsn"=>$r->id_tsn, "id_trz"=>$r->id_trz);

            return json_encode($array);
        } else {
            $this->db->insert("historial_clinico", $param);
            $a = $this->db->insert_id();
            $array = array('id_hc' => $a, "trt"=>null,
                            "nom_pieza"=>null, "num_pieza"=>null,
                            "id_tsn"=>null, "id_trz"=>null);
            return json_encode($array);
        }
        
    }

    public function registrarDiagnostico($id_hc, $diagnostico){
        
        $query = $this->db->query("SELECT id_dg FROM diagnostico 
        WHERE id_hc = $id_hc LIMIT 1");

        $campos = array(
            "id_hc" => $id_hc,
            "diagnostico" => $diagnostico
        );

        if($query->num_rows() > 0){
            $r = $query->row();
            $id_dg = $r->id_dg;

            $this->db->where("id_dg", $id_dg);
            $this->db->update("diagnostico", $campos);
            return ($this->db->affected_rows() != 1) ? "0" : "1";
        } else {

            $this->db->insert("diagnostico", $campos);
            return ($this->db->affected_rows() != 1) ? "0" : "1";
        }

    }

    public function listarPiezas(){
        $query = $this->db->query("SELECT id_pd, nombre ||' '|| numero AS nombre2, nombre, numero  
        FROM piezas_dentales 
        WHERE activo_pd = TRUE 
        ORDER BY nombre, numero");

        $option = '';

        foreach($query->result() as $row){
            $option .= '<option nombre="'.$row->nombre.'" numero="'.$row->numero.'" value="'.$row->id_pd.'">'.$row->nombre2.'</option>';
        }

        return $option;
    }

    public function setTrtSinRealizar($param){

        $this->db->insert("tratamientos_sin_realizar", $param);
        //return ($this->db->affected_rows() > 0) ? "1" : "0";
        if($this->db->affected_rows() > 0){
            return $this->db->insert_id();
        } else{
            return 0;
        }

    }

    public function borrarTratamiento($id_tsn){
        $this->db->where("id_tsn", $id_tsn);
        $this->db->delete("tratamientos_sin_realizar");

        return ($this->db->affected_rows() > 0) ? "1" : "0";
	}

    public function getTrtSinRealizar($rut_p){

        $query = $this->db->query("SELECT tsr.id_tsn, trt.id_trt, trt.tratamiento, tsr.nombre_pieza_d, tsr.num_pieza_d 
        FROM tratamientos trt 
        INNER JOIN tratamientos_sin_realizar tsr ON trt.id_trt = tsr.id_trt 
        WHERE tsr.activo_tsn = TRUE AND tsr.rut_p = '$rut_p'");

        $fila = '';

        foreach($query->result() as $row){
            $fila .= '<tr>';
            $fila .= '<td class="col1">'.$row->tratamiento.'</td>';
            $fila .= '<td class="col2">'.$row->nombre_pieza_d.'</td>';
            $fila .= '<td class="col3">'.$row->num_pieza_d.'</td>';
            $fila .= '<td class="col4"><button type="button" id_trt="'.$row->id_trt.'" tsn="'.$row->id_tsn.'" trt="'.$row->tratamiento.'" pieza="'.$row->nombre_pieza_d.'" numero="'.$row->num_pieza_d.'" class="btn btn-success btn2 realizar"><i class="fa fa-check"></i></button></td>';
            $fila .= '</tr>';
        }

        return $fila;

    }

    public function getTrtRealizados($rut_p){

        $query = $this->db->query("SELECT tsr.id_tsn, trt.id_trt, trt.tratamiento, tsr.nombre_pieza_d, tsr.num_pieza_d 
        FROM tratamientos trt 
        INNER JOIN tratamientos_sin_realizar tsr ON trt.id_trt = tsr.id_trt 
        WHERE tsr.activo_tsn = TRUE AND tsr.rut_p = '$rut_p'");

        $fila = '';

        foreach($query->result() as $row){
            $fila .= '<tr>';
            $fila .= '<td class="col1">'.$row->tratamiento.'</td>';
            $fila .= '<td class="col2">'.$row->nombre_pieza_d.'</td>';
            $fila .= '<td class="col3">'.$row->num_pieza_d.'</td>';
            $fila .= '<td class="col4"><button type="button" id_trt="'.$row->id_trt.'" tsn="'.$row->id_tsn.'" trt="'.$row->tratamiento.'" pieza="'.$row->nombre_pieza_d.'" numero="'.$row->num_pieza_d.'" class="btn btn-success btn2 realizar"><i class="fa fa-check"></i></button></td>';
            $fila .= '</tr>';
        }

        return $fila;

    }

    public function realizarTratamiento($param, $id_hc){
        
        $this->db->where("id_tsn", $param['id_tsn']);
        $campos = array("activo_tsn" => FALSE);
        $this->db->update("tratamientos_sin_realizar", $campos);
        


        if($this->db->affected_rows() > 0){
            $this->db->insert("tratamientos_realizados", $param);
            if($this->db->affected_rows() > 0){
                $id_trz =  $this->db->insert_id();

                $campos2 = array(
                    "nombre_pieza_d" => $param['nombre_pieza_d'],
                    "num_pieza_d" => $param['num_pieza_d'],
                    "id_trt" => $param['id_trt'],
                    "id_trz" => $id_trz
                );

                $this->db->where("id_hc", $id_hc);
                $this->db->update("historial_clinico", $campos2);

                if($this->db->affected_rows() > 0){
                    return $id_trz;
                } else{
                    return 0;
                }

            } else {
                return 0;
            }
        } else{
            return 0;
        }
        
    }

    public function removerTrtRealizado($id_hc, $id_tsn, $id_trz){

        $null = array(
            "id_trz" => null,
            "id_trt" => null,
            "nombre_pieza_d" => null,
            "num_pieza_d" => null
        );

        $e = 0;
        $this->db->where("id_hc", $id_hc);
        $this->db->update("historial_clinico", $null);
        if($this->db->affected_rows() > 0){
            $e = 1;
        }
        if($e == 0){
            return 0;
        }

        $e = 0;
        //$this->db->where("id_trz", $id_trz);
        $this->db->delete('tratamientos_realizados', array('id_trz' => $id_trz)); 
        //$this->db->delete("tratamientos_realizados");
        if($this->db->affected_rows() > 0){
            $e = 1;
        }
        if($e == 0){
            return 0;
        }

        $false = array("activo_tsn" => TRUE);
        $this->db->where("id_tsn", $id_tsn);
        $this->db->update("tratamientos_sin_realizar", $false);
        if($this->db->affected_rows() > 0){
            return 1;
        } else{
            return 0;
        }


    }

    public function getHistorial($rut_p){
        $query = $this->db->query("SELECT ag.fecha, u.nombre_u ||' '|| u.apellidop_u ||' '|| u.apellidom_u AS dentista, 
        trt.tratamiento AS trt_agenda, ltr.tratamiento AS trt_realizado, 
        hc.nombre_pieza_d, hc.num_pieza_d, 
        ag.atendida, ag.activo_ag, 
        ag.conflicto_at, ag.conflicto_box, ag.conflicto_dent, ag.conflicto_dia, ag.conflicto_disp, 
        ag.conflicto_esp, ag.conflicto_trt, dg.id_dg 
        FROM agenda ag 
        INNER JOIN tratamientos trt ON ag.id_trt = trt.id_trt 
        INNER JOIN dentistas d ON ag.id_dent = d.id_dent 
        INNER JOIN usuarios u ON u.rut_u = d.rut_u 
        LEFT JOIN historial_clinico hc ON ag.id_agenda = hc.id_agenda 
        LEFT JOIN diagnostico dg ON hc.id_hc = dg.id_hc 
        LEFT JOIN tratamientos ltr ON hc.id_trt = ltr.id_trt 
        WHERE ag.rut_p = '$rut_p' ORDER BY ag.fecha");

        if($query->num_rows() == 0){
            return '<tr><td colspan="8">Este Paciente no tiene historial registrado.</td></tr>';
        }

        $option = '';
        foreach($query->result() as $row){
            $conflicto = '';
            $conflicto .= ($row->conflicto_at == "t") ? 'Atención<br>' : '';
            $conflicto .= ($row->conflicto_box == "t") ? 'Box<br>' : '';
            $conflicto .= ($row->conflicto_dent == "t") ? 'Dentista<br>' : '';
            $conflicto .= ($row->conflicto_dia == "t") ? 'Día<br>' : '';
            $conflicto .= ($row->conflicto_disp == "t") ? 'Disponibilidad<br>' : '';
            $conflicto .= ($row->conflicto_esp == "t") ? 'Especialidad<br>' : '';
            $conflicto .= ($row->conflicto_trt == "t") ? 'Tratamiento<br>' : '';

            if($row->atendida == "t"){
                $estado = "Atendida";
            } else if ($row->activo_ag == "f"){
                $estado = "Eliminada";
            } else {
                $estado = "Sin atender";
            }

            $dg = ($row->id_dg != null) ? '<button type="button" class="btn btn-primary btn2" onclick="verDiagnostico('.$row->id_dg.');"><i class="fa fa-eye"></i></button>' : '';

            $fecha = new DateTime($row->fecha);
            $date = $this->convertFecha($fecha->format('Y-m-d'));

            $option .= '<tr>';
            $option .= '<td>'.$estado.'</td>';
            $option .= '<td>'.$conflicto.'</td>';
            $option .= '<td>'.$date.'</td>';
            $option .= '<td>'.$row->dentista.'</td>';
            $option .= '<td>'.$row->trt_agenda.'</td>';
            $option .= '<td>'.$row->trt_realizado.'</td>';
            $option .= '<td>'.$row->nombre_pieza_d.' '.$row->num_pieza_d.'</td>';
            $option .= '<td>'.$dg.'</td>';
            $option .= '</tr>';
        }

        return $option;
    }

    public function finalizarAtencion($id_agenda){
        $campos = array('atendida' => TRUE );
        $this->db->where("id_agenda", $id_agenda);
        $this->db->update("agenda", $campos);

        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }

    public function getDiagnostico($id){
        $query = $this->db->query("SELECT dg.diagnostico, hc.fecha_hc 
                FROM diagnostico dg 
                INNER JOIN historial_clinico hc ON dg.id_hc = hc.id_hc 
                WHERE dg.id_dg = $id LIMIT 1");

        $r = $query->row();

        $date = new DateTime($r->fecha_hc);
        $fecha = $this->convertFecha($date->format('Y-m-d'));
        return json_encode(array("fecha"=>$fecha, "diagnostico"=>$r->diagnostico));
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
}