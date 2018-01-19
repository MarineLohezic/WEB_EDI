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
    	<form action="do.Inscription.php" method="post">
		<div class="colonne">
			<label for="identifiant"> Identifiant : </label>
			<input id="identifiant" type="text" name="login" />
			<label for="mdp1"> Mot de passe : </label>
		 	<input id="mdp1" type="password" name="password1" />
		 	<label for="mdp2"> Confirmation : </label>
		 	<input id="mdp2" type="password" name="password2" />
		 	<label for="nom"> Nom : </label>
			<input id="nom" type="text" name="lastname" />
			<label for="prenom"> Prénom : </label>
			<input id="prenom" type="text" name="firstname" />
			<div class="sub">
				<input type="submit" value="S'inscrire">
			</div>
		</div>
		</form>
    </body>
</html>