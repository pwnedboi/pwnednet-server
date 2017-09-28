<?php 

    class DB {
		private static function connect($username, $password, $database) {
			$pdo = new PDO('mysql:host=localhost;dbname=dbname;charset=utf8', $username, $password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		}
		public static function query($query, $params = array()) {
			$db = self::connect('user', 'pass', 'db');
			$statement = $db->prepare($query);
			$statement->execute($params);

			if (explode(' ', $query)[0] == 'SELECT') {
				$data = $statement->fetchAll();
				return $data;
			}
		}
	}

?>
