<div class="boxPrincipal">

    <h2>Horarios de trabajo</h2>


    <div class="panel-group" id="accordion" role="tablist">

        <div class="panel panel-primary">
            <div class="panel-heading" role="tab" id="heading1">
                <h4 class="panel-title">
                    <a href="#collapse1" class="acoredeon" data-toggle="collapse" data-parent="#accordion">
							Horario actual
						</a>
                </h4>
            </div>

            <div id="collapse1" class="panel-collapse collapse in">
                <div class="panel-body">
                    <table class="formulario-persona">
                        <tr>
                            <td>Fecha inicio:</td>
                            <td><input type="text" class="form-control fech" id="txtFechaHorarioActual1" name="txtFechaHorarioActual" readonly></td>
                            <td>Fecha fin:</td>
                            <td><input type="text" class="form-control fech" id="txtFechaHorarioActual2" name="txtFechaHorarioActual" readonly></td>
                        </tr>
                    </table>

                    <table class="formulario-persona">
                        <tr>
                            <td>Duración bloques:</td>
                            <td><input type="text" class="form-control hora-fin-actual" id="txtMinutosBloqueActual" name="txtMinutosBloqueActual" readonly></td>
                            <td>Min Hora inicio</td>
                            <td><input type="text" class="form-control hora-fin-actual" id="txtMinInicio" name="txtMinInicio" readonly></td>
                            <td>Max Hora fin</td>
                            <td><input type="text" class="form-control hora-fin-actual" id="txtMaxFin" name="txtMaxFin" readonly></td>
                        </tr>
                    </table>
                </div>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Día</th>
                            <th>Opción</th>
                            <th>Horario inicio</th>
                            <th>Horario fin</th>
                        </tr>
                    </thead>
                    <tbody id="listHorario">
                        
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-warning">
            <div class="panel-heading" role="tab" id="heading2">
                <h4 class="panel-title">
                    <a href="#collapse2" class="acoredeon" data-toggle="collapse" data-parent="#accordion">
							Horario nuevo
						</a>
                </h4>
            </div>

            <div id="collapse2" class="panel-collapse collapse">
                
                <div class="panel-body">
                    
                <table class="formulario-persona">
                        <tr>
                            <td>Fecha inicio:</td>
                            <td><input type="text" class="form-control fech" id="nuevo-fecha-inicio" name="txtFechaHorarioActual" readonly></td>
                            <td id="td-opcion">
                                
                            </td>
                        </tr>
                    </table>

                    <table class="formulario-persona">
                        <tr>
                            <td>Duración bloques:</td>
                            <td><input type="text" class="form-control hora-fin-actual" id="minutos-nuevo" name="txtMinutosBloqueActual" readonly></td>
                            <td>Min Hora inicio</td>
                            <td><input type="text" class="form-control hora-fin-actual" id="hora-inicio-nuevo" name="txtMinInicio" readonly></td>
                            <td>Max Hora fin</td>
                            <td><input type="text" class="form-control hora-fin-actual" id="hora-inicio-fin" name="txtMaxFin" readonly></td>
                        </tr>
                    </table>
                </div>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Día</th>
                            <th>Opción</th>
                            <th>Horario inicio</th>
                            <th>Horario fin</th>
                        </tr>
                    </thead>
                    <tbody id="horario-nuevo">
                        
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-success">
            <div class="panel-heading" role="tab" id="heading3">
                <h4 class="panel-title">
                    <a href="#collapse3" class="acoredeon" data-toggle="collapse" data-parent="#accordion">
                            Registrar nuevo horario
                        </a>
                </h4>
            </div>

            <div id="collapse3" class="panel-collapse collapse">
                <form id="formHorario">
                <div class="panel-body">
                    <p id="palerta"><span id="alerta-inicio-horario">Cada horario nuevo debe comenzar un día Lunes y desde su fecha en adelante no deben haber horas de atención registradas</span></p>

                    <table class="formulario-persona">
                        <tr>
                            <td>Fecha inicio:</td>
                            <td>
                                <input type="date" class="form-control" id="txtFechaHorarioNuevo" name="txtFechaHorarioNuevo">
                                <div id="mensajeFecha" class="errores">Ingresa una fecha</div>
                            </td>
                            <td>Duración de cada bloque (minutos)</td>
                            <td>
                                <input type="text" class="form-control hora-fin" id="txtMinutosBloque" name="txtMinutosBloque">
                                <div id="mensajeBloque" class="errores">Ingresa la duración de los bloques</div>
                            </td>
                            <td>Hora inicio</td>
                            <td>
                                <input type="time" class="form-control hora-fin" id="txt-hora-inicio" name="txt-hora-inicio">
                                <div id="mensaje-hinicio" class="errores">Ingresa Hora inicio</div>
                            </td>
                            <td>Hora fin</td>
                            <td>
                                <input type="time" class="form-control hora-fin" id="txt-hora-fin" name="txt-hora-fin">
                                <div id="mensaje-hfin" class="errores">Ingresa Hora fin</div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" id="btnRegistrar">Registrar</button>
                            </td>
                        </tr>
                    </table>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Día</th>
                            <th>Activo</th>
                            <th>Horario inicio</th>
                            <th>Horario fin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Lunes</td>
                            <td>
                                <input type="checkbox" dia="1" id="chkLunes" name="dia[1]" value="1"><input type="hidden" id="txtLunesVal" name="txtLunesVal" value="0">
                            </td>
                            <td>
                                <input name="hi_dia[1]" ini="1" type="time" class="form-control hora-inicio txtLunes" readonly maxlength="5">
                            </td>
                            <td>
                                <input name="hf_dia[1]" fin="1" type="time" class="form-control hora-fin txtLunes" readonly maxlength="5">
                            </td>
                        </tr>

                        <tr>
                            <td>Martes</td>
                            <td>
                                <input type="checkbox" dia="2" id="chkMartes" name="dia[2]" value="2"><input type="hidden" id="txtMartesVal" name="txtMartesVal" value="0">
                            </td>
                            <td>
                                <input name="hi_dia[2]" ini="2" type="time" class="form-control hora-inicio txtMartes" readonly maxlength="5">
                            </td>
                            <td>
                                <input name="hf_dia[2]" fin="2" type="time" class="form-control hora-fin txtMartes" readonly maxlength="5">
                            </td>
                        </tr>

                        <tr>
                            <td>Miercoles</td>
                            <td>
                                <input type="checkbox" dia="3" id="chkMiercoles" name="dia[3]" value="3"><input type="hidden" id="txtMiercolesVal" name="txtMiercolesVal" value="0">
                            </td>
                            <td>
                                <input name="hi_dia[3]" ini="3" type="time" class="form-control hora-inicio txtMiercoles" readonly maxlength="5">
                            </td>
                            <td>
                                <input name="hf_dia[3]" fin="3" type="time" class="form-control hora-fin txtMiercoles" readonly maxlength="5">
                            </td>
                        </tr>

                        <tr>
                            <td>Jueves</td>
                            <td>
                                <input type="checkbox" dia="4" id="chkJueves" name="dia[4]" value="4"><input type="hidden" id="txtJuevesVal" name="txtJuevesVal" value="0">
                            </td>
                            <td>
                                <input name="hi_dia[4]" ini="4" type="time" class="form-control hora-inicio txtJueves" readonly maxlength="5">
                            </td>
                            <td>
                                <input name="hf_dia[4]" fin="4" type="time" class="form-control hora-fin txtJueves" readonly maxlength="5">
                            </td>
                        </tr>

                        <tr>
                            <td>Viernes</td>
                            <td>
                                <input type="checkbox" dia="5" dia="5" id="chkViernes" name="dia[5]" value="5"><input type="hidden" id="txtViernesVal" name="txtViernesVal" value="0">
                            </td>
                            <td>
                                <input name="hi_dia[5]" ini="5" type="time" class="form-control hora-inicio txtViernes" readonly maxlength="5">
                            </td>
                            <td>
                                <input name="hf_dia[5]" fin="5" type="time" class="form-control hora-fin txtViernes" readonly maxlength="5">
                            </td>
                        </tr>


                        <tr>
                            <td>Sábado</td>
                            <td>
                                <input type="checkbox" dia="6" id="chkSabado" name="dia[6]" value="6"><input type="hidden" id="txtSabadoVal" name="txtSabadoVal" value="0">
                            </td>
                            <td>
                                <input name="hi_dia[6]" ini="6" type="time" class="form-control hora-inicio txtSabado" readonly maxlength="5">
                            </td>
                            <td>
                                <input name="hf_dia[6]" fin="6" type="time" class="form-control hora-fin txtSabado" readonly maxlength="5">
                            </td>
                        </tr>
                    </tbody>
                </table>
                </form>
            </div>
        </div>

    </div>
</div>
