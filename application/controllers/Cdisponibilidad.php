<?php 
class Cdisponibilidad extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('Mdisponibilidad');
        $this->load->model('Mconflicto');
		
	}

	public function index(){
		$this->load->view('layout/header');
        $this->load->view('usuarios/Vdisponibilidad');
		$this->load->view('layout/menu');
        $this->load->view('layout/footer');
	}
    
    public function getDisponibilidad(){
        $id_dia = $this->input->post("id_dia");
        $jornada = $this->input->post("jornada");
        
        $res = $this->Mdisponibilidad->getDisponibilidad($jornada, $id_dia);
        
        echo json_encode($res);
    }
    
    public function getDisponibilidadDent(){
        $id_dia = $this->input->post("id_dia");
        $rut_c = $this->input->post("rut_c");
        $jornada = $this->input->post("jornada");
        
        $res = $this->Mdisponibilidad->getDisponibilidadDent($jornada, $id_dia, $rut_c);
        
        echo json_encode($res);
    }
    
    public function getDentista(){
        $rut = $this->input->post("rut");
        $dv = $this->input->post("dv");
        
        $res = $this->Mdisponibilidad->getDentista($rut, $dv);
        
        echo json_encode($res);
    }
    
    
    public function getListaHorario(){
        $rut = $this->input->post("rut");
        $dv = $this->input->post("dv");
        $jornada = $this->input->post("jornada");
        
        $res = $this->Mdisponibilidad->getListaHorario($rut, $dv, $jornada);
        
        echo $res;
    }
    
    public function getBox(){
        $res = $this->Mdisponibilidad->getBox();
        
        echo $res;
    }
    
    public function setRegistrar(){
        
        $param['id_dent'] = $this->input->post("id_dent");
        
        $param['id_horario'] = $this->input->post("cbxJornada");
        $param['id_especialidad'] = $this->input->post("id_esp");
        $param['id_box'] = $this->input->post("cbxBox");
        $param['id_dia'] = $this->input->post("cbxDiasNuevo");
        $param['hora_inicio'] = $this->input->post("txtBloqueInicio");
        $param['hora_fin'] = $this->input->post("cbxBloqueFin");
        $param['activo_disp'] = TRUE;
        $param['conflicto_box'] = FALSE;
        $param['conflicto_dia'] = FALSE;
        
        if ($this->Mdisponibilidad->consultaDispOcupada2($param) != "0"){
            echo "B";
        } else if ($this->Mdisponibilidad->consultaDispOcupada($param) != "0"){
            echo "A";
        } else {
            echo $this->Mdisponibilidad->setRegistrar($param);
        }
        
    }

    public function removeDisponibilidad(){
        $id = $this->input->post("id");
        if($this->Mdisponibilidad->removeDisponibilidad($id) == "A"){
            echo $this->Mconflicto->conflictoDisp($id);
        } else {
            echo "B";
        }
    }
    

	
}