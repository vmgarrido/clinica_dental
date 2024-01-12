<div class="boxPrincipal">

    <h2>Atenciones Paciente</h2>


    <form id="formUsuario">
        <div class="formPersona">
            <div class="formPersona1">
                <input type="hidden" id="estado" name="estado">
                <table class="formulario-persona">
                    <tr>
                        <td>Rut (*): </td>
                        <td><input type="text" id="txtRut" name="txtRut" class="form-control" maxlength="8" />
                        </td>
                        <td>-</td>
                        <td><input type="text" id="txtDv" name="txtDv" class="form-control" maxlength="1" />
                        </td>
                        <td><button type="button" class="btn btn-info" id="btnConsultar"><span class="glyphicon glyphicon-search"></span> Consultar</button></td>
                    </tr>

                    <tr>
                        <td>Nombre: </td>
                        <td><input type="text" id="txtNombre" name="txtNombre" class="form-control txtDerecha" maxlength="30" readonly="" />
                        </td>
                    </tr>

                    <tr>
                        <td>Apellido Paterno: </td>
                        <td><input type="text" id="txtApellidoP" name="txtApellidoP" class="form-control txtDerecha" maxlength="30" readonly="" />
                        </td>
                    </tr>

                    <tr>
                        <td>Apellido Materno: </td>
                        <td><input type="text" id="txtApellidoM" name="txtApellidoM" class="form-control txtDerecha" maxlength="30" readonly="" />
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div id="panel1">
        <div class="panel panel-primary">
            <div class="panel-heading">Listado</div>
            <div class="panel-body">
            </div>
            <table  class="table">
                <thead>
                    <tr>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Dentista</th>
                        <th>Especialidad</th>
                        <th>Fecha</th>
                        <th>Conflicto?</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>17710430-2</td>
                        <td>Alfredo Castro Villouta</td>
                        <td>Laura Farfan Vega</td>
                        <td>Implantología</td>
                        <td>20 - Junio - 2018</td>
                        <td></td>
                        <td>Sin atender</td>
                        <td><button type="button" class="btn btn-danger btn2"><i class="fa fa-arrow-down"></i></button>
                            <button type="button" class="editar btn btn-success btn2"><i class="fa fa-edit"></i></button</td>
                    </tr>
                    <tr>
                        <td>17710430-2</td>
                        <td>Alfredo Castro Villouta</td>
                        <td>Laura Farfan Vega</td>
                        <td>Implantología</td>
                        <td>20 - Junio - 2018</td>
                        <td>Conflicto tratamiento<br>Conflicto Box</td>
                        <td>Sin atender</td>
                        <td><button type="button" class="btn btn-danger btn2"><i class="fa fa-arrow-down"></i></button>
                            <button type="button" class="editar btn btn-success btn2"><i class="fa fa-edit"></i></button></td>
                    </tr>

                    <tr>
                        <td>17710430-2</td>
                        <td>Alfredo Castro Villouta</td>
                        <td>Laura Farfan Vega</td>
                        <td>Implantología</td>
                        <td>20 - Junio - 2018</td>
                        <td></td>
                        <td>Eliminada</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>


        </div>
    </div>
    </form>


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
