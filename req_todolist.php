<?php 
    //connexion bdd
	session_start();

    $bdd = new PDO('mysql:host=localhost;dbname=crud', '', '');

    // enregistrer une tâche
	if (isset($_POST['save'])) {
		$tache = $_POST['tache'];
		$description = $_POST['description'];
        $userId = $_SESSION['user_id']; 
        
        $statement = $bdd->prepare("INSERT INTO info (tache, description, user_id) VALUES (?, ?, ?)");
        $statement->execute(array($tache, $description, $userId));
        
		header('location: todolist.php');
	}

    // pour modifier une tâche
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $tache = $_POST['tache'];
        $description = $_POST['description'];
        
        $statement = $bdd->prepare("UPDATE info SET tache=?, description=? WHERE id=?");
        $statement->execute(array($tache, $description, $id));
        
        header('location: todolist.php');
    }

    // pour supprimer une tâche
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        
        $statement = $bdd->prepare("DELETE FROM info WHERE id=?");
        $statement->execute(array($id));
   
        header('location: todolist.php');
    }

    // pour supprimer un compte
    if (isset($_GET['userIdDelete'])) {
        $userIdDelete = $_GET['userIdDelete'];
        
        $statement = $bdd->prepare("DELETE FROM users WHERE user_id=?");
        $statement->execute(array($userIdDelete));
        
        header('location: inscription.php');
    }