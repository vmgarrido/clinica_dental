<div class="boxPrincipal">
    <h2>Atenciones en conflicto</h2>

    <div id="panel1">
        
            <div class="panel panel-primary">
                <div class="panel-heading">Atenciones</div>
                <div class="panel-body">
                </div>

                <div id="contenedor">
                <table id="tablaAtenciones" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="150px">Fecha</th>
                            <th width="100px">Bloque</th>
                            <th width="120px">Rut Paciente</th>
                            <th width="170px">Nombre Paciente</th>
                            <th width="120px">Teléfono</th>
                            <th width="170px">Dentista</th>
                            <th width="120px">Especialidad</th>
                            <th width="150px">Tratamiento</th>
                            <th width="120px">Conflictos</th>
                            <th width="100px">Opción</th>
                        </tr>
                    </thead>
                    <tbody id="h-body">
                        
                    </tbody>
                </table>
                </div>


            </div>
    </div>

    <div id="panel2">

        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">Agenda</div>
            <div class="panel-body">
                
                <table class="formulario-persona">
                    <tr>
                        <td>Rut Paciente:</td>
                        <td><input type="text" class="form-control" id="txtRutPaciente" name="txtRutPaciente" readonly></td>
                        <td>-</td>
                        <td><input type="text" class="form-control" id="txtDvPaciente" name="txtDvPaciente" readonly></td>
                        <td>Nombre Paciente:</td>
                        <td><input type="text" class="form-control" id="txtNombrePaciente" name="txtNombrePaciente" readonly></td>
                    </tr>
                </table>

               <div><br></div>
               
                <div id="content">
                    <table id="tablaAgenda" class="table table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th class="column1 info">Horario</th>
                                <th class="info">Lunes</th>
                                <th class="info">Martes</th>
                                <th class="info">Miércoles</th>
                                <th class="info">Jueves</th>
                                <th class="info">Viernes</th>
                                <th class="info">Sábado</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="column1 warning">08:00</td>
                                <td class="danger">10745863-8<br>Antonio Vargas Guchurruaga<br>Box 4</td>
                                <td>Juan Soto</td>
                                <td>Habitacion 5</td>
                                <td>Perez Lara</td>
                                <td>Perez Lara</td>
                                <td>Perez Lara</td>
                            </tr>
                            <tr>
                                <td class="column1 warning">08:00</td>
                                <td class="danger">Antonio Vargas Guchurruaga</td>
                                <td>Juan Soto</td>
                                <td>Habitacion 5</td>
                                <td>Perez Lara</td>
                                <td>Perez Lara</td>
                                <td>Perez Lara</td>
                            </tr>
                            <tr>
                                <td class="column1 warning">08:00</td>
                                <td class="danger">Antonio Vargas Guchurruaga</td>
                                <td>Juan Soto</td>
                                <td>Habitacion 5</td>
                                <td>Perez Lara</td>
                                <td>Perez Lara</td>
                                <td>Perez Lara</td>
                            </tr>
                            <tr>
                                <td class="column1 warning">08:00</td>
                                <td class="danger">Antonio Vargas Guchurruaga</td>
                                <td>Juan Soto</td>
                                <td>Habitacion 5</td>
                                <td>Perez Lara</td>
                                <td>Perez Lara</td>
                                <td>Perez Lara</td>
                            </tr>
                            <tr>
                                <td class="column1 warning">08:00</td>
                                <td>Libre<br>Box 4</td>
                                <td>Juan Soto</td>
                                <td>Habitacion 5</td>
                                <td>Perez Lara</td>
                            </tr>
                            <tr>
                                <td class="column1 warning">08:00</td>
                                <td>Antonio Vargas Guchurruaga</td>
                                <td>Juan Soto</td>
                                <td>Habitacion 5</td>
                                <td>Perez Lara</td>
                            </tr>
                            <tr>
                                <td class="column1 warning">08:00</td>
                                <td>Antonio Vargas Guchurruaga</td>
                                <td>Juan Soto</td>
                                <td>Habitacion 5</td>
                                <td>Perez Lara</td>
                            </tr>
                            <tr>
                                <td class="column1 warning">08:00</td>
                                <td class="danger">Antonio Vargas Guchurruaga</td>
                                <td>Juan Soto</td>
                                <td>Habitacion 5</td>
                                <td>Perez Lara</td>
                            </tr>
                            <tr>
                                <td class="column1 warning">08:00</td>
                                <td class="danger">Antonio Vargas Guchurruaga</td>
                                <td>Juan Soto</td>
                                <td>Habitacion 5</td>
                                <td>Perez Lara</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Fin Content -->

                <table class="formulario-persona">
                    <tr>
                        <td>Especialidad:</td>
                        <td>
                            <select class="form-control des" id="cbxEspecialidad" name="cbxEspecialidad">
                            </select>
                        </td>
                        <td>Dentista:</td>
                        <td><select class="form-control des" id="cbxDentista" name="cbxDentista">
                    </select></td>
                        <td>Semana:</td>
                        <td>
                            <select class="form-control des" id="cbxSemana" name="cbxSemana">
                            </select>
                        </td>
                    </tr>
                </table>

                <table class="formulario-persona" style="display:block; margin-top:10px;">
                    <tr>
                        <td>Tratamiento a realizar:</td>
                        <td>
                            <select class="form-control des" id="cbxTratamiento" name="cbxTratamiento">
                            </select>
                        </td>
                        <td>Valor:</td>
                        <td><input type="text" class="form-control" valor="" id="txtValorTratamiento" name="txtValorTratamiento" readonly="true"></td>
                        <td>Cantidad de bloques:</td>
                        <td>
                            <select name="cbxCantidadBloques" id="cbxCantidadBloques" class="form-control des">
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </td>
                    </tr>
                </table>

                <table class="formulario-persona" style="display:block; margin-top:10px;">
                    <tr>
                        <td><input type="checkbox" id="chkSeleccionarBloque"> Seleccionar bloque</td>
                        <td>Fecha:</td>
                        <td><input type="text" style="width:220px;" class="form-control" fecha="" id="txtFechaAtención1" name="txtFechaAtención1" readonly="true" value="" id_dia="" id_box=""></td>
                        <td>Bloque:</td>
                        <td><input type="text" hora_inicio="" hora_fin="" class="form-control" id="txtBloque1" name="txtBloque1" readonly></td>
                        <td>Tipo Paciente:</td>
                        <td>
                            <select class="form-control des" name="cbxTipoPaciente" id="cbxTipoPaciente"></select>
                        </td>
                        <td class="tdIsapre">Isapre:</td>
                        <td class="tdIsapre">
                            <select class="form-control des" name="cbxIsapre" id="cbxIsapre"></select>
                        </td>
                    </tr>
                </table>

                <table class="formulario-persona">
                    <tr>
                        <td><button type="button" class="btn btn-primary" id="btnRegistrar">Registrar atención</button></td>
                        <td><button type="button" class="btn btn-danger" id="btnCancelar">Cancelar</button></td>
                    </tr>
                </table>


            </div>
        </div>

    </div>

</div>
