<?php 
class Cdentista extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('Mdentistas');
        $this->load->model('Mlibreria');
        $this->load->model('Mtratamientos');
		
	}

	public function index(){
		$this->load->view('layout/header');
        $this->load->view('dentista/Vdentista');
		$this->load->view('layout/menu');
        $this->load->view('layout/footer');
	}

	public function getAgenda(){
		$id_dent = $this->input->post("id_dent");
		$fecha = $this->input->post("fecha");

		echo $this->Mdentistas->getAgenda($id_dent, $fecha);
	}

	public function fechaSuperior(){
		$fecha = $this->input->post("fecha");

		echo $this->Mlibreria->fechaSuperior2($fecha);
	}

	public function getPaciente(){
		$id_agenda = $this->input->post("id_agenda");

		echo $this->Mdentistas->getPaciente($id_agenda);
	}

	public function registrarHistorial(){

		$param['id_agenda'] = $this->input->post("id_agenda");
		$param['id_dent'] = $this->input->post("id_dent");
		$param['rut_p'] = $this->input->post("rut_p");
		$param['id_especialidad'] = $this->input->post("id_especialidad");

		echo $this->Mdentistas->registrarHistorial($param);

	}

	public function registrarDiagnostico(){

		$id_hc = $this->input->post("id_hc");
		$diagnostico = $this->input->post("diagnostico");

		echo $this->Mdentistas->registrarDiagnostico($id_hc, $diagnostico);
	}

	public function listarTratamientos(){

		$id_esp = $this->input->post("id_esp");
		echo $this->Mtratamientos->listarTratamientos($id_esp);
	}

	public function listarPiezas(){
		echo $this->Mdentistas->listarPiezas();
	}

	public function setTrtSinRealizar(){
		$param['id_dent'] = $this->input->post("id_dent");
		$param['rut_p'] = $this->input->post("rut_p");
		$param['id_trt'] = $this->input->post("id_trt");
		$param['nombre_pieza_d'] = $this->input->post("nombre_pieza_d");
		$param['num_pieza_d'] = $this->input->post("num_pieza_d");
		$param['activo_tsn'] = TRUE;

		echo $this->Mdentistas->setTrtSinRealizar($param);
	}

	public function borrarTratamiento(){
		$id_tsn = $this->input->post("id_tsn");
		echo $this->Mdentistas->borrarTratamiento($id_tsn);
	}

	public function getTrtSinRealizar(){
		$rut_p = $this->input->post("rut_p");

		echo $this->Mdentistas->getTrtSinRealizar($rut_p);
	}

	public function getTrtRealizados(){
		$rut_p = $this->input->post("rut_p");

		echo $this->Mdentistas->getTrtRealizados($rut_p);
	}

	public function realizarTratamiento(){
		$id_hc = $this->input->post("id_hc");
		$param['id_dent'] = $this->input->post("id_dent");
		$param['rut_p'] = $this->input->post("rut_p");
		$param['id_tsn'] = $this->input->post("id_tsn");
		$param['id_trt'] = $this->input->post("id_trt");
		$param['nombre_pieza_d'] = $this->input->post("nombre_pieza_d");
		$param['num_pieza_d'] = $this->input->post("num_pieza_d");

		echo $this->Mdentistas->realizarTratamiento($param, $id_hc);
	}

	public function removerTrtRealizado(){
		$id_hc = $this->input->post("id_hc");
		$id_tsn = $this->input->post("id_tsn");
		$id_trz = $this->input->post("id_trz");

		echo $this->Mdentistas->removerTrtRealizado($id_hc, $id_tsn, $id_trz);
	}

	public function getHistorial(){
		$rut_p = $this->input->post("rut_p");
		echo $this->Mdentistas->getHistorial($rut_p);
	}

	public function finalizarAtencion(){
		$id_agenda = $this->input->post("id_agenda");
		echo $this->Mdentistas->finalizarAtencion($id_agenda);
	}

	public function getDiagnostico(){
		$id = $this->input->post("id");
		echo $this->Mdentistas->getDiagnostico($id);
	}

	
}

