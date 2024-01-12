<?php

class Mbox extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }

    public function getBoxes(){
        
        $query = $this->db->query("SELECT id_box, num_box, activo_box 
                                    FROM boxes ORDER BY num_box");
        
        foreach ($query->result() as $row){
            $id = $row->id_box;
            $box = $row->num_box;
            $activo = $row->activo_box;

            $edit = '<button type="button" class="btn btn-success" onclick="editarBox('.$id.', \''.$box.'\')" >Editar</button>';

            if($activo == "t"){
                $accion = '<button type="button" class="btn btn-danger" onclick="desactivarBox('.$id.', \''.$box.'\');" >Desactivar</button>';
            } else {
                $accion = '<button type="button" class="btn btn-primary" onclick="activarBox('.$id.', \''.$box.'\');" >Activar</button>';
            }
            
            $data[]=array(
                "0"=>"Box ".$box,
               "1"=>$edit." ".$accion
            );

        }

        $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
        return json_encode($results);

    }
    
    public function registrarBox($param){

        $queryExiste = $this->db->query("SELECT * FROM boxes WHERE num_box = ".$param['num_box'].";");

        if($queryExiste->num_rows() > 0){
            return "A";
        }

        $this->db->insert("boxes", $param);
        return ($this->db->affected_rows() != 1) ? "0" : "1";

    }

    public function modificarBox($id_box, $num_box){
        $queryExiste = $this->db->query("SELECT * FROM boxes WHERE num_box = $num_box 
                        AND id_box <> $id_box;");

        if($queryExiste->num_rows() > 0){
            return "A";
        }

        $campos = array("num_box"=>$num_box);

        $this->db->where("id_box", $id_box);
        $this->db->update("boxes", $campos);
        
        return ($this->db->affected_rows() != 1) ? "0" : "1";
    }

    public function desactivarBox($id_box){

        $campos = array("activo_box"=>FALSE);

        $this->db->where("id_box",$id_box);
        $this->db->update("boxes", $campos);

        return ($this->db->affected_rows() != 1) ? "0" : "1";
	}

	public function activarBox($id_box){
		$campos = array("activo_box"=>TRUE);

        $this->db->where("id_box",$id_box);
        $this->db->update("boxes", $campos);

        return ($this->db->affected_rows() != 1) ? "0" : "1";
	}

}