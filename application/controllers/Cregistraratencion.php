<?php 
class Cregistraratencion extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('Mregistraratencion');
		
	}

	public function index(){
		$this->load->view('layout/header');
        $this->load->view('pacientes/Vregistraratencion');
		$this->load->view('layout/menu');
        $this->load->view('layout/footer');
	}
    
    public function cargarAgenda(){
        $id_esp = $this->input->post("id_esp");
        $id_dent = $this->input->post("id_dent");
        $semana = $this->input->post("semana");
        
        $resp = $this->Mregistraratencion->cargarAgenda($id_esp, $id_dent, $semana);
        echo json_encode($resp);
    }
    
    public function setAgenda(){
        $fecha = new DateTime($this->input->post("fecha"));
        
        
        $param['id_horario'] = $this->input->post("id_horario");
        $param['id_dent'] = $this->input->post("id_dent");
        $param['rut_p'] = $this->input->post("rut_p");
        $param['id_especialidad'] = $this->input->post("id_especialidad");
        $param['fecha'] = $fecha->format('Y-m-d');
        $param['id_dia'] = $this->input->post("id_dia");
        $param['id_box'] = $this->input->post("id_box");
        $param['id_tp'] = $this->input->post("id_tp");
        
        if($this->input->post("id_tp") == "3"){
            $param['id_isapre'] = $this->input->post("id_isapre");
        } else {
            $param['id_isapre'] = NULL;
        }
        
        $param['id_trt'] = $this->input->post("id_trt");
        $param['valor_trt'] = $this->input->post("valor_trt");
        $param['id_disp'] = $this->input->post("id_disp");
        $param['hora_inicio'] = $this->input->post("hora_inicio");
        $param['hora_fin'] = $this->input->post("hora_fin");
        $param['conflicto_box'] = FALSE;
        $param['fecha_conflicto_box'] = NULL;
        $param['conflicto_dia'] = FALSE;
        $param['fecha_conflicto_dia'] = NULL;
        $param['conflicto_dent'] = FALSE;
        $param['fecha_conflicto_dent'] = NULL;
        $param['conflicto_trt'] = FALSE;
        $param['fecha_conflicto_trt'] = NULL;
        $param['conflicto_esp'] = FALSE;
        $param['fecha_conflicto_esp'] = NULL;
        $param['conflicto_at'] = FALSE;
        $param['fecha_conflicto_at'] = NULL;
        $param['conflicto_disp'] = FALSE;
        $param['fecha_conflicto_disp'] = NULL;
        $param['conflicto_horario'] = FALSE;
        $param['fecha_conflicto_horario'] = NULL;
        $param['atendida'] = FALSE;
        $param['activo_ag'] = TRUE;
        
        echo $this->Mregistraratencion->setAgenda($param);
    }

	
}

