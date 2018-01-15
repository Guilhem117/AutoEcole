<h3>Ajouter une nouvelle leçon de conduite</h3>

<?php

	if (!empty($message)) {
		echo '<p class="info">'.htmlspecialchars($message).'</p>';
	}
	
?>

<form name="creer_lecon" action="main.php?rubrique=lecon&action=creer" method="post" accept-charset="utf-8">
	
	<label for="date">Date (JJ/MM/AAAA HH:MM:SS) :</label>
	<input type="text" name="date" id="date" value="<?php echo htmlspecialchars($date); ?>" />
	
	<label for="statut">Statut :</label>
	<select name="statut" id="statut" />
		<option value="en attente" <?php if ($statut == 'en attente') { echo 'selected'; } ?> >En attente</option>
		<option value="effectuée" <?php if ($statut == 'effectuée') { echo 'selected'; } ?> >Effectuée</option>
		<option value="annulée" <?php if ($statut == 'annulée') { echo 'selected'; } ?> >Annulée</option>
	</select>
	
	<label for="eleve">Elève :</label>
	<select name="eleve" id="eleve" />
		<?php
			
			foreach ($eleves as $eleve) {
				echo '<option value="'.$eleve['IDELEVE'].'" ';
				
				if ($idEleve == $eleve['IDELEVE']) {
					echo 'selected ';
				}
				
				echo '>'.strtoupper($eleve['NOM']).' '.ucfirst(strtolower($eleve['PRENOM'])).'</option>';
			}
		
		?>
	</select>
	
	<label for="moniteur">Moniteur :</label>
	<select name="moniteur" id="moniteur" />
		<?php
			
			foreach ($moniteurs as $moniteur) {
				echo '<option value="'.$moniteur['IDSALARIE'].'" ';
				
				if ($idSalarie == $moniteur['IDSALARIE']) {
					echo 'selected ';
				}
				
				echo '>'.strtoupper($moniteur['NOM']).' '.ucfirst(strtolower($moniteur['PRENOM'])).'</option>';
			}
		
		?>
	</select>
	
	<label for="vehicule">Véhicule :</label>
	<select name="vehicule" id="vehicule" />
		<?php
			
			foreach ($vehicules as $vehicule) {
				echo '<option value="'.$vehicule['NUMVEHICULE'].'" ';
				
				if ($numVehicule == $vehicule['NUMVEHICULE']) {
					echo 'selected ';
				}
				
				echo '>'.$vehicule['NUMVEHICULE'].'</option>';
			}
		
		?>
	</select>
	
	<input type="submit" name="soumission" value="Valider" />
</form>

<a href="main.php?rubrique=lecon&action=lister">Retour</a>
