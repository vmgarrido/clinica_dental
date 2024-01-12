<?php
/**
* 
*/
class Clogin extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('Mlibreria');
	}

	public function index(){
		$this->load->view('Vlogin');
	}

	public function ingresar(){
		$rut = $this->input->post("rut");
		$dv = $this->input->post("dv");
		$pass = sha1($this->input->post("pass"));

		if ($this->Mlibreria->validarRut($rut.'-'.$dv) == "0"){
			echo "Rut falso";
		} else {
			echo $this->Mlibreria->existeUsuario($rut, $dv, $pass);
		}
	}

	public function validarRut(){
		$rut = $this->input->post("rut");
		$dv = $this->input->post("dv");
		echo $this->Mlibreria->validarRut($rut.'-'.$dv);
	}

	public function logout(){
		
	}
}