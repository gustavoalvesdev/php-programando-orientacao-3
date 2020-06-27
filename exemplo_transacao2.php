<?php 

require_once 'classes/ar/ProdutoComTransacao.php';
require_once 'classes/api/Connection.php';
require_once 'classes/api/Transaction.php';

try {
	Transaction::open('estoque');

	$p1 = new Produto();
	$p1->descricao 	   = 'Chocolate amargo';
	$p1->estoque   	   = 8;
	$p1->preco_custo   = 4;
	$p1->preco_venda   = 7;
	$p1->codigo_barras = '68323453234234';
	$p1->data_cadastro = date('Y-m-d');
	$p1->origem 	   = 'N';
	$p1->save();

	Transaction::close();

} catch (Exception $e) {
	Transaction::rollback();
	print $e->getMessage();
}
