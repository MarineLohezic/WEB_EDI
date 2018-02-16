<?php

//On test si les deux motse passe sont identiques
if($_POST['password1']!=$_POST['password2']){
	header ('Location: inscription.php?error_password=true');
}

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

$Requete_preparee= $connection-> prepare("Select * from UTILISATEURS where login =?");
$Requete_preparee->bindParam(1,$_POST['login']);
$Requete_preparee->execute();

 //L'identifiant est déjà dans la base
if($enregistrement = $Requete_preparee->fetch(PDO::FETCH_OBJ))
	{
		header ('Location: inscription.php?error_login=true');
	}
else{
	// On initialise la transaction
	$connection-> beginTransaction();

	$Requete_ajout=$connection-> prepare("Insert into UTILISATEURS (ID,LOGIN,MDP,NOM,PRENOM,NB_TENTATIVE,DATE_CONNEXION) VALUES (NULL, ?,?,?,?,0,'2017-01-01');");
	$Requete_ajout->bindParam(1,$_POST['login']);
	$Requete_ajout->bindParam(2, password_hash($_POST['password1'],PASSWORD_DEFAULT));
	$Requete_ajout->bindParam(3,$_POST['lastname']);
	$Requete_ajout->bindParam(4,$_POST['firstname']);
	$execution= $Requete_ajout->execute();
	if ($execution ==1){
		$connection-> commit();
		header ('Location: inscription.php?success=true');
	}
	else{
		$connection->rollback();
		header ('Location: inscription.php?error_insert=true');
	}
}
?>