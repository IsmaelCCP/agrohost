<?php

/*
 * classe TSqlDelete
 * Esta classe provê meios para manipulação de uma istrução de DELETE no banco de dados
 */

final class TSqlDelete extends TSqlInstruction
{
    /*
     * método getInstruction()
     */
    
    public function getInstruction()
    {
        // monta a string de DELETE
        $this->sql = "DELETE FROM {$this->entity}";
        
        // retorna a cláusula WHERE do objeto $this->criteria
        if($this->criteria)
        {
            $expression = $this->criteria->dump();
            if($expression)
            {
                $this->sql .= ' WHERE ' . $expression;
            }
        }
        
        return $this->sql;
    }
}

?>