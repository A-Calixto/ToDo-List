<?php

	$servername = "localhost";
	$database = "calixto";
	$username = "root";
	$password = "";

	try{
		$pdo = new PDO('mysql:host='.$servername.';dbname='.$database,$username,$password);
	} catch(PDOException $exception) {
		exit($exception->getMessage());
	}

?>