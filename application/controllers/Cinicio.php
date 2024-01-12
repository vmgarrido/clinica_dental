<?php 
class Cinicio extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
	}

	public function index(){
		$this->load->view('layout/header');
        $this->load->view('Vinicio');
		$this->load->view('layout/menu');
        $this->load->view('layout/footer');
	}

	
}

