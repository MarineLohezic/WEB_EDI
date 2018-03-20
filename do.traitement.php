<?php
require('session.php');
$numlot=time();
$date = date('Y-m-d H:i:s', substr($numlot, 0, -3));
$vide=0;
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

// On initialise la transaction
$connection-> beginTransaction();

$nbpre=0;
$nbvir=0;
$totalpre=0;
$totalvir=0;
//On parcours les enregistrements
for ($i = 1; $i <= 5; $i++) {
	if(!empty($_POST['montant'.$i]) && !empty($_POST['Cmp_Or'.$i]) && !empty($_POST['Cmp_Dest'.$i])){
		$execution[$i]=0;
		$Requete_ajout=$connection-> prepare("Insert into OPERATIONS (ID,TYPE,MONTANT,CPT_ORIGINE,CPT_DEST,DEVISE,ID_UTILISATEUR,ID_LOT) VALUES (NULL, ?,?,?,?,?,?,?);");
		$execution[$i]=$Requete_ajout->execute(array($_POST['choix'.$i],intval($_POST['montant'.$i]), $_POST['Cmp_Or'.$i], $_POST['Cmp_Dest'.$i],$_POST['devise'.$i],$_SESSION['ID'],$date));

		if($_POST['choix'.$i]=="Pre"){
			$nbpre++;
			$totalpre+=$_POST['montant'.$i];
		}else{
			$nbvir++;
			$totalvir+=$_POST['montant'.$i];
		}
	}else{
		$vide++;
	}
}
if ($vide == 5){
	$Requete_preparee= $connection-> prepare("Select * from UTILISATEURS where id =?");
	$Requete_preparee->bindParam(1,$_SESSION['ID']);
	$Requete_preparee->execute();
	$enregistrement = $Requete_preparee->fetch(PDO::FETCH_ASSOC);

	header ('Location: saisie.php?nom='.$enregistrement["NOM"].'&prenom='.$enregistrement["PRENOM"].'&id='.$enregistrement["ID"].'&error_vide=true');
}else{
	$testcommit=0;

	foreach ($execution as $exe){
    	if ($exe!=1){
    		$testcommit++;
    	}
	}
	if($testcommit==0){
		$connection-> commit();
		header ('Location: resultat.php?nbvir='.$nbvir.'&totalvir='.$totalvir.'&nbpre='.$nbpre.'&totalpre='.$totalpre);
	}
	else{
		$connection->rollback();
		header ('Location: saisie.php?error_insert=true');
	}
}
?>