<?php

$nome = "";
$codigo = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $nome = $_POST["nome"];
    $codigo = $_POST["codigo"];
    $lista = ItemDAO::lista($nome, $codigo);
}


?>
<br/>
<div class="row tooltip_ism">
	<div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Itens</strong>
            </div>
            <div class="panel-body">
                <form method="POST" action="#">
                	<div class="col-lg-7">
                    	<div class="form-group">
                            <label>Nome</label>
                            <input class="form-control" type="text" name="nome" maxlength="60" value="<?php echo $nome; ?>" />
                        </div>
                    </div>
                	<div class="col-lg-2">
                    	<div class="form-group">
                            <label>Código</label>
                            <input class="form-control" type="text" name="codigo" maxlength="5" value="<?php echo $codigo; ?>" />
                        </div>
                    </div>   
                    <div class="col-lg-3">
                    	<div class="form-group">       
                            <label style="color: #fff;">.</label>                    
                            <input type="submit"class="form-control btn btn-primary btn-block" value="Pesquisar"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-footer">
                <a href="<?php echo TGlobal::$default_url_path ?>/admin/item_cadastro" class="btn btn-default btn-circle"  data-toggle='tooltip' data-placement='top' title='Adicionar'><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
    <!-- /.col-lg-4 -->
	<div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Código</th>
                                <th>Nome</th>
                                <th style="width: 30px;"></th>
                                <th style="width: 30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        	<?php 
                        	
                        	if(!empty($lista))
                        	{
                            	foreach ($lista as $obj)
                            	{
                            	    echo "
                                        <tr>
                                            <td>{$obj->getId()}</td>
                                            <td>{$obj->getCodigo()}</td>
                                            <td>{$obj->getNome()}</td>
                                            <td>
                                                <a href='". TGlobal::$default_url_path ."/admin/item_cadastro/?id={$obj->getId()}' class='btn btn-default btn-circle' data-toggle='tooltip' data-placement='top' title='Editar'>
                                                    <i class='fa fa-edit'></i>
                                                </a></td>
                                            <td>
                                                <a href='". TGlobal::$default_url_path ."/admin/item_remover/?id={$obj->getId()}' class='btn btn-default btn-circle' data-toggle='tooltip' data-placement='top' title='Excluir'>
                                                    <i class='fa fa-trash'></i>
                                                </a>
                                            </td>
                                        </tr>
                                        ";
                            	}
                        	}
                        	
                        	?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
</div>

<script>

$('.tooltip_ism').tooltip({
    selector: "[data-toggle=tooltip]",
    container: "body"
})

</script>