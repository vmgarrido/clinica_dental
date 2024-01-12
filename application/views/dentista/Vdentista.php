<?php
if ($this->session->userdata('s_cargo') != "Dentista") {
    redirect('Clogin');
}

?>

<div class="boxPrincipal">

    <h2>Agenda Dentista</h2>
    <form>

        <div class="panel panel-primary">
            <div class="panel-heading">Agenda</div>
            <div class="panel-body">

                <table class="formulario-persona">
                    <tr>
                        <td>Fecha:</td>
                        <td><input type="date" class="form-control" id="txtFecha" name="txtFecha"></td>
                        <td><button type="button" class="btn btn-info" id="btnConsultar">Consultar</button></td>
                        <td><button type="button" class="btn btn-primary" id="btnNuevo">Nuevo</button></td>
                    </tr>
                </table>
            </div>

            <div class="row col-xs-12">
                <button type="button" class="btn btn-danger pull-right btnP" id="btnFinalizar">Finalizar</button>
                <button type="button" class="btn btn-warning pull-right btnP" id="btnConfirmar">Confirmar</button>
            </div>
            <table id="tablaAgenda" class="table table-striped">
                <thead>
                    <tr>
                        <th width="17%">Bloque</th>
                        <th width="12%">Rut</th>
                        <th width="30%">Nombre</th>
                        <th width="31%">Tratamiento</th>
                        <th width="10%">Seleccionar</th>
                    </tr>
                </thead>
                <tbody id="bodyAg">
                    
                </tbody>
            </table>


        </div>

        <div class="panel panel-info">
            <div class="panel-heading">Información del paciente</div>
            <div class="panel-body">

                <table class="formulario-persona">
                    <tr>
                        <td>Rut:</td>
                        <td><input type="text" class="form-control" id="txtRut" name="txtRut" maxlength="8" readonly></td>
                        <td>-</td>
                        <td><input type="text" class="form-control" id="txtDv" name="txtDv" maxlength="1" readonly></td>
                        <td>Nombre:</td>
                        <td><input type="text" class="form-control" id="txtNombre" name="txtNombre" readonly></td>
                    </tr>
                </table>

            </div>
        </div>

        <br><br>

        <div id="contenido-agenda">

            <div class="panel-group" id="accordion" role="tablist">

                <div class="panel panel-success">
                    <div class="panel-heading" role="tab" id="heading1">
                        <h4 class="panel-title">
                            <a href="#collapse1" class="acoredeon" data-toggle="collapse" data-parent="#accordion">
							Historial
						</a>
                        </h4>
                    </div>

                    <div id="collapse1" class="panel-collapse collapse">
                    <!-- Table -->
                        <div id="content">
                        <table class="table" id="tabla-historial">
                            <thead>
                                <tr>
                                    <th>Estado</th>
                                    <th>Conflicto ?</th>
                                    <th>Fecha</th>
                                    <th>Dentista</th>
                                    <th>Tratamiento agendado</th>
                                    <th>Tratamiento realizado</th>
                                    <th>Pieza</th>
                                    <th>Diagnóstico</th>
                                </tr>
                            </thead>
                            <tbody id="body-historial">
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>

                <div class="panel panel-warning">
                    <div class="panel-heading" role="tab" id="heading2">
                        <h4 class="panel-title">
                            <a href="#collapse2" class="acoredeon" data-toggle="collapse" data-parent="#accordion">
							Diagnóstico
						</a>
                        </h4>
                    </div>

                    <div id="collapse2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <textarea name="txtDiagnostico" id="txtDiagnostico" readonly></textarea>
                            <button type="button" class="btn btn-primary pull-right btnP" id="btnGuardar">Guardar</button>
                        </div>
                    </div>
                </div>

                <div class="panel panel-success">
                    <div class="panel-heading" role="tab" id="heading3">
                        <h4 class="panel-title">
                            <a href="#collapse3" class="acoredeon" data-toggle="collapse" data-parent="#accordion">
							Tratamientos realizados y sin realizar
						</a>
                        </h4>
                    </div>

                    <div id="collapse3" class="panel-collapse collapse">
                        <div class="panel-body">

                            <div class="row">
                            <!-- Tratamientos sin realizar -->
                            <div class="col-xs-6">
                                <div class="panel panel-default">
                                    <!-- Default panel contents -->
                                    <div class="panel-heading">Tratamientos sin realizar</div>

                                    <!-- Table -->
                                    <table id="tablaTratamientoNoRealizado" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="col1">Tratamiento</th>
                                                <th class="col2">Pieza</th>
                                                <th class="col3">Número</th>
                                                <th class="col4"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-trt-no-realizados">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Fin Tratamientos sin realizar -->

                            <!-- Tratamientos realizados -->
                            <div class="col-xs-6">
                                <div class="panel panel-default">
                                    <!-- Default panel contents -->
                                    <div class="panel-heading">Tratamientos realizados hoy</div>

                                    <!-- Table -->
                                    <table id="tablaTratamientoRealizado" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="col1">Tratamiento</th>
                                                <th class="col2">Pieza</th>
                                                <th class="col3">Número</th>
                                                <th class="col4"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-tratamientos-realizados">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                            <!-- Fin Tratamientos realizados -->
                        </div>
                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="heading4">
                        <h4 class="panel-title">
                            <a href="#collapse4" class="acoredeon" data-toggle="collapse" data-parent="#accordion">
							Registrar tratamientos a realizar
						</a>
                        </h4>
                    </div>

                    <div id="collapse4" class="panel-collapse collapse">
                        <div class="panel-body">

                            <table class="formulario-persona">
                                <tr>
                                    <td>Tratamiento:</td>
                                    <td>
                                        <select class="form-control" id="cbxTratamiento" name="cbxTratamiento">
                                            
                                        </select>
                                    </td>
                                    <td>Pieza:</td>
                                    <td>
                                        <select class="form-control" id="cbxPieza" name="cbxPieza">
                                        </select>
                                    </td>
                                    <td><button type="button" class="btn btn-success" id="btnRegistrar">Registrar</button></td>
                                </tr>
                            </table>

                        </div>

                        <table id="tablaTratamientos" class="table">
                            <thead>
                                <tr>
                                    <th class="colTr">Tratamiento</th>
                                    <th class="colTr">Pieza</th>
                                    <th class="colTr">Número de pieza</th>
                                    <th class="colTr">Eliminar?</th>
                                </tr>
                            </thead>
                            <tbody id="body-lista-trt">
                            </tbody>
                        </table>

                        <div class="col-xs-12">
                            <button type="button" class="btn btn-success pull-right" id="btnListo">Listo</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </form>



</div>

<!-- Modal -->
<div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h3 class="modal-title" id="m-title">Diagnóstico</h3>
      </div>

      <div class="modal-body">
        <textarea id="m-body" readonly></textarea>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<script>
    var id_dent = <?php echo $this->session->userdata('s_id_dent');?>;
    var id_especialidad = <?php echo $this->session->userdata('s_id_esp');?>;
</script>
