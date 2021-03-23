<?php
   session_start();
   @$nom=$_POST["nom"];
   @$prenom=$_POST["prenom"];
   @$login=$_POST["login"];
   @$pass=$_POST["pass"];
   @$repass=$_POST["repass"];
   @$valider=$_POST["valider"];
   $erreur="";
   if(isset($valider)){
      if(empty($nom)) $erreur="Nom laissé vide!";
      elseif(empty($prenom)) $erreur="Prénom laissé vide!";
      elseif(empty($prenom)) $erreur="Prénom laissé vide!";
      elseif(empty($login)) $erreur="Login laissé vide!";
      elseif(empty($pass)) $erreur="Mot de passe laissé vide!";
      elseif($pass!=$repass) $erreur="Mots de passe non identiques!";
      else{
         include("connexion.php");
         $sel=$pdo->prepare("select id from utilisateurs where login=? limit 1");
         $sel->execute(array($login));
         $tab=$sel->fetchAll();
         if(count($tab)>0)
            $erreur="Login existe déjà!";
         else{
            $ins=$pdo->prepare("insert into utilisateurs(nom,prenom,login,pass) values(?,?,?,?)");
            if($ins->execute(array($nom,$prenom,$login,sha1($pass))))
               header("location:index.php");
        }   
    }
   }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Formulaire</title>
</head>
<body>
<h1>Inscription <a href="index.php">connexion</a></h1>
      <div class="erreur"><?php echo $erreur ?></div> <!--Gestion des erreurs-->
      <form name="fo" method="post" action="">

    <label >Votre Nom</label>
         <input type="text" name="nom" placeholder="Nom" value="<?php echo $nom?>"><br>

    <label>Votre Prénom</label>
         <input type="text" name="prenom" placeholder="Prénom" value="<?php echo $prenom?>"><br>

    <label>Votre Identifiant</label>
         <input type="text" name="login" placeholder="Login" value="<?php echo $login?>"><br>

    <label>Votre Mot de passe</label>
         <input type="password" name="pass" placeholder="Mot de passe" value="<?php echo $pass?>"><br>

    <label>Confirmer Mot de passe</label>     
         <input type="password" name="repass" placeholder="Confirmer Mot de passe" value="<?php echo $repass?>"><br>
         <input type="submit" name="valider" value="S'enregistrer">
      </form>
</body>
</html>