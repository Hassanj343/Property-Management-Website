<?php

$DB_NAME = "whp_main";
$DB_USER = 'root';
$DB_PASSWORD = 'some_pass';
$DB_HOST ='localhost';

try {
	$pdo = new PDO('mysql:host=' . $DB_HOST .';dbname=' . $DB_NAME ,$DB_USER,$DB_PASSWORD);
} catch(PDOException $e)
{
	exit("Database Error!");
}

