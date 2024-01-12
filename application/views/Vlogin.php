<?php

if ($this->session->userdata('s_rut')) {
      redirect('Cinicio/index');
    }
?>

<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/login.css">

    <script>
        window.onload = function() {
            var contenedor = document.getElementById("contenedor_carga");

            contenedor.style.visibility = 'hidden';
            contenedor.style.opacity = '0';
        }

    </script>
</head>

<body>

<div id="contenedor_carga">
    <div id="carga"></div>
</div>

<div id="login">
    <img src="<?php echo base_url(); ?>img/dental-logo-mini.png">
    <p>Identifíquese para ingresar</p>
    <table id="table-login">
        <tr>
            <td>Rut:</td>
            <td><input type="text" class="form-control" id="txtRut" name="txtRut" maxlength="8"><div id="mensajeRut" class="errores">Ingresa un Rut (Parte numérica)</div></td>
            <td>-</td>
            <td><input type="text" class="form-control" id="txtDv" name="txtDv" maxlength="1"><div id="mensajeDv" class="errores">Ingresa un Dígito verificador</div></td>
        </tr>
        <tr>
            <td>Contraseña:</td>
            <td colspan="3"><input type="password" class="form-control" id="txtPass" name="txtPass"><div id="mensajePass" class="errores">Ingresa una Contraseña</div></td>
        </tr>
    </table>

    
    <button type="button" class="btn btn-warning pull-left" id="btnLimpiar">Limpiar</button>
    <button type="button" class="btn btn-primary pull-right" id="btnIngresar">Ingresar</button>

    
</div>
<div id="mensaje">
    <div class="alert alert-danger">
        <strong>Error!</strong> <span id="sp-msg"></span>
    </div>
</div>





<script src="<?php echo base_url();?>assets/js/jquery-3.2.1.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

<script>
    var base_url = "<?php echo base_url(); ?>";

    var contenedor = document.getElementById("contenedor_carga");

    function inicioAjax() {
        contenedor.style.visibility = 'visible';
        contenedor.style.opacity = '1';
    }

    function finAjax() {
        contenedor.style.visibility = 'hidden';
        contenedor.style.opacity = '0';
    }

    $(document).ajaxStart(function() {
        inicioAjax();
    });

    $(document).ajaxStop(function() {
        finAjax();
    });

    window.onerror = function(){
        finAjax();
    }
</script>

<script src="<?php echo base_url();?>js/login.js"></script>
</body>

</html>
