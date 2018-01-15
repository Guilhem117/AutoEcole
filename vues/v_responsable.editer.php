<h3>Editer un responsable</h3>

<?php

	if (!empty($message)) {
		echo '<p class="info">'.htmlspecialchars($message).'</p>';
	}
	
?>


<form name="responsable" action="main.php?rubrique=responsable&action=editer&id=<?php echo $_GET['id']; ?>" method="post" accept-charset="utf-8">
	
	
	<label for="nom">Nom :</label>
	<input type='text' name='nom' id='nom' value="<?php echo htmlspecialchars($nom); ?>" />
	
	<label for="prenom">Prénom :</label>
	<input type='text' name='prenom' id='prenom' value="<?php echo htmlspecialchars($prenom); ?>" />
	
	<label for="adresse">Adresse :</label>
	<input type='text' name='adresse' id='adresse' value="<?php echo htmlspecialchars($adresse); ?>" />
	
	<label for="ville">Ville :</label>
	<input type='text' name='ville' id='ville' value="<?php echo htmlspecialchars($ville); ?>" />
	
	<label for="codePostal">Code postal :</label>
	<input type='text' name='codePostal' id='codePostal' value="<?php echo htmlspecialchars($codePostal); ?>" />
	
	<label for="telephoneDomicile">Téléphone domicile :</label>
	<input type='text' name='telephoneDomicile' id='telephoneDomicile' value="<?php echo htmlspecialchars($telephoneDomicile); ?>" />
	
	<label for="telephonePortable">Téléphone portable :</label>
	<input type='text' name='telephonePortable' id='telephonePortable' value="<?php echo htmlspecialchars($telephonePortable); ?>" />
	
	
	<input type="submit" name="soumission" value="Valider" />
</form>


<a href="main.php?rubrique=responsable&action=lister">Retour</a>