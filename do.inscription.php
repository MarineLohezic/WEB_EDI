<?php

//On test si les deux motse passe sont identiques
if($_POST['password1']!=$_POST['password2']){
	header ('Location: inscription.php?error_password=true');
}else{

	// On test la connexion à la base de données
	try
	{
		/*$host = 'mysql:host=localhost;dbname=WEB_EDI';
		$utilisateur = 'root';
		$motDePasse = NULL;
*/
		$options = array(
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
		);
		$connection = new PDO(
    	"mysql:host=" . getenv("MYSQL_ADDON_HOST") . ";dbname=" . getenv("MYSQL_ADDON_DB"),
    	getenv("MYSQL_ADDON_USER"),
    	getenv("MYSQL_ADDON_PASSWORD"),$options);

	}catch( Exception $e )
	{
		echo "Connection à MySQL impossible : ", $e->getMessage();
		die();
	}

	$Requete_preparee= $connection-> prepare("Select * from utilisateurs where login =?");
	$Requete_preparee->bindParam(1,$_POST['login']);
	$Requete_preparee->execute();

	 //L'identifiant est déjà dans la base
	if($enregistrement = $Requete_preparee->fetch(PDO::FETCH_OBJ))
		{
			header ('Location: inscription.php?error_login=true');
		}
	else{
		$hash= password_hash($_POST['password1'],PASSWORD_DEFAULT);
		// On initialise la transaction
		$connection-> beginTransaction();

		echo( "

			Transaction

			");


		$Requete_ajout=$connection-> prepare("Insert into utilisateurs (ID,LOGIN,MDP,NOM,PRENOM,NB_TENTATIVE,DATE_CONNEXION,VALIDATION) VALUES (NULL, ?,?,?,?,0,'2017-01-01',0);");
		$Requete_ajout->bindParam(1,$_POST['login']);
		$Requete_ajout->bindParam(2,$hash);
		$Requete_ajout->bindParam(3,$_POST['lastname']);
		$Requete_ajout->bindParam(4,$_POST['firstname']);
		$execution= $Requete_ajout->execute();
		echo $execution;
		if ($execution ==1){
			$connection-> commit();
			header('Location: resultat.souscript.php?login='.$_POST['login']);
		}
		else{
			$connection->rollback();
			header ('Location: inscription.php?error_insert=true');
		}
	}
}
?>