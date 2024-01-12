<?php

if (!$this->session->userdata('s_rut')) {
      redirect('Clogin');
    }
    
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/estilos.css">

    <link rel="stylesheet" href="<?php echo base_url();?>css/general.css">

    <?php if($this->uri->segment(1)=='Cinicio') {?>
    <title>Inicio - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/inicio.css">
    <?php }?>

    <?php if($this->uri->segment(1)=='Cadminusuario') {?>
    <title>Administrar Usuarios - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/usuarios/adminusuarios.css">
    <?php }?>
    
    <?php if($this->uri->segment(1)=='Cadmindentista') {?>
    <title>Administrar Dentistas - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/usuarios/admindentistas.css">
    <?php }?>

    <?php if($this->uri->segment(1)=='Cdentistafin') {?>
    <title>Finalizar atenciones Dentistas - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/usuarios/admindentistas.css">
    <?php }?>

    <?php if($this->uri->segment(1)=='Cdentistasfin') {?>
    <title>Dentistas a desactivar - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/usuarios/admindentistas.css">
    <?php }?>

    <?php if($this->uri->segment(1)=='Cdisponibilidad') {?>
    <title>Disponibilidad de Dentistas - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/usuarios/disponibilidad.css">
    <?php }?>

    <?php if($this->uri->segment(1)=='Cadminpaciente') {?>
    <title>Administrar pacientes - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/pacientes/adminpacientes.css">
    <?php }?>

    <?php if($this->uri->segment(1)=='Cregistraratencion') {?>
    <title>Registrar atención - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/pacientes/registraratencion.css">
    <?php }?>

    <?php if($this->uri->segment(1)=='Catencionesconflicto') {?>
    <title>Cambiar atención - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/pacientes/atencionesconflicto.css">
    <?php }?>

    <?php if($this->uri->segment(1)=='Catencionespaciente') {?>
    <title>Lista atenciones - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/pacientes/atencionesconflicto.css">
    <?php }?>    

    <?php if($this->uri->segment(1)=='Cpiezasdentales') {?>
    <title>Piezas dentales - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/general/piezasdentales.css">
    <?php }?>

    <?php if($this->uri->segment(1)=='Ctratamientos') {?>
    <title>Tratamientos - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/general/tratamientos.css">
    <?php }?>

    <?php if($this->uri->segment(1)=='Cespecialidades') {?>
    <title>Especialidades - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/general/especialidades.css">
    <?php }?>

    <?php if($this->uri->segment(1)=='Cbox') {?>
    <title>Boxes - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/general/box.css">
    <?php }?>

    <?php if($this->uri->segment(1)=='Chorarios') {?>
    <title>Bloques de atención - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/general/horarios.css">
    <?php }?>

    <?php if($this->uri->segment(1)=='Cdias') {?>
    <title>Días de trabajo - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/general/dias.css">
    <?php }?>

    <?php if($this->uri->segment(1)=='Cprevision') {?>
    <title>Previsión - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/general/prevision.css">
    <?php }?>

    <?php if($this->uri->segment(1)=='Cdentista') {?>
    <title>Agenda Dentista - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/dentista/dentista.css">
    <?php }?>

    <?php if($this->uri->segment(1)=='Cihistorialclinico') {?>
    <title>Informe Historial clínico - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/informes/historialclinico.css">
    <?php }?>

    <?php if($this->uri->segment(1)=='Cihorasatendidas') {?>
    <title>Informe Horas atendidas y sin atender - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/informes/horasatendidas.css">
    <?php }?>

    <?php if($this->uri->segment(1)=='Cidemandaespecialidad') {?>
    <title>Informe Demanda de especialidad - Dental del Sur</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/informes/demandaespecialidad.css">
    <?php }?>


    <style>
        h2{
            border-radius: 0px;
        }
    </style>
    <script>
        window.onload = function() {
            var contenedor = document.getElementById("contenedor_carga");

            contenedor.style.visibility = 'hidden';
            contenedor.style.opacity = '0';
        }

    </script>

</head>

<body class="hold-transition skin-blue sidebar-mini">

    <div id="contenedor_carga">
        <div id="carga"></div>
    </div>

    <?php

    /*
if (!$this->session->userdata('s_idUsuario')) {
      redirect('clogin');
    }
    */
?>

        <div class="wrapper">
