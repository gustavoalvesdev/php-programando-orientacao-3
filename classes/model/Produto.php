<?php 

class Produto extends Record {
	const TABLENAME = 'produto';

	public function set_estoque($estoque) {
		if (is_numeric($estoque) AND $estoque > 0) {
			$this->data['estoque'] = $estoque;
		} else {
			throw new Exception("Estoque {$estoque} inválido em ".__CLASS__);
		}
	}
}
