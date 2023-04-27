<?php session_start(); //$_SESSION 
/*inclusion de l'entête du site*/
 include_once('header.php'); 

require_once("C:/MAMP/htdocs/tests/JE/dataconnexion.php");
 
 if (!isset($_SESSION['LOGGED_USER'])){
    header('Location: index.php');
    exit;
 }
 
// On récupère les informations de l'utilisateur connecté
$afficher_profil = $access->query("SELECT * FROM users WHERE id = ?", array($_SESSION['LOGGED_USER']));
$afficher_profil = $afficher_profil->fetch();

if(!empty($_POST)){
    extract($_POST);
    $valid = true;
 
    if (isset($_POST['modification'])){
        $email = htmlentities(trim($email));
        $mdp = htmlentities(trim($mdp));
        $prenom = htmlentities(strtolower(trim($prenom)));
     
        if(empty($email)){
            $valid = false;
            $er_mail = "Il faut mettre un email";
         }
 
        if(empty($mdp)){
         $valid = false;
         $er_mdp = "Il faut mettre un mot de passe";
         }
 
        if(empty($prenom)){
         $valid = false;
         $er_prenom = "Il faut mettre un prenom";
         
         }elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $email)){
        $valid = false;
        $er_mail = "Le mail n'est pas valide";
 
        }else{
            $stmt = $access->prepare("SELECT * FROM users WHERE email=?");   /*test si l'utilisateur n'est pas déjà inscrit*/
                    $stmt->execute([$email]); 
                    $verif = $stmt->fetch();
                    if ($verif) {
                        echo ("Cet email est déjà associé à un compte");
            }
             }
             
        if ($valid){
 
             $access->insert("UPDATE utilisateur SET email = ?, mdp = ?, prenom = ? WHERE id = ?", array($email, $mdp ,$prenom, $_SESSION['LOGGED_USER']));
             
             $_SESSION['email'] = $email;
             $_SESSION['mdp'] = $mdp;
             $_SESSION['prenom'] = $prenom;
 
            header('Location:profil.php');
            exit;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Modifier votre profil</title>
     </head>
        <body>
            <div>Modification</div>
            <form method="post">
                <?php
                if (isset($er_mail)){
                ?>
                    <div><?= $er_mail ?></div>
                <?php
                }
                ?>
                <input type="email" placeholder="Votre email" name="mail" value="<?php if(isset($email)){ echo $email; }else{ echo $afficher_profil['email'];}?>" required>
                <?php
                    if (isset($er_mdp)){
                ?>
                        <div><?= $er_mdp ?></div>
                <?php
                }
                ?>
                 <input type="text" placeholder="Votre mot de passe" name="mdp" value="<?php if(isset($mdp)){ echo $mdp; }else{ echo $afficher_profil['mdp'];}?>" required>
                <?php
                    if (isset($er_prenom)){
                ?>
                        <div><?= $er_prenom ?></div>
                <?php
                }
                ?>
                <input type="text" placeholder="Votre prénom" name="prenom" value="<?php if(isset($prenom)){ echo $prenom; }else{ echo $afficher_profil['prenom'];}?>" required>
                <button type="submit" name="modification">Modifier</button>
             </form>
        </body>
</html>