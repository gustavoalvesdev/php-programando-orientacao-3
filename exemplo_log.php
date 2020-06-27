<?php 

require_once 'classes/ar/ProdutoComTransacaoELog.php';
require_once 'classes/api/Connection.php';
require_once 'classes/api/Transaction.php';
require_once 'classes/api/Logger.php';
require_once 'classes/api/LoggerTXT.php';


try {
	Transaction::open('estoque');
	Transaction::setLogger(new LoggerTXT('tmp/log.txt'));
	Transaction::log('Inserindo produto novo');

	$p1 				= new Produto();
	$p1->descricao 		= 'Chocolate amargo';
	$p1->estoque 		= 80;
	$p1->preco_custo 	= 4;
	$p1->preco_venda 	=  7;
	$p1->codigo_barras 	= '68323453234234';
	$p1->data_cadastro 	= date('Y-m-d');
	$p1->origem 		= 'N';
	$p1->save();

	Transaction::close();

} catch(Excpetion $e) {
	Transaction::rollback();
	print $e->getMessage();
}
