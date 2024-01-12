<div class="boxPrincipal">

    <h2>Especialidades</h2>

    <div class="panel panel-primary panelInit">
        <div class="panel-heading">Registrar nueva especialidad</div>
        <div class="panel-body">

            <table class="formulario-persona">
                <tr>
                    <td>Especialidad:</td>
                    <td>
                        <input type="text" class="form-control" id="txtNombreEspecialidadNueva" name="txtNombreEspecialidadNueva">
                        <div id="mensaje-especialidad" class="errores">Ingresa Especialidad</div>
                    </td>
                    <td><button type="button" class="btn btn-primary" id="btnConsultar">Consultar</button></td>
                </tr>
            </table>

        </div>
    </div>

    <!-- Inicio Tratamientos -->
    <div class="panel panel-success" id="panelTrt">
        <div class="panel-heading" ></div>
        <div class="panel-body">
            <form id="formEsp">
                <h3 id="espTitulo"></h3>

                <table class"formulario-persona" id="tbEsp">
                    <tr>
                        <td><input type="text" class="form-control" id="txtEsp" name="txtEsp" readonly ></td>
                        <td><input type="hidden" id="txtIdEsp" name="txtIdEsp" ></td>
                    </tr>
                </table>
                <br>
                <br>
                <br>

                <h3>Tratamientos asignados</h3><br>
                <div id="listTrt"></div>



                <br><br><br><br>
                <button type="button" class="btn btn-primary btnAccion" id="btnRegistrar"><span class="glyphicon glyphicon-floppy-disk"></span> Registrar</button>
                <button type="button" class="btn btn-success btnAccion" id="btnModificar"><span class="glyphicon glyphicon-pencil"></span> Modificar</button>
                <button type="button" class="btn btn-danger btnAccion" id="btnDesactivar"><span class="glyphicon glyphicon-arrow-down"></span> Desactivar</button>
                <button type="button" class="btn btn-success btnAccion" id="btnActivar"><span class="glyphicon glyphicon-arrow-up"></span> Activar</button>
                <button type="button" class="btn btn-warning btnAccion" id="btnCancelar"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</button> 
                    
            </form>
        </div>
    </div>
    <!-- Fin Tratamientos -->

    <div class="panel panel-info panelInit">
        <div class="panel-heading">Especialidades actuales</div>
        <div class="panel-body">
        </div>

        <table id="tablaEspecialidades2" class="table">
            <thead>
                <tr>
                    <th width="50%">Nombre</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar especialidad</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" id="txtIdPieza" name="txtIdPieza"> Nombre:
                        <br>
                        <input type="text" class="form-control" id="txtNombreEspecialidadEdit" name="txtNombreEspecialidadEdit">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
</div>
