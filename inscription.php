<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>WEB_EDI</title>
    </head>
    <body>
    	<header> <h1>WEB_EDI</h1> </header>
    	<form action="index.php" method="post">
			<input class="bold" type="submit" value="Se connecter">
		</form>
    	<h4>Inscription :</h4>
    	<div class="error">
        <?php
			if (isset($_GET['error_password'])) 
			{
				echo 'Attention les deux mots de passe ne correspondent pas !' ;
			}
			if (isset($_GET['error_login'])) 
			{
				echo 'Attention ce login a déjà été choisit par un autre utilisateur, veuillez en choisir un autre.' ;
			}
			if (isset($_GET['success'])) 
			{
				echo 'Votre inscription a été prise en compte, veuillez à présent vous connecter' ;
			}
			if (isset($_GET['error_insert'])) 
			{
				echo 'Une erreur a eu lieu lors de votre inscription' ;
			}
		?>
		</div> 
    	<form action="do.inscription.php" method="post">
		<div class="colonne">
			<label for="identifiant"> Identifiant : </label>
			<input id="identifiant" type="email" name="login" required/>
			<label for="mdp1"> Mot de passe : </label>
		 	<input id="mdp1" type="password" name="password1" required/>
		 	<label for="mdp2"> Confirmation : </label>
		 	<input id="mdp2" type="password" name="password2" required/>
		 	<label for="nom"> Nom : </label>
			<input id="nom" type="text" name="lastname" required />
			<label for="prenom"> Prénom : </label>
			<input id="prenom" type="text" name="firstname" required/>
			<div class="sub">
				<input type="submit" value="S'inscrire">
			</div>
		</div>
		</form>
    </body>
</html>