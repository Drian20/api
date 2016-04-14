<?php

	function getDB(){
		$dsn = 'mysql:dbname=adiction;host=localhost';
		$user = 'root';
		$password = 'password';

		try {
    		$dbh = new PDO($dsn, $user, $password);
		}		 
		catch (PDOException $e) {
    		$dbh= 'Connection failed: ' . $e->getMessage();
		}
		return $dbh;


	}
?>