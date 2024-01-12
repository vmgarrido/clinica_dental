<?php

class Mtratamientos extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }
    
    public function getTratamientos(){
        $query = $this->db->query("SELECT * FROM tratamientos ORDER BY tratamiento");
            
        foreach ($query->result() as $row){
            $id = $row->id_trt;
            $nombre = $row->tratamiento;
            $valor = $row->valor;
            $activo = $row->activo_trt;
            
            $pieza_unica = "No";
            if($row->pieza_unica == "t"){
                $pieza_unica = "Si";
            }
            
            $edit = '<button type="button" class="btn btn-success editar" onclick="edit('.$id.', \''.$nombre.'\', '.$valor.', \''.$pieza_unica.'\');" >Editar</button>';
            //$edit = '<button type="button" class="btn btn-success editar" onclick="edit(1, 2, 3, 4);" >Editar</button>';
            
            if($activo == "t"){
                $accion = '<button type="button" class="btn btn-danger desactivar" onclick="desactivar('.$id.', \''.$nombre.'\');" >Desactivar</button>';
            } else{
                $accion = '<button type="button" class="btn btn-info activar" onclick="activar('.$id.', \''.$nombre.'\');" >Activar</button>';
            }
            
            $data[]=array(
 				"0"=>$nombre,
 				"1"=>$valor,
                "2"=>$pieza_unica,
                "3"=>$edit." ".$accion
 				);
        }
        
        $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
        return json_encode($results);
    }
    
    public function setTratamientos($param){
		
        $trt = $param['tratamiento'];

        $query1 = $this->db->query("SELECT * FROM tratamientos WHERE tratamiento = '$trt'");
        
        if($query1->num_rows() > 0){
            return "A";
        }
        
        $this->db->insert("tratamientos", $param);
        
        return $this->db->affected_rows();
        
    }
    
    public function listarTratamientos($id_especialidad){
        $query = $this->db->query("SELECT trt.id_trt, trt.tratamiento, trt.pieza_unica, trt.valor  
        FROM tratamientos trt 
        INNER JOIN tratamientos_asignados taa ON trt.id_trt = taa.id_trt 
        WHERE taa.id_especialidad = $id_especialidad  
        ORDER BY trt.tratamiento");

        $option = '';
        foreach($query->result() as $row){
            $pi = ($row->pieza_unica == "t") ? "si" : "no";
            $option .= '<option valor="'.$row->valor.'" unica="'.$pi.'" value="'.$row->id_trt.'">'.$row->tratamiento.'</option>';
        }

        return $option;
    }
    
    public function editarTratamiento($param, $id){
		
        if(isset($param['tratamiento'])){
            $query1 = $this->db->query("SELECT * FROM tratamientos WHERE tratamiento = '".$param['tratamiento']."' 
            AND id_trt <> $id");
            
            if($query1->num_rows() > 0){
                return "A";
            }
        }
        
        $this->db->where('id_trt', $id);
        $this->db->update("tratamientos", $param);
        
        return ($this->db->affected_rows() != 1) ? "0" : "1";
        
	}
}