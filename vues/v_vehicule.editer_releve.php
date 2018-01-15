<h3>Editer <?php echo $_GET['idReleve']; ?></h3>

<?php

	if (!empty($message)) {
		echo '<p class="info">'.htmlspecialchars($message).'</p>';
	}
	
?>

<form name="vehicule" action="main.php?rubrique=vehicule&action=editer_releve&id=<?php echo $_GET['id']; ?>&idReleve=<?php echo $_GET['idReleve']; ?>" method="post" accept-charset="utf-8">

	<label for="date">Date (JJ/MM/AAAA HH:MM:SS) :</label>
	<input type="text" name="date" id="date" value="<?php echo htmlspecialchars($date); ?>" />
	
	<label for="kilometrage">Kilométrage :</label>
	<input type="number" name="kilometrage" id="kilometrage" value="<?php echo htmlspecialchars($kilometrage); ?>" />
	
	<input type="submit" name="soumission" value="Valider" />
</form>

<a href="main.php?rubrique=vehicule&action=lister_releves&id=<?php echo $_GET['id']; ?>">Retour</a>