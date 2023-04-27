<!-- header.php -->
<!doctype html>
<html lang="fr">
    <head>
        <link rel="shortcut icon" href="images/logo.png" type="image/x-icon"> <!--insertion du logo sur la barre de navigation-->
    </head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="main.php"><img src="images/logo.png" alt="Logo JE" class="flottant" style="width:200px"/></a>
  <button 
   class="navbar-toggler" 
   type="button" 
   data-toggle="collapse" 
   data-target="#navbarNavDropdown" 
   aria-controls="navbarNavDropdown" 
   aria-expanded="false" 
   aria-label="Toggle navigation"> 
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="modifusers.php">Liste des utilisateurs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="listecommandes.php">Commandes récentes</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-expanded="false" role="button">
          Produit
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="index.php">Ajout de produit</a>
          <a class="dropdown-item" href="supprimer.php">Suppression de produit</a>
          <a class="dropdown-item" href="stock.php">Gestion des stocks</a>
        </ul>
      </li>
    </ul>
  </div>

<?php 

require_once("C:/MAMP/htdocs/tests/JE/dataconnexion.php");

    if(isset($_POST['envoye']))
    {
           if(!empty($_POST['email']) AND !empty($_POST['mdp']))
            {
                $email=htmlspecialchars($_POST['email']);
                $mdp=sha1($_POST['mdp']);
                try
                {
                    $recupuser = $access->prepare("SELECT * FROM users WHERE email=? AND mdp=?");
                    $recupuser->execute(array($email, $mdp));   /*appeler prenom ?*/
                    $verif = $recupuser->fetch();
                    if ($verif) {
                            $_SESSION['LOGGED_USER'] = $verif['prenom']; 
                            $_SESSION['EMAIL'] = $verif['email'];
                            $_SESSION['MDP']=$verif['mdp'];
                            $_SESSION['ID']=$verif['id_users'];

                          }
                  } catch(Exception $e) {
                    $e->getMessage();
                }
            }
        }
        
?>
  <?php if(!isset($_SESSION['LOGGED_USER'])): ?>                               <!--vérifie qu'une session n'est pas déjà ouverte-->
      <form class="connexion" action="main.php" method="post">
    <!-- si message d'erreur on l'affiche -->
    <?php if(isset($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>

        <div class="mb-3" id="email" style ="align-items: flex-end;">
        <input type="email" class="form-control" name="email" aria-describedby="email-help" placeholder="Email" text style="width:200px;height:25px; align-items:center"> <!--regarder si le align-items marche l.46 et l.47-->
        
    </div>
    <div style="display:flex; justify-content:space-between;">
    <div class="mb-3">
        <input type="password" class="form-control" name="mdp" placeholder="Mot de Passe" text style="width:130px;height:25px">
    </div>
    <div class="button_login">
    <button type="submit" name="envoye" class="button-login">Envoyer</button>
  </div>
  </div>
</form>

<?php else: ?>                                                              <!--sinon affiche bonjour et le bouton de deconnexion-->
  <div class="menu actif" style="display:flex; justify-content:space-between; width: 500px;">
    <div class="sucess" role="alert">
        Bonjour <?php echo $_SESSION['LOGGED_USER'];?> et bienvenue sur le site !
    </div>
    <form action="deconnexion.php" method="post" style="padding-right: 25px;">
        <button type="submit" class="button-deconnexion">Deconnexion</button>
    </form>
  </div>
<?php endif; ?>

</nav>
</html>