<?php session_start(); //$_SESSION
  require("C:/MAMP/htdocs/tests/JE/dataconnexion.php");
  include_once('header.php');
if(isset($_SESSION['LOGGED_USER'])) {  //si l'utilisateur est déjà connecté alors il est automatiquement redirigé vers la page principale car il n'a pas besoin de créer son compte
    header('location:main.php');
}      
?>
<style>
.message 
{
    padding-left: 55%;
}
</style>

<!DOCTYPE html>                        
<html>
    <head>
        <meta charset="utf-8" />
        <title>Inscription</title>   
        <link rel="stylesheet" href="style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>      
        <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/album/">

    </head>
    <body>
 <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <p style="padding-top : 50px">Veuillez rentrer vos informations pour vous inscrire :</p>
        <div class="inscription">
            <form method="post">

                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="prenom" autocomplete="off" required>
                  </div>

                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" autocomplete="off" required>
                  </div>

                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Adresse email</label>
                    <input type="email" class="form-control" name="email" autocomplete="off" required>  <!-- autocomplete évite que des propositions n'apparaissent-->
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="mdp" autocomplete="off" required>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Confirmation du mot de passe</label>
                    <input type="password" class="form-control" name="mdp2" autocomplete="off" required>
                  </div>

                  <button type="submit" class="button" name="envoi">Créer le compte</button>
                </form>
        </div>
    </div>
</div>

    </body>


</html>

<?php
      require("C:/MAMP/htdocs/tests/JE/commandes.php");

      if(isset($_POST['envoi']))
      {
        if(!empty($_POST['email']) AND !empty($_POST['mdp']) AND !empty($_POST['prenom']) AND !empty($_POST['mdp2']) AND !empty($_POST['nom'])) 
        {
            $email = htmlspecialchars($_POST['email']);
            $mdp = sha1($_POST['mdp']);
            $mdp2 = sha1($_POST['mdp2']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $nom = htmlspecialchars($_POST['nom']);

            if ($mdp==$mdp2):
                 try
                    {
                    $stmt = $access->prepare("SELECT * FROM users WHERE email=?");   /*test si l'utilisateur n'est pas déjà inscrit*/
                    $stmt->execute([$email]); 
                    $verif = $stmt->fetch();
                    if ($verif): ?>
                        <div class="message">
                            Cet email est déjà associé à un compte
                         </div> 
                    <?php else : 
                        ajout_users($email, $mdp, $prenom, $nom);
                        ?><div class="message">
                            Votre compte a bien été créé, vous pouvez maintenant vous connecter
                         </div>
                    <?php endif; 
                                        
                } catch(Exception $e) {
                    $e->getMessage();
                }
             else : ?>
                <div class="message">
                    Attention vous n'avez pas rentré les mêmes mot de passe
                </div>
            <?php endif;
        }
      }
?>