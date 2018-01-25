<?php

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

$Requete_preparee= $connection-> prepare("Select * from UTILISATEURS where LOGIN=? AND MDP=? ");
$Requete_preparee->bindParam(1,$_POST['login']);
$Requete_preparee->bindParam(2,$_POST['password']);
$Requete_preparee->execute();

 //Les identifiants correspondent a un enregistrement de la base
if($enregistrement = $Requete_preparee->fetch(PDO::FETCH_ASSOC))
	{
		header ('Location: saisie.php?nom='.$enregistrement["NOM"].'&prenom='.$enregistrement["PRENOM"].'&id='.$enregistrement["ID"]);
		//print_r($enregistrement);
	}
else{
	header ('Location: index.php?error=true');
}

?>