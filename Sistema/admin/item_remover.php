<?php
$id = "";
$nome = "";
$codigo = "";
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $id = $_POST['id'];
    
    if(!empty($id))
    {
        $obj = new Tipo();
        $obj->setId($id);
        $mensagem = ItemDAO::remover($obj);
    }
    else
    {
        $mensagem = "Selecione um item válido!";
    }
}
else if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        if($id > 0)
        {
            $obj = ItemDAO::objetoPorId($id);
            $nome = $obj->getNome();
            $codigo = $obj->getCodigo();
            $mensagem = "Remove item.";
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
            <p>O item foi removido com sucesso!<br/><a href="<?php echo TGlobal::$default_url_path; ?>/admin/itens">>>Ir para itens<<</a></p>
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
                <a href="<?php echo TGlobal::$default_url_path; ?>/admin/itens">Itens</a> / <strong>Remover</strong>                
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
                            <input class="form-control" type="text" readonly="readonly" name="nome" value="<?php echo $nome; ?>" />
                        </div>
                    </div>    
                	<div class="col-lg-12">
                    	<div class="form-group">
                            <label>Código</label>
                            <input class="form-control" type="text" readonly="readonly" name="codigo" value="<?php echo $codigo; ?>" />
                        </div>
                    </div>    
                    <div class="col-lg-4">
                    	<div class="form-group">       
                            <label style="color: #fff;">.</label>                    
                            <input type="submit"class="form-control btn btn-danger btn-block" value="Remover Item"/>
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
