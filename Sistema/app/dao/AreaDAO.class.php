<?php

final class AreaDAO
{
    
    public static function gerarObjeto($row)
    {          
        $obj = new Area();
        $obj->setId($row['id']);
        $obj->setNome($row['nome']);
        $obj->setHectare($row['hectare']);
        $obj->setNomeParceiro($row['parceiroNome']);
        $obj->setParceiroID($row['parceiroId']);
        return $obj;
    }
    
    public static function objetoPorId($id)
    {
        $obj = null;
        try {
            
            $conn = TConnection::open(TGlobal::getDbPath());
            
            $sql = "
                SELECT a.id, a.nome, a.hectare, p.nome parceiroNome, p.id parceiroId
                FROM tb_area a
                JOIN tb_parceiro p ON a.parceiro_id = p.id
                WHERE a.id = :id";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id);            
            $stmt->execute();
            
            if ($stmt->rowCount() > 0)
            {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
                foreach($result as $row)
                {
                    $obj = AreaDAO::gerarObjeto($row);
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
        
    public static function lista($nome, $proprietario)
    {
        $lista = [];
                
        $nome = ($nome == "")? "%" : $nome;
        $proprietario = ($proprietario == "")? "%" : $proprietario;
        
                
        try {
            
            $conn = TConnection::open(TGlobal::getDbPath());
            
            $sql = "
                SELECT a.id, a.nome, a.hectare, p.nome parceiroNome, p.id parceiroId
                FROM tb_area a
                JOIN tb_parceiro p ON a.parceiro_id = p.id
                WHERE (
                    LOWER(a.nome) LIKE LOWER(:nome)
                    AND
                    LOWER(p.nome) LIKE LOWER(:proprietario)
                )
            ";
            
            $stmt = $conn->prepare($sql);   
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':proprietario', $proprietario);
            
            $stmt->execute();
            
            if ($stmt->rowCount() > 0)
            {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($result as $row)
                {
                    $lista[] = AreaDAO::gerarObjeto($row);
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
    
    public static function update(Area $obj)
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
                $sql = " INSERT INTO tb_area (nome, hectare, parceiro_id) values (:nom, :hec, :par)";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':nom', $obj->getNome());
                $stmt->bindValue(':hec', $obj->getHectare());
                $stmt->bindValue(':par', $obj->getParceiroId());
                $stmt->execute();       
                $obj->setId($conn->lastInsertId());
                $retorno = "0";
            }
            else 
            {
                /* 
                 * UPDATE
                 */
                $sql = " UPDATE tb_area SET nome=:nom, hectare=:hec, parceiro_id=:par WHERE id=:id";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':nom', $obj->getNome());
                $stmt->bindValue(':hec', $obj->getHectare());
                $stmt->bindValue(':par', $obj->getParceiroId());
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
    
    public static function remover(Area $obj)
    {
        $retorno = "";
        $conn = null;
        try {
            $conn = TConnection::open(TGlobal::getDbPath());
            $sql = " DELETE FROM tb_area WHERE id=:id";
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