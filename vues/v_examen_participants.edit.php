<form name="modif_participant" action="main.php?rubrique=examen&action=editer_participants&id=<?php echo $_GET['id'] ?>" method="post" accept-charset="utf-8" onchange="this.form.submit()">
	<?php
		echo '<b>Liste des participants de l\'examen du '.$examen['DATEEXAM'].' de type "'.$examen['TYPEEXAM'].'" : </b><br />';

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
</form>


<form name="ajout_participant" action="main.php?rubrique=examen&action=editer_participants&id=<?php echo $_GET['id'] ?>" method="post" accept-charset="utf-8">
	
	<label for="participants">Elèves :</label>
	<select name="participants" id="participants">
		<?php
			
			foreach($non_inscrits as $non_inscrit) {
				echo '<option value="'.$non_inscrit['IDELEVE'].'">'.strtoupper($non_inscrit['NOM']).' '.ucfirst(strtolower($non_inscrit['PRENOM'])).'</option>';
			}
		
		?>
	</select>
	
	<input type="submit" name="soumission_ajout_participant" value="Ajouter" />
</form>

<a href="main.php?rubrique=examen&action=editer&id=<?php echo $_GET['id'] ?>">Retour</a>