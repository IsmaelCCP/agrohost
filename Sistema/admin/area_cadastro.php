<?php
$id = "";
$nome = "";
$hectare = "";
$parceiroId = -1;
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{       
    $id = $_POST['id'];
    $nome = strtoupper($_POST['nome']);
    $hectare = $_POST['hectare'];
    $parceiroId = $_POST['parceiro'];
    
    if(empty($nome))
    {
        $mensagem = "* O nome deve ser inserido!";
    }
    else if(empty($hectare))
    {
        $mensagem = "* A quantidade de Hectares deve ser inserida!";
    }
    else if(empty($parceiroId))
    {
        $mensagem = "* O proprietário deve ser selecionado!";
    }
    else
    {
        $obj = new Area();
        $obj->setId($id);
        $obj->setNome($nome);
        $obj->setHectare($hectare);
        $obj->setParceiroId($parceiroId);
        
        //echo $obj->getId(); 
        $mensagem = AreaDAO::update($obj);
    }        
}
else if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        if($id > 0)
        {
            $obj = AreaDAO::objetoPorId($id);
            $nome = $obj->getNome();
            $hectare = $obj->getHectare();
            $parceiroId = $obj->getParceiroId();
            $mensagem = "Tela de alteração de áreas.";
        }
    }
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
            <p>Operação realizada com sucesso!<br/><a href="<?php echo TGlobal::$default_url_path; ?>/admin/areas">>>Ir para Áreas<<</a></p>
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
/*
 * 
 * getParceiros($situacao, $fornecedor, $fornecedorpecas, $interno)
 * 
 */

$lista = ParceiroDAO::lista('1', '1', '-1', '1');

?>

<br/>
<div class="row tooltip_ism">
	<div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="<?php echo TGlobal::$default_url_path; ?>/admin/areas">Áreas</a> / <strong>Cadastro</strong>                
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
                	<div class="col-lg-3">
                    	<div class="form-group">
                            <label>Hectares</label>
                            <input class="form-control numerico" style="text-align: right;" type="text" onkeyup="isNumeric(this.value);" name="hectare" value="<?php echo $hectare; ?>" />
                            <!-- <p class="help-block">Informe o tamanho da terra em hectares.</p> -->
                        </div>
                    </div>
                	<div class="col-lg-12">
                    	<div class="form-group">
                            <label>Proprietário</label>
                            <select name="parceiro" class="form-control">
                            	<?php 
                            	
                            	if(empty($parceiro))
                            	{
                            	    echo "<option value=''>Selecione um proprietário</option>";
                            	}
                            	
                            	foreach ($lista as $obj)
                            	{
                            	    echo "<option value='{$obj->getId()}' ". ( ($parceiroId == $obj->getId())? "selected": "") .">{$obj->getNome()}</option>";
                            	}
                            	
                            	?>
                            </select>
                            <p class="help-block" style="font-size: 8pt;">Este campo somente mostra parceiros que tenham o check fornecedor ou interno ativo.</p>
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