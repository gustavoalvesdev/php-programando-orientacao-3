<?php 

class Venda {
	private $id;
	private $itens;

	public function setId($id) {
		$this->id = $id;
	}

	public function getId() {
		return $this->id;
	}

	public function addItem($quantidade, Produto $produto) {
		$this->itens[] = array($quantidade, $produto);
	}

	public function getItens() {
		return $this->itens;
	}

	
}
