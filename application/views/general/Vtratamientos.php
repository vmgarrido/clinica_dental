<div class="boxPrincipal">

    <h2>Tratamientos</h2>

    <div class="panel panel-primary">
        <div class="panel-heading">Registrar nuevos tratamientos</div>
        <div class="panel-body">

            <table class="formulario-persona">
                <tr>
                    <td>Tratamiento:</td>
                    <td><input type="text" class="form-control" id="txtTratamientoNuevo" name="txtTratamientoNuevo">
                        <div id="mensajeTrt" class="errores">Ingresa un tratamiento</div></td>
                    <td>Valor:</td>
                    <td><input type="text" class="form-control" id="txtValor" name="txtValor">
                    <div id="mensajeValor" class="errores">Ingresa un Valor</div></td>
                    <td>Pieza unica?</td>
                    <td><input type="checkbox" id="chkPU" name="chkPU"></td>
                    <td><button type="button" class="btn btn-primary" id="btnRegistrar">Registrar</button></td>
                </tr>
            </table>

        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">Tratamientos actuales</div>
        <div class="panel-body">
        </div>

        <table id="tablaTratamientos2" class="table">
            <thead>
                <tr>
                    <th width="25%">Tratamiento</th>
                    <th width="25%">Valor</th>
                    <th width="25%">Pieza única</th>
                    <th width="25%">Opciones</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar Tratamiento</h5>
                </div>
                <form id="formCambiar">
                <div class="modal-body">
                    
                        <input type="hidden" id="aId" name="aId">
                        Tratamiento:
                        <input type="text" readonly class="form-control" id="newTrt" name="newTrt">
                        Valor:
                        <input type="text" class="form-control" id="newValor" name="newValor">
                        Pieza única <input type="checkbox" id="newPu">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnCambiar" class="btn btn-primary">Guardar cambios</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
