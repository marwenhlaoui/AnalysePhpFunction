<?php
// connexion à la base de donnée 
    define('DATABASE_USERNAME','root');
    define('DATABASE_PASSEWORD','');
    define('DATABASE_ADRESSE','localhost');
    define('DATABASE_BD','base');
    $connection = new PDO('mysql:dbname=' . DATABASE_BD . ';host=' . DATABASE_ADRESSE, DATABASE_USERNAME, DATABASE_PASSEWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); 
// ouverture du session 
	session_start();
	require_once 'function.php'; 
