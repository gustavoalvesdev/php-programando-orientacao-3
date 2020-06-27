<?php 

require_once 'Produto.php';
require_once 'Venda.php';
require_once 'VendaMapper.php';

try {

	$p1 = new Produto();
	$p1->id = 1;

	$p1->preco = 12;

	$p2 = new Produto();
	$p2->id = 2;
	$p2->preco = 14;

	$venda = new Venda();

	// adiciona alguns produtos
	$venda->addItem(10, $p1);
	$venda->addItem(20, $p2);

	$conn = new PDO('mysql:host=localhost;dbname=persistencia', 'root', '');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	VendaMapper::setConnection($conn);

	// salva venda
	VendaMapper::save($venda);

} catch(Exception $e) {
	print $e->getMessage();
}
