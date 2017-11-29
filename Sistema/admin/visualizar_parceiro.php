<?php

$url_1 = Url::getURL( 1 );     
 
if($url_1)
{
    $where= new TCriteria;
    $where->add(new TFilter('tb_parceiro_id', '=', $url_1));
    // cria critério de seleção de dados
    $where->setProperty('offset', 0);
    $where->setProperty('limit', 1);
    // define o ordenamento da consulta
    $where->setProperty('order', 'nomefantasia');
    
    $parceiro = ParceiroDAO::getParceiro($where);
    
    echo $parceiro->getNomeFantasia();
}
else
{
    echo 'Dados inválidos...';
}

?>