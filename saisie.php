<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>WEB_EDI</title>
    </head>
    <body>

		<p>Bonjour <?php echo $_GET['nom'] . ' ' . $_GET['prenom']; ?> </p>

		<div>

		<form action="do.traitement.php?id=<?php echo $_GET['id']; ?>" method="post">
		<select name="choix">
		    <option value="Vir">Vir</option>
		    <option value="Pre">Pre</option>
		</select>
		<p>Montant : <input type="text" name="montant" /></p>
		<select name="devise">
		    <option value="Euro">€</option>
		    <option value="Dollar">$</option>
		    <option value="Livre">£</option>
		</select>
		<p>Compte Origine: <input type="text" name="Cmp_Or" /></p>
		<p>Compte Destinataire : <input type="text" name="Cmp_Dest" /></p>
		<p><input type="submit" value="Valider"></p>
		</form>
	</div>
    </body>
</html>