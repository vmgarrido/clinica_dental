<?php 
class Ctratamientos extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('Mtratamientos');
        $this->load->model('Mconflicto');
		
	}

	public function index(){
		$this->load->view('layout/header');
        $this->load->view('general/Vtratamientos');
		$this->load->view('layout/menu');
        $this->load->view('layout/footer');
	}
    
    public function getTratamientos(){
        echo $this->Mtratamientos->getTratamientos();
	}
	
	public function setTratamientos(){
		
        $param['tratamiento'] = $this->input->post("trt");
        $param['valor'] = $this->input->post("valor");
        $param['pieza_unica'] = $this->input->post("pu");
        $param['activo_trt'] = TRUE;
        
        /*
        if($this->Mtratamientos->setTratamientos($param) == 1){
            echo "1";
        } else {
            echo "0";
        }
        */
        echo $this->Mtratamientos->setTratamientos($param);
	}
    
    public function editarTratamiento(){
        $param['tratamiento'] = $this->input->post("trt");
        $param['valor'] = $this->input->post("valor");
        $param['pieza_unica'] = $this->input->post("pu");
        
        $id = $this->input->post("id");
        
        echo $this->Mtratamientos->editarTratamiento($param, $id);
    }
    
    public function desactivarTratamiento(){
        $id = $this->input->post("id");
        $param['activo_trt'] = FALSE;
        
        if($this->Mtratamientos->editarTratamiento($param, $id) == "1"){
            $this->Mconflicto->setConflictoTrt($id);
            echo "1";
        } else {
            echo "0";
        }
    }
    
    public function activarTratamiento(){
        $id = $this->input->post("id");
        $param['activo_trt'] = TRUE;
        
        if($this->Mtratamientos->editarTratamiento($param, $id) == "1"){
            $this->Mconflicto->quitConflictoTrt($id);
            echo "1";
        } else {
            echo "0";
        }
    }

	
}

