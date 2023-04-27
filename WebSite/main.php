<?php session_start(); //$_SESSION 
require_once("C:/MAMP/htdocs/tests/JE/dataconnexion.php");
require_once("C:/MAMP/htdocs/tests/JE/commandes.php");
$myProducts=afficherpremier();
?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">     <!--insertion du logo sur la barre de navigation-->
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" />

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/album/">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Bootstrap core CSS -->
    <link href="/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      a
      {
        text-decoration: none;
      }

      .filtre
      {
        display: flex;
        justify-content: space-around;
        position: relative;
        margin: auto;
      }
    </style>
  </head>
  <body>
    
<header>
  <!-- inclusion de l'entête du site en fonction du compte ouvert (admin ou utilisateur)-->
    <?php 
    if(isset($_SESSION['LOGGED_USER'])) {
      if($_SESSION['EMAIL']=="admin@admin") {
      include_once('headeradmin.php');
      } else {
        include_once('header.php');
      }
    } else {
      include_once('header.php'); 
    }
      ?>
</header>


<main>
  <!-- Si l'utilisateur est connecté, il peut commander et afficher la description des articles -->
  <?php if(isset($_SESSION['LOGGED_USER'])): ?>
    <section class="banniere" style="background-image:url(images/banniere3.png);">
  <div class="row py-sm-5">
    <div class="col-lg-4 col-md-8 mx-auto">
      <h1 class="fw-light" style="font-size: 4.5em; text-align: center; color:white; font-family:Calisto MT, Bookman Old Style, Bookman, Goudy Old Style, Garamond, Hoefler Text, Bitstream Charter,  serif;">SHOES'EA</h1>
      <p class="lead text-muted" style="text-align: center; color:white;">Shop your Shoes</br>La mode, le choix, le prix ! </p>
    </div>
  </div>
  </section>

  <div class="album py-5 bg-light">
  <!--permet à l'utilisateur de filtrer les articles -->
    <div class="filtre">
      <form class="row row-cols-lg-auto g-3 align-items-center" method="post" >

  <div class="col-12">
    <label class="visually-hidden" for="inlineFormSelectPref">Type</label>
    <select class="form-select" id="inlineFormSelectPref" name="type">
      <option selected value="0" >Type de chaussures...</option>
      <option value="lifestyle">lifestyle</option>
      <option value="talons">talons</option>
      <option value="chaussures plates">chaussures plates</option>
      <option value="sport">sport</option>
    </select>
  </div>

  <div class="col-12">
    <label class="visually-hidden" for="inlineFormSelectPref">Couleur</label>
    <select class="form-select" id="inlineFormSelectPref" name="color">
      <option selected value="0">Couleur...</option>
      <option value="blanc">blanc</option>
      <option value="noir">noir</option>
      <option value="marron">marron</option>
      <option value="rose">rose</option>
      <option value="rouge">rouge</option>
      <option value="vert">vert</option>
      <option value="bleu">bleu</option>
      <option value="gris">gris</option>
      <option value="jaune">jaune</option>
      <option value="violet">violet</option>    
      <option value="orange">orange</option>    
    </select>
  </div>

  <div class="col-12">
    <button type="submit" class="button" name="filtres">Rechercher</button>
  </div>
      </form>
    </div>
  </div>
</main>
  <div class="album py-5 bg-light">
<?php if(isset($_POST['filtres'])){
    require_once("C:/MAMP/htdocs/tests/JE/commandes.php");
    $myProducts=afficher();  //appelle la fonction dans le fichier "commandes.php" permettant d'afficher les produits en fonction des filtres selectionné
} ?>

     <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        <?php foreach ($myProducts as $produit): ?>  <!--affiche les produits en mettant le plus récent tout en haut-->

            <div class="card shadow-sm">
              <title><?= $produit->nom  ?></title><img src ="<?= $produit->image ?>" ></svg>
              <div class="card-body">
              <p class="card-text"><?= $produit->nom  ?></p>                     <!-- affiche la description du produit-->
                <form method="post">
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a class="click" href="recap.php?id=<?= $produit->id ?>">Commander</a>
                      <a class="click" name ="?= $produit->description  ?>" href="page_produit.php?id=<?= $produit->id ?>"> Plus d'infos </a>
                    </div>
                <small class="text-muted"><?= $produit->prix ?> €</small>        <!-- affiche le prix du produit-->
                </form>
              </div>
            </div>
            </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

<!--Si l'utilisateur n'est pas connecté il ne peut pas commander les produits ni afficher leur description-->
<?php else: ?> 
  <section class="banniere" style="background-image:url(images/banniere3.png);">
  <div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
      <h1 class="fw-light" style="font-size: 4.5em; text-align: center; color:white; font-family:Calisto MT, Bookman Old Style, Bookman, Goudy Old Style, Garamond, Hoefler Text, Bitstream Charter,  serif;">SHOES'EA</h1>
      <p class="lead text-muted" style="text-align: center; color:white;">Shop your Shoes</br>La mode, le choix, le prix !</p>
    </div>
  </div>
  </section>

  <div class="album py-5 bg-light">
  <!--permet à l'utilisateur de filtrer les articles -->
    <div class="filtre">
      <form class="row row-cols-lg-auto g-3 align-items-center" method="post" >

  <div class="col-12">
    <label class="visually-hidden" for="inlineFormSelectPref">Type</label>
    <select class="form-select" id="inlineFormSelectPref" name="type">
      <option selected value="0" >Choose...</option>
      <option value="lifestyle">lifestyle</option>
      <option value="talons">talons</option>
      <option value="chaussures plates">chaussures plates</option>
      <option value="sport">sport</option>
    </select>
  </div>

  <div class="col-12">
    <label class="visually-hidden" for="inlineFormSelectPref">Couleur</label>
    <select class="form-select" id="inlineFormSelectPref" name="color">
      <option selected value="0">Choose...</option>
      <option value="blanc">blanc</option>
      <option value="noir">noir</option>
      <option value="marron">marron</option>
      <option value="rose">rose</option>
      <option value="rouge">rouge</option>
      <option value="vert">vert</option>
      <option value="bleu">bleu</option>
      <option value="gris">gris</option>
      <option value="jaune">jaune</option>
      <option value="violet">violet</option>    
      <option value="orange">orange</option>    
    </select>
  </div>

  <div class="col-12">
    <button type="submit" class="button" name="filtres">Rechercher</button>
  </div>
      </form>
    </div>
  </div>

  <div class="album py-5 bg-light">
<?php if(isset($_POST['filtres'])){
    require_once("C:/MAMP/htdocs/tests/JE/commandes.php");
    $myProducts=afficher();  //appelle la fonction dans le fichier "commandes.php" permettant d'afficher les produits en fonction des filtres selectionné
} ?>

     <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        <?php foreach ($myProducts as $produit): ?>   <!--affiche les produits en mettant le plsu récent tout en haut-->
          <div class="card shadow-sm">
            <title><?= $produit->nom  ?></title><img src ="<?= $produit->image ?>"></svg>
            <div class="card-body">
              <p class="card-text"><?= $produit->nom  ?></p>                    
              <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted"><?= $produit->prix ?> €</small>       
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
<?php endif; ?>

      </main>
  </body>
  
  <footer>
<?php include_once('footer.php'); ?>
  </footer>

</html>
