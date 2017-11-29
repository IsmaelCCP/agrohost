<?php

final class TSqlInsert extends TSqlInstruction
{
    
    /*
     * método setRowData()
     * Atribui valores à determinadas colunas no banco de dados que serão inseridas
     * @param   $column = coluna da tabela
     * @param   $value  = valor a ser armazenado
     */
    
    public function setRowData($column, $value)
    {
        // monta um array indexado pelo nome da coluna 
        if(is_string($value))
        {
            // adiciona \ em aspas
            $value = addslashes($value);
            // caso seja uma string
            $this->columnValues[$column] = "'$value'";
        }
        else if(is_bool($value))
        {
            // caso seja um boolean
            $this->columnValues[$column] = $value ? 'TRUE' : 'FALSE';
        }
        else if(isset($value))
        {
            // caso seja outro tipo de dado
            $this->columnValues[$column] = $value;
        }
        else 
        {
            // caso seja null
            $this->columnValues[$column] = "NULL";
        }
    }
    
    /*
     * método setCriteria()
     * Não existe no contexto desta classe, logo, irá lançar um erro se for executado
     */
    
    public function setCriteria(TCriteria $criteria)
    {
        // lança erro
        throw new Exception("Cannot call setCriteria from ". __CLASS__);
    }
    
    /*
     * método getInstruction()
     * retorna a instrução de INSERT em forma de string.
     */
    
    public function getInstruction()
    {
        $this->sql = "INSERT INTO {$this->entity} (";
        // monta uma string contendo os nomes das colunas
        $columns = implode(', ', array_keys($this->columnValues));
        // monta uma string contendo os valores
        $values = implode(', ', array_values($this->columnValues));
        $this->sql .= $columns . ')';
        $this->sql .= " values ({$values})";        
        return $this->sql; 
    }
}

?>