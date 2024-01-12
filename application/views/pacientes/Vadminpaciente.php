<div class="boxPrincipal">

    <h2>Administrar Paciente</h2>
    <form id="formP">
        <div class="col-md-7">
            <table class="formulario-persona">
                <tr>
                    <td>Rut (*): </td>
                    <td><input type="text" id="txtRut" name="txtRut" class="form-control" maxlength="8" />
                        <div id="mensajeRut" class="errores">Ingresa un Rut (Parte numérica)</div>
                    </td>
                    <td>-</td>
                    <td><input type="text" id="txtDv" name="txtDv" class="form-control" maxlength="1" />
                        <div id="mensajeDv" class="errores">Ingresa un Dígito verificador</div>
                    </td>
                    <td><button type="button" class="btn btn-info" id="btnConsultar"><span class="glyphicon glyphicon-search"></span> Consultar</button></td>
                </tr>

                <tr>
                    <td>Nombre (*): </td>
                    <td><input type="text" id="txtNombre" name="txtNombre" class="form-control" maxlength="30" />
                        <div id="mensajeNombre" class="errores"> Ingresa un Nombre</div>
                    </td>
                </tr>

                <tr>
                    <td>Apellido Paterno (*): </td>
                    <td><input type="text" id="txtApellidoP" name="txtApellidoP" class="form-control" maxlength="30" />
                        <div id="mensajeApellidoP" class="errores"> Ingresa un Apellido Paterno</div>
                    </td>
                </tr>

                <tr>
                    <td>Apellido Materno (*): </td>
                    <td><input type="text" id="txtApellidoM" name="txtApellidoM" class="form-control" maxlength="30" />
                        <div id="mensajeAéllidoM" class="errores"> Ingresa un Apellido Materno</div>
                    </td>
                </tr>

                <tr>
                    <td>Sexo (*): </td>
                    <td>
                        <select class="form-control" name="txtSexo" id="txtSexo">
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
                    </td>
                </tr>

                <tr>
                    <td>Fecha de Nacimiento (*): </td>
                    <td><input type="date" id="txtFechaNac" name="txtFechaNac" class="form-control" />
                        <div id="mensajeFechaNac" class="errores"> Ingresa una Fecha de nacimiento</div>
                    </td>
                </tr>

                <tr>
                    <td>Región (*): </td>
                    <td><select class="form-control" id="cbxRegion" name="txtRegion"></select></td>
                </tr>

                <tr>
                    <td>Comuna (*): </td>
                    <td><select class="form-control" id="cbxComuna" name="txtComuna"></select></td>
                </tr>
            </table>
        </div>

        <div class="col-md-5">
            <table class="formulario-persona">
                <tr>
                    <td>Calle (*): </td>
                    <td><input type="text" id="txtCalle" name="txtCalle" class="form-control" maxlength="30" />
                        <div id="mensajeCalle" class="errores"> Ingresa una Calle</div>
                    </td>
                </tr>

                <tr>
                    <td>Número Domicilio (*): </td>
                    <td><input type="text" id="txtDomicilio" name="txtDomicilio" class="form-control" maxlength="10" />
                        <div id="mensajeNumeroDomicilio" class="errores"> Ingresa un Número de domicilio</div>
                    </td>
                </tr>

                <tr>
                    <td>Número Departamento (opcional): </td>
                    <td><input type="text" id="txtDepartamento" name="txtDepartamento" class="form-control" maxlength="10" /></td>
                </tr>

                <tr>
                    <td>Teléfono (*): </td>
                    <td><input type="text" id="txtTelefono" name="txtTelefono" class="form-control" maxlength="20" />
                        <div id="mensajeTelefono" class="errores"> Ingresa un Teléfono de contacto</div>
                    </td>
                </tr>

                <tr>
                    <td>Tipo Paciente (*): </td>
                    <td><select class="form-control" id="cbxPrevision" name="cbxPrevision"></select></td>
                </tr>
                
                <tr id="trTpDesc" class="desc">
                    <td></td>
                    <td>Tipo Paciente: <span id="spnTp"></span></td>
                </tr>

                <tr id="trIsapre">
                    <td>Isapre (*): </td>
                    <td><select class="form-control" id="cbxIsapre" name="cbxIsapre"></select></td>
                </tr>
                
                <tr id="trIsDesc" class="desc">
                    <td></td>
                    <td>Isapre: <span id="spnIsapre"></span></td>
                </tr>
            </table>
        </div>


        <div class="col-md-12">
            <br><br><br><br>
            <table class="formulario-persona">
                <tr>
                    <td><button type="button" class="btn btn-primary btnAccion" id="btnRegistrar"><span class="glyphicon glyphicon-floppy-disk"></span> Registrar</button></td>
                    <td><button type="button" class="btn btn-success btnAccion" id="btnModificar"><span class="glyphicon glyphicon-pencil"></span> Modificar</button></td>
                    <td><button type="button" class="btn btn-danger btnAccion" id="btnDesactivar"><span class="glyphicon glyphicon-arrow-down"></span> Desactivar</button></td>
                    <td><button type="button" class="btn btn-success btnAccion" id="btnActivar"><span class="glyphicon glyphicon-arrow-up"></span> Activar</button></td>
                    <td><button type="button" class="btn btn-warning btnAccion" id="btnCancelar"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</button> </td>
                </tr>
            </table>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Opciones</h5>
                    </div>
                    <div class="modal-body">
                        <h3></h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary op" id="opRegistrar">Registrar</button>
                        <button type="button" class="btn btn-success op" id="opEditar">Modificar</button>
                        <button type="button" class="btn btn-danger op" id="opDesactivar">Desactivar</button>
                        <button type="button" class="btn btn-warning op" id="opActivar">Activar</button>
                        <button type="button" class="btn btn-info op" id="opVer">Ver Datos</button>
                        <button type="button" class="btn btn-secondary opc" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
