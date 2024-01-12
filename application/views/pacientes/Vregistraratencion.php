<div class="boxPrincipal">

    <h2>Registrar atención</h2>

    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">Datos Paciente</div>
        <div class="panel-body">
            <table class="formulario-persona">
                <tr>
                    <td>Rut Paciente:</td>
                    <td><input type="text" class="form-control" id="txtRut" name="txtRut" maxlength="8"><div id="mensajeRut" class="errores">Ingresa un Rut (Parte numérica)</div></td>
                    <td>-</td>
                    <td><input type="text" class="form-control" id="txtDv" name="txtDv" maxlength="1"><div id="mensajeDv" class="errores">Ingresa un Dígito verificador</div></td>
                    <td><button type="button" class="btn btn-info btn-flat" id="btnConsultar"><span class="glyphicon glyphicon-search"></span> Consultar</button></td>
                    <td>Nombre:</td>
                    <td><input type="text" class="form-control" id="txtNombrePaciente" name="txtNombrePaciente" readonly="true"></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">Datos Dentista</div>
        <div class="panel-body">
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
        </div>
    </div>


    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">Agenda - Semana Actual</div>
        <div class="panel-body">
            <div id="content">
                <table id="tablaAgenda" class="table table-bordered table-hover table-condensed">
                    <thead>
                        <tr id="barraAgenda">
                        </tr>
                    </thead>

                    <tbody id="cuerpoAgenda">
                        
                    </tbody>
                </table>
            </div>
            <!-- Fin Content -->

            <div class="datosRegistrar">
            

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
            <input type="hidden" id="jornada">
            <input type="hidden" id="id_disp">
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
