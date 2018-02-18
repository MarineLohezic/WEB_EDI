<?php
	require('session.php');
	echo $_SESSION['nom'];
	session_destroy ();
	header ('Location: index.php');
	echo $_SESSION['nom'];
?>