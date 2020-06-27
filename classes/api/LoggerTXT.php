<?php 

class LoggerTXT extends Logger {
	public function write($message) {
		date_default_timezone_set('America/Sao_Paulo');
		$time = date('Y-m-d');

		// monta a string
		$text = "$time :: $message\n";

		// adiciona ao final do arquivo
		$handler = fopen($this->filename, 'a');
		fwrite($handler, $text);
		fclose($handler);
	}
}
