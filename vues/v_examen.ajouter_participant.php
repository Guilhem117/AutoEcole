<h3>Ajouter un élève à cet examen :</h3>

<?php

	if (!empty($message)) {
		echo '<p class="info">'.htmlspecialchars($message).'</p>';
	}
	
?>


<?php
	
	if (empty($non_inscrits)) {
		echo '<p>Il n\'y a pas d\'élèves à ajouter.<p>';
	} else {

?>

<form name="ajouter_participant" action="main.php?rubrique=examen&action=ajouter_participant&id=<?php echo $_GET['id'] ?>" method="post" accept-charset="utf-8">
	
	<label for="participant">Elèves :</label>
	<select name="participant" id="participant">
		<?php
			
			foreach($non_inscrits as $non_inscrit) {
				echo '<option value="'.$non_inscrit['IDELEVE'].'">'.strtoupper($non_inscrit['NOM']).' '.ucfirst(strtolower($non_inscrit['PRENOM'])).'</option>';
			}
		
		?>
	</select>
	
	<input type="submit" name="soumission" value="Ajouter" />
</form>

<?php

	}
	
?>

<a href="main.php?rubrique=examen&action=lister_editer_participants&id=<?php echo $_GET['id'] ?>">Retour</a><br />