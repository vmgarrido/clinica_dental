<?php 
class Cihistorialclinico extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('Mihistorialclinico');
		
	}

	public function index(){
		$this->load->view('layout/header');
        $this->load->view('informes/Vhistorialclinico');
		$this->load->view('layout/menu');
        $this->load->view('layout/footer');
	}

	public function getHistorial(){
		$fecha1 = $this->input->post("txtFechaInicio");
		$fecha2 = $this->input->post("txtFechaFin");
		$id_esp = $this->input->post("cbxEspecialidad");

		echo $this->Mihistorialclinico->getHistorial($fecha1, $fecha2, $id_esp);
	}

	public function getHistorial2(){
		$fecha1 = $this->input->post("txtFechaInicio");
		$fecha2 = $this->input->post("txtFechaFin");
		$id_esp = $this->input->post("cbxEspecialidad");

		echo $this->Mihistorialclinico->getHistorial2($fecha1, $fecha2, $id_esp);
	}

	public function demandaEspecialidad(){
		$fecha1 = $this->input->post("txtFechaInicio");
		$fecha2 = $this->input->post("txtFechaFin");
		$id_esp = $this->input->post("cbxEspecialidad");

		echo $this->Mihistorialclinico->demandaEspecialidad($fecha1, $fecha2, $id_esp);
	}



	
}

