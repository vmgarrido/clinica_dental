<div class="boxPrincipal">

    <h2>Tipos de pacientes y Previsiones</h2>

    <div class="panel panel-primary">
        <div class="panel-heading">Tipos de pacientes</div>
        <div class="panel-body">

            <table class="formulario-persona">
                <tr>
                    <td>*) Particular</td>
                </tr>
                <tr>
                    <td>*) Fonasa</td>
                    <td id="td-fonasa"><button type="button" class="btn btn-danger" onclick="desactivar(1);">Desactivar</button></td>
                </tr>
                <tr>
                    <td>*) Isapre</td>
                    <td id="td-isapre"><button type="button" class="btn btn-success" onclick="activar(1);">Activar</button></td>
                </tr>
            </table>

        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">Registrar nueva Isapre</div>
        <div class="panel-body">

            <table class="formulario-persona">
                <tr>
                    <td>Nombre Isapre</td>
                    <td><input type="text" class="form-control" id="txtNuevaIsapre" name="txtNuevaIsapre">
                        <div id="mensajeIsapre" class="errores">Ingresa una Isapre</div></td>
                    <td><button type="button" class="btn btn-primary" id="btnRegistrar">Registrar</button></td>
                </tr>
            </table>

        </div>
    </div>

    <div class="panel panel-success">
        <div class="panel-heading">Editar Isapre</div>
        <div class="panel-body">
        </div>
        <table id="tablaEditIsapre" class="table">
            <thead>
                <tr>
                    <th width="50%">Nombre</th>
                    <th width="50%">Opción</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Isapre</h5>
            </div>
            <form id="formCambiar">
            <div class="modal-body">
                    <center><h4>Los cambios realizdos afectarán los datos realacionados</h4></center>
                
                    <input type="hidden" id="aId" name="aId">
                    Isapre:
                    <input type="text" class="form-control" id="newIsapre" name="newIsapre">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnCambiar" class="btn btn-primary">Guardar cambios</button>
            </div>
            </form>
        </div>
    </div>
</div>
