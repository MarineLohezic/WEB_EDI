<?php
$virement = fopen('VIR.txt', 'a');
$prelevement = fopen('PRE.txt', 'a');
$numlot=time();

for ($i = 1; $i <= 5; $i++) {
	if(!empty($_POST['montant'.$i])){
		$data= array($numlot,$_GET['id'],$_POST['montant'.$i], $_POST['devise'.$i], $_POST['Cmp_Or'.$i] , $_POST['Cmp_Dest'.$i]);
		$nouvelleLigne= implode(";", $data);
		if ($_POST['choix'.$i]=="Vir") {
			fwrite($virement, $nouvelleLigne."\r\n");
		}else{
			fwrite($prelevement, $nouvelleLigne."\r\n");
		}
	}
}

fclose($virement);
fclose($prelevement);

$virement = fopen('VIR.txt', 'r');
$prelevement = fopen('PRE.txt', 'r');
	//Calcul des resultats
$totalvir=0;
$nbvir=0;
	$vir = fgets($virement);
	/*Tant que l'on est pas à la fin du fichier (la ligne existe) */
	while (!feof($virement))
	{
		/*On affiche la ligne courante */
		list($newnumlot, $id, $montant, $devise, $comp_or, $comp_dest) = explode(";", $vir);
		if ($newnumlot==$numlot){
			$totalvir=$totalvir+ $montant;
			$nbvir=$nbvir+1;
		}
		$vir = fgets($virement);
	}

$totalpre=0;
$nbpre=0;
	$pre = fgets($prelevement);
	/*Tant que l'on est pas à la fin du fichier (la ligne existe) */
	while (!feof($prelevement))
	{
		/*On affiche la ligne courante */
		list($newnumlot, $id, $montant, $devise, $comp_or, $comp_dest) = explode(";", $pre);
		if ($newnumlot==$numlot){
			$totalpre=$totalpre+ $montant;
			$nbpre=$nbpre+1;
		}
		$pre = fgets($prelevement);
	}
// On ferme les fichiers
fclose($virement);
fclose($prelevement);
header ('Location: resultat.php?nbvir='.$nbvir.'&totalvir='.$totalvir.'&nbpre='.$nbpre.'&totalpre='.$totalpre);
?>