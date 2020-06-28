<?php 

class Criteria extends Expression {
	private $expressions; // armazena a lista de expressões
	private $operators; // armazena a lista de operadores
	private $properties; // propriedades do critério

	function __construct() {
		$this->expressions = array();
		$this->operators = array();
	}

	public function add(Expression $expression, $operator = self::AND_OPERATOR) {
		// na primeira vez, não precisamos concatenar
		if (empty($this->expressions)) {
			$operator = NULL;
		}
		// agrega o resultado de expressões à lista de expressões
		$this->expressions[] = $expression;
		$this->operators[] = $operator;
	}

	public function dump() {
		// concatena a lista de expressões
		if (is_array($this->expressions)) {
			if (count($this->expressions) > 0) {
				$result = '';
				foreach ($this->expressions as $i => $expression) {
					$operator = $this->operators[$i];
					// concatena o operador com a respectiva expressão
					$result .= $operator . $expression->dump() . ' ';
				}
				$result = trim($result);
				return "({$result})";
			}
		}
	}

	public function setProperty($property, $value) {
		if (isset($value)) {
			$this->properties[$property] = $value;
		} else {
			$this->properties[$property] = NULL;
		}
	}

	public function getProperty($property) {
		if (isset($this->properties[$property])) {
			return $this->properties[$property];
		}
	}
}
