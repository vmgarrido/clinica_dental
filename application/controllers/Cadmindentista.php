<?php 
class Cadmindentista extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('Madmindentista');
        $this->load->model('Mconflicto');
		
	}

	public function index(){
		$this->load->view('layout/header');
        $this->load->view('usuarios/Vadmindentista');
		$this->load->view('layout/menu');
        $this->load->view('layout/footer');
	}
    
    public function getEspecialidades(){
        echo $this->Madmindentista->getEspecialidades();
    }
    
    public function getDentista(){
        $rut = $this->input->post("rut");
        $dv = $this->input->post("dv");
        $res = $this->Madmindentista->getDentista($rut, $dv);
        
        echo json_encode($res);
    }
    
    public function registrarDentista(){
        $dpto = $this->input->post("txtDepartamento");
        
        $rut = $this->input->post("txtRut");
        
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
        $param['activo_u'] = TRUE;
        
        $especialidad = $this->input->post("txtEspecialidad");
        
        if($dpto == ""){
            $param['dpto_u'] = NULL;
        } else {
            $param['dpto_u'] = $this->input->post("txtDepartamento");
        }
        for($i=0; $i<=1; $i++){
            if($i == 0){
                $this->Madmindentista->registrarUsuario($param);
            } else {
                $resp = $this->Madmindentista->registrarDentista($rut, $especialidad);
            }
        }
        
        
        echo $resp;
    }

    public function registrarDentista2(){
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
        $param['pass_u'] = sha1($this->input->post("txtPass"));
        $param['activo_u'] = TRUE;
        
        $especialidad = $this->input->post("txtEspecialidad");
        
        if($dpto == ""){
            $param['dpto_u'] = NULL;
        } else {
            $param['dpto_u'] = $this->input->post("txtDepartamento");
        }
        for($i=0; $i<=1; $i++){
            if($i == 0){
                $this->Madmindentista->modificarUsuario($param, $rut);
            } else {
                $resp = $this->Madmindentista->registrarDentista($rut, $especialidad);
            }
        }
        
        
        echo $resp;
    }
    
    public function modificarDentista(){
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
        
        $pass = $this->input->post("txtPass");
        
        if($pass != ""){
            $param['pass_u'] = sha1($pass);
        }
        
        $id_esp = "";
        $flag = false;
        if($this->input->post("txtEspecialidad")){
            $param2['id_especialidad'] = $this->input->post("txtEspecialidad");
            $flag = true;
            $id_esp = $param2['id_especialidad'];
        }
        
        
        if($dpto == ""){
            $param['dpto_u'] = NULL;
        } else {
            $param['dpto_u'] = $this->input->post("txtDepartamento");
        }
        
        for($i=0; $i<=1; $i++){
            if($i == 0){
                $resp = $this->Madmindentista->modificarUsuario($param, $rut);
            } else {
                if($flag){
                    $resp = $this->Madmindentista->modificarDentista($rut, $param2);

                    if($resp == "1"){
                        $this->Mconflicto->cambiarConflictoEsp($rut, $id_esp);
                    }
                }
            }
        }
        
        
        
        echo $resp;
    }
    
    public function desactivarDentista(){
        
        $rut = $this->input->post("txtRut");
        $param['activo_u'] = FALSE;
        $param2['activo_dent'] = FALSE;
        
        for($i=0; $i<=1; $i++){
            if($i == 0){
                $resp = $this->Madmindentista->desactivarUsuario($rut, $param);
            } else {
                
                $resp = $this->Madmindentista->desactivarDentista($rut, $param2);
                
                if($resp == "1"){
                    $this->Mconflicto->setDispFalse($rut);
                }
                
            }
        }
        
        echo $resp;
    }
    
    public function activarDentista(){
        
        $rut = $this->input->post("txtRut");
        $param['activo_u'] = TRUE;
        $param2['activo_dent'] = TRUE;
        
        for($i=0; $i<=1; $i++){
            if($i == 0){
                $resp = $this->Madmindentista->activarUsuario($rut, $param);
            } else {
                
                $resp = $this->Madmindentista->activarDentista($rut, $param2);
                
            }
        }
        
        echo $resp;
    }

	
}

