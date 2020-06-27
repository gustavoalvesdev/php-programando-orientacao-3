<?php 

final class Transaction {
	private static $conn; // conexão ativa
	private static $logger; // objeto de log

	private function __construct() {}

	public static function open($database) {
		if (empty(self::$conn)) {
			self::$conn = Connection::open($database);
			self::$conn->beginTransaction(); // inicia a transação
			self::$logger = NULL; // desliga o log de SQL
		}
	}

	public static function get() {
		return self::$conn; // retorna a conexão ativa
	}

	public static function rollback() {
		if (self::$conn) {
			self::$conn->rollback(); // desfaz as operações realizadas
			self::$conn = NULL;
		}
	}

	public static function close() {
		if (self::$conn) {
			self::$conn->commit(); // aplica as operações realizadas
			self::$conn = NULL;
		}
	}

	public function setLogger(Logger $logger) {
		self::$logger = $logger;
	}

	public static function log($message) {
		if (self::$logger) {
			self::$logger->write($message);
		}
	}
}