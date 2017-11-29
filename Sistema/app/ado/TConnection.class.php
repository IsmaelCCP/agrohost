<?php

/*
 * classe TConnection
 * Gerencia conexões com bancos de dados através de arquivos de configuração
 */

final class TConnection
{
    /*
     * método __construct()
     * não existirão instâncias de TConnection, por isto esamos marcando-o como private
     */
    
    private function __construct() {}
    
    /*
     * método open()
     * Recebe o nome do banco de dados e instanciao objeto PDO correspondente
     */
    
    public static function open($path)
    {
        // verifica se existe arquivo de configuração para este banc ode dados
        if(file_exists($path))
        {
            // lê o INI e retorna um array
            $db = parse_ini_file($path);
        }
        else
        {
            // se não existir, lança um erro
            throw new Exception("ARQUIVO NÃO ENCONTRADO");
        }
        
        // lê as informações contidas no arquivo
        $user = $db['user'];
        $pass = $db['pass'];
        $name = $db['name'];
        $host = $db['host'];
        $port = $db['port'];
        $type = $db['type'];
        
        // descobre qual o tipo (driver) de banco de dados a ser utilizado 
        switch ($type)
        {
            case 'pgsql':
                $conn = new PDO("pgsql:dbname={$name};user={$user};password={$pass};host=$host");
                break;
            case 'mysql':
                $conn = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);
                break;
            case 'sqlite':
                $conn = new PDO("sqlite:{$name}");
                break;
        }
        
        // define para que o PDO lance exceções na correspondência de erros
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //retorna o objeto instanciado
        return $conn;
        
    }
}

?>