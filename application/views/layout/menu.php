<header>
   
    <span id="button-menu" class="fa fa-bars"></span>
    <span class="pull-right user"><?php echo $this->session->userdata('s_nombre').' - '.$this->session->userdata('s_cargo'); ?></span>

    <nav class="navegacion">
        <ul class="menu">
            <!-- TITULAR -->
            <li class="title-menu">MENU</li>
            <!-- TITULAR -->

            <li><a href="<?php echo base_url(); ?>Cinicio/index"><span class="fa fa-home icon-menu"></span>Inicio</a></li>

            <?php if ($this->session->userdata('s_cargo') == "Secretaria" || $this->session->userdata('s_cargo') == "Administrador") { ?>
            <li class="item-submenu" menu="1">
                <a href="#"><span class="fa fa-user icon-menu"></span>Usuarios del Sistema</a>
                <ul class="submenu">
                    <li class="title-menu"><span class="fa fa-user icon-menu"></span>Usuarios del Sistema</li>
                    <li class="go-back">Atras</li>

                    <li><a href="<?php echo base_url(); ?>Cadminusuario/index">Administrar Usuarios</a></li>
                    <li><a href="<?php echo base_url(); ?>Cadmindentista/index">Administrar Dentistas</a></li>
                    <li><a href="<?php echo base_url(); ?>Cdisponibilidad/index">Horario de Dentistas</a></li>
                    <li><a href="<?php echo base_url(); ?>Cdentistafin/index">Finalizar Atenciones</a></li>
                    <li><a href="<?php echo base_url(); ?>Cdentistasfin/index">Dentistas a desactivar</a></li>
                </ul>
            </li>
            

            <li class="item-submenu" menu="2">
                <a href="#"><span class="fa fa-user-plus icon-menu"></span>Pacientes</a>
                <ul class="submenu">
                    <li class="title-menu"><span class="fa fa-user-plus icon-menu"></span>Pacientes</li>
                    <li class="go-back">Atras</li>

                    <li><a href="<?php echo base_url(); ?>Cadminpaciente/index">Administrar Pacientes</a></li>
                    <li><a href="<?php echo base_url(); ?>Cregistraratencion/index">Registrar hora de atención</a></li>
                    <li><a href="<?php echo base_url(); ?>Catencionesconflicto/index">Atenciones en conflicto</a></li>
                    <li><a href="<?php echo base_url(); ?>Catencionespaciente/index">Atenciones Paciente</a></li>
                </ul>
            </li>

            
            <li class="item-submenu" menu="3">
                <a href="#"><span class="fa fa-cog icon-menu"></span>General</a>
                <ul class="submenu">
                    <li class="title-menu"><span class="fa fa-cog icon-menu"></span>Datos Generales</li>
                    <li class="go-back">Atras</li>

                    <li><a href="<?php echo base_url(); ?>Cpiezasdentales/index">Piezas dentales</a></li>
                    <li><a href="<?php echo base_url(); ?>Ctratamientos/index">Tratamientos</a></li>
                    <li><a href="<?php echo base_url(); ?>Cespecialidades/index">Especialidades</a></li>
                    <li><a href="<?php echo base_url(); ?>Cbox/index">Boxes</a></li>
                    <li><a href="<?php echo base_url(); ?>Chorarios/index">Horarios de trabajo</a></li>
                    <li><a href="<?php echo base_url(); ?>Cprevision/index">Pacientes y Previsiones</a></li>
                </ul>
            </li>
            <?php } ?>
            
            <?php if ($this->session->userdata('s_cargo') == "Dentista") { ?>
            <li class="item-submenu" menu="4">
                <a href="#"><span class="fa fa-user-md icon-menu"></span>Dentista</a>
                <ul class="submenu">
                    <li class="title-menu"><span class="fa fa-user-md icon-menu"></span>Dentista</li>
                    <li class="go-back">Atras</li>

                    <li><a href="<?php echo base_url(); ?>Cdentista/index">Agenda</a></li>
                </ul>
            </li>
            <?php } ?>
            
            <?php if ($this->session->userdata('s_cargo') == "Gerencia" || $this->session->userdata('s_cargo') == "Administrador") { ?>
            <li class="item-submenu" menu="5">
                <a href="#"><span class="fa fa-file icon-menu"></span>Informes</a>
                <ul class="submenu">
                    <li class="title-menu"><span class="fa fa-file icon-menu"></span>Informes</li>
                    <li class="go-back">Atras</li>

                    <li><a href="<?php echo base_url(); ?>Cihistorialclinico/index">Historial clínico</a></li>
                    <li><a href="<?php echo base_url(); ?>Cihorasatendidas/index">Horas atendidas y sin atender</a></li>
                    <li><a href="<?php echo base_url(); ?>Cidemandaespecialidad/index">Demanda de especialidad</a></li>
                </ul>
            </li>
            <?php } ?>
            
            <li>
                <a href="<?php echo base_url(); ?>Ccerrar/cerrar"><i class="fa fa-sign-out icon-menu"></i> Cerrar Sesión</a>
            </li>
        </ul>
    </nav>
</header>