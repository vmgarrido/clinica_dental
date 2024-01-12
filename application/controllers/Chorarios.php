<?php 
class Chorarios extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('Mlibreria');
        $this->load->model('Mhorarios');
        $this->load->model('Mconflicto');
		
	}

	public function index(){
		$this->load->view('layout/header');
        $this->load->view('general/Vbloques');
		$this->load->view('layout/menu');
        $this->load->view('layout/footer');
    }
    
    public function getHorarioActual(){
        echo $this->Mhorarios->getHorarioActual();
    }
    
    public function evaluarFecha(){
        $fecha = $this->input->post("fecha");
        
        if($this->Mlibreria->saber_dia($fecha) != 'Lunes'){
            echo "No Lunes";
        } else if ($this->Mlibreria->fechaSuperior($fecha) == false) {
            echo "pasado";
        } else {
            echo "ok";
        }
    }

    public function desactivarDia(){
        $id_dia = $this->input->post("id_dia");
        $id_horario = $this->input->post("id_horario");

        $resp = $this->Mhorarios->desactivarDia($id_dia, $id_horario);

        if($resp == "1"){
            $this->Mconflicto->setConflictoDia($id_dia, $id_horario);
        }

        echo $resp;
    }

    public function activarDia(){
        $id_dia = $this->input->post("id_dia");
        $id_horario = $this->input->post("id_horario");

        $resp = $this->Mhorarios->activarDia($id_dia, $id_horario);

        if($resp == "1"){
            $this->Mconflicto->quitConflictoDia($id_dia, $id_horario);
        }

        echo $resp;
    }
    
    public function registrarHorario(){
        $param['fecha_inicio'] = $this->input->post("txtFechaHorarioNuevo");
        $param['hora_inicio'] = $this->input->post("txt-hora-inicio");
        $param['hora_fin'] = $this->input->post("txt-hora-fin");
        $param['duracion_bloque'] = $this->input->post("txtMinutosBloque");
        $param['activo_h'] = TRUE;
        
        $insert_id = $this->Mhorarios->insertarHorario($param);
        
        
        $dias = $this->input->post("dia");
        $hora_inicio = $this->input->post("hi_dia");
        $hora_fin = $this->input->post("hf_dia");
        
        echo $this->Mhorarios->insertarDias($insert_id, $dias, $hora_inicio, $hora_fin);
    }
    
    public function valu(){
        date_default_timezone_set("Chile/Continental");
        $hoy = date("Y-m-d");
        echo $hoy;
    }

    public function evalHorario(){
        echo $this->Mhorarios->evalHorario();
    }

    public function getHorarioNuevo(){
        echo $this->Mhorarios->getHorarioNuevo();
    }

    public function desactivarHorarioNuevo(){
        $id = $this->input->post("id");
        $this->Mhorarios->desactivarHorarioNuevo($id);

        echo $this->Mconflicto->setConflictoHorario($id);
    }

	
}

