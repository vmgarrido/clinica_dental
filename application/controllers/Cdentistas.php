<?php 
class Cdentistas extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('Mdentistas');
		
	}

	
    public function getEspecialidades(){
        echo $this->Mdentistas->getEspecialidades();
    }
    
    public function getDentistas(){
        $id = $this->input->post("id_esp");
        
        echo $this->Mdentistas->getDentistas($id);
    }
    
    public function getTratamientos(){
        $id = $this->input->post("id_esp");
        
        echo $this->Mdentistas->getTratamientos($id);
    }
	
}