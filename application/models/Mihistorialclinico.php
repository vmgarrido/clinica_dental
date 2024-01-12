<?php

class Mihistorialclinico extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }

    public function getHistorial($fecha1, $fecha2, $id_esp){
    	$query = $this->db->query("SELECT pa.rut_p ||'-'|| pa.dv_p AS rut_p, pa.nombre_p ||' '|| pa.apellidop_p ||' '|| pa.apellidom_p AS nombre_p, 
		u.rut_u ||'-'|| u.dv_u AS rut_u, u.nombre_u ||' '|| u.apellidop_u ||' '|| u.apellidom_u AS nombre_u, 
		esp.nombre_esp, hc.fecha_hc, trt.tratamiento, hc.nombre_pieza_d ||' '|| hc.num_pieza_d AS pieza 
		FROM historial_clinico hc 
		INNER JOIN pacientes pa ON hc.rut_p = pa.rut_p 
		INNER JOIN dentistas d ON hc.id_dent = d.id_dent 
		INNER JOIN usuarios u ON u.rut_u = d.rut_u 
		INNER JOIN tratamientos trt ON hc.id_trt = trt.id_trt 
		INNER JOIN especialidades esp ON hc.id_especialidad = esp.id_especialidad 
		WHERE hc.id_especialidad = $id_esp 
		AND (hc.fecha_hc BETWEEN '$fecha1' AND '$fecha2') 
		ORDER BY hc.fecha_hc");

		if($query->num_rows() == 0){
			return '<tr><td colspan="8">No se encontraron datos</td></tr>';
		}

		
		$fila = '';
		foreach($query->result() as $row){
			$fecha = $this->convertFecha($row->fecha_hc);
			$fila .='<tr>';
			$fila .='<td>'.$fecha.'</td>';
			$fila .='<td>'.$row->rut_p.'</td>';
			$fila .='<td>'.$row->nombre_p.'</td>';
			$fila .='<td>'.$row->rut_u.'</td>';
			$fila .='<td>'.$row->nombre_u.'</td>';
			$fila .='<td>'.$row->nombre_esp.'</td>';
			$fila .='<td>'.$row->tratamiento.'</td>';
			$fila .='<td>'.$row->pieza.'</td>';
			$fila .='</tr>';
		}

		return $fila;
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

    public function getHistorial2($fecha1, $fecha2, $id_esp){
    	$atendidas = 0;
		$sin_atender = 0;
		
    	$query = $this->db->query("SELECT pa.rut_p ||'-'|| pa.dv_p AS rut_p, pa.nombre_p ||' '|| pa.apellidop_p ||' '|| pa.apellidom_p AS nombre_p, 
		u.rut_u ||'-'|| u.dv_u AS rut_u, u.nombre_u ||' '|| u.apellidop_u ||' '|| u.apellidom_u AS nombre_u, 
		esp.nombre_esp, ag.fecha, ag.hora_inicio, ag.hora_fin, ag.atendida 
		FROM agenda ag 
		INNER JOIN pacientes pa ON ag.rut_p = pa.rut_p 
		INNER JOIN dentistas d ON ag.id_dent = d.id_dent 
		INNER JOIN usuarios u ON u.rut_u = d.rut_u 
		INNER JOIN especialidades esp ON ag.id_especialidad = esp.id_especialidad 
		WHERE ag.id_especialidad = $id_esp 
		AND (ag.fecha BETWEEN '$fecha1' AND '$fecha2') 
		AND ag.conflicto_at = FALSE AND ag.conflicto_box = FALSE AND ag.conflicto_dent = FALSE 
		AND ag.conflicto_dia = FALSE AND ag.conflicto_disp = FALSE AND ag.conflicto_esp = FALSE 
		AND ag.conflicto_trt = FALSE AND ag.conflicto_horario AND ag.activo_ag = TRUE 
		ORDER BY ag.fecha");

		if($query->num_rows() == 0){
			$fila = '<tr><td colspan="7">No se encontraron datos</td></tr>';
			return json_encode(array("filas"=>$fila, "atendidas"=>$atendidas, "sin_atender"=>$sin_atender));
		}

		
		
		$fila = '';
		foreach($query->result() as $row){
			$fecha = $this->convertFecha($row->fecha);

			if($row->atendida == "t"){
				$atendidas++;
				$estado = "Atendida";
			} else{
				$sin_atender++;
				$estado = "Sin Atender";
			}

			$fila .='<tr>';
			$fila .='<td>'.$fecha.'</td>';
			$fila .='<td>'.$row->rut_p.'</td>';
			$fila .='<td>'.$row->nombre_p.'</td>';
			$fila .='<td>'.$row->rut_u.'</td>';
			$fila .='<td>'.$row->nombre_u.'</td>';
			$fila .='<td>'.$row->nombre_esp.'</td>';
			$fila .='<td>'.date("H:i", strtotime("$row->hora_inicio")).' - '.date("H:i", strtotime("$row->hora_fin")).'</td>';
			$fila .='<td>'.$estado.'</td>';
			$fila .='</tr>';
		}

		return json_encode(array("filas"=>$fila, "atendidas"=>$atendidas, "sin_atender"=>$sin_atender));
    }


    public function demandaEspecialidad($fecha1, $fecha2, $id_esp){
		$query = $this->db->query("SELECT pa.rut_p ||'-'|| pa.dv_p AS rut_p, pa.nombre_p ||' '|| pa.apellidop_p ||' '|| pa.apellidom_p AS nombre_p, 
		u.rut_u ||'-'|| u.dv_u AS rut_u, u.nombre_u ||' '|| u.apellidop_u ||' '|| u.apellidom_u AS nombre_u, 
		esp.nombre_esp, ag.fecha, ag.hora_inicio, ag.hora_fin 
		FROM agenda ag 
		INNER JOIN pacientes pa ON ag.rut_p = pa.rut_p 
		INNER JOIN dentistas d ON ag.id_dent = d.id_dent 
		INNER JOIN usuarios u ON u.rut_u = d.rut_u 
		INNER JOIN especialidades esp ON ag.id_especialidad = esp.id_especialidad 
		WHERE ag.id_especialidad = $id_esp 
		AND (ag.fecha BETWEEN '$fecha1' AND '$fecha2') 
		ORDER BY ag.fecha");

		if($query->num_rows() == 0){
			$fila = '<tr><td colspan="7">No se encontraron datos</td></tr>';
			return json_encode(array("filas"=>$fila, "count"=>0));
		}

		
		$count = $query->num_rows();

		$fila = '';
		foreach($query->result() as $row){
			$fecha = $this->convertFecha($row->fecha);

			$fila .='<tr>';
			$fila .='<td>'.$fecha.'</td>';
			$fila .='<td>'.$row->rut_p.'</td>';
			$fila .='<td>'.$row->nombre_p.'</td>';
			$fila .='<td>'.$row->rut_u.'</td>';
			$fila .='<td>'.$row->nombre_u.'</td>';
			$fila .='<td>'.$row->nombre_esp.'</td>';
			$fila .='<td>'.date("H:i", strtotime("$row->hora_inicio")).' - '.date("H:i", strtotime("$row->hora_fin")).'</td>';
			$fila .='</tr>';
		}

		return json_encode(array("filas"=>$fila, "count"=>$count));
	}
}