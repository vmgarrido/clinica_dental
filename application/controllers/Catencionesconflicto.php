<?php 
class Catencionesconflicto extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('Matconflicto');
		
	}

	public function index(){
		$this->load->view('layout/header');
        $this->load->view('pacientes/Vatencionesconflicto');
		$this->load->view('layout/menu');
        $this->load->view('layout/footer');
	}

	public function getHoras(){
		echo $this->Matconflicto->getHoras();
	}

	
}

