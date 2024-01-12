<?php 
class Ccerrar extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index(){

	}

	public function cerrar(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

}