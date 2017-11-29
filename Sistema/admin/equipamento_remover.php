<?php
$id = "";
$nome = "";
$funcao = "";
$tipo = "";
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $id = $_POST['id'];
    
    if(!empty($id))
    {
        $obj = new Equipamento();
        $obj->setId($id);
        $mensagem = EquipamentoDAO::remover($obj);
    }
    else
    {
        $mensagem = "Selecione um equipamento válido!";
    }
}
else if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        if($id > 0)
        {
            $obj = EquipamentoDAO::objetoPorId($id);
            $nome = $obj->getNome();
            $funcao = $obj->getFuncao();
            $tipo = $obj->getTipo();
            $mensagem = "Remove equipamento.";
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
            <p>O equipamento foi removido com sucesso!<br/><a href="<?php echo TGlobal::$default_url_path; ?>/admin/equipamentos">>>Ir para equipamentos<<</a></p>
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
                <a href="<?php echo TGlobal::$default_url_path; ?>/admin/tipos">Tipos</a> / <strong>Remover</strong>                
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
                            <label>Função</label>
                            <input class="form-control" type="text" readonly="readonly" name="funcao" value="<?php echo $funcao; ?>" />
                        </div>
                    </div>    
                	<div class="col-lg-12">
                    	<div class="form-group">
                            <label>Tipo</label>
                            <input class="form-control" type="text" readonly="readonly" name="funcao" value="<?php echo TipoDAO::objetoPorId($tipo)->getNome(); ?>" />
                        </div>
                    </div>    
                    <div class="col-lg-4">
                    	<div class="form-group">       
                            <label style="color: #fff;">.</label>                    
                            <input type="submit"class="form-control btn btn-danger btn-block" value="Remover Equipamento"/>
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
