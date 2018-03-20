<?php
try
{
	/*$host = 'mysql:host=localhost;dbname=WEB_EDI';
	$utilisateur = 'root';
	$motDePasse = NULL;*/
	$options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
	);
	$connection = new PDO(
    	"mysql:host=" . getenv("MYSQL_ADDON_HOST") . ";dbname=" . getenv("MYSQL_ADDON_DB"),
    	getenv("MYSQL_ADDON_USER"),
    	getenv("MYSQL_ADDON_PASSWORD"),$options
  	);
}catch( Exception $e )
{
	echo "Connection à MySQL impossible : ", $e->getMessage();
	die();
}

$Requete_preparee= $connection-> prepare("Select * from UTILISATEURS where LOGIN=?");
$Requete_preparee->bindParam(1,$_GET['login']);
$Requete_preparee->execute();

if($enregistrement = $Requete_preparee->fetch(PDO::FETCH_ASSOC)){
	if($enregistrement["VALIDATION"]==0){
		$Requete_preparee= $connection-> prepare("UPDATE UTILISATEURS SET VALIDATION=1 WHERE ID=?;");
		$Requete_preparee->bindParam(1,$enregistrement["ID"]);
		$Requete_preparee->execute();

		setcookie('login',$enregistrement['LOGIN'],time()+3600*24*31);
		session_cache_expire(30);
		session_start();
		$_SESSION["nom"]=$enregistrement["NOM"];
		$_SESSION["prenom"]=$enregistrement["PRENOM"];
		$_SESSION["ID"]=$enregistrement["ID"];

		header ('Location: saisie.php');
	}else{
		header ('Location: index.php?valide=true');
	}

}else{
	header ('Location: inscription.php');
}
?>