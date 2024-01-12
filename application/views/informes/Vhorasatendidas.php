<div class="boxPrincipal">

    <h2>Informe Horas atendidas y sin atender</h2>

    <div class="panel panel-primary">
        <div class="panel-heading">Ingresar datos</div>
        <div class="panel-body">
            <form id="form-historial">
                <table class="formulario-persona">
                    <tr>
                        <td>Fecha inicio:</td>
                        <td>
                            <input type="date" class="form-control" id="txtFechaInicio" name="txtFechaInicio">
                            <div id="mensaje-fecha-inicio" class="errores">Ingresa Fecha inicio</div>
                        </td>
                        <td>Fecha fin:</td>
                        <td>
                            <input type="date" class="form-control" id="txtFechaFin" name="txtFechaFin">
                            <div id="mensaje-fecha-fin" class="errores">Ingresa Fecha fin</div>
                        </td>
                        <td>Especialidad:</td>
                        <td>
                            <select class="form-control" id="cbxEspecialidad" name="cbxEspecialidad">
                                <option value="1">Endodoncia</option>
                                <option value="1">Ortodoncia</option>
                            </select>
                        </td>
                        <td><input type="button" class="btn btn-info" id="btnConsultar" value="Consultar"></td>
                        <td><button type="button" class="btn btn-warning" id="btnLimpiar">Limpiar</button></td>
                    </tr>
                </table>
            </form>
            
            <div>
                <br>
            </div>
            
            <table class="formulario-persona">
                <tr>
                    <td>Cantidad de horas atendidas:</td>
                    <td><input type="text" class="form-control" id="txtHrsAtendidas" name="txtHrsAtendidas" readonly></td>
                    <td>Cantidad de horas sin atender:</td>
                    <td><input type="text" class="form-control" id="txtHrsSinAtender" name="txtHrsSinAtender" readonly></td>
                    <td><input type="hidden" id="search"></td>
                    <td>Filtrar</td>
                    <td>
                        <select class="form-control" name="cbxFiltro" id="cbxFiltro">
                            <option value="T">Todas</option>
                            <option value="A">Atendida</option>
                            <option value="S">Sin Atender</option>
                        </select>
                    </td>
                </tr>
            </table>

            <div id="content">
                <table id="tablaHrs" class="table">
                    <thead>
                        <tr>
                            <th class="info">Fecha</th>
                            <th class="info">Rut Paciente</th>
                            <th class="info">Paciente</th>
                            <th class="info">Rut Dentista</th>
                            <th class="info">Dentista</th>
                            <th class="info">Especialidad</th>
                            <th class="info">Bloque</th>
                            <th class="info">Estado</th>
                        </tr>
                    </thead>

                    <tbody id="h-body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
