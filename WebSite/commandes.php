<?php

 function ajouter($image, $nom, $prix, $desc, $couleur, $type, $stock)
{
	global $access;
	$desc = addslashes($desc);
	$nom = addslashes($nom);
	if (require("dataconnexion.php"))
	{
		$req = $access->prepare("INSERT INTO produits (image,nom,prix,description,couleur,type, stock) VALUES ('$image', '$nom', $prix, '$desc', '$couleur','$type', $stock)");
		$req->execute(array($image, $nom, $prix, $desc, $couleur, $type, $stock)); /*addsLashes permet d'insérer du texte avec des apostrophes*/
		$req->closeCursor();
	}

}

function afficher()
{
	global $access;
	if (require("dataconnexion.php"))
	{
		if($_POST['type']=="0" AND $_POST['color']!="0"){
			$req= $access->prepare("SELECT * FROM produits WHERE couleur='".$_POST['color']."' ");
		} elseif($_POST['color']=="0" AND $_POST['type']!="0") {
			$req= $access->prepare("SELECT * FROM produits WHERE type ='".$_POST['type']."'");
		} elseif($_POST['type']=="0" AND $_POST['color']=="0") {
			$req= $access->prepare("SELECT * FROM produits ORDER BY id DESC");
		} else {
			$req= $access->prepare("SELECT * FROM produits WHERE type ='".$_POST['type']."' OR couleur='".$_POST['color']."' ");
		}

		$req->execute();
		$data = $req->fetchAll(PDO::FETCH_OBJ);        /*on récupere les données sous forme d'objet qu'on stocke dans data*/

		return $data;
		$req->closeCursor();

	}
}

function afficherpremier()
{
	global $access;
	if (require("dataconnexion.php"))
	{
		$req= $access->prepare("SELECT * FROM produits ORDER BY id DESC");
		$req->execute();
		$data = $req->fetchAll(PDO::FETCH_OBJ);        /*on récupere les données sous forme d'objet qu'on stocke dans data*/

		return $data;
		$req->closeCursor();

	}
}

function supprimer($id)
{
	global $access;
	if(require("dataconnexion.php"))
	{
		$req=$access->prepare("DELETE FROM produits WHERE id=?");
		$req->execute(array($id));
	}
}

 function ajout_users($email, $mdp, $prenom,$nom)
{
	global $access;
	if (require("dataconnexion.php"))
	{
		$req = $access->prepare("INSERT INTO users (email,mdp,prenom,nom) VALUES ('$email', '$mdp', '$prenom', '$nom')");
		$req->execute(array($email, $mdp, $prenom, $nom));
		$req->closeCursor();
	}
}

function listeusers()
{
	global $access;
	if (require("dataconnexion.php"))
	{
		$req = $access->prepare("SELECT * FROM users");
		$req->execute();
		$data = $req->fetchAll(PDO::FETCH_OBJ);
		return $data;
		$req->closeCursor();
	}
}

function supprimeruser($id)
{
	global $access;
	if(require("dataconnexion.php"))
	{
		$req=$access->prepare("DELETE FROM users WHERE id_users=?");

		$req->execute(array($id));
	}
}

function ajoutstock($id,$ajout)
{
	global $access;
	if(require("dataconnexion.php"))
	{
	  $req = $access->prepare("UPDATE produits SET stock= :stock WHERE id='".$id."'");
	  $req->bindParam(':stock', $ajout);
	  $req->execute();

	}
}

function retirerstock($id,$ajout)
{
	global $access;
	if(require("dataconnexion.php"))
	{

	  $req = $access->prepare("UPDATE produits SET stock= :stock WHERE id='".$id."'");
	  $req->bindParam(':stock', $ajout);
	  $req->execute();
	}
}

function listecommandes()
{
	global $access;
	if (require("dataconnexion.php"))
	{
		$req = $access->prepare("SELECT * FROM commande ORDER BY id_co ASC");  
		$req->execute();
		$data = $req->fetchAll(PDO::FETCH_OBJ);
		return $data;
		$req->closeCursor();
	}
}

function getRowsNumber() 
{
	global $access;
	if (require("dataconnexion.php"))
	{
		$conn = new mysqli($host, $username, $password, $database);
        $req = ("SELECT * FROM users");
		if ($stmt = $conn->prepare($req)) {
		    $stmt->execute();
		    $stmt->store_result();
		    printf($stmt->num_rows);
		}

	}
}
?>