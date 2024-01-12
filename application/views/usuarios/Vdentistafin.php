<div class="boxPrincipal">

    <h2>Finalizar atenciones Dentista</h2>


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

                    <tr>
                        <td>Especialidad: </td>
                        <td><input type="text" class="form-control" readonly=""></select></td>
                    </tr>

                    <tr>
                        <td>Fecha fin:</td>
                        <td><input type="date" class="form-control"></td>
                    </tr>
                </table>
            </div>
        </div>


        <br><br><br><br>
        <table class="formulario-persona">
            <tr>
                <td><button type="button" class="btn btn-primary btnAccion" id="btnRegistrar"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button></td>
                <td><button type="button" class="btn btn-success btnAccion" id="btnModificar"><span class="glyphicon glyphicon-pencil"></span> Modificar</button></td>
                <td><button type="button" class="btn btn-info btnAccion" id="btnDesactivar"><span class="glyphicon glyphicon-arrow-up"></span> Deshacer</button></td>
                <td><button type="button" class="btn btn-warning btnAccion" id="btnCancelar"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</button> </td>
            </tr>
        </table>
    </form>



</div>
