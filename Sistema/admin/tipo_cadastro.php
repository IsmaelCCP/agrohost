<?php
$id = "";
$nome = "";
$referencia = "";
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $id = $_POST['id'];
    $nome = strtoupper($_POST['nome']);
    $referencia = strtoupper($_POST['referencia']);
    
    if(empty($nome))
    {
        $mensagem = "* O nome deve ser inserido!";
    }
    else if(empty($referencia))
    {
        $mensagem = "* A referência deve ser inserida!";
    }
    else
    {
        $obj = new Tipo();
        $obj->setId($id);
        $obj->setNome(strtoupper($nome));
        $obj->setReferencia(strtoupper($referencia));
        
        $mensagem = TipoDAO::update($obj);
    }
}
else if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        if($id > 0)
        {
            $obj = TipoDAO::objetoPorId($id);
            $nome = $obj->getNome();
            $referencia = $obj->getReferencia();
            $mensagem = "Tela de alteração de tipo.";
        }
    }
}
else
{
    $mensagem = "Tela de inserção de tipo.";
}

if($mensagem == "0")
{
    ?>
<br/>
<div class="col-lg-12">
    <div class="panel panel-success">
        <div class="panel-heading">
            Atenção
        </div>
        <div class="panel-body">
            <p>Operação realizada com sucesso!<br/><a href="<?php echo TGlobal::$default_url_path; ?>/admin/tipos">>>Ir para Tipos<<</a></p>
        </div>
        <div class="panel-footer">
        </div>
    </div>
</div>
<!-- /.col-lg-12 -->
<?php 
}
else 
{
?>

<br/>
<div class="row tooltip_ism">
	<div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="<?php echo TGlobal::$default_url_path; ?>/admin/tipos">Tipos</a> / <strong>Cadastro</strong>                
            </div>
            <div class="panel-body">
                <form method="POST" action="#">
                	<div class="col-lg-3">
                    	<div class="form-group">
                            <label>Id</label>
                            <input class="form-control" type="text" name="id" readonly="readonly" value="<?php echo $id; ?>" />
                        </div>
                    </div>                    
                	<div class="col-lg-12">
                    	<div class="form-group">
                            <label>Nome</label>
                            <input class="form-control" type="text" name="nome" maxlength="100" value="<?php echo $nome; ?>" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                    	<div class="form-group">
                            <label>Referência</label>
                        	<select name="referencia" class="form-control">
                            	<option value="">Selecione...</option>
                            	<option value="EQUIP" <?php echo ($referencia == 'EQUIP')? 'selected':''; ?>>EQUIPAMENTO</option>
                            	<option value="ENTRA" <?php echo ($referencia == 'ENTRA')? 'selected':''; ?>>ENTRADA</option>
                            	<option value="SAIDA" <?php echo ($referencia == 'SAIDA')? 'selected':''; ?>>SAÍDA</option>
                            </select>        
                        </div>
                    </div>      
                    <div class="col-lg-4">
                    	<div class="form-group">       
                            <label style="color: #fff;">.</label>                    
                            <input type="submit"class="form-control btn btn-success btn-block" value="Salvar"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-footer" style="color: #f00; font-weight: bold;">
                <p><?php echo $mensagem; ?></p>
            </div>
        </div>
    </div>
</div>

<script>
$(".numerico").keypress(function (e){

	var str = $(".numerico").val();
	
    if((e.which<48 || e.which>57) && e.which!=46){
      return false;
    }

	if(e.which==46 && !(str.indexOf('.') == -1)){
      return false;
    }
});
</script>
<?php 
}
?>