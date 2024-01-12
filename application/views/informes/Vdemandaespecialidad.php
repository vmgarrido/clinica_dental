<div class="boxPrincipal">
    <h2>Informe de demanda de especialidad</h2>

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
                    <td>Cantidad de reservaciones:</td>
                    <td><input type="text" class="form-control" id="txtCantidadReservas" name="txtCantidadReservas" readonly></td>
                    <td>Buscar: </td>
                    <td><input type="text" id="search" class="form-control"></td>
                </tr>
            </table>

            <div id="content">
                <table id="tablaDE" class="table">
                    <thead>
                        <tr>
                            <th class="info">Fecha</th>
                            <th class="info">Rut Paciente</th>
                            <th class="info">Paciente</th>
                            <th class="info">Rut Dentista</th>
                            <th class="info">Dentista</th>
                            <th class="info">Especialidad</th>
                            <th class="info">Bloque</th>
                        </tr>
                    </thead>

                    <tbody id="h-body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
