<div class="boxPrincipal">

    <h2>Piezas dentales</h2>

    <div class="panel panel-primary">
        <div class="panel-heading">Registrar piezas nuevas</div>
        <div class="panel-body">

            <table class="formulario-persona">
                <tr>
                    <td>Nombre pieza:</td>
                    <td>
                        <input type="text" class="form-control" id="txtNombrePiezaNueva" name="txtNombrePiezaNueva">
                        <div id="mensaje-pieza" class="errores">Ingresa Pieza dental</div>
                    </td>
                    <td>Número pieza:</td>
                    <td>
                        <input type="text" class="form-control" id="txtNumeroPiezaNueva" name="txtNumeroPiezaNueva">
                        <div id="mensaje-numero" class="errores">Ingresa Número</div>
                    </td>
                    <td><button type="button" class="btn btn-primary" id="btnRegistrar">Registrar</button></td>
                </tr>
            </table>

        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">Piezas actuales</div>
        <div class="panel-body">
        </div>

        <table id="tablaPiezasactuales" class="table">
            <thead>
                <tr>
                    <th width="33%">Nombre</th>
                    <th width="33%">Número</th>
                    <th width="33%">Opciones</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar pieza</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" id="txtIdPieza" name="txtIdPieza">
                        Nombre:<br>
                        <input type="text" class="form-control" id="txtNombrePiezaEdit" name="txtNombrePiezaEdit">
                        Número:
                        <input type="text" class="form-control" id="txtNumeroPiezaEdit" name="txtNumeroPiezaEdit">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardar" >Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
</div>
