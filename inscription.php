<?php  include('req_inscription.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="inscription_style.css">
</head>
    <body>
            <h2 class="title">Votre inscription</h2>
            <form  method="POST" action="">
                <div class="input-group">
                    <label for="login">Indiquer votre pseudo :</label>
                    <input type="text" placeholder="Pseudo" id="login" name="login"/>
                 </div>   
                 <div class="input-group">
                    <label for="mail">Indiquer votre e-mail :</label>
                    <input type="email" placeholder="E-mail" id="mail" name="mail"/>
                </div> 
                <div class="input-group">
                    <label for="mail2">Confirmation de votre e-mail :</label>
                    <input type="mail2" placeholder="Confirmation du E-mail" id="mail2" name="mail2"/>
                </div>  
                <div class="input-group">
                    <label for="pwd">Votre mot de passe :</label>
                    <input type="password" placeholder="Mot de passe" id="pwd" name="pwd"/>
                </div>
                <div class="input-group">
                    <label for="pwd2">Confirmation de votre mot de passe :</label>
                    <input type="password" placeholder="Confirmation du mot de passe" id="pwd2" name="pwd2"/>
                </div>
                 <?php //pour afficher les messages d'erreur
                        if(isset($message))
                        {
                            echo $message;
                        }
                 ?>
                <button class="btn" type="submit" name="inscription" value="Je m'inscris">Je m'inscris</button>
            </form>
        <a href="connexion.php">J'ai déjà un compte !</a>
    </body>
</html>