<?php 
class Cbox extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mbox');
        $this->load->model('Mconflicto');
	}

	public function index(){
		$this->load->view('layout/header');
        $this->load->view('general/Vbox');
		$this->load->view('layout/menu');
        $this->load->view('layout/footer');
	}

	public function getBoxes(){
		echo $this->Mbox->getBoxes();
	}

	public function registrarBox(){
		$num_box = $this->input->post("num_box");

		$param["num_box"] = $num_box;
		$param["activo_box"] = TRUE;

		echo $this->Mbox->registrarBox($param);
	}

	public function modificarBox(){
		$id_box = $this->input->post("id_box");
		$num_box = $this->input->post("num_box");

		echo $this->Mbox->modificarBox($id_box, $num_box);
	}

	public function desactivarBox(){
		$id_box = $this->input->post("id_box");
		$resp = $this->Mbox->desactivarBox($id_box);

		if($resp == "1"){
			$this->Mconflicto->setConflictoBox($id_box);
		}

		echo $resp;
	}

	public function activarBox(){
		$id_box = $this->input->post("id_box");

		$resp = $this->Mbox->activarBox($id_box);

		if($resp == "1"){
			$this->Mconflicto->quitConflictoBox($id_box);
		}

		echo $resp;
	}

	
}

