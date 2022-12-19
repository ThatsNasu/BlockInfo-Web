<?php
	class DatabaseManager {
		private $SERVER;
		private $DATABASE;
		private $USER;
		private $PASS;
		private $pdo;


		public function __construct($server, $database, $user, $pass) {
			$this->SERVER = $server;
			$this->DATABASE = $database;
			$this->USER = $user;
			$this->PASS = $pass;
		}

		private function connect() {
			$this->pdo = new PDO('mysql:host='.$this->SERVER.';dbname='.$this->DATABASE, $this->USER, $this->PASS);
		}

		public function get($table, $name, $fields) {
			$this->connect();
			$stmtbuilder = "SELECT ";
			if($fields != NULL && sizeof($fields[0]) != 0) {
				foreach($fields[0] as $field) {
					$stmtbuilder .= $field.',';
				}
				$stmtbuilder = rtrim($stmtbuilder, ",");
			} else {
				$stmtbuilder .= "*";
			}
			$stmtbuilder .= " FROM ".$table." WHERE name = ?";
			$stmt = $this->pdo->prepare($stmtbuilder);
			$stmt->execute(array($name));
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}

		public function update($table, $name, $field, $value) {
			
		}

		public function add($table, $values) {
			
		}
	}
?>