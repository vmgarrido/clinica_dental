<?php 
class Cihorasatendidas extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
	}

	public function index(){
		$this->load->view('layout/header');
        $this->load->view('informes/Vhorasatendidas');
		$this->load->view('layout/menu');
        $this->load->view('layout/footer');
	}

	
}

