<?php

if ($_POST['choix']=="Vir") // On a eu une erreur
{	
	$monfichier = fopen('VIR.txt', 'a');
}else{
	$monfichier = fopen('PRE.txt', 'a');
}

// On lit la première ligne du fichier
$ligne = fgets($monfichier);

if (!empty($ligne)){
	//SI la liste n'est pas vide on recupere notament le numero de lot
	list($numlot, $id, $montant, $devise, $compteor, $comptDest) = explode(";", $ligne);
}
else{
	$numlot=0;
}

$numlot=$numlot+1;


//Def tableau +id + numLot
$data= array($numlot,$_GET['id'],$_POST['montant'], $_POST['devise'], $_POST['Cmp_Or'] , $_POST['Cmp_Dest']);

//fputs($monfichier, implode(";", $data)); 
//file_put_contents($monfichier, implode(";", $data), FILE_APPEND);
$nouvelleLigne= implode(";", $data);

fwrite($monfichier, "\r\n".$nouvelleLigne);


header ('Location: resultat.php');

// On ferme le fichier
fclose($monfichier);
?>