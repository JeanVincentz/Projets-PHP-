<?php
   session_start();
   @$login=$_POST["login"];
   @$pass=sha1($_POST["pass"]);
   @$valider=$_POST["valider"];
   $erreur="";
   if(isset($valider)){
      include("connexion.php");
      $sel=$pdo->prepare("select * from utilisateurs where login=? and pass=? limit 1");
      $sel->execute(array($login,$pass));
      $tab=$sel->fetchAll();
      if(count($tab)>0){
         $_SESSION["prenomNom"]=ucfirst(strtolower($tab[0]["prenom"])).
         " ".strtoupper($tab[0]["nom"]);
         $_SESSION["autoriser"]="oui";
         header("location:session.php");
      }
      else
         $erreur="Mauvais login ou mot de passe!";
   }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Connexion</title>
</head>
<body onLoad="document.fo.login.focus()">
      <h1>Authentification <a href="inscription.php">Créer un compte</a></h1>
      <div class="erreur"><?php echo $erreur ?></div>
    <form name="fo" method="post" action="">
         <input type="text" name="login" placeholder="Login"><br>
         <input type="password" name="pass" placeholder="Mot de passe"><br>
         <input type="submit" name="valider" value="S'authentifier">
    </form>
</body>
</html>