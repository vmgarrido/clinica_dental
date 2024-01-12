<div class="boxPrincipal">
    <div class="box-body">
        
        <h2>Bienvenido</h2>
        <p class="name"><?php echo $this->session->userdata('s_nombre'); ?></p>
        <p class="cargo"><?php echo $this->session->userdata('s_cargo'); ?></p>
        
        <img src="<?php echo base_url(); ?>img/dental-logo.png" />
    </div>
</div>