<?php

final class UsuarioDAO
{
    public static function addColunas(TSqlSelect $sql)
    {
        $sql->addColumn('id');
        $sql->addColumn('nome');
        $sql->addColumn('login');
        $sql->addColumn('acesso');
        return $sql;
    }
    
    
    public static function validaLogin(TCriteria $criterio)
    {
        $obj = null;
        
        $sql = new TSqlSelect;
        // define o nome da entidade
        $sql->setEntity('tb_usuario');
        
        $sql = UsuarioDAO::addColunas($sql);
        
        $sql->setCriteria($criterio);
        
        try {
            $conn = TConnection::open(TGlobal::getDbPath());
            $result = $conn->query($sql->getInstruction());
            
            if($result)
            {
                $row = $result->fetch(PDO::FETCH_ASSOC);
                $obj = new Usuario();
                $obj->setId($row['id']);
                $obj->setNome($row['nome']);
                $obj->setAcesso($row['acesso']);
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
}

?>