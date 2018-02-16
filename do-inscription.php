<?php

//require 'vendor/autoload.php';
use \Mailjet\Resources;

//On test si les deux motse passe sont identiques
if($_POST['password1']!=$_POST['password2']){
	header ('Location: inscription.php?error_password=true');
}

// On test la connexion à la base de données
try
{
	/*$host = 'mysql:host=localhost;dbname=WEB_EDI';
	$utilisateur = 'root';
	$motDePasse = NULL;*/

	$host= 'mysql:host=buds9nnrx-mysql.services.clever-cloud.com;port=3306;dbname=buds9nnrx;';
	$utilisateur= 'ukgxbhg7pl152ibd';
	$motDePasse='3QgbjRSXojTMz3l7JMF';
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

		//MAIL
		/*$apikey = 'f22758a3ac56b3ea3e33ddc95bd35174';
		$apisecret = '76109d1a1bf6b5846b99f5f5d6482930';

		$mj = new \Mailjet\Client($apikey, $apisecret);

		$body = [
		    'Messages' => [
		        [
		            'From' => [
		                'Email' => "pilot@mailjet.com",
		                'Name' => "Mailjet Pilot"
		            ],
		            'To' => [
		                [
		                    'Email' => "lohezic.marine@gmail.com",
		                    'Name' => "passenger 1"
		                ]
		            ],
		            'Subject' => "Your email flight plan!",
		            'TextPart' => "Dear passenger 1, welcome to Mailjet! May the delivery force be with you!",
		            'HTMLPart' => "<h3>Dear passenger 1, welcome to Mailjet!</h3><br />May the delivery force be with you!"
		        ]
		    ]
		];
		$response = $mj->post(Resources:*/:$Email, ['body' => $body]);
	}
	else{
		$connection->rollback();
		header ('Location: inscription.php?error_insert=true');
	}
}
?>