<?php

class Mprevision extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }

    public function getTipoPacientes(){
		$query = $this->db->query("SELECT id_tp, tipo, activo_tipo FROM tipo_pacientes WHERE id_tp > 1");

		$arr = array();
		foreach($query->result() as $row){
			$arr[] = array("id"=>$row->id_tp, "tipo"=>$row->tipo, "activo_tipo"=>$row->activo_tipo);
		}

		return json_encode($arr);
	}

	public function desactivarTipoPaciente($id){
		$this->db->where("id_tp", $id);
		$this->db->update("tipo_pacientes", array('activo_tipo'=>FALSE));

		return ($this->db->affected_rows() == 1) ? "1" : "0";

	}

	public function activarTipoPaciente($id){
		$this->db->where("id_tp", $id);
		$this->db->update("tipo_pacientes", array('activo_tipo'=>TRUE));

		return ($this->db->affected_rows() == 1) ? "1" : "0";

	}

	public function getIsapres(){
		$query = $this->db->query("SELECT id_isapre, isapre, activo_isapre FROM isapres ORDER BY isapre");
            
        foreach ($query->result() as $row){
            $id = $row->id_isapre;
            $isapre = $row->isapre;
            $activo = $row->activo_isapre;
            
            $edit = '<button type="button" class="btn btn-success editar" onclick="edit('.$id.', \''.$isapre.'\');" >Editar</button>';
            //$edit = '<button type="button" class="btn btn-success editar" onclick="edit(1, 2, 3, 4);" >Editar</button>';
            
            if($activo == "t"){
                $accion = '<button type="button" class="btn btn-danger desactivar" onclick="desactivarIs('.$id.', \''.$isapre.'\');" >Desactivar</button>';
            } else{
                $accion = '<button type="button" class="btn btn-info activar" onclick="activarIs('.$id.', \''.$isapre.'\');" >Activar</button>';
            }
            
            $data[]=array(
 				"0"=>$isapre,
 				"1"=>$edit.' '.$accion
 				);
        }
        
        $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
        return json_encode($results);
	}

	public function desactivarIsapre($id){
		$this->db->where("id_isapre", $id);
		$this->db->update("isapres", array("activo_isapre"=>FALSE));
		return ($this->db->affected_rows() == 1) ? "1" : "0";
	}

	public function activarIsapre($id){
		$this->db->where("id_isapre", $id);
		$this->db->update("isapres", array("activo_isapre"=>TRUE));
		return ($this->db->affected_rows() == 1) ? "1" : "0";
	}

	public function registrarIsapre($param){
		$query1 = $this->db->query("SELECT * FROM isapres WHERE isapre = '".$param['isapre']."'");

		if($query1->num_rows() > 0){
			return "A";
		}

		$this->db->insert("isapres", $param);
		return ($this->db->affected_rows() == 1) ? "1" : "0";
	}

	public function editarIsapre($id, $isapre){
		$query = $this->db->query("SELECT * 
				FROM isapres 
				WHERE isapre = '$isapre' AND id_isapre <> $id");

		if($query->num_rows() > 0){
			return "A";
		}


		$this->db->where("id_isapre", $id);
		$this->db->update("isapres", array("isapre"=>$isapre));
		return ($this->db->affected_rows() == 1) ? "1" : "0";
	}

}