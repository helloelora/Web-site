<?php session_start(); //$_SESSION 
require_once("C:/MAMP/htdocs/tests/JE/dataconnexion.php");
require_once("C:/MAMP/htdocs/tests/JE/commandes.php");
?>

<!doctype html>
<html lang="fr">
  <head>
    <link rel="stylesheet" href="style.css" />
    <title>Produit</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/album/">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   </head>

   <body>
<?php include('header.php');

if (isset($_GET['id'])){
  $product = $access->prepare("SELECT * FROM produits WHERE id='".$_GET['id']."'");  //récupère les infos d'un produit
	$product->execute();   /*appeler prenom ?*/
	$verif = $product->fetch();
	if ($verif) {
        $_SESSION['IMAGE'] = $verif['image']; 
        $_SESSION['NOM'] = $verif['nom'];
        $_SESSION['PRIX']=$verif['prix'];
        $_SESSION['DESC']=$verif['description'];
        $_SESSION['STOCK']=$verif['stock'];
      }

}
?>
<div class="box" style="width: 800px;">
<div class="titre" style="margin-top: 100px;">
<h2 style="text-align:center;"><?= $_SESSION['NOM'] ?></h2>
</div>
  <div class="bloc-produit">
    <form class="col" method="post">
        <div class="card shadow-sm">
          <img src ="<?= $_SESSION['IMAGE'] ?>"></svg>
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                </div>
                <small class="text-muted"><?= $_SESSION['PRIX'] ?> €</small>       
              </div>
            </div>
    </form>
  </div>
</div>

<div class="text">
  <div class="desc" ><?=  $_SESSION['DESC'] ?></div>   
    <div class="bouton">         
     <a class="button" style="text-decoration: none;" href="recap.php?id=<?= $_GET['id'] ?>">Commander</a>
    </div>
  </div>
</body>
</html>