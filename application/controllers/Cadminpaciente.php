<?php 
class Cadminpaciente extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('Madminpaciente');
		
	}

	public function index(){
		$this->load->view('layout/header');
        $this->load->view('pacientes/Vadminpaciente');
		$this->load->view('layout/menu');
        $this->load->view('layout/footer');
	}
    
    // cargar regiones comunas tipo_paciente e isapres
    
    
    public function getTipoPaciente(){
        $res = $this->Madminpaciente->getTipoPaciente();
        
        echo $res;
    }
    
    public function getIsapres(){
        $id_tp = $this->input->post("id_tp");
        $res = $this->Madminpaciente->getIsapres($id_tp);
        
        echo $res;
    }
    // fin cargar regiones comunas tipo_paciente e isapres

	public function getPaciente(){
        $rut = $this->input->post("rut");
        $dv = $this->input->post("dv");
        $res = $this->Madminpaciente->getPaciente($rut, $dv);
        
        echo json_encode($res);
    }
    
    public function registrarPaciente(){
        $is = $this->input->post("cbxPrevision");
        $dpto = $this->input->post("txtDepartamento");
        
        $param['rut_p'] = $this->input->post("txtRut");
        $param['dv_p'] = $this->input->post("txtDv");
        $param['nombre_p'] = $this->input->post("txtNombre");
        $param['apellidop_p'] = $this->input->post("txtApellidoP");
        $param['apellidom_p'] = $this->input->post("txtApellidoM");
        $param['sexo_p'] = $this->input->post("txtSexo");
        $param['f_nacimiento_p'] = $this->input->post("txtFechaNac");
        $param['id_comuna'] = $this->input->post("txtComuna");
        $param['calle_p'] = $this->input->post("txtCalle");
        $param['domicilio_p'] = $this->input->post("txtDomicilio");
        $param['telefono_p'] = $this->input->post("txtTelefono");
        $param['id_tp'] = $is;
        $param['activo_p'] = TRUE;
        
        if($is == "3"){
            $param['id_isapre'] = $this->input->post("cbxIsapre");
        } else{
            $param['id_isapre'] = NULL;
        }
        
        if($dpto == ""){
            $param['dpto_p'] = NULL;
        } else {
            $param['dpto_p'] = $this->input->post("txtDepartamento");
        }
        
        $resp = $this->Madminpaciente->registrarPaciente($param);
        
        echo $resp;
    }
    
    public function modificarPaciente(){
        $is = $this->input->post("cbxPrevision");
        $dpto = $this->input->post("txtDepartamento");
        
        $rut = $this->input->post("txtRut");
        $dv = $this->input->post("txtDv");
        $param['nombre_p'] = $this->input->post("txtNombre");
        $param['apellidop_p'] = $this->input->post("txtApellidoP");
        $param['apellidom_p'] = $this->input->post("txtApellidoM");
        $param['sexo_p'] = $this->input->post("txtSexo");
        $param['f_nacimiento_p'] = $this->input->post("txtFechaNac");
        $param['id_comuna'] = $this->input->post("txtComuna");
        $param['calle_p'] = $this->input->post("txtCalle");
        $param['domicilio_p'] = $this->input->post("txtDomicilio");
        $param['telefono_p'] = $this->input->post("txtTelefono");
        $param['id_tp'] = $is;
        
        if($is == "3"){
            $param['id_isapre'] = $this->input->post("cbxIsapre");
        } else{
            $param['id_isapre'] = NULL;
        }
        
        if($dpto == ""){
            $param['dpto_p'] = NULL;
        } else {
            $param['dpto_p'] = $this->input->post("txtDepartamento");
        }
        
        $resp = $this->Madminpaciente->modificarPaciente($param, $rut, $dv);
        
        echo $resp;
    }
    
    public function desactivarPaciente(){
        $rut = $this->input->post("txtRut");
        $param['activo_p'] = FALSE;
        
        $resp = $this->Madminpaciente->desactivarPaciente($param, $rut);
        
        echo $resp;
    }
    
    public function activarPaciente(){
        $rut = $this->input->post("txtRut");
        $param['activo_p'] = TRUE;
        
        $resp = $this->Madminpaciente->activarPaciente($param, $rut);
        
        echo $resp;
    }
}

