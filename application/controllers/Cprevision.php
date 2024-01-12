<?php 
class Cprevision extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('Mprevision');
		
	}

	public function index(){
		$this->load->view('layout/header');
        $this->load->view('general/Vprevision');
		$this->load->view('layout/menu');
        $this->load->view('layout/footer');
	}

	public function getTipoPacientes(){
		echo $this->Mprevision->getTipoPacientes();
	}

	public function desactivarTipoPaciente(){
		$id = $this->input->post("id");
		echo $this->Mprevision->desactivarTipoPaciente($id);
	}

	public function activarTipoPaciente(){
		$id = $this->input->post("id");
		echo $this->Mprevision->activarTipoPaciente($id);
	}

	public function getIsapres(){
		echo $this->Mprevision->getIsapres();
	}

	public function desactivarIsapre(){
		$id = $this->input->post("id");
		echo $this->Mprevision->desactivarIsapre($id);
	}

	public function activarIsapre(){
		$id = $this->input->post("id");
		echo $this->Mprevision->activarIsapre($id);
	}

	public function registrarIsapre(){
		$param['id_tp'] = 3;
		$param['isapre'] = $this->input->post("isapre");
		$param['activo_isapre'] = TRUE;

		echo $this->Mprevision->registrarIsapre($param);
	}

	public function editarIsapre(){
		$id = $this->input->post("id");
		$isapre = $this->input->post("isapre");
		echo $this->Mprevision->editarIsapre($id, $isapre);
	}

	
}

