<?php
include('../templates/template2.php');
include('../conexao/conexao.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12"></div>
    </div>
    <center>
    <div id="modal" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document" style="min-width: 95%">
          <div class="modal-content">                    
            <div id="alert" style="height: 50px;"></div>
        </div>
    </div>
    </div>  
<div class="row">
    <div class="col-lg-8" style="float: none">
        <br><br>
        <h1>Restaurar Backups</h1>
        <br><br>
        <div class="form-horizontal form-label-left">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" ><span class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <label> Selecione o usuário </label>
                <select id="comp_id" class="form-control">
                    <option value="">--------------------------------------------------------------------------</option>
                    <?php
                    $sql = mysqli_query($conexao,"SELECT comp_id,comp_nome_usuario FROM computadores ORDER BY comp_nome_usuario");
                    while($usuarios = mysqli_fetch_array($sql)){
                        echo"<option value='$usuarios[comp_id]'>$usuarios[comp_nome_usuario]</option>";
                    }
                    ?>
                </select>
                <br><br>
                <label> Selecione o Diretório </label>
                <select id="documento_id" class="form-control">
                    <option value="">--------------------------------------------------------------------------</option>
                </select>
            </div>
        </div>
        <br><br>
        <button type="button" id="restaurar" class="btn btn-success" onclick="restaurar_backup()"> RESTAURAR </button>
        <button type="button" id="cancelar" class="btn btn-warning" onclick="limpar_restore_backup()"> CANCELAR </button>
    </div>
    <div id="gif2" style="display:block; margin-top: 20px;"><br><br><h4> Consultando Diretórios deste usuário ...</h4><br><img src="../imagens/gif.gif"></div>
    <div id="gif" style="display:block; margin-top: 20px;"><br><br><h4> Restaurando Documentos ...</h4><br><img src="../imagens/gif.gif"></div>       
</div>
</center>
</div>
<script>
    $('#gif').hide();
    $('#gif2').hide();
</script>
<script src="../../js/funcoes_diversas.js"></script>
<script src="../../js/jsapi.js"></script>
<script src="../../js/loader.js"></script>
<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);

</script>
        <script type="text/javascript">
        $(function(){
            $('#comp_id').change(function(){
                if( $(this).val() ) {
                    $('#documento_id').hide();
                    $('#gif2').show();
                    $.getJSON('retorna_docs_restaurar.php?search=',{comp_id: $(this).val(), ajax: 'true'}, function(data){
                        var options = '<option value="">--------------------------------------------------------------------------</option>'; 
                        for (var i = 0; i < data.length; i++) {
                            options += '<option value="' + data[i].documento_id + '">' + data[i].documento_nome + '</option>';
                        }   
                        $('#documento_id').html(options).show();
                        $('#gif2').hide();
                    });
                } else {
                    $('#documento_id').html('<option value="">--------------------------------------------------------------------------</option>');
                }
            });
        });
        </script>

</body>
</html>
