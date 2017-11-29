<?php



final class ParceiroDAO
{
    
    public static function gerarObjeto($row)
    {                
        $obj = new Parceiro();
        $obj->setId($row['id']);
        $obj->setNome($row['nome']);
        $obj->setRazaoSocial($row['razaosocial']);        
        $obj->setCpfCnpj($row['cpfcnpj']);
        $obj->setTelefone1($row['telefone1']);
        $obj->setTelefone2($row['telefone2']);
        $obj->setEndereco($row['endereco']);
        $obj->setNumero($row['numero']);
        $obj->setComplemento($row['complemento']);
        $obj->setBairro($row['bairro']);
        $obj->setCep($row['cep']);
        $obj->setSituacao($row['situacao']);
        $obj->setData($row['data']);
        $obj->setInscricaoEstadual($row['inscricaoestadual']);
        $obj->setFornecedorPecas($row['fornecedorpecas']);
        $obj->setFornecedor($row['fornecedor']);
        $obj->setInterno($row['interno']);
        
        $cidade = new Cidade();
        $cidade->setCodigo($row['cidade_id']);
        $cidade->setNome($row['cidade_nome']);
        $cidade->setCodigo($row['cidade_codigo']);
        $cidade->setUf($row['cidade_uf']);
        
        $obj->setCidade($cidade);
            
        return $obj;
    }
    
    public static function objetoPorId($id)
    {
        $parceiro = null;
        
        return $parceiro;
        
        
    }
    
    public static function lista($situacao, $fornecedor, $fornecedorpecas, $interno)
    {
        
        $lista = [];
        
        
        if(empty($fornecedorpecas))
        {
            $fornecedorpecas = '-1';
        }
        
        if(empty($fornecedor))
        {
            $fornecedor = '-1';
        }
        
        if(empty($interno))
        {
            $interno = '-1';
        }        
            
        if(empty($situacao))
        {
            $situacao = '-1';
        }
        
        
        try {
            
            $conn = TConnection::open(TGlobal::getDbPath());
            
            $sql = "
                SELECT p.id, p.nome, p.razaosocial, p.cpfcnpj, p.telefone1, p.telefone2, p.endereco, p.numero, 
                       p.complemento, p.bairro, p.cep, p.situacao, p.data, p.inscricaoestadual, p.fornecedor, 
                       p.fornecedorpecas, p.interno, p.cidade_id, c.nome cidade_nome, c.uf cidade_uf, c.codigo cidade_codigo       
                FROM tb_parceiro p
                JOIN tb_cidade c ON c.id = p.cidade_id
                WHERE (p.fornecedor = :fornecedor OR :fornecedor = '-1')
                AND (p.fornecedorpecas = :fornecedorpecas OR :fornecedorpecas = '-1')
                AND (p.interno = :interno OR :interno = '-1')
                AND (p.situacao = :situacao OR :situacao = '-1')";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':fornecedor', $fornecedor);
            $stmt->bindValue(':fornecedorpecas', $fornecedorpecas);
            $stmt->bindValue(':interno', $interno);
            $stmt->bindValue(':situacao', $situacao);
            
            $stmt->execute();
            
            if ($stmt->rowCount() > 0)
            {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($result as $row)
                {
                    $obj = ParceiroDAO::gerarObjeto($row);
                    $lista[] = $obj;
                }
            }
        }
        catch (Exception $e)
        {
            print '
                <br/>
                <div class="col-lg-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            Atenção
                        </div>
                        <div class="panel-body">
                            <p>Erro!: ' . $e->getMessage() . '</p>
                        </div>
                        <div class="panel-footer">
                            Caso você não entender o motivo deste erro, procure um técnico para solucionar seu problema.
                        </div>
                    </div>
                </div>';
            die();
        }
        finally {
            $conn = null;
        }
                
        return $lista;
        
    }
    
    public static function listaWhere($nome, $situacao, $cidade)
    {
        
        $lista = [];
        
        
        if(empty($nome))
        {
            $nome = '%';
        }        
        
        if(empty($cidade))
        {
            $cidade = '%';
        }
        
        if(empty($situacao))
        {
            $situacao = '0';
        }
        
        
        
        try {
            
            $conn = TConnection::open(TGlobal::getDbPath());
            
            $sql = "
                SELECT p.id, p.nome, p.razaosocial, p.cpfcnpj, p.telefone1, p.telefone2, p.endereco, p.numero,
                       p.complemento, p.bairro, p.cep, p.situacao, p.data, p.inscricaoestadual, p.fornecedor,
                       p.fornecedorpecas, p.interno, p.cidade_id, c.nome cidade_nome, c.uf cidade_uf, c.codigo cidade_codigo
                FROM tb_parceiro p
                JOIN tb_cidade c ON c.id = p.cidade_id
                WHERE (p.situacao = :sit OR :sit = '-1')
                AND (p.nome LIKE :nome)
                AND (p.cidade_id = :cid OR :cid = '-1')";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':sit', $situacao);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':cid', $cidade);
                        
            $stmt->execute();
            
            if ($stmt->rowCount() > 0)
            {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($result as $row)
                {
                    $lista[] = ParceiroDAO::gerarObjeto($row);
                }
            }
        }
        catch (Exception $e)
        {
            print '
                <br/>
                <div class="col-lg-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            Atenção
                        </div>
                        <div class="panel-body">
                            <p>Erro!: ' . $e->getMessage() . '</p>
                        </div>
                        <div class="panel-footer">
                            Caso você não entender o motivo deste erro, procure um técnico para solucionar seu problema.
                        </div>
                    </div>
                </div>';
            die();
        }
        finally {
            $conn = null;
        }
        
        return $lista;
        
    }
}

?>