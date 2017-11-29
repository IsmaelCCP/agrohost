<?php
$id = "";
$nome = "";
$funcao = "";
$tipo = "";
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $id = $_POST['id'];
    $nome = strtoupper($_POST['nome']);
    $funcao = strtoupper($_POST['funcao']);
    $tipo = strtoupper($_POST['tipo']);
    
    if(empty($nome))
    {
        $mensagem = "* O nome deve ser inserido!";
    }
    else if(empty($funcao))
    {
        $mensagem = "* A função deve ser inserida!";
    }
    else if(empty($tipo))
    {
        $mensagem = "* O tipo deve ser selecionado!";
    }
    else
    {
        $obj = new Equipamento();
        $obj->setId($id);
        $obj->setNome(strtoupper($nome));
        $obj->setFuncao(strtoupper($funcao));
        $obj->setTipo(strtoupper($tipo));
        
        $mensagem = EquipamentoDAO::update($obj);
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
            $mensagem = "Tela de alteração de equipamento.";
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
            <p>Operação realizada com sucesso!<br/><a href="<?php echo TGlobal::$default_url_path; ?>/admin/equipamentos" id="link_redirect">>>Ir para equipamentos<<</a></p>
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
    
    $listaTipo = TipoDAO::lista("%", "EQUIP");
    
    ?>

    <br/>
    <div class="row tooltip_ism">
    	<div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="<?php echo TGlobal::$default_url_path; ?>/admin/equipamentos">Equipamentos</a> / <strong>Cadastro</strong>                
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
                                <input class="form-control" type="text" name="nome" maxlength="150" value="<?php echo $nome; ?>" />
                            </div>
                        </div>               
                    	<div class="col-lg-12">
                        	<div class="form-group">
                                <label>Função</label>
                                <input class="form-control" type="text" name="funcao" maxlength="200" value="<?php echo $funcao; ?>" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                        	<div class="form-group">
                                <label>Tipo</label>
                            	<select class="form-control" name="tipo">
                                	<?php 
                                	
                                	if(empty($tipo))
                                	{
                                	    echo "<option value=''>Selecione um Tipo</option>";
                                	}
                                	
                                	foreach ($listaTipo as $obj)
                                	{
                                	    echo "<option value='{$obj->getId()}' ". ( ($tipo == $obj->getId())? "selected": "") .">{$obj->getNome()}</option>";
                                	}
                                	
                                	?>
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