<?php
$id = "";
$nome = "";
$uf = "";
$codigo = "";
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $id = $_POST['id'];
    $nome = strtoupper($_POST['nome']);
    $uf = $_POST['uf'];
    $codigo = $_POST['codigo'];
    
    if(empty($nome))
    {
        $mensagem = "* O nome deve ser inserido!";
    }
    else if(empty($uf))
    {
        $mensagem = "* A unidade federativa deve ser inserida!";
    }
    else if(empty($codigo))
    {
        $mensagem = "* O código do IBGE deve ser inserido!";
    }
    else
    {
        $obj = new Cidade();
        $obj->setId($id);
        $obj->setNome(strtoupper($nome));
        $obj->setUf($uf);
        $obj->setCodigo($codigo);

        $mensagem = CidadeDAO::update($obj);
    }
}
else if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        if($id > 0)
        {
            $obj = CidadeDAO::objetoPorId($id);
            $nome = $obj->getNome();
            $uf = $obj->getUf();
            $codigo = $obj->getCodigo();
            $mensagem = "Tela de alteração de cidade.";
        }
    }
}
else 
{    
    $mensagem = "Tela de inserção de cidade.";
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
            <p>Operação realizada com sucesso!<br/><a href="<?php echo TGlobal::$default_url_path; ?>/admin/cidades">>>Ir para Cidades<<</a></p>
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
                <a href="<?php echo TGlobal::$default_url_path; ?>/admin/cidades">Cidades</a> / <strong>Cadastro</strong>                
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
                            <label>Código Município IBGE</label>
                            <input class="form-control" type="text" name="codigo" maxlength="10" value="<?php echo $codigo; ?>" />
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
                            <label>UF</label>
                        	<select name="uf" class="form-control">
                            	<option value="">Selecione...</option>
                            	<option value="AC" <?php echo ($uf == 'AC')? 'selected':''; ?>>Acre</option>
                            	<option value="AL" <?php echo ($uf == 'AL')? 'selected':''; ?>>Alagoas</option>
                            	<option value="AP" <?php echo ($uf == 'AP')? 'selected':''; ?>>Amapá</option>
                            	<option value="AM" <?php echo ($uf == 'AM')? 'selected':''; ?>>Amazonas</option>
                            	<option value="BA" <?php echo ($uf == 'BA')? 'selected':''; ?>>Bahia</option>
                            	<option value="CE" <?php echo ($uf == 'CE')? 'selected':''; ?>>Ceará</option>
                            	<option value="DF" <?php echo ($uf == 'DF')? 'selected':''; ?>>Distrito Federal</option>
                            	<option value="ES" <?php echo ($uf == 'ES')? 'selected':''; ?>>Espírito Santo</option>
                            	<option value="GO" <?php echo ($uf == 'GO')? 'selected':''; ?>>Goiás</option>
                            	<option value="MA" <?php echo ($uf == 'MA')? 'selected':''; ?>>Maranhão</option>
                            	<option value="MT" <?php echo ($uf == 'MT')? 'selected':''; ?>>Mato Grosso</option>
                            	<option value="MS" <?php echo ($uf == 'MS')? 'selected':''; ?>>Mato Grosso do Sul</option>
                            	<option value="MG" <?php echo ($uf == 'MG')? 'selected':''; ?>>Minas Gerais</option>
                            	<option value="PA" <?php echo ($uf == 'PA')? 'selected':''; ?>>Pará</option>
                            	<option value="PB" <?php echo ($uf == 'PB')? 'selected':''; ?>>Paraíba</option>
                            	<option value="PR" <?php echo ($uf == 'PR')? 'selected':''; ?>>Paraná</option>
                            	<option value="PE" <?php echo ($uf == 'PE')? 'selected':''; ?>>Pernambuco</option>
                            	<option value="PI" <?php echo ($uf == 'PI')? 'selected':''; ?>>Piauí</option>
                            	<option value="RJ" <?php echo ($uf == 'RJ')? 'selected':''; ?>>Rio de Janeiro</option>
                            	<option value="RN" <?php echo ($uf == 'RN')? 'selected':''; ?>>Rio Grande do Norte</option>
                            	<option value="RS" <?php echo ($uf == 'RS')? 'selected':''; ?>>Rio Grande do Sul</option>
                            	<option value="RO" <?php echo ($uf == 'RO')? 'selected':''; ?>>Rondônia</option>
                            	<option value="RR" <?php echo ($uf == 'RR')? 'selected':''; ?>>Roraima</option>
                            	<option value="SC" <?php echo ($uf == 'SC')? 'selected':''; ?>>Santa Catarina</option>
                            	<option value="SP" <?php echo ($uf == 'SP')? 'selected':''; ?>>São Paulo</option>
                            	<option value="SE" <?php echo ($uf == 'SE')? 'selected':''; ?>>Sergipe</option>
                            	<option value="TO" <?php echo ($uf == 'TO')? 'selected':''; ?>>Tocantins</option>
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