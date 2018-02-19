<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="./style.css" />
        <title>WEB_EDI</title>
    </head>
    <body>
    	<header> <h1>WEB_EDI</h1> </header>
        <div class="error">
        <?php
        	if (isset($_GET['valide'])) // On a eu une erreur
			{
				echo 'Votre compte a déjà été activé, veuillez a présent vous connecter' ;
			}
       		if (isset($_GET['validation'])) // On a eu une erreur
			{
				echo 'Veuillez valider votre inscription avant de vous connecter' ;
			}

        	if (isset($_GET['auth'])) // On a eu une erreur
			{
				echo 'Veuillez vous connecter pour continuer' ;
			}
			if (isset($_GET['error'])) // On a eu une erreur
			{
				echo ' Mauvaise authentification, veuillez rééssayer' ;
			}
			if (isset($_GET['tentative'])) // On a eu une erreur
			{
				echo 'Trop de tentatives, votre compte est bloqué' ;
			}
		?>
		</div> 
		<form action="inscription.php" method="post">
			<input class="bold" type="submit" value="Inscription"/>
		</form>
		<h4> Se connecter : </h4>
		<form action="do.authentification.php" method="post">
			<div class="colonne">
				<label for="identifiant"> Identifiant : </label>

				<input id="identifiant" type="text" name="login" required value= <?php if(isset($_COOKIE["login"])){ 
						echo $_COOKIE["login"];}else{echo "";} ?>>
				<label for="mdp"> Mot de passe : </label>
				<input id="mdp" type="password" name="password" required />
				<div class="sub">
			 		<input type="submit" value="Valider">
			 	</div>
			</div>
		</form>
    </body>
</html>