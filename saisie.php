<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>WEB_EDI</title>
    </head>
    <body classe="center">
    	<?php 
    		require('session.php');
    	?>
	   
	    <div class="droite">
			<a style="color:rgba(232, 86, 126, 0.94);" href="do.deconnexion.php">Déconnexion</a>
		</div>
		<h1>Bonjour <?php echo $_SESSION['nom'] . ' ' . $_SESSION['prenom']; ?> </h1>
		
    	<div class="error center">
        <?php        	
        	if(!isset($_SESSION['nom'])){
        		header ('Location: index.php?auth=true');
        	}
    		if (isset($_GET['error_insert'])) // On a eu une erreur
			{
				echo 'Une erreur est survenue lors du traitement des transactions, aucune transaction n\'a été prise en compte ';
			}
			if (isset($_GET['error_vide'])) // On a eu une erreur
			{
				echo 'Veuillez compléter au moins une transaction avant de valider ';
			}
		?>
		</div>

		<div class="center">
			<form action="do.traitement.php" method="post">
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
	</div>
    </body>
</html>