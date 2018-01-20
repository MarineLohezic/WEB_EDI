<?php
// On test la connexion à la base de données
try
{
	$host = 'mysql:host=localhost;dbname=WEB_EDI';
	$utilisateur = 'root';
	$motDePasse = NULL;
	$options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
	);
	$connection = new PDO($host, $utilisateur, $motDePasse, $options);
}catch( Exception $e )
{
	echo "Connection à MySQL impossible : ", $e->getMessage();
	die();
}

?>