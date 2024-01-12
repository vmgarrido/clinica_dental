<div class="boxPrincipal">

    <h2>Disponibilidad de dentistas</h2>


    <div class="panel panel-primary">
        <div class="panel-heading">Ingresar Datos</div>
        <div class="panel-body">

            <table class="formulario-persona">
                <tr>
                    <td>Seleccionar jornada</td>
                    <td><select class="form-control" name="cbxHorario" id="cbxHorario"></select></td>
                    <td>Seleccionar día</td>
                    <td>
                        <select class="form-control" id="cbxDia" name="cbxDia">
                            
                        </select>
                    </td>
                    <td><button type="button" class="btn btn-danger btnAccion btn-flat" id="btnNuevaHorario">Nuevo horario</button></td>
                </tr>
            </table>

            <!-- Disponibilidad tabla -->
            <div>
                <br>
            </div>
            <div id="content">
                <table id="tablaDisponibilidad" class="table table-bordered table-hover table-condensed">
                    <thead>
                        <tr id="barraDisp">
                            
                        </tr>
                    </thead>

                    <tbody id="filasDisp">
                        
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <!-- Datos Dentista -->
    <form id="formDisp">
    <div class="panel panel-info">
        <div class="panel-heading">Consultar datos</div>
        <div class="panel-body">
            <table class="formulario-persona">
                <tr>
                    <td>Rut: </td>
                    <td><input type="text" class="form-control" id="txtRut" name="txtRut" maxlength="8" /><div id="mensajeRut" class="errores">Ingresa un Rut (Parte numérica)</div></td>
                    <td>-</td>
                    <td><input type="text" class="form-control" id="txtDv" name="txtDv" maxlength="1" /><div id="mensajeDv" class="errores">Ingresa un Dígito verificador</div></td>
                    <td><button type="button" class="btn btn-info btn-flat" id="btnConsultarDentista"><span class="glyphicon glyphicon-search"></span> Consultar</button></td>
                </tr>
                <tr>
                    <td>Nombre:</td>
                    <td colspan="4"><input type="text" class="form-control" id="txtNombre" name="txtNombre" readonly="true" /></td>
                </tr>
                <tr>
                    <td>Especialidad:</td>
                    <td colspan="4"><input type="text" class="form-control" id="txtEspecialidad" name="txtEspecialidad" readonly="true" /></td>
                    <td><input type="hidden" id="id_dent" name="id_dent"><input type="hidden" id="id_esp" name="id_esp"></td>
                </tr>
            </table>
        </div>
    </div>
    
    <!-- nuevo horario -->
    <div class="panel panel-success">
        <div class="panel-heading">Registrar disponibilidad</div>
        <div class="panel-body">
            <table class="formulario-persona">
                <tr>
                    <td>Jornada:</td>
                    <td>
                        <select class="form-control" name="cbxJornada" id="cbxJornada"></select>
                    </td>
                    <td>Dia:</td>
                    <td>
                        <select class="form-control" name="cbxDiasNuevo" id="cbxDiasNuevo">
                            
                        </select>
                    </td>
                    <td>Bloque inicio:</td>
                    <td><select class="form-control" id="txtBloqueInicio" name="txtBloqueInicio">
                        </select>
                    </td>
                    <td>Bloque fin:</td>
                    <td>
                        <select class="form-control" id="cbxBloqueFin" name="cbxBloqueFin">
                        </select>
                    </td>
                    <td>Box:</td>
                    <td>
                        <select class="form-control" id="cbxBox" name="cbxBox">
                        </select>
                    </td>
                    <td><button type="button" class="btn btn-success btn-flat" id="btnRegistrarHorario">Registrar</button></td>
                </tr>
            </table>
        </div>
    </div>
    </form>

    <!-- horarios registrados -->
    <div class="panel panel-info">
        <div class="panel-heading">Horarios registrados</div>
        <div class="panel-body">

            <table class="table" id="tablaHorario">
                <thead>
                    <tr>
                        <th>Día</th>
                        <th>Bloque inicio</th>
                        <th>Bloque fin</th>
                        <th>Box</th>
                        <th>Desactivar</th>
                    </tr>
                </thead>

                <tbody id="listaHorario">
                    
                </tbody>
            </table>

            <div id="contenedorBotones" class="margenButtons">
                <button type="button" class="btn btn-warning btn-flat pull-right" id="btnLimpiar">Limpiar</button>
            </div>
        </div>
    </div>

</div>
