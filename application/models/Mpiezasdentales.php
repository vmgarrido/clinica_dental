<?php

class Mpiezasdentales extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }

    public function getPiezas(){

        $query = $this->db->query("SELECT * FROM piezas_dentales");

        foreach ($query->result() as $row){
            $id = $row->id_pd;
            $nombre = $row->nombre;
            $numero = $row->numero;
            $activo = $row->activo_pd;
            
            $edit = '<button type="button" class="btn btn-success" onclick="editarPieza('.$id.', \''.$nombre.'\', '.$numero.');" ><i class="fa fa-edit"></i></button>';
            //$edit = '<button type="button" class="btn btn-success editar" onclick="edit(1, 2, 3, 4);" >Editar</button>';
            
            if($activo == "t"){
                $accion = '<button type="button" class="btn btn-danger" onclick="desactivarPieza('.$id.', \''.$nombre.'\', '.$numero.');" ><i class="fa fa-arrow-down"></i></button>';
            } else{
                $accion = '<button type="button" class="btn btn-warning" onclick="activarPieza('.$id.', \''.$nombre.'\', '.$numero.');" ><i class="fa fa-arrow-up"></i></button>';
            }
            
            $data[]=array(
                "0"=>$nombre,
                "1"=>$numero,
                "2"=>$edit." ".$accion
 				);
        }
        
        $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
        return json_encode($results);

    }

    public function registrarPieza($nombre, $numero){
        $queryExiste = $this->db->query("SELECT * FROM piezas_dentales WHERE nombre = '$nombre' AND numero = $numero");
    
        if($queryExiste->num_rows() > 0){
            return "A";
        }

        $campos = array(
            "nombre" => $nombre,
            "numero" => $numero,
            "activo_pd" => TRUE
        );

        $this->db->insert("piezas_dentales", $campos);
        return ($this->db->affected_rows() != 1) ? "0" : "1"; 
    
    }

    public function modificarPieza($id_pd, $nombre, $numero){

        $queryExiste = $this->db->query("SELECT * FROM piezas_dentales WHERE nombre = '$nombre' AND numero = $numero 
        AND id_pd <> $id_pd");
    
        if($queryExiste->num_rows() > 0){
            return "A";
        }

        $campos = array(
            "nombre" => $nombre,
            "numero" => $numero
        );

        $this->db->where("id_pd", $id_pd);
        $this->db->update("piezas_dentales", $campos);
        return ($this->db->affected_rows() != 1) ? "0" : "1"; 
    }

    public function desactivarPieza($id_pd){
        $campos = array(
            "activo_pd" => FALSE
        );

        $this->db->where("id_pd", $id_pd);
        $this->db->update("piezas_dentales", $campos);
        return ($this->db->affected_rows() != 1) ? "0" : "1"; 
    }

    public function activarPieza($id_pd){
        $campos = array(
            "activo_pd" => TRUE
        );

        $this->db->where("id_pd", $id_pd);
        $this->db->update("piezas_dentales", $campos);
        return ($this->db->affected_rows() != 1) ? "0" : "1"; 
    }

}