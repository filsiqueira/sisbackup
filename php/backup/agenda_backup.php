<?php
require_once("../painel/painel.php");
require_once("../conexao/conexao.php");
?>
<div class="page-header">
        <h1>Agenda de Backup</h1>
    </div>
    <div class="container">
        <div class="col-xs-12 col-sm-8" style="margin-left:210px;">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Selecione dia e Hora</h4>          
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                      <div class="row">
                          <div class="col-sm-4">
                            <label for="inputState">Dia da Semana</label>
                            <select id="dia_da_semana" class="chosen-select form-control" id="dia_da_semana" onchange="desmarca_checkbox()">                              
                                <option value=""> Selecione</option>
                                <option value="comp_dia_0"> Domingo </option>
                                <option value="comp_dia_1"> Segunda - Feira </option>
                                <option value="comp_dia_2"> Terça - Feira  </option>
                                <option value="comp_dia_3"> Quarta - Feira  </option>
                                <option value="comp_dia_4"> Quinta - Feira  </option>
                                <option value="comp_dia_5"> Sexta - Feira  </option>
                                <option value="comp_dia_6"> Sábado </option>  
                            </select>
                          </div>
                        </div>
                    <hr>
                    <div class="row">
                          <div class="col-sm-4">
                            <label for="inputState">Horário</label>
                            <select id="hora_backup" class="chosen-select form-control" onchange="desmarca_checkbox()">                              
                            <option value=""> Selecione</option>
                            <option value="0">00:00</option>
                            <option value="01">01:00</option>
                            <option value="02">02:00</option>
                            <option value="03">03:00</option>
                            <option value="04">04:00</option>
                            <option value="05">05:00</option>
                            <option value="06">06:00</option>
                            <option value="07">07:00</option>
                            <option value="08">08:00</option>
                            <option value="09">09:00</option>
                            <option value="10">10:00</option>
                            <option value="11">11:00</option>
                            <option value="12">12:00</option>
                            <option value="13">13:00</option>
                            <option value="14">14:00</option>
                            <option value="15">15:00</option>
                            <option value="16">16:00</option>
                            <option value="17">17:00</option>
                            <option value="18">18:00</option>
                            <option value="19">19:00</option>
                            <option value="20">20:00</option>
                            <option value="21">21:00</option>
                            <option value="22">22:00</option>
                            <option value="23">23:00</option>
                            </select>
                          </div>
                        </div>
                        <br>
                         <label class="checkbox-inline" onclick="ajusta_filtros()">Não aplicar filtros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="filtro" ></label>
                        <hr>
                    <center>
                    <button type="button" id="listar" class="btn btn-primary" onclick="lista_backup()"> LISTAR </button>
                    <button type="button" id="cancelar" class="btn btn-warning" onclick="limpar_agenda_backup()"> CANCELAR </button>
                    </center>
                    <br>
                </div>
            </div>
        </div>
      </div>
    </div>

