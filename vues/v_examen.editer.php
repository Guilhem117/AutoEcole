<h3>Editer examen numéro <?php echo $_GET['id']; ?></h3>

<?php

	if (!empty($message)) {
		echo '<p class="info">'.htmlspecialchars($message).'</p>';
	}
	
?>

<form name="examen" action="main.php?rubrique=examen&action=editer&id=<?php echo $_GET['id'] ?>" method="post" accept-charset="utf-8">
	
	<label for="date">Date (JJ/MM/AAAA HH:MM:SS) :</label>
	<input type="text" name="date" id="date" value="<?php echo htmlspecialchars($date); ?>" />
	
	<label for="type">Type :</label>
	<select name="type" id="type" />
		<option value="code" <?php if ($type == 'code') { echo 'selected'; } ?> >Code</option>
		<option value="conduite" <?php if ($type == 'conduite') { echo 'selected'; } ?> >Conduite</option>
	</select>
	
	<a href="main.php?rubrique=examen&action=lister_editer_participants&id=<?php echo $_GET['id'] ?>">Gérer la liste des participants</a>
	
	<input type="submit" name="soumission" value="Valider" />
</form>

<a href="main.php?rubrique=examen&action=lister">Retour</a>