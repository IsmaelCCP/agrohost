<?php

final class CidadeDAO
{
    
    public static function gerarObjeto($row)
    {
        $obj = new Cidade();
        $obj->setId($row['id']);
        $obj->setNome($row['nome']);
        $obj->setCodigo($row['codigo']);
        $obj->setUf($row['uf']);
        return $obj;
    }    
    
    public static function objetoPorId($id)
    {
        $obj = null;
        try {            
            $conn = TConnection::open(TGlobal::getDbPath());            
            $sql = "
                SELECT id, nome, codigo, uf
                FROM tb_cidade
                WHERE id = :id";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0)
            {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $row)
                {
                    $obj = CidadeDAO::gerarObjeto($row);
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
        return $obj;
    }
    
    public static function lista($nome, $uf, $codigo)
    {
        $lista = [];
        
        $nome = ($nome == "")? "%" : $nome;
        $uf = ($uf == "")? "%" : $uf;
        $codigo = ($codigo == "")? "%" : $codigo;        
        
        try {
            
            $conn = TConnection::open(TGlobal::getDbPath());
            
            $sql = "
                SELECT id, nome, codigo, uf
                FROM tb_cidade
                WHERE (
                    LOWER(nome) LIKE LOWER(:nome)
                    AND
                    LOWER(uf) LIKE LOWER(:uf)
                    AND
                    LOWER(codigo) LIKE LOWER(:codigo)
                )
                ORDER BY nome ASC
            ";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':uf', $uf);
            $stmt->bindValue(':codigo', $codigo);
            
            $stmt->execute();
            
            if ($stmt->rowCount() > 0)
            {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($result as $row)
                {
                    $lista[] = CidadeDAO::gerarObjeto($row);
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
    
    public static function update(Cidade $obj)
    {
        $retorno = "";
        $conn = null;
        try {
            $conn = TConnection::open(TGlobal::getDbPath());
            
            if(empty($obj->getId()))
            {
                /*
                 * INSERT
                 */
                $sql = " INSERT INTO tb_cidade (nome, uf, codigo) values (:nom, :uf, :cod)";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':nom', $obj->getNome());
                $stmt->bindValue(':uf', $obj->getUf());
                $stmt->bindValue(':cod', $obj->getCodigo());
                $stmt->execute();
                $obj->setId($conn->lastInsertId());
                $retorno = "0";
            }
            else
            {
                /*
                 * UPDATE
                 */
                $sql = " UPDATE tb_cidade SET nome=:nom, uf=:uf, codigo=:cod WHERE id=:id";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':nom', $obj->getNome());
                $stmt->bindValue(':uf', $obj->getUf());
                $stmt->bindValue(':cod', $obj->getCodigo());
                $stmt->bindValue(':id', $obj->getId());
                $stmt->execute();
                $retorno = "0";
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
        return $retorno;
    }
    
    public static function remover(Cidade $obj)
    {
        $retorno = "";
        $conn = null;
        try {
            $conn = TConnection::open(TGlobal::getDbPath());
            $sql = " DELETE FROM tb_cidade WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $obj->getId());
            $stmt->execute();
            $retorno = "0";
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
        return $retorno;
    }
}

?>