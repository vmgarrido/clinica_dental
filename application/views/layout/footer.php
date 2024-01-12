</div>
<!-- ./wrapper -->



</body>

<!-- jQuery 3.2.1-->
<script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/alertifyjs/alertify.js"></script>
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>

<!-- script del proyecto -->
<script>
    var base_url = "<?php echo base_url(); ?>";

    

</script>

<?php if($this->uri->segment(1)=='Cadminusuario') {?>
<script src="<?php echo base_url(); ?>js/usuarios/adminusuarios.js"></script>
<?php }?>

<?php if($this->uri->segment(1)=='Cadmindentista') {?>
<script src="<?php echo base_url(); ?>js/usuarios/admindentista.js"></script>
<?php }?>

<?php if($this->uri->segment(1)=='Cadminpaciente') {?>
<script src="<?php echo base_url(); ?>js/pacientes/adminpaciente.js"></script>
<?php }?>

<?php if($this->uri->segment(1)=='Cregistraratencion') {?>
<script src="<?php echo base_url(); ?>js/pacientes/registraratencion.js"></script>
<?php }?>

<?php if($this->uri->segment(1)=='Cdisponibilidad') {?>
<script src="<?php echo base_url(); ?>js/usuarios/disponibilidad.js"></script>
<?php }?>

<?php if($this->uri->segment(1)=='Catencionesconflicto') {?>
<script src="<?php echo base_url(); ?>js/pacientes/cambiaratencion.js"></script>
<?php }?>

<?php if($this->uri->segment(1)=='Cpiezasdentales') {?>
<script src="<?php echo base_url(); ?>js/general/piezasdentales.js"></script>
<?php }?>

<?php if($this->uri->segment(1)=='Chorarios') {?>
<script src="<?php echo base_url(); ?>js/general/horarios.js"></script>
<?php }?>

<?php if($this->uri->segment(1)=='Ctratamientos') {?>
<script src="<?php echo base_url(); ?>js/general/tratamientos.js"></script>
<?php }?>

<?php if($this->uri->segment(1)=='Cespecialidades') {?>
<script src="<?php echo base_url(); ?>js/general/especialidades.js"></script>
<?php }?>

<?php if($this->uri->segment(1)=='Cbox') {?>
<script src="<?php echo base_url(); ?>js/general/box.js"></script>
<?php }?>

<?php if($this->uri->segment(1)=='Cdentista') {?>
<script src="<?php echo base_url(); ?>js/dentista/agenda.js"></script>
<?php }?>

<?php if($this->uri->segment(1)=='Cihistorialclinico') {?>
<script src="<?php echo base_url(); ?>js/informes/historialclinico.js"></script>
<?php }?>

<?php if($this->uri->segment(1)=='Cihorasatendidas') {?>
<script src="<?php echo base_url(); ?>js/jquery.quicksearch.min.js"></script>
<script src="<?php echo base_url(); ?>js/informes/horas_atendidas.js"></script>
<?php }?>

<?php if($this->uri->segment(1)=='Cidemandaespecialidad') {?>
<script src="<?php echo base_url(); ?>js/jquery.quicksearch.min.js"></script>
<script src="<?php echo base_url(); ?>js/informes/demanda_especialidad.js"></script>
<?php }?>

<?php if($this->uri->segment(1)=='Cprevision') {?>
<script src="<?php echo base_url(); ?>js/general/prevision.js"></script>
<?php }?>

<?php if($this->uri->segment(1)=='Catencionespaciente') {?>
<script src="<?php echo base_url(); ?>js/pacientes/atenciones.js"></script>
<?php }?>


<script>


    $('#txtRut').on('input', function () { 
        this.value = this.value.replace(/[^0-9]/g,'');
    });

    $('#txtDv').on('input', function () { 
        var a = this.value.replace(/[^0-9kK]/g,'');
        this.value = a.toUpperCase();
    });

    $(document).ready(function() {

        
        $('#tablaEspecialidades').DataTable({
            "paging": false,
            "ordering": false,
            "info": false,
            "language": {
                "lengthMenu": "Mostrar las _MENU_ primeras filas",
                "zeroRecords": "No se encuentran resultados.",
                "infoEmpty": "",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "sSearch": "Buscar:"
            }
        });
        
        
        
        

    });
    
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


</html>
