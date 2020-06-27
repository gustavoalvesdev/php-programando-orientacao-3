<?php 

require_once 'classes/api/Transaction.php';
require_once 'classes/api/Connection.php';
require_once 'classes/api/Logger.php';
require_once 'classes/api/LoggerTXT.php';
require_once 'classes/api/Record.php';
require_once 'classes/model/Produto.php';

try {
	Transaction::open('estoque');
	Transaction::setLogger(new LoggerTXT('tmp/log_update.txt'));
	Transaction::log('Alterando um produto');

	$p1 = Produto::find(2);

	print $p1->estoque."<br />\n";
	$p1->estoque += 10;
	print $p1->estoque."<br />\n";
	$p1->store();
	
	Transaction::close();

} catch(Exception $e) {
	Transaction::rollback();
	print $e->getMessage();
}