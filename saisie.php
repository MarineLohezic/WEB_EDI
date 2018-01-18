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
					echo('<div class="flex">
						<select name="choix'.$i.'">
						    <option value="Vir">Vir</option>
						    <option value="Pre">Pre</option>
						</select>
						<p>Montant : <input type="number" name="montant'.$i.'" /></p>
						<select name="devise'.$i.'">
						    <option value="Euro">€</option>
						    <option value="Dollar">$</option>
						    <option value="Livre">£</option>
						</select>
						<p>Compte Origine: <input type="text" name="Cmp_Or'.$i.'" /></p>
						<p>Compte Destinataire : <input type="text" name="Cmp_Dest'.$i.'" /></p>
						</div>'
					);
				}
			?>
			<div align="right"><input type="submit" value="Valider"></div>
		</form>
	</div>
    </body>
</html>