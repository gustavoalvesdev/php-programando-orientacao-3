<?php 

class Produto {
	private $data;

	function __get($prop) {
		return $this->data[$prop];
	}

	function __set($prop, $value) {
		$this->data[$prop] = $value;
	}
}
