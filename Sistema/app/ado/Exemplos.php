<?php

/*
 * exemplos
 */

include_once '../util/TGlobal.class.php';

// INSERT --------------------------------------------------------

function __autoload($classe)
{
    echo "Incluido a classe: <strong>{$classe}</strong>.class.php <br/>";
    if(file_exists("./{$classe}.class.php"))
    {
        include_once "./{$classe}.class.php";
    }
}

// define o LOCALE do sistema, para permitir ponto decimal
// PS: no Windows, usar "english" - POSIX linux
setlocale(LC_NUMERIC, 'english');

// cria uma instrução de INSERT
$sqlI = new TSqlInsert();
// define o nome da entidade
$sqlI->setEntity('aluno');
// atribui o valor de cada coluna
$sqlI->setRowData('id', 3);
$sqlI->setRowData('nome', 'Pedro Cardoso');
$sqlI->setRowData('fone', '(65) 9 9933-3265');
$sqlI->setRowData('nascimento', '1985-04-12');
$sqlI->setRowData('sexo', 'M');
$sqlI->setRowData('serie', '4');
$sqlI->setRowData('mensalidade', 280.4);

// processa a instrução SQL
echo "<br/>\n";
echo $sqlI->getInstruction();
echo "<br/>\n";
echo "<br/>\n";


// UPDATE --------------------------------------------------------

$crt = new TCriteria();
$crt->add(new TFilter('id', '=', '3'));
$crt->add(new TFilter('nome', 'LIKE', 'josé mac%'), TCriteria::AND_OPERATOR);

$sqlU = new TSqlUpdate();
// define o nome da entidade
$sqlU->setEntity('aluno');
// atribui o valor de cada coluna
$sqlU->setRowData('id', 3);
$sqlU->setRowData('nome', 'Pedro Cardoso');
$sqlU->setRowData('fone', '(65) 9 9933-3265');
$sqlU->setRowData('serie', '4');
$sqlU->setRowData('mensalidade', 280.4);
$sqlU->setCriteria($crt);

// processa a instrução SQL
echo "<br/>\n";
echo $sqlU->getInstruction();
echo "<br/>\n";
echo "<br/>\n";


// DELETE --------------------------------------------------------

$criteriaD = new TCriteria;
$criteriaD->add(new TFilter('id', '=', '3'));
$sqlD = new TSqlDelete();
// define o nome da entidade
$sqlD->setEntity('aluno');

$sqlD->setCriteria($criteriaD);

// processa a instrução SQL
echo "<br/>\n";
echo $sqlD->getInstruction();
echo "<br/>\n";
echo "<br/>\n";

// SELECT --------------------------------------------------------

$crS= new TCriteria;
$crS->add(new TFilter('nome', 'like', 'maria%'));
$crS->add(new TFilter('cidade', 'like', 'Porto%'));

// cria critério de seleção de dados
$crS->setProperty('offset', 0);
$crS->setProperty('limit', 10);
// define o ordenamento da consulta
$crS->setProperty('order', 'nome');

$sqlS = new TSqlSelect();
// define o nome da entidade
$sqlS->setEntity('aluno');
// acrescenta colunas à consulta
$sqlS->addColumn('nome');
$sqlS->addColumn('fone');

$sqlS->setCriteria($crS);

// processa a instrução SQL
echo "<br/>\n";
echo $sqlS->getInstruction();
echo "<br/>\n";
echo "<br/>\n";


// SELECT CONECTADO--------------------------------------------------------


$sql = new TSqlSelect();
$sql->setEntity('tb_pedido');
$sql->addColumn('tb_pedido_id');
$sql->addColumn('tb_parceiro_id');
$sql->addColumn('vendedor');
$sql->addColumn('data');

$criteria = new TCriteria;
$criteria->add(new TFilter('data', '>', '2017-10-20'));

$sql->setCriteria($criteria);

try {
    // abre conexão com a base db_mysql
    $conn = TConnection::open('db_mysql');
    
    echo "<br/>\n";
    // executa a instrução SQL
    $result = $conn->query($sql->getInstruction());
    if($result)
    {
        //$row = $result->fetch(PDO::FETCH_ASSOC);
        
        // exibe os dados resultantes        
        foreach($result as $row) 
        {        
            echo str_pad($row['tb_pedido_id'], 7, "_", STR_PAD_LEFT) . ' ' . 
                str_pad($row['tb_parceiro_id'], 10, "_", STR_PAD_LEFT)  . ' ' . 
                str_pad($row['vendedor'], 10, "_", STR_PAD_LEFT) . ' ' . 
                str_pad($row['data'], 18, "_", STR_PAD_RIGHT) . "<br/>";
        }
    }
    // fecha a conexão
    $conn = null;
}
catch (PDOException $e)
{
    // exibe a mensagem de erro
    print "Erro!: " . $e.getMessage() . "<br/>";
    die();
}



?>