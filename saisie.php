<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>WEB_EDI</title>
    </head>
    <body>
		<h1>Bonjour <?php echo $_GET['nom'] . ' ' . $_GET['prenom']; ?> </h1>

		<form action="do.traitement.php?id=<?php echo $_GET['id']; ?>" method="post">
			<?php 
				for ($i = 1; $i <= 5; $i++) {
					echo('<div style="margin: 5px;";>
						<select name="choix'.$i.'">
						    <option value="Vir">Vir</option>
						    <option value="Pre">Pre</option>
						</select>
						<label for="montant"> Montant : </label>
						<input id="montant" type="number" name="montant'.$i.'" />
						<select name="devise'.$i.'">
						    <option value="Euro">€</option>
						    <option value="Dollar">$</option>
						    <option value="Livre">£</option>
						</select>
						<label for="origine"> Compte d\'origine : </label>
						<input id="origine" type="text" name="Cmp_Or'.$i.'" />
						<label for="destinataire"> Compte destinataire : </label>
						<input id="destinataire" type="text" name="Cmp_Dest'.$i.'" />
						</div>'
					);
				}
			?>
			<div align="right"><input type="submit" value="Valider"></div>
		</form>
	</div>
    </body>
</html>