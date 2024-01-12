<?php 
class Ctiempo extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('Mtiempo');
		
	}
    
    public function index(){
		echo "Hola";
	}
    
    public function getDiasActivos(){
        $joranada = $this->input->post("jornada");
		$res = $this->Mtiempo->getDiasActivos($joranada);
        
        echo $res;
	}
    
    public function getHorarios(){
        $res = $this->Mtiempo->getHorarios();
        echo $res;
    }
    
    public function getBloques1(){
        $joranada = $this->input->post("jornada");
        $dia = $this->input->post("dia");
        
        $res = $this->Mtiempo->getBloques1($joranada, $dia);
        echo $res;
    }
    
    public function getBloques2(){
        
        $jornada = $this->input->post("jornada");
        $dia = $this->input->post("dia");
        $hi = $this->input->post("hi");
        
        $res = $this->Mtiempo->getBloques2($jornada, $dia, $hi);
        echo $res;
    }
    
    public function getTresSemanas(){
        
        echo $this->Mtiempo->getTresSemanas();
        
    }
}