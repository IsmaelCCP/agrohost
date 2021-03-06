<?php
$id = "";
$nome = "";
$hectare = "";
$parceiroId = -1;
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $id = $_POST['id'];
    
    if(!empty($id))
    {
        $obj = new Area();
        $obj->setId($id);
        $mensagem = AreaDAO::remover($obj);
    }
    else 
    {
        $mensagem = "Selecione uma área válida!";        
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
            $parceiroNome = $obj->getNomeParceiro();
            $mensagem = "Remover Área.";
        }
    }
}

/*
 *
 * getParceiros($situacao, $fornecedor, $fornecedorpecas, $interno)
 *
 */

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
            <p>A área foi removida do sistema com sucesso!<br/><a href="<?php echo TGlobal::$default_url_path; ?>/admin/areas">>>Ir para Áreas<<</a></p>
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
                <a href="<?php echo TGlobal::$default_url_path; ?>/admin/areas">Áreas</a> / <strong>Remover</strong>                
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
                            <input class="form-control" type="text" readonly="readonly" name="nome" maxlength="100" value="<?php echo $nome; ?>" />
                        </div>
                    </div>
                	<div class="col-lg-3">
                    	<div class="form-group">
                            <label>Hectares</label>
                            <input class="form-control numerico" style="text-align: right;" type="text" readonly="readonly" onkeyup="isNumeric(this.value);" name="hectare" value="<?php echo $hectare; ?>" />
                            <!-- <p class="help-block">Informe o tamanho da terra em hectares.</p> -->
                        </div>
                    </div>
                	<div class="col-lg-12">
                    	<div class="form-group">
                            <label>Proprietário</label>
                            <input class="form-control" type="text" readonly="readonly" name="nome" maxlength="100" value="<?php echo $parceiroNome; ?>" />
                        </div>
                    </div>                    
                    <div class="col-lg-4">
                    	<div class="form-group">       
                            <label style="color: #fff;">.</label>                    
                            <input type="submit"class="form-control btn btn-danger btn-block" value="Remover Área"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-footer">
                <p><?php echo $mensagem; ?></p>
            </div>
        </div>
    </div>
</div>
<?php } ?>
