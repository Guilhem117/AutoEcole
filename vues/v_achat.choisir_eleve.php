<h3>Choisir un élève</h3>

<?php
	
	if (empty($eleves)) {
		echo '<p>Il n\'y a pas d\'élèves disponibles.<p>';
	} else {

?>

<form name="choix_eleve" action="main.php?rubrique=achat&action=choisir_eleve" method="post" accept-charset="utf-8">
	
	<label for="eleves">Elèves :</label>
	<select name="eleves" id="eleves">
		<?php
			
			foreach($eleves as $eleve) {
				echo '<option value="'.$eleve['IDELEVE'].'">'.strtoupper($eleve['NOM']).' '.ucfirst(strtolower($eleve['PRENOM'])).'</option>';
			}
		
		?>
	</select>
	
	<input type="submit" name="soumission" value="Valider" />
</form>

<?php

	}

?>