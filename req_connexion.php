<?php
//ouverture de la session
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=crud', '', '');

if(isset($_POST['connect']))
{
    //pour simplifier et sécuriser
    $loginconnect = htmlspecialchars($_POST['loginconnect']);
    $pwdconnect = sha1($_POST['pwdconnect']);
    
    //pour savoir si tous les champs sont complétés
    if(!empty($_POST['loginconnect']) AND !empty($_POST['pwdconnect']))
    {
        //pour savoir si les données sont identiques sur la bdd
        $requser = $bdd->prepare("SELECT * FROM users WHERE login = ? AND pwd = ?");
        $requser->execute(array($loginconnect, $pwdconnect));
        $userexist = $requser->rowCount();
        
        if($userexist == 1)   
        {
            //création d'une session
            $userinfo = $requser->fetch();
            $_SESSION['user_id'] = $userinfo['user_id'];
            $_SESSION['login'] = $userinfo['login'];
            $_SESSION['pwd'] = $userinfo['pwd'];
            //pour diriger l'utilisateur sur sa page 
            header("Location: todolist.php"); 
        }
        else
        {
            $message = "Vos données ne sont pas valides !";
        }
    }
    else 
    {
        $message = "Tous les champs doivent être complétés";
    }
}
?>