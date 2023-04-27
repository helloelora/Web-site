<?php session_start(); //$_SESSION 
      require("C:/MAMP/htdocs/tests/JE/commandes.php");
if(!isset($_SESSION['LOGGED_USER'])) {
    header('location:main.php');
} 
if(isset($_SESSION['LOGGED_USER'])) {  //vérifie que l'utilisateur connecté est bien l'admin (au cas ou un utilisateur malveillant change l'adresse dans la barre de recherche)
    if($_SESSION['EMAIL']!="admin@admin") {
        header('location:main.php');
}
}?>

<?php include_once('headeradmin.php'); ?>

<!DOCTYPE html>                        
<html>
    <head>
        <meta charset="utf-8" />
        <title>Admin ajout produits</title>   
        <link rel="stylesheet" href="style.css" /> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>  
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>             
    </head>

    <body>

   
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" style="padding-top: 35px;">
    <form method="post">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Lien de l'image de la chaussure</label>
        <input type="name" name="image" placeholder="https://..." class="form-control" required>               

      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Nom du produit</label>
        <input type="text" class="form-control" name="nom" required>
      </div>

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Prix</label>
        <input type="number" step="0.01" class="form-control" placeholder="85.15" name="prix" required>
    </div>

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Description</label>
        <textarea class="form-control" name="desc" required> </textarea>
    </div>

    <div class="mb-3">
        Veuillez sélectionner la couleur de la chaussure <br />
        <select name="color">
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

    <div class="mb-3">
        Veuillez sélectionner le type de la chaussure <br />
        <select name="type">
            <option value="lifestyle">lifestyle</option>
            <option value="talons">talons</option>
            <option value="chaussures plates">chaussures plates</option>
            <option value="sport">sport</option>
        </select>
    </label><br/>

    </div>
        <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Nombre d'exemplaire en stock du produit</label>
        <input type="number" class="form-control"  placeholder="10" name="stock" required>
    </div>
 
      <button style="margin-bottom: 20px;" type="submit" name ="valider" class="button">Créer le produit</button>
    </form>
</div></div></div>
    </body>
</html>

<?php 

    if(isset($_POST['valider']))
    {
        if(isset($_POST['image']) AND isset($_POST['nom']) AND isset($_POST['prix']) AND isset($_POST['desc']) AND isset($_POST['color']) AND isset($_POST['type']) AND isset($_POST['stock']))
        {
           if(!empty($_POST['image']) AND !empty($_POST['nom']) AND !empty($_POST['prix']) AND !empty($_POST['desc']) AND !empty($_POST['color']) AND !empty($_POST['type']) AND !empty($_POST['stock']))
            {
                $image=htmlspecialchars(strip_tags($_POST['image']));     
                $nom=htmlspecialchars(strip_tags($_POST['nom']));
                $prix=htmlspecialchars(strip_tags($_POST['prix']));
                $desc=htmlspecialchars(strip_tags($_POST['desc']));
                $couleur=htmlspecialchars(strip_tags($_POST['color']));
                $type=htmlspecialchars(strip_tags($_POST['type']));
                $stock=htmlspecialchars(strip_tags($_POST['stock']));

                try
                {
                    ajouter($image, $nom, $prix, $desc, $couleur, $type, $stock); ?>
                    <div class="message" style="margin-bottom: 60px; margin-left: 110px;">
                        Le produit à bien été ajouté au site
                    </div>
                <?php } catch(Exception $e) {
                    $e->getMessage();
                }
            }
        }
    }

?>