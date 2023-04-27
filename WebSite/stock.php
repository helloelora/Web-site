<?php session_start(); //$_SESSION 
      require_once("C:/MAMP/htdocs/tests/JE/commandes.php");
      $listeproduits = afficherpremier();

if(!isset($_SESSION['LOGGED_USER'])) {
    header('location:main.php');
}      
if(isset($_SESSION['LOGGED_USER'])) { //vérifie que l'utilisateur connecté est bien l'admin (au cas ou un utilisateur malveillant change l'adresse dans la barre de recherche)
    if($_SESSION['EMAIL']!="admin@admin") {
        header('location:main.php');
    }
}

include_once('headeradmin.php'); ?>

<!DOCTYPE html>                        
<html>
    <head>
        <meta charset="utf-8" />
        <title>Admin stock</title>  
        <link rel="stylesheet" href="style.css" /> 

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>  
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" style="margin-top: 30px;">
        <form method="post">
            <div class="mb-3">
                <div class="mb-3" style="padding-left: 30px; text-align: center;">
                    <label for="exampleInputPassword1" class="form-label">Rentrez l'ID de l'article dont vous voulez modifier le stock :</label>
                    <input type="number" class="form-control" name="idproduit" style="width: 100px; margin-left: 180px;" required>
                </div>
                <div class="mb-3" style="padding-left: 30px; text-align: center;">
                    <label for="exampleInputPassword1" class="form-label">Rentrez le nouveau stock de cet article :</label>
                    <input type="number" class="form-control" name="nbrexemp" style="width: 100px; margin-left: 180px;" required>
                </div>
            <button type="submit" class="button" name ="valider" style="margin-left:200px;">Ajouter du stock</button>
        </form>
        </div>


    <div>
      <div class="bloc-produit">
      <div class="mb-3"></br></br>
       

    <table class="table" style="width: 700px;">
        <caption>Stocks des différent articles</caption>
        <th> ID de l'article </th> 
        <th>Nom de l'article</th>
        <th>Stock actuel</th>

            <?php foreach($listeproduits as $produit) : ?>
        <tr>
            <td ><?= $produit->id ?></td>
            <td ><?= $produit->nom ?></td>
            <td ><?= $produit->stock ?></td>
        </tr>
            <?php endforeach; ?>
    </table>  
        </div>
        </div>
    </div>

    </body>
</html>

<?php 
    if(isset($_POST['valider']))
    {
        if(isset($_POST['idproduit'])) 
        {
           if(!empty($_POST['idproduit']) AND is_numeric($_POST['idproduit']) AND !empty($_POST['nbrexemp']) AND is_numeric($_POST['nbrexemp'])) 
            {
                $idproduit=htmlspecialchars(strip_tags($_POST['idproduit']));
                $nbrexemp=htmlspecialchars(strip_tags($_POST['nbrexemp']));
                try
                {
                    ajoutstock($idproduit,$nbrexemp);
                    header('location:stock.php');
                    exit;
                } catch(Exception $e) {
                    $e->getMessage();
                }
            }
        }
    }
?>
