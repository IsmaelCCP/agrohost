<?php

final class ItemDAO
{
    public static function gerarObjeto($row)
    {
        $obj = new Item();
        $obj->setId($row['id']);
        $obj->setNome($row['nome']);
        $obj->setCodigo($row['codigo']);
        return $obj;
    }
    
    public static function objetoPorId($id)
    {
        $obj = null;
        try {
            $conn = TConnection::open(TGlobal::getDbPath());
            $sql = "
                SELECT id, nome, codigo
                FROM tb_item
                WHERE id = :id";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0)
            {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $row)
                {
                    $obj = ItemDAO::gerarObjeto($row);
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
    
    public static function lista($nome, $codigo)
    {
        $lista = [];
        
        $nome = ($nome == "")? "%" : $nome;
        $codigo = ($codigo == "")? "%" : $codigo;
        
        try {
            
            $conn = TConnection::open(TGlobal::getDbPath());
            
            $sql = "
                SELECT id, nome, codigo
                FROM tb_item
                WHERE (
                    LOWER(nome) LIKE LOWER(:nome)
                    AND
                    LOWER(codigo) LIKE LOWER(:codigo)
                )
                ORDER BY nome ASC
            ";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':codigo', $codigo);
            
            $stmt->execute();
            
            if ($stmt->rowCount() > 0)
            {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($result as $row)
                {
                    $lista[] = ItemDAO::gerarObjeto($row);
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
    
    public static function update(Item $obj)
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
                $sql = " INSERT INTO tb_item (nome, codigo) values (:nom, :cod)";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':nom', $obj->getNome());
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
                $sql = " UPDATE tb_item SET nome=:nom, codigo=:cod WHERE id=:id";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':nom', $obj->getNome());
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
    
    public static function remover(Tipo $obj)
    {
        $retorno = "";
        $conn = null;
        try {
            $conn = TConnection::open(TGlobal::getDbPath());
            $sql = " DELETE FROM tb_item WHERE id=:id";
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