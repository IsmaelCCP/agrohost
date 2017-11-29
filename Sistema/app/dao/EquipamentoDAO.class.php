<?php

final class EquipamentoDAO
{
    
    public static function gerarObjeto($row)
    {
        $obj = new Equipamento();
        $obj->setId($row['id']);
        $obj->setNome($row['nome']);
        $obj->setFuncao($row['funcao']);
        $obj->setTipo($row['tipo_id']);
        return $obj;
    }
    
    public static function objetoPorId($id)
    {
        $obj = null;
        try {
            $conn = TConnection::open(TGlobal::getDbPath());
            $sql = "
                SELECT id, nome, funcao, tipo_id
                FROM tb_equipamento
                WHERE id = :id";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0)
            {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $row)
                {
                    $obj = EquipamentoDAO::gerarObjeto($row);
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
    
    public static function lista($nome, $funcao, $tipo)
    {
        $lista = [];
        
        $nome = ($nome == "")? "%" : $nome;
        $funcao = ($funcao == "")? "%" : $funcao;
        $tipo = ($tipo == "")? "-1" : $tipo;
        
        try {
            
            $conn = TConnection::open(TGlobal::getDbPath());
            
            $sql = "
                SELECT id, nome, funcao, tipo_id
                FROM tb_equipamento
                WHERE (
                    LOWER(nome) LIKE LOWER(:nome)
                    AND LOWER(funcao) LIKE LOWER(:funcao)
                    AND (tipo_id = :tipo OR :tipo = -1)
                )
                ORDER BY nome ASC
            ";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':funcao', $funcao);
            $stmt->bindValue(':tipo', $tipo);
            
            $stmt->execute();
            
            if ($stmt->rowCount() > 0)
            {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($result as $row)
                {
                    $lista[] = EquipamentoDAO::gerarObjeto($row);
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
    
    public static function update(Equipamento $obj)
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
                $sql = " INSERT INTO tb_equipamento (nome, funcao, tipo_id) values (:nom, :fun, :tip)";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':nom', $obj->getNome());
                $stmt->bindValue(':fun', $obj->getFuncao());
                $stmt->bindValue(':tip', $obj->getTipo());
                $stmt->execute();
                $obj->setId($conn->lastInsertId());
                $retorno = "0";
            }
            else
            {
                /*
                 * UPDATE
                 */
                $sql = " UPDATE tb_equipamento SET nome=:nom, funcao=:fun, tipo_id=:tip WHERE id=:id";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':nom', $obj->getNome());
                $stmt->bindValue(':fun', $obj->getFuncao());
                $stmt->bindValue(':tip', $obj->getTipo());
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
    
    public static function remover(Equipamento $obj)
    {
        $retorno = "";
        $conn = null;
        try {
            $conn = TConnection::open(TGlobal::getDbPath());
            $sql = " DELETE FROM tb_equipamento WHERE id=:id";
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