<?php


class Database {

	

	public static function connect() {
		
			$connexion = new PDO('mysql:host=localhost;dbname=rh', 'root', '');

			$connexion->exec("SET CHARACTER SET utf8");
		return $connexion;
	}
	
} 

?>