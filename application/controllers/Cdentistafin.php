<?php 
class Cdentistafin extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$this->load->view('layout/header');
        $this->load->view('usuarios/Vdentistafin');
		$this->load->view('layout/menu');
        $this->load->view('layout/footer');
	}

}