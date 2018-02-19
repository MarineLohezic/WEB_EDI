<?php
	$subject = 'Confirmation Inscritption';
 
	// Headers
	$headers = 'Mime-Version: 1.0'."\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
	$headers .= "\r\n";
	 
	// Message
	$msg = '
		<h1> Bienvenue sur WEB-EDI </h1> 
		<div> Afin de valider votre inscription veuillez à présent suivre le lien suivant : </div> 
		<a style="color:rgba(232, 86, 126, 0.94);" href="http://localhost/WEB_EDI/do.validation.php?login='.$_GET["login"].'">
		Valider mon mail</a>
	';

	// Function mail()
	mail("lohezic.marine@gmail.com", $subject, $msg, $headers);
	//mail($_GET["login"], $subject, $msg, $headers);
	header ('Location: inscription.php?success=true');
?>