<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>WEB_EDI</title>
    </head>
    <body>
        <h1>WEB_EDI</h1>
        <?php
			if (isset($_GET['error'])) // On a eu une erreur
			{
				echo ' Mauvaise authentification, veuillez rééssayer' ;
			}
		?>
		<form action="do.authentification.php" method="post">
		 <p>Id : <input type="text" name="id" /></p>
		 <p>Mot de passe : <input type="password" name="password" /></p>
		 <p><input type="submit" value="Valider"></p>
		</form>
    </body>
</html>