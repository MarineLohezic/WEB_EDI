<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
         <link rel="stylesheet" href="style.css" />
        <title>WEB_EDI</title>
    </head>
    <body>
        <?php
            require('session.php');
            if(!isset($_SESSION['nom'])){
                header ('Location: index.php?auth=true');
            }
        ?>
        <div class="droite">
            <a style="color:rgba(232, 86, 126, 0.94);" href="do.deconnexion.php">Déconnexion</a>
        </div>
        <h1>Bilan:</h1>
        <p> Nombre de virement :  <?php echo $_GET['nbvir'] ?> pour un total de : <?php echo $_GET['totalvir'] ?> €</p>
        <p> Nombre de prelevement :  <?php echo $_GET['nbpre'] ?> pour un total de : <?php echo $_GET['totalpre'] ?> €</p>

        <div class="droite">
            <form action="saisie.php" method="post">
                <input class="bold" type="submit" value="Retour"/>
            </form>
        </div>
    </body>
</html>