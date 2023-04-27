<?php session_start(); //$_SESSION 
require_once("C:/MAMP/htdocs/tests/JE/dataconnexion.php");
require_once("C:/MAMP/htdocs/tests/JE/commandes.php");

      include_once('header.php');
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Album example · Bootstrap v5.1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" />

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/album/">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </head>

<body>
<div class="checkout">
  <div class="title">
    <div class="wrap">
    <h2 class="first">Recapitulatif de commande</h2>



<?php 
  if(isset($_GET['id'])){
  $product = $access->prepare("SELECT * FROM produits WHERE id='".$_GET['id']."'");
  $product->execute();   /*appeler prenom ?*/
  $verif = $product->fetch();
  if ($verif) {
        $_SESSION['ID'] = $verif['id'];
        $_SESSION['IMAGE'] = $verif['image']; 
        $_SESSION['NOM'] = $verif['nom'];
        $_SESSION['PRIX']=$verif['prix'];
        $_SESSION['DESC']=$verif['description'];
        $_SESSION['STOCK']=$verif['stock'];
        if ($_SESSION['STOCK']<1): ?>
          <h3 class="message2" style="text-align: center; padding-top: 20px;">
              Cet article est épuisé, vous allez être redirigé sur la page principale
              <?php header('Refresh:10 url=main.php') ?>
          </h3>
        <?php endif;
      }
}
?>
<table class="table">
      <th>  </th> 
       <th>Nom du produit</th>
       <th>Prix</th>
       <th>Quantite</th>


   <tr>
      <td ><img src ="<?= $_SESSION['IMAGE'] ?>" style="height: 150px;"></td>
      <td ><?= $_SESSION['NOM'] ?></td>
      <td ><?= $_SESSION['PRIX'] ?> €</td>
      <td> <div class="mb-3">
        <form method="post">
          <input type="number" style="width: 70px;" class="form-control" value="1" name="quantite" required>
              </div></td>
   </tr>
</table>
<div class="mb-3">
      <form method="post">
        <button type="submit" style="margin-top: 5px;" name ="commander" class="button">Commander</button>
     </form>
</div>
        </form>

</div>
</div>
</body>
<?php

    if(isset($_POST['commander']))
    {
       if(!empty($_POST['quantite']) AND is_numeric($_POST['quantite']))  /*vérifie que la case est bien remplie et que la valeur est un entier*/
          {
            if ($_SESSION['STOCK']<$_POST['quantite']): ?>
          <h3 class="message2" style="text-align:center">
              Vous ne pouvez pas commander une telle quantité de cet article</br>
              Il ne reste en stock que  <?= $_SESSION['STOCK'] ?> articles, vous allez être redirigé sur la page principale
              <?php header('Refresh:10 url=main.php') ?>
          </h3>
          <?php else :
            if($_POST['quantite']<0):                                      
              $quantite=htmlspecialchars(strip_tags($_POST['quantite']));      /*vérifie que l'utilisateur ne rentre pas une valeur négative*/
              $quantite=abs($quantite);
              $total = $_SESSION['PRIX']*$quantite;
              $_SESSION['STOCK']-=$quantite;
              retirerstock($_SESSION['ID'],$_SESSION['STOCK']); 
              $_SESSION['NOM'] = addslashes($_SESSION['NOM']);
              $req = $access->prepare("INSERT INTO commande (produit,quantite) VALUES ('".$_SESSION['NOM']."', $quantite)");
              $req->execute();
              $req->closeCursor(); 
              echo "Nous avons bien pris en compte votre commande, merci et à bientôt !";
              header("Refresh:4; url=main.php");?>
            <h4 style="padding-top: 20px;"> Total : <?= $total ?> €</h4>
            </div>
            <?php else:
              $quantite=htmlspecialchars(strip_tags($_POST['quantite']));
              $total = $_SESSION['PRIX']*$quantite; 
              $_SESSION['STOCK']-=$quantite;
              retirerstock($_SESSION['ID'],$_SESSION['STOCK']); 
              $_SESSION['NOM'] = addslashes($_SESSION['NOM']);
              $req = $access->prepare("INSERT INTO commande (produit,quantite) VALUES ('".$_SESSION['NOM']."', $quantite)");
              $req->execute();
              $req->closeCursor(); 
              echo "Nous avons bien pris en compte votre commande, merci et à bientôt !";
              header("Refresh:4; url=main.php");?>
            <h4 style="padding-top: 20px;"> Total : <?= $total ?> €</h4>
              </div>   
            <?php endif;
          endif;
          }
    }
?>

</html>

