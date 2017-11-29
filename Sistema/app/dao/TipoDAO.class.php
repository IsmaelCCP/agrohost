<?php

final class TipoDAO
{
    public static function gerarObjeto($row)
    {
        $obj = new Tipo();
        $obj->setId($row['id']);
        $obj->setNome($row['nome']);
        $obj->setReferencia($row['referencia']);
        return $obj;
    }
    
    public static function objetoPorId($id)
    {
        $obj = null;
        try {
            $conn = TConnection::open(TGlobal::getDbPath());
            $sql = "
                SELECT id, nome, referencia
                FROM tb_tipo
                WHERE id = :id";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0)
            {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $row)
                {
                    $obj = TipoDAO::gerarObjeto($row);
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
    
    public static function lista($nome, $referencia)
    {
        $lista = [];
        
        $nome = ($nome == "")? "%" : $nome;
        $referencia = ($referencia == "")? "%" : $referencia;
        
        try {
            
            $conn = TConnection::open(TGlobal::getDbPath());
            
            $sql = "
                SELECT id, nome, referencia
                FROM tb_tipo
                WHERE (
                    LOWER(nome) LIKE LOWER(:nome)
                    AND
                    LOWER(referencia) LIKE LOWER(:ref)
                )
                ORDER BY nome ASC
            ";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':ref', $referencia);
            
            $stmt->execute();
            
            if ($stmt->rowCount() > 0)
            {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($result as $row)
                {
                    $lista[] = TipoDAO::gerarObjeto($row);
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
    
    public static function update(Tipo $obj)
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
                $sql = " INSERT INTO tb_tipo (nome, referencia) values (:nom, :ref)";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':nom', $obj->getNome());
                $stmt->bindValue(':ref', $obj->getReferencia());
                $stmt->execute();
                $obj->setId($conn->lastInsertId());
                $retorno = "0";
            }
            else
            {
                /*
                 * UPDATE
                 */
                $sql = " UPDATE tb_tipo SET nome=:nom, referencia=:ref WHERE id=:id";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':nom', $obj->getNome());
                $stmt->bindValue(':ref', $obj->getReferencia());
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
            $sql = " DELETE FROM tb_tipo WHERE id=:id";
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