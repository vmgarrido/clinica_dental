<div class="boxPrincipal">

    <h2>Boxes</h2>

    <div class="panel panel-primary">
        <div class="panel-heading">Registrar box nuevo</div>
        <div class="panel-body">

            
            <table class="formulario-persona">
                <tr>
                    <td>Número box:</td>
                    <td>
                        <input type="text" class="form-control" id="txtNumeroBoxNuevo" name="txtNumeroBoxNuevo" required>
                        <div id="mensaje-numero" class="errores">Ingresa Número</div>
                    </td>
                    <td><button type="button" class="btn btn-primary" id="btnRegistrar">Registrar</button></td>
                </tr>
            </table>

        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">Boxes actuales</div>
        <div class="panel-body">
        </div>

        <table id="tablaBox2" class="table">
            <thead>
                <tr>
                    <th width="50%">Número</th>
                    <th width="50%">Opciones</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar box</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" id="txtIdBox" name="txtIdBox">
                        Número:
                        <input type="text" class="form-control" id="txtNumeroBoxEdit" name="txtNumeroBoxEdit">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardar">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
</div>
