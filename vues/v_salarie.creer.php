<h3>Créer un nouveau salarié</h3>

<?php

	if (!empty($message)) {
		echo '<p class="info">'.htmlspecialchars($message).'</p>';
	}
	
?>

<form name="salarie" action="main.php?rubrique=salarie&action=creer" method="post" accept-charset="utf-8">
	
	<label for="SURNOM">Surnom : </label>
	<input type="text" name="SURNOM" id="SURNOM" value="<?php echo htmlspecialchars($surnom); ?>" />

	<label for="NOM">Nom : </label>
	<input type="text" name="NOM" id="NOM" value="<?php echo htmlspecialchars($nom); ?>" />

	<label for="PRENOM">Prénom : </label>
	<input type="text" name="PRENOM" id="PRENOM" value="<?php echo htmlspecialchars($prenom); ?>" />

	<label for="ADRESSE">Adresse : </label>
	<input type="text" name="ADRESSE" id="ADRESSE" value="<?php echo htmlspecialchars($adresse); ?>"/>

	<label for="VILLE">Ville : </label>
	<input type="text" name="VILLE" id="VILLE" value="<?php echo htmlspecialchars($ville); ?>" />

	<label for="CODE">Code Postal : </label>
	<input type="text" name="CODE" id="CODE" maxlength="5" value="<?php echo htmlspecialchars($cp); ?>" />

	<label for="TELEPHONE">Téléphone : </label>
	<input type="text" name="TELEPHONE" id="TELEPHONE" maxlength="10" value="<?php echo htmlspecialchars($telephone); ?>" />

	<label for="FONCTION">Fonction : </label>
	<select name="FONCTION" id="FONCTION">
		<option value='secrétaire' <?php if ($fonction == 'secrétaire') { echo 'selected '; } ?>>Secrétaire</option>
		<option value='moniteur' <?php if ($fonction == 'moniteur') { echo 'selected '; } ?>>Moniteur</option>
		<option value='gérant' <?php if ($fonction == 'gérant') { echo 'selected '; } ?>>Gérant</option>
	</select>

	<label for="EMAIL">Email : </label>
	<input type="text" name="EMAIL" id="EMAIL" value="<?php echo htmlspecialchars($email); ?>" />

	<label for="MOTDEPASSE">Mot de Passe : </label>
	<input type="password" name="MOTDEPASSE" id="MOTDEPASSE" value="<?php echo htmlspecialchars($mdp); ?>" />
	
	<label for="MOTDEPASSECONF">Mot de Passe (confirmation) : </label>
	<input type="password" name="MOTDEPASSECONF" id="MOTDEPASSECONF" value="<?php echo htmlspecialchars($mdp_conf); ?>" />

    <input type="submit" name="soumission" value="Valider"/>

</form>

<a href="main.php?rubrique=salarie&action=lister">Retour</a>