<?php 
class Cubicacion extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('Mubicacion');
		
	}

	public function getRegiones(){
        $res = $this->Mubicacion->getRegiones();
        
        echo $res;
    }
    
    public function getComunas(){
        $id_region = $this->input->post("id_region");
        $res = $this->Mubicacion->getComunas($id_region);
        
        echo $res;
    }

	
}