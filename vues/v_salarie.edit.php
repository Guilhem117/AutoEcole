<form name="salarie" action="main.php?rubrique=salarie&action=editer&id=<?php echo htmlspecialchars($salarie['IDSALARIE']); ?>" method="post" accept-charset="utf-8">
	
	<label for="SURNOM">Surnom : </label>
	<input type="text" name="SURNOM" id="SURNOM" value="<?php echo htmlspecialchars($salarie['SURNOM']); ?>" />

	<label for="NOM">Nom : </label>
	<input type="text" name="NOM" id="NOM" value="<?php echo htmlspecialchars($salarie['NOM']); ?>" />

	<label for="PRENOM">Prénom : </label>
	<input type="text" name="PRENOM" id="PRENOM" value="<?php echo htmlspecialchars($salarie['PRENOM']); ?>" />

	<label for="ADRESSE">Adresse : </label>
	<input type="text" name="ADRESSE" id="ADRESSE" value="<?php echo htmlspecialchars($salarie['ADRESSE']); ?>" />

	<label for="VILLE">Ville : </label>
	<input type="text" name="VILLE" id="VILLE" value="<?php echo htmlspecialchars($salarie['VILLE']); ?>" />

	<label for="CODE">Code Postal : </label>
	<input type="text" name="CODE" id="CODE" value="<?php echo htmlspecialchars($salarie['CODE']); ?>" />

	<label for="TELEPHONE">Téléphone : </label>
	<input type="text" name="TELEPHONE" id="TELEPHONE" value="<?php echo htmlspecialchars($salarie['TELEPHONE']); ?>" />

	<label for="FONCTION">Fonction : </label>
	<select name="FONCTION" id="FONCTION">

	<?php

	if ($salarie['FONCTION'] == "secrétaire" ) {
		echo "<option value='secrétaire' selected>Secrétaire</option>"; 
	} else {
		echo "<option value='secrétaire'>Secrétaire</option>"; 

	}

	
	if ($salarie['FONCTION'] == "moniteur" ) {
		echo "<option value='moniteur' selected>Moniteur</option>";
	} else {
		echo "<option value='moniteur'>Moniteur</option>";
	}

	
	if ($salarie['FONCTION'] == "gérant" ) {
		echo "<option value='gérant' selected>Gérant</option>";
	} else {
		echo "<option value='gérant'>Gérant</option>";
	}

	?>
	

	</select>

	<label for="EMAIL">Email : </label>
	<input type="text" name="EMAIL" id="EMAIL" value="<?php echo htmlspecialchars($salarie['EMAIL']); ?>" />

	<label for="MOTDEPASSE">Mot de Passe : </label>
	<input type="password" name="MOTDEPASSE" id="MOTDEPASSE" value="<?php echo htmlspecialchars($salarie['MOTDEPASSE']); ?>" />

	<input type="submit" name="modifier" value="Modifier"/>

</form>


<!-- Permet d'eviter de dévoiler l'action de suppression -->
<form name="salarie" action="main.php?rubrique=salarie&action=editer&id=<?php echo htmlspecialchars($salarie['IDSALARIE']); ?>" method="post" accept-charset="utf-8">
	
<input type="submit" name="suppression" value="Supprimer"/>
</form>