
<?php 

$lista = null;

$nome = '';
$situacao = '';
$cidade = '';

$listaCidade = CidadeDAO::lista("%", "%", "%");

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $nome = $_POST["nome"];
    $situacao = $_POST["situacao"];
    $cidade = $_POST["cidade"];
    //echo $nome.'-'.$situacao.'-'.$cidade;
    $lista = ParceiroDAO::listaWhere($nome, $situacao, $cidade);
}
?>
<br/>
<div class="row tooltip_ism">
	<div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Parceiros</strong>
            </div>
            <div class="panel-body">
                <form method="POST" action="#">
                	<div class="col-lg-4">
                    	<div class="form-group">
                            <label>Nome</label>
                            <input class="form-control" type="text" name="nome" maxlength="60" value="<?php echo $nome; ?>" />
                        </div>
                    </div>  
                    <div class="col-lg-3">
                    	<div class="form-group">
                            <label>Cidade</label>
                            <select class="form-control" name="cidade">
                            	<?php 
                            	
                            	    echo "<option value='-1'>Todos</option>";
                            	
                            	    foreach ($listaCidade as $obj)
                                	{
                                	    echo "<option value='{$obj->getId()}' ". ( ($cidade == $obj->getId())? "selected": "") .">{$obj->getNome()}</option>";
                                	}
                            	
                            	?>
                            </select>
                        </div>
                    </div>    
                	<div class="col-lg-2">
                    	<div class="form-group">
                            <label>Situação</label>
                            <select class="form-control" name="situacao" >
                            	<option value="-1" <?php echo ($situacao==-1)? 'selected':''; ?>>Todos</option>
                            	<option value="0" <?php echo ($situacao==0)? 'selected':''; ?>>Inativo</option>
                            	<option value="1" <?php echo ($situacao==1)? 'selected':''; ?>>Ativo</option>
                            </select>
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
                <a href="<?php echo TGlobal::$default_url_path ?>/admin/tipo_cadastro" class="btn btn-default btn-circle"  data-toggle='tooltip' data-placement='top' title='Adicionar'><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>

<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Parceiros</strong>
                <?php 
                if (count($lista)>0)
                {
                    echo "(Encontrado ".count($lista)." registros)";
                }
                ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body tooltip_ism">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-parceiros">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Razão Social</th>
                            <th>Nome</th>
                            <th>Cidade</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php 
                    	
                    	foreach($lista as $obj)
                    	{        
                    	    
                    	    $corAtivo = ($obj->getSituacao() == "1") ? 'background_verde' : 'background_vermelho';
                    	    
                    	    echo ('
                                <tr>
                                    <td class="'.$corAtivo.'">'. $obj->getId() . '</td>
                                    <td>'. $obj->getRazaoSocial() . '</td>
                                    <td>'. $obj->getNome() . '</td>
                                    <td class="center">'. $obj->getCidade()->getNome() .'-'. $obj->getCidade()->getUf() .'</td>
                                    <td class="center_align font_14">
                                    	<a href="" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>&ensp;
                                    	<a href="'.TGlobal::$default_url_path.'/admin/visualizar_parceiro/'.$obj->getId().'" data-toggle="tooltip" data-placement="top" title="Vizualizar"><i class="fa fa-search"></i></a>
                                	</td>
                                </tr>
                                ');
                    	    
                    	}
                    	
                    	?>
                        
                    </tbody>
                </table>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<!-- DataTables JavaScript -->
<script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {

	if(<?php echo $ativo; ?> == 0)
		$('#ativo').prop('checked', false);
	else
		$('#ativo').prop('checked', true);
	
	$("#input_filtro").focus();
	$("#input_filtro").val('<?php echo $txt_filtro; ?>');
	
    $('#dataTables-parceiros').DataTable({
        responsive: true,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nenhum dado encontrado",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum dado encontrado",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "Buscar: "
        },
        "pageLength": 25
    });
});

$('.tooltip_ism').tooltip({
    selector: "[data-toggle=tooltip]",
    container: "body"
})



</script>