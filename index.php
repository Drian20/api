<?php

require 'vendor/autoload.php';
require 'db.php';
\Slim\Slim::registerAutoloader();
$app=new \Slim\Slim();

$app->get('/users/', 'users');
$app->post('/users/', 'insertusers');
$app->get('/hello/:name', 'hello');
$app->run();

	function hello($name){
		echo "<h1>Hello ".$name."! Everything OK.</h1>";
	}

	function users(){
		$sql = "SELECT * FROM users";
		$dbh = getDB();
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		header('Content-Type', 'application/json');
		echo json_encode($result);
	}

	function insertusers(){
		$sql = "INSERT INTO users VALUES(:username, :name, :lastname, :password, :email, :country, :rol)";
		$request = \Slim\Slim::getInstance()->request();
		$user = $request->params();
		$username = $user["username"];
		$name = $user["name"];
		$lastname = $user["lastname"];
		$password = $user["password"];
		$email = $user["email"];
		$country = $user["country"];
		$rol = $user["rol"];
		try{
			$dbh = getDB();
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':lastname', $lastname);
			$stmt->bindParam(':password', $password);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':country', $country);
			$stmt->bindParam(':rol', $rol);
			$stmt->execute();
		}
		catch(Exception $e){
			echo "error";
		}
	}