<?php  include('req_todolist.php'); ?>

<!-- on modifie une tâche, pour laisser les anciennes tâches en tant que valeur de l'attribut--> 
<?php 


	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
        
        $record = $bdd->prepare("SELECT * FROM info WHERE id=?");
        $record->execute(array($id));
		//$record = mysqli_query($db, "SELECT * FROM info WHERE id=$id");
        
        
		if (count($record) == 1 ) {
			//$n = mysqli_fetch_array($record);
            $n = $record->fetch();
			$tache = $n['tache'];
			$description = $n['description'];
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>My To do List</title>
    <link rel="stylesheet" type="text/css" href="todolist_style.css">
</head>
<body>
      
<!-- 
Pour récupérer les enregistrements de la base de données et les afficher sur la page -->    
<?php 
    $userId = $_SESSION['user_id'];
    
    $record = $bdd->prepare("SELECT * FROM info WHERE user_id =?");
    $record->execute(array($userId));
    //$results = mysqli_query($db, "SELECT * FROM info WHERE user_id ='$userId'");
    ?>
<table>
    <caption class="title">La To do list de <?php echo $_SESSION['login']; ?> !</caption>
	<thead>
		<tr>
			<th>Tâche</th>
			<th>Description</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = $record->fetch()) { ?>
		<tr>
			<td><?php echo $row['tache']; ?></td>
			<td><?php echo $row['description']; ?></td>
			<td>
				<a href="todolist.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Modifier</a>
			</td>
			<td>
				<a href="req_todolist.php?del=<?php echo $row['id']; ?>" class="del_btn">Supprimer</a>
			</td>
		</tr>
	<?php } ?>
</table>    
	<form method="post" action="req_todolist.php?.user" >
        <input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="input-group">
			<label>Tâche</label>
            <!--pour être reconnu dans la bdd uniquement par son identifiant-->
			<input type="text" name="tache" value="<?php echo $tache; ?>">
		</div>
		<div class="input-group">
			<label>Description</label>
			<input type="text" name="description" value="<?php echo $description; ?>">
		</div>
		<div class="input-group">
            <!--On utilise $update qui est boolean. Si condition est vrai, le bouton "mettre à jour" est affiché. Mais si la condition est fausse, le bouton "sauvegarder" est affichés -->
            <?php if ($update == true): ?>
                <button class="btn" type="submit" name="update" style="background: #88ffd1;">Mettre à jour</button>
            <?php else: ?>
                <button class="btn" type="submit" name="save" >Sauvegarder</button>
            <?php endif ?>
		</div>
	</form>
    <a class="dcnx" href="deconnexion.php">Je me déconnecte</a>
    <a class="dcnx" href="todolist.php?userIdDelete=<?php echo $userId; ?>">Supprimer le compte</a>
    
</body>
</html>


