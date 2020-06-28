<?php 

// carrega as classes necessárias
require_once 'classes/api/Expression.php';
require_once 'classes/api/Filter.php';

// cria um filtro por data (string)
$filter1 = new Filter('data', '=',  '2007-06-02');
print $filter1->dump() . "<br />\n";

// cria um filtro por salário (integer)
$filter2 = new Filter('salario', '>', 3000);
print $filter2->dump() . "<br />\n";

// cria um filtro por gênero (array)
$filter3 = new Filter('genero', 'IN', array('M', 'F'));
print $filter3->dump() . "<br />\n";

// cria um filtro por contrato (NULL)
$filter4 = new Filter('contrato', 'IS NOT', NULL);
print $filter4->dump() . "<br />\n";

// cria um filtro por ativo (boolean)
$filter5 = new Filter('ativo', '=', TRUE);
print $filter5->dump() . "<br />\n";
