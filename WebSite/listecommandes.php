<?php session_start(); //$_SESSION 
      require_once("C:/MAMP/htdocs/tests/JE/commandes.php");
      $listecommandes = listecommandes();

if(!isset($_SESSION['LOGGED_USER'])) {
    header('location:main.php');
}      
if(isset($_SESSION['LOGGED_USER'])) {  //vérifie si l'utilisateur connecté est bien l'admin (au cas ou un utilisateur malveillant change l'adresse dans la barre de recherche)
    if($_SESSION['EMAIL']!="admin@admin") {
        header('location:main.php');
}
}?>
    <?php include_once('headeradmin.php'); ?>
<!DOCTYPE html>                        
<html>
    <head>
        <meta charset="utf-8" />
        <title>Admin listecommandes</title>  
        <link rel="stylesheet" href="style.css" /> 

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>  
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>

    <body>
    <div class="container">
      <div class="bloc-produit">
        <div class="mb-3" style="padding-top: 90px;">

    <?php 
    //récupération de la taille de la table commande
    $res = $access->query('select count(*) as nb from commande');  
    $data = $res->fetch();
    $nb = $data['nb'];       
    $i=0;
    ?>

    <table class="table">
        <caption>10 dernières commandes</caption>
        <th>ID de la commande</th> 
        <th>Nom du produit</th>
        <th>Quantité</th>

            <?php foreach($listecommandes as $commande) : 
                $i++;
                if ($i>$nb-10): ?>
                <tr>
                    <td ><?= $commande->id_co ?></td>
                    <td ><?= $commande->produit ?></td>
                    <td ><?= $commande->quantite ?></td>
                </tr>
                <?php endif; ?>
            <?php endforeach; ?>
    </table>  
        </div>
    </div>

    </body>
</html>
