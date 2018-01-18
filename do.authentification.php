<?php
// On ouvre le fichier
$monfichier = fopen('utilisateurs.txt', 'r+');

// On lit la première ligne du fichier
$ligne = fgets($monfichier);

list($id, $login, $motdepasse, $nom, $prenom) = explode(";", $ligne);

if($_POST['id']==$id & $_POST['password']==$motdepasse){
	echo "Coucou";
	header ('Location: saisie.php?nom='.$nom.'&prenom='.$prenom.'&id='.$id);
}else{
	header ('Location: index.php?error=true');
}

// On ferme le fichier
fclose($monfichier);
?>