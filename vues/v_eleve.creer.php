<h3>Ajouter un élève</h3>

<?php

	if (!empty($message)) {
		echo '<p class="info">'.htmlspecialchars($message).'</p>';
	}
	
?>


<form name="eleve" action="main.php?rubrique=eleve&action=creer" method="post" accept-charset="utf-8">
	
	
	<label for="nomEleve">Nom :</label>
	<input type='text' name='nomEleve' id='nomEleve' value="<?php echo htmlspecialchars($nom); ?>" />
	
	<label for="prenomEleve">Prénom :</label>
	<input type='text' name='prenomEleve' id='prenomEleve' value="<?php echo htmlspecialchars($prenom); ?>" />
	
	<label for="adresseEleve">Adresse :</label>
	<input type='text' name='adresseEleve' id='adresseEleve' value="<?php echo htmlspecialchars($adresse); ?>" />
	
	<label for="villeEleve">Ville :</label>
	<input type='text' name='villeEleve' id='villeEleve' value="<?php echo htmlspecialchars($ville); ?>" />
	
	<label for="codePostalEleve">Code postal :</label>
	<input type='text' name='codePostalEleve' id='codePostalEleve' maxlength="5" value="<?php echo htmlspecialchars($codePostal); ?>" />
	
	<label for="dateNaissance">Date de naissance (JJ/MM/AAAA HH:MM:SS) :</label>
	<input type="text" name="dateNaissance" id="dateNaissance" value="<?php echo htmlspecialchars($dateNaissance); ?>" />
	
	<label for="telephoneDomicileEleve">Téléphone domicile :</label>
	<input type='text' name='telephoneDomicileEleve' id='telephoneDomicileEleve' maxlength="10" value="<?php echo htmlspecialchars($telephoneDomicile); ?>" />

	<label for="telephonePortableEleve">Téléphone portable :</label>
	<input type='text' name='telephonePortableEleve' id='telephonePortableEleve' maxlength="10" value="<?php echo htmlspecialchars($telephonePortable); ?>" />
	
	<label for="adresseProEleve">Adresse travail :</label>
	<input type='text' name='adresseProEleve' id='adresseProEleve' value="<?php echo htmlspecialchars($lieuEtude); ?>" /> 

	<label for="codePostalProEleve">Code postal travail :</label>
	<input type='text' name='codePostalProEleve' id='codePostalProEleve' maxlength="5" value="<?php echo htmlspecialchars($codePostalTravail); ?>" />
	
	<label for="villeProEleve">Ville travail :</label>
	<input type='text' name='villeProEleve' id='villeProEleve' value="<?php echo htmlspecialchars($villeTravail); ?>" />

	<label for="formuleEleve">Formule :</label>
	<select name="formuleEleve" id="formuleEleve">
		<?php
			
			foreach ($formules as $formule) {
				echo '<option value="'.$formule['IDFORMULE'].'" ';
				
				if ($idFormule == $formule['IDFORMULE']) {
					echo 'selected ';
				}
				
				echo '>'.strtoupper($formule['NOM']).'</option>';
			}
		
		?>
	</select>

	<label for="responsableEleve">Responsable :</label>
	<select name="responsableEleve" id="responsableEleve">
		<option value="null">Aucun</option>
		<?php
			
			foreach ($responsables as $responsable) {
				echo '<option value="'.$responsable['IDRESPONSABLE'].'" ';
				
				if ($idResponsable == $responsable['IDRESPONSABLE']) {
					echo 'selected ';
				}
				
				echo '>'.strtoupper($responsable['NOM'].' '.$responsable['PRENOM']).'</option>';
			}
		
		?>
	</select>
	
	<label for="salarieEleve">Moniteur référent :</label>
	<select name="salarieEleve" id="salarieEleve">
		<?php
			
			foreach ($moniteurs as $moniteur) {
				echo '<option value="'.$moniteur['IDSALARIE'].'" ';
				
				if ($idSalarie == $moniteur['IDSALARIE']) {
					echo 'selected ';
				}
				
				echo '>'.strtoupper($moniteur['SURNOM']).'</option>';
			}
		
		?>
	</select>
	
	
	<input type="submit" name="soumission" value="Valider" />
</form>


<a href="main.php?rubrique=eleve&action=lister">Retour</a>