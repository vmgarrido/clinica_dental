<?php

class Mespecialidades extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }
    
    public function getEspecialidades(){
        $query = $this->db->query("SELECT * FROM especialidades");
        
        foreach ($query->result() as $row){
            $id = $row->id_especialidad;
            $nombre = $row->nombre_esp;
            $activo = $row->activo_esp;
            
            $edit = '<button type="button" class="btn btn-success editar" onclick="edit('.$id.', \''.$nombre.'\');" ><i class="fa fa-edit"></i></button>';
            //$edit = '<button type="button" class="btn btn-success editar" onclick="edit(1, 2, 3, 4);" >Editar</button>';
            
            if($activo == "t"){
                $accion = '<button type="button" class="btn btn-danger" onclick="desactivar('.$id.', \''.$nombre.'\');" ><i class="fa fa-arrow-down"></i></button>';
            } else{
                $accion = '<button type="button" class="btn btn-warning" onclick="activar('.$id.', \''.$nombre.'\');" ><i class="fa fa-arrow-up"></i></button>';
            }
            
            $ver = '<button type="button" class="btn btn-primary" onclick="ver('.$id.', \''.$nombre.'\');" ><i class="fa fa-eye"></i></button>';
            
            $data[]=array(
 				"0"=>$nombre,
                "1"=>$edit." ".$accion." ".$ver
 				);
        }
        
        $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
        return json_encode($results);
    }
    
    public function getTratamientos($id){
        
        $trt = array();
        if($id != null){
            $query1 = $this->db->query("SELECT trt.id_trt, trt.tratamiento, ta.id_especialidad 
                        FROM tratamientos_asignados ta 
                        INNER JOIN especialidades e ON e.id_especialidad = ta.id_especialidad 
                        INNER JOIN tratamientos trt ON trt.id_trt = ta.id_trt 
                        WHERE e.id_especialidad = $id AND trt.activo_trt = TRUE");

            foreach($query1->result() as $row){
                array_push($trt, $row->id_trt);
            }
        }

        $queryTrt = $this->db->query("SELECT trt.id_trt, trt.tratamiento 
                        FROM tratamientos trt 
                        WHERE trt.activo_trt = TRUE 
                        ORDER BY trt.tratamiento");

        $html = '';
        $i = 0;
        foreach($queryTrt->result() as $row){
            
            $check = "";
            $span = '<span class="checkmark"></span>';
            if(!empty($trt)){
                $check = in_array($row->id_trt, $trt) ? "checked" : "";
            }

            if($i == 0){
                $html .= '<div class="row">';
            }
            //------------

            $html .= '<div class="col-md-4">';
            $html .= '<label class="container"> '.$row->tratamiento;
            $html .= '<input type="checkbox" class="trt" '.$check.' name="trt[]" value="'.$row->id_trt.'">'.$span;
            $html .= '</label>';
            $html .= '</div>';

            //---------
            $i++;
            if($i == 3){
                $html .= '</div>';
                $i = 0;
            }
        }

        if($i > 0){
            $html .= '</div>';
        }
        
        return $html;
    }

    public function verificarEsp($esp, $id){
        $and = "";
        if($id != null){
            $and = "AND id_especialidad != $id";
        }

        $query = $this->db->query("SELECT * FROM especialidades WHERE nombre_esp = '$esp' $and");

        if($query->num_rows() == 0){
            return "0";
        } else {
            return "1";
        }
    }

    public function registrarEsp($esp, $trt){
        
        $num_elementos=0;
		$sw = "1";

        //$datos['id_especialidad'] = 20;
        $datos['nombre_esp'] = $esp;
        $datos['activo_esp'] = TRUE;

        
        $this->db->insert("especialidades", $datos);
        $id_esp = $this->db->insert_id();

		while ($num_elementos < count($trt))
		{
            $param = array("id_especialidad"=> $id_esp, "id_trt"=>$trt[$num_elementos]);
            $this->db->insert("tratamientos_asignados", $param);
            
            if($this->db->affected_rows() != 1){
                $sw = "0";
                break;
            }

            $num_elementos++;
		}

		return $sw;
        
    }

    

    public function modificarEsp($id, $esp, $trt){
        
        $num_elementos=0;
		$sw = "1";

        $datos['nombre_esp'] = $esp;

        $this->db->delete('tratamientos_asignados', array('id_especialidad' => $id));

        $this->db->where('id_especialidad', $id);
        $this->db->update('especialidades', $datos);

        if($trt == 0){
            $this->setConflictoEsp($id);
            return "1";
        }

		while ($num_elementos < count($trt))
		{
            $param = array("id_especialidad"=> $id, "id_trt"=>$trt[$num_elementos]);
            $this->db->insert("tratamientos_asignados", $param);
            
            if($this->db->affected_rows() != 1){
                $sw = "0";
                break;
            }

            $num_elementos++;
        }
        
        $this->setConflictoEsp($id);

		return $sw;
        
    }

    public function updateEsp($param, $id){
        if($param['activo_esp'] == FALSE){
            $query = $this->db->query("SELECT count(*) AS cuenta 
                        FROM dentistas 
                        WHERE id_especialidad = $id AND activo_dent = TRUE");

            if ($query->row()->cuenta > 0){
                return "No";
            }
        }

        $this->db->where('id_especialidad', $id);
        $this->db->update('especialidades', $param);

        return ($this->db->affected_rows() != 1) ? "0" : "1"; 
    }

    private function setConflictoEsp($id_esp){

        date_default_timezone_set("Chile/Continental");
        $hoy = date("Y-m-d");
        //-------------

        $queryTrt = $this->db->query("SELECT id_trt 
                    FROM tratamientos_asignados 
                    WHERE id_especialidad = $id_esp");

        $arrTrt = array();
        foreach($queryTrt->result() as $row){
            array_push($arrTrt, $row->id_trt);
        }
        //--------------

        $queryTrAg = $this->db->query("SELECT ag.id_agenda, ag.id_trt 
                    FROM agenda ag 
                    WHERE ((ag.id_especialidad = $id_esp AND ag.esp_actual IS NULL) OR (ag.esp_actual = $id_esp) ) 
                    AND ag.fecha >= '$hoy'");



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
    
}