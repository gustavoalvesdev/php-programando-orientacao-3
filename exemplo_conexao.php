<?php 

require_once 'classes/ar/Produto.php';
require_once 'classes/api/Connection.php';

try {
	$conn = Connection::open('estoque');
	Produto::setConnection($conn);

	$pro 				= new Produto();
	$pro->descricao 	= 'Café torrado e moído brasileiro';
	$pro->estoque 		= 100;
	$pro->preco_custo 	= 4;
	$pro->preco_venda 	=  7;
	$pro->codigo_barras = '34963045930455';
	$pro->data_cadastro = date('Y-m-d');
	$pro->origem 		= 'N';
	$pro->save();
} catch(Excpetion $e) {
	print $e->getMessage();
}
