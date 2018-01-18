<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>WEB_EDI</title>
    </head>
    <body>
        <h1>WEB_EDI</h1>
        <div class="error">
        <?php
			if (isset($_GET['error'])) // On a eu une erreur
			{
				echo ' Mauvaise authentification, veuillez rééssayer' ;
			}
		?>
		</div>
		<form action="do.authentification.php" method="post">
		<div class="flex">
		 <p>Id : <input type="text" name="id" /></p>
		 <p>Mot de passe : <input type="password" name="password" /></p>
		 <p><input type="submit" value="Valider"></p>
		</div>
		</form>
    </body>
</html>