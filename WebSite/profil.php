<?php session_start();
require_once('header.php');
require_once("C:/MAMP/htdocs/tests/JE/dataconnexion.php");
?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Profil</title>  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" />

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/album/">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    

  </head>
<div class="container-xl px-4 mt-4">
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Image de profil</div>
                <div class="card-body text-center">
                    <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">Informations du compte</div>
                <div class="card-body">
                    <form method="POST" action=''>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Email</label>
                            <input class="form-control" type="email" placeholder="Enter your username" name="email" value="<?= $_SESSION['EMAIL'] ?>">
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Prénom</label>
                                <input class="form-control" type="text" placeholder="Enter your first name" name="prenom" value="<?= $_SESSION['LOGGED_USER'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Nom</label>
                                <input class="form-control" type="text" placeholder="Enter your last name" name="nom" value="<?= $_SESSION['NOM'] ?>">
                            </div>
                        </div>
                    
                        <input class="button" name="confirmer_changements" type="submit" value="Confirmer les changements">
                        <input class="button" name="change_mdp" type="submit" value="Changer le mot de passe">
                    </form>
                </div>
            </div>
            <?php if(isset($_POST['change_mdp'])): ?>
            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header">Changement du mot de passe</div>
                    <div class="card-body">
                        <form method="POST" action=''>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Votre nouveau mot de passe :</label>
                                <input class="form-control" type="password" placeholder="mot de passe" name="mdp" required>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" class="inputUsername">Confirmation du mot de passe :</label>
                                <input type="password" class="form-control" name="mdp2" placeholder="mot de passe" required>
                            </div>
                            <input class="button" type='submit' name='confirmer_changement_mdp' value='Confirmer le changement'>
                        </form>
                    </div>
                    </div>
                </div>
          <?php endif; ?>
        </div>
    </div>
</div>

</html>

<?php 
if(!isset($_SESSION['LOGGED_USER'])){
  header('location:main.php');    //Si l'utilisateur n'est pas connecté : il est redirigé vers la page d'accueil
}

if(isset($_POST['confirmer_changements']) AND !empty($_POST['email']) AND !empty($_POST['prenom']) AND !empty($_POST['nom']))
{
    $_SESSION['EMAIL'] = $_POST['email'];
    $_SESSION['LOGGED_USER'] = $_POST['prenom'];
    $_SESSION['NOM'] = $_POST['nom'];
    $req = $access->prepare("UPDATE users SET email = :email WHERE id_users= '".$_SESSION['ID']."'");
    $req->bindParam(':email', $_SESSION['EMAIL']);
    $req->execute();
    $reqz = $access->prepare("UPDATE users SET prenom = :prenom WHERE id_users= '".$_SESSION['ID']."'");
    $reqz->bindParam(':prenom', $_SESSION['LOGGED_USER']);
    $reqz->execute();
    $req = $access->prepare("UPDATE users SET nom = :nom WHERE id_users= '".$_SESSION['ID']."'");
    $req->bindParam(':nom', $_SESSION['NOM']);
    $req->execute();
    $reqzz = $access->prepare("UPDATE users SET mdp = :mdp WHERE id_users= '".$_SESSION['ID']."'");
    $reqzz->bindParam(':mdp', $_SESSION['MDP']);
    $reqzz->execute();
    header('location:profil.php');
    exit;
}

if(isset($_POST['confirmer_changement_mdp'])) 
{
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);
    if ($mdp==$mdp2):
        $_SESSION['MDP']=sha1($_POST['mdp']);
        $reqzz = $access->prepare("UPDATE users SET mdp = :mdp WHERE id_users= '".$_SESSION['ID']."'");
        $reqzz->bindParam(':mdp', $_SESSION['MDP']);
        $reqzz->execute();
        header('location:profil.php'); 
        exit; 
    else: ?>
        <div class="message" style="text-align: center;">
            Attention vous n'avez pas rentré les mêmes mot de passe, le mot de passe n'a pas été changé
        </div>
        <?php endif; 
}
?>