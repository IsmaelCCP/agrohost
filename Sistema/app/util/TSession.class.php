<?php

/*
 * calsse TSession
 * gerencia uma seção com o usuário
 */

class TSession
{
    /*
     * método construtor
     * inicializa uma seção
     */
    
    function __construct()
    {
        session_start();
    }
    
    /*
     * método setValue()
     * armazena uma variável na seção
     * @param $var = Nome da variável
     * @param $value = valor
     */
    
    function setValue($var, $value)
    {
        $_SESSION[$var] = $value;
    }
    
    /*
     * método getValue()
     * retorna uma variável da seção
     * @param $var = Nome da variável
     */
    
    function getValue($var)
    {
        return $_SESSION[$var];
    }
    
    /*
     * metodo freeSession()
     * destrói os dados de uma seção
     */
    
    function freeSession()
    {
        $_SESSION = array();
        session_destroy();
    }
}

/* COMO USAR

include 'TSession.class.php';

new TSession(); 

if(!TSession::getValue('counted'))
{
    echo 'registrando visita';
    TSession::setValue('counted', true);
}
else
{
    echo 'visita já registrada';
}

*/

?>