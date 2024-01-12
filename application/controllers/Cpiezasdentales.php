<?php 
class Cpiezasdentales extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('Mpiezasdentales');
		
	}

	public function index(){
		$this->load->view('layout/header');
        $this->load->view('general/Vpiezasdentales');
		$this->load->view('layout/menu');
        $this->load->view('layout/footer');
	}

	public function getPiezas(){
		echo $this->Mpiezasdentales->getPiezas();
	}

	public function registrarPieza(){
		$nombre = $this->input->post("nombre");
		$numero = $this->input->post("numero");

		echo $this->Mpiezasdentales->registrarPieza($nombre, $numero);
	}

	public function modificarPieza(){
		$id_pd = $this->input->post("id_pd");
		$nombre = $this->input->post("nombre");
		$numero = $this->input->post("numero");

		echo $this->Mpiezasdentales->modificarPieza($id_pd, $nombre, $numero);
	}

	public function desactivarPieza(){
		$id_pd = $this->input->post("id_pd");

		echo $this->Mpiezasdentales->desactivarPieza($id_pd);
	}

	public function activarPieza(){
		$id_pd = $this->input->post("id_pd");

		echo $this->Mpiezasdentales->activarPieza($id_pd);
	}

	
}

