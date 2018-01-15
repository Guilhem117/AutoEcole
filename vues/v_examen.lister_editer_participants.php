<?php echo '<h3>Liste des participants de l\'examen du '.$examen['DATEEXAM'].' de type "'.$examen['TYPEEXAM'].'" : </h3>'; ?>

<?php

	if (!empty($message)) {
		echo '<p class="info">'.htmlspecialchars($message).'</p>';
	}
	
?>

<?php
	
	if (empty($inscrits)) {
		echo '<p>Il n\'y a pas d\'élèves inscrits à cet examen.<p>';
	} else {

?>

<form name="lister_editer_participants" action="main.php?rubrique=examen&action=lister_editer_participants&id=<?php echo $_GET['id'] ?>" method="post" accept-charset="utf-8" onchange="this.form.submit()">
	<?php
		foreach($inscrits as $inscrit) {
			echo strtoupper($inscrit['NOM']).' '.ucfirst(strtolower($inscrit['PRENOM'])).' - <b>Statut :</b> ';
			
			echo '<select name="statut'.$inscrit['IDELEVE'].'" id="statut'.$inscrit['IDELEVE'].'">';
			
			echo '<option value="en attente" ';
			if ($inscrit['STATUTEXAM'] == "en attente") { echo 'selected'; }
			echo ' >en attente</option>';
			
			echo '<option value="réussi" ';
			if ($inscrit['STATUTEXAM'] == "réussi") { echo 'selected'; }
			echo ' >réussi</option>';
			
			echo '<option value="échoué"' ;
			if ($inscrit['STATUTEXAM'] == "échoué") { echo 'selected'; }
			echo ' >échoué</option>';
			
			echo '<option value="désistement" ';
			if ($inscrit['STATUTEXAM'] == "désistement") { echo 'selected'; }
			echo ' >désistement</option>';
			
			echo '</select>';
			
			echo ' <a href="main.php?rubrique=examen&action=supprimer_participant&idExamen='.htmlspecialchars($examen['IDEXAM']).'&idEleve='.htmlspecialchars($inscrit['IDELEVE']).'">Supprimer</a><br />';
		}
	?>
	
	<input type="submit" name="soumission" value="Mettre à jour les statuts" />
</form>

<?php

	}

?>

<a href="main.php?rubrique=examen&action=ajouter_participant&id=<?php echo $_GET['id'] ?>">Ajouter un participant</a><br />
<a href="main.php?rubrique=examen&action=editer&id=<?php echo $_GET['id'] ?>">Retour</a>