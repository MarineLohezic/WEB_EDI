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
		if ($enregistrement["NB_TENTATIVE"] >=3 ){
			header ('Location: index.php?tentative=true');
		}else{
			$date = date("Y-m-d");
			$Requete_preparee= $connection-> prepare("UPDATE UTILISATEURS SET DATE_CONNEXION=?, NB_TENTATIVE=0 WHERE ID=?;");
			$Requete_preparee->execute(array($date,$enregistrement["ID"]));

			header ('Location: saisie.php?nom='.$enregistrement["NOM"].'&prenom='.$enregistrement["PRENOM"].'&id='.$enregistrement["ID"]);
		}
	}
else{
	$Requete_preparee= $connection-> prepare("Select * from UTILISATEURS where LOGIN=?");
	$Requete_preparee->bindParam(1,$_POST['login']);
	$Requete_preparee->execute();
	if($loginTrue = $Requete_preparee->fetch(PDO::FETCH_ASSOC))
		{
			if ($loginTrue["NB_TENTATIVE"] >=3 ){
				header ('Location: index.php?tentative=true');
			}else{
				$Requete_preparee= $connection-> prepare("update UTILISATEURS set NB_TENTATIVE=? where LOGIN=? ");
				$Requete_preparee->execute(array($loginTrue["NB_TENTATIVE"]+1,$loginTrue["LOGIN"]));
			}
		}
	header ('Location: index.php?error=true');
}
?>