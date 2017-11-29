<?php
$id = "";
$nome = "";
$codigo = "";
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $id = $_POST['id'];
    $nome = strtoupper($_POST['nome']);
    $codigo = strtoupper($_POST['codigo']);
    
    if(empty($nome))
    {
        $mensagem = "* O nome deve ser inserido!";
    }
    else if(empty($codigo))
    {
        $mensagem = "* O código deve ser inserido!";
    }
    else
    {
        $obj = new Item();
        $obj->setId($id);
        $obj->setNome(strtoupper($nome));
        $obj->setCodigo(strtoupper($codigo));
        
        $mensagem = ItemDAO::update($obj);
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
            <p>Operação realizada com sucesso!<br/><a href="<?php echo TGlobal::$default_url_path; ?>/admin/itens"> >>Ir para itens<< </a></p>
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
                <a href="<?php echo TGlobal::$default_url_path; ?>/admin/itens">Itens</a> / <strong>Cadastro</strong>                
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
                            <input class="form-control" type="text" name="nome" maxlength="75" value="<?php echo $nome; ?>" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                    	<div class="form-group">
                            <label>Código</label>
                            <input class="form-control" type="text" name="codigo" maxlength="60" value="<?php echo $codigo; ?>" />
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
<?php 
}
?>