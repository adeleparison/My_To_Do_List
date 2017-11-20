<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=crud', '', '');

//pour confirmer l'envoie du formulaire
if(isset($_POST['inscription']))
{
    //pour simplifier et sécuriser 
        $login = htmlspecialchars($_POST['login']);
        $mail = htmlspecialchars($_POST['mail']);
        $mail2 = htmlspecialchars($_POST['mail2']);
        $pwd = sha1($_POST['pwd']);
        $pwd2 = sha1($_POST['pwd2']);
    
    //pour savoir si tous les champs sont complétés 
    if(!empty($_POST['login']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['pwd']) AND !empty($_POST['pwd2']))
    {
        //pour savoir si les mails sont identiques
        if($mail == $mail2)
        {
            //pour verifier si c'est des adresses mails
            if(filter_var($mail, FILTER_VALIDATE_EMAIL))
            {
                //pour savoir si une adresse mail n'est pas déjà pris
                $reqmail = $bdd->prepare("SELECT * FROM users WHERE mail = ?");
                $reqmail->execute(array($mail));
                $mailexist = $reqmail->rowCount();
                if($mailexist == 0)
                {
                    //pour savoir si les mots de passes sont identiques
                    if($pwd == $pwd2)
                    {
                        //quand tout est ok, création d'une fonction pour inscrire le membre dans la bdd
                        $insertuser = $bdd->prepare("INSERT INTO users (login, mail, pwd) VALUES(?, ?, ?)");
                        $insertuser->execute(array($login, $mail, $pwd));
                        header("Location: connexion.php");
                    }
                    else
                    {
                        $message = "Vos mots de passes ne sont pas identiques";
                    }
                }
                else
                {
                    $message = "Cette adresse mail, est déjà utilisée";    
                }
            }
            else 
            {
                $message = "Votre adresse mail n'est pas valide";
            }
        }
        else 
        {
            $message = "Vos adresses mail ne sont pas identiques";
        }
    }
    else
    {
      $message = "Tous les champs doivent être complétés";  
    }
       
} 
?>