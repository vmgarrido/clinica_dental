<?php 
class Cadminusuario extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('Madminusuario');
		
	}

	public function index(){
		$this->load->view('layout/header');
        $this->load->view('usuarios/Vadminusuario');
		$this->load->view('layout/menu');
        $this->load->view('layout/footer');
	}
    
    public function getCargo(){
        $res = $this->Madminusuario->getCargo();
        
        echo $res;
    }
    
    public function getUsuario(){
        $rut = $this->input->post("rut");
        $dv = $this->input->post("dv");
        $res = $this->Madminusuario->getUsuario($rut, $dv);
        
        echo json_encode($res);
    }
    
    public function registrarUsuario(){
        $dpto = $this->input->post("txtDepartamento");
        
        $param['rut_u'] = $this->input->post("txtRut");
        $param['dv_u'] = $this->input->post("txtDv");
        $param['nombre_u'] = $this->input->post("txtNombre");
        $param['apellidop_u'] = $this->input->post("txtApellidoP");
        $param['apellidom_u'] = $this->input->post("txtApellidoM");
        $param['sexo_u'] = $this->input->post("txtSexo");
        $param['f_nacimiento_u'] = $this->input->post("txtFechaNac");
        $param['id_comuna'] = $this->input->post("cbxComuna");
        $param['calle_u'] = $this->input->post("txtCalle");
        $param['domicilio_u'] = $this->input->post("txtDomicilio");
        $param['telefono_u'] = $this->input->post("txtTelefono");
        $param['email_u'] = $this->input->post("txtEmail");
        $param['pass_u'] = sha1($this->input->post("txtPass"));
        $param['id_cargo'] = $this->input->post("txtCargo");
        $param['activo_u'] = TRUE;
        
        if($dpto == ""){
            $param['dpto_u'] = NULL;
        } else {
            $param['dpto_u'] = $this->input->post("txtDepartamento");
        }
        
        $resp = $this->Madminusuario->registrarUsuario($param);
        
        echo $resp;
    }
    
    public function modificarUsuario(){
        $dpto = $this->input->post("txtDepartamento");
        
        $rut = $this->input->post("txtRut");
        $param['nombre_u'] = $this->input->post("txtNombre");
        $param['apellidop_u'] = $this->input->post("txtApellidoP");
        $param['apellidom_u'] = $this->input->post("txtApellidoM");
        $param['sexo_u'] = $this->input->post("txtSexo");
        $param['f_nacimiento_u'] = $this->input->post("txtFechaNac");
        $param['id_comuna'] = $this->input->post("cbxComuna");
        $param['calle_u'] = $this->input->post("txtCalle");
        $param['domicilio_u'] = $this->input->post("txtDomicilio");
        $param['telefono_u'] = $this->input->post("txtTelefono");
        $param['email_u'] = $this->input->post("txtEmail");
        
        if($this->input->post("txtCargo")){
            $param['id_cargo'] = $this->input->post("txtCargo");
        }
        
        $pass = $this->input->post("txtPass");
        
        if($pass != ""){
            $param['pass_u'] = sha1($pass);
        }
        
        
        if($dpto == ""){
            $param['dpto_u'] = NULL;
        } else {
            $param['dpto_u'] = $this->input->post("txtDepartamento");
        }
        
        $resp = $this->Madminusuario->modificarUsuario($param, $rut);
        
        echo $resp;
    }
    
    public function desactivarUsuario(){
        
        $rut = $this->input->post("txtRut");
        
        $param['activo_u'] = FALSE;
        
        
        $resp = $this->Madminusuario->desactivarUsuario($rut, $param);
        
        echo $resp;
    }
    
    public function activarUsuario(){
        
        $rut = $this->input->post("txtRut");
        $activo = TRUE;
        
        
        $resp = $this->Madminusuario->activarUsuario($rut, $activo);
        
        echo $resp;
    }

	
}

