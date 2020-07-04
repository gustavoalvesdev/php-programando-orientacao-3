<?php

// carrega as classes necessárias
require_once 'classes/api/Transaction.php';
require_once  'classes/api/Connection.php';
require_once 'classes/api/Expression.php';
require_once 'classes/api/Criteria.php';
require_once 'classes/api/Repository.php';
require_once 'classes/api/Record.php';
require_once 'classes/api/Filter.php';
require_once 'classes/api/Logger.php';
require_once 'classes/api/LoggerTXT.php';
require_once 'classes/model/Produto.php';

try {
    // inicia a transação com a base de dados
    Transaction::open('estoque');

    // define o arquivo para log
    Transaction::setLogger(new LoggerTXT('tmp/log_collection_get.txt'));

    // define o critério de seleção
    $criteria = new Criteria();
    $criteria->add(new Filter('estoque', '>', 10));
    $criteria->add(new Filter('origem', '=', 'N'));

    // cria o repositório
    $repository = new Repository('Produto');

    // carrega os objetos conforme o critério
    $produtos = $repository->load($criteria);

    if ($produtos) {
        echo "Produtos <br />\n";

        foreach ($produtos as $produto) {
            echo 'ID: '.$produto->id;
            echo ' - Descricao: '.$produto->descricao;
            echo ' - Estoque: '.$produto->estoque;
            echo "<br />\n";
        }

        print 'Quantidade: '.$repository->count($criteria);
        Transaction::close(); // fecha a transação

    }


} catch(Exception $e) {
    echo $e->getMessage();
    Transaction::rollback();
}
