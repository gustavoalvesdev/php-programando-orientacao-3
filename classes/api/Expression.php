<?php 

abstract class Expression {
	// operadores lógicos
	const AND_OPERATOR = 'AND ';
	const OR_OPERATOR = 'OR ';

	abstract public function dump();
}
