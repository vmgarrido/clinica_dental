<?php 
class Cespecialidades extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('Mespecialidades');
	}

	public function index(){
		$this->load->view('layout/header');
        $this->load->view('general/Vespecialidades');
		$this->load->view('layout/menu');
        $this->load->view('layout/footer');
	}
    
    public function getEspecialidades(){
        echo $this->Mespecialidades->getEspecialidades();
    }
    
    public function getTratamientos(){
        
        $id = null;
        if($this->input->post("id")){
            $id = $this->input->post("id");
        }
        
        echo $this->Mespecialidades->getTratamientos($id);
    }

    public function verificarEsp(){
        $esp = $this->input->post("esp");

        echo $this->Mespecialidades->verificarEsp($esp, null);
    }

    public function registrarEsp(){
        $esp = $this->input->post("txtEsp");

        if($this->input->post("trt")){
            $trt = $this->input->post("trt");
        } else {
            echo "B";
            return false;
        }

        echo $this->Mespecialidades->registrarEsp($esp, $trt);
    }

    public function modificarEsp(){
        $esp = $this->input->post("txtEsp");
        $id = $this->input->post("txtIdEsp");

        if($this->input->post("trt")){
            $trt = $this->input->post("trt");
        } else {
            echo "B";
            return false;
        }

        if($this->Mespecialidades->verificarEsp($esp, $id) > 0){
            echo "A";
        } else {
            $r = $this->Mespecialidades->modificarEsp($id, $esp, $trt);
            echo $r;
        }

        
    }

    public function activarEsp(){
        $id = $this->input->post("txtIdEsp");
        $param['activo_esp'] = TRUE;

        echo $this->Mespecialidades->updateEsp($param, $id);
    }

    public function desactivarEsp(){
        $id = $this->input->post("txtIdEsp");
        $param['activo_esp'] = FALSE;

        echo $this->Mespecialidades->updateEsp($param, $id);
    }

	
}

