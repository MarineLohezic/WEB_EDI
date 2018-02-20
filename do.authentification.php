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

$Requete_preparee= $connection-> prepare("Select * from UTILISATEURS where LOGIN=?");
$Requete_preparee->bindParam(1,$_POST['login']);
$Requete_preparee->execute();

if($enregistrement = $Requete_preparee->fetch(PDO::FETCH_ASSOC)){

	if(password_verify($_POST['password'],$enregistrement['MDP']))
		{
			if ($enregistrement["NB_TENTATIVE"] >=3 ){
				header ('Location: index.php?tentative=true');
			}else{
				if($enregistrement["VALIDATION"]==1){
					$date = date("Y-m-d");
					$Requete_preparee= $connection-> prepare("UPDATE UTILISATEURS SET DATE_CONNEXION=?, NB_TENTATIVE=0 WHERE ID=?;");
					$Requete_preparee->execute(array($date,$enregistrement["ID"]));
					//Sauvegarde du login en cookie
					setcookie('login',$enregistrement['LOGIN'],time()+3600*24*31);
					session_cache_expire(30);
					session_start();
					$_SESSION["nom"]=$enregistrement["NOM"];
					$_SESSION["prenom"]=$enregistrement["PRENOM"];
					$_SESSION["ID"]=$enregistrement["ID"];

					header ('Location: saisie.php');
				}else{
					header ('Location: index.php?validation=true');
				}
			}
		}
	else{
			if ($enregistrement["NB_TENTATIVE"] >=3 ){
				header ('Location: index.php?tentative=true');
			}else{
				$Requete_preparee= $connection-> prepare("update UTILISATEURS set NB_TENTATIVE=? where LOGIN=? ");
				$Requete_preparee->execute(array($enregistrement["NB_TENTATIVE"]+1,$enregistrement["LOGIN"]));
				header ('Location: index.php?error=true');
			}
		}
}else{
	header ('Location: index.php?error=true');
}
?>