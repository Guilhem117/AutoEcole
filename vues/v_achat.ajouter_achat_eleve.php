<h3>Ajouter des tickets pour <?php echo $eleve['NOM'].' '.$eleve['PRENOM']; ?></h3>

<?php

	if (!empty($message)) {
		echo '<p class="info">'.htmlspecialchars($message).'</p>';
	}
	
?>

<form name="ajouter_achat_eleve" action="main.php?rubrique=achat&action=ajouter_achat_eleve&id_eleve=<?php echo $_GET['id_eleve']; ?>" method="post" accept-charset="utf-8">
	
	<label for="date">Date (JJ/MM/AAAA HH:MM:SS) :</label>
	<input type="text" name="date" id="date" value="<?php echo htmlspecialchars($date); ?>" />
	
	<label for="quantite">Quantité :</label>
	<input type="number" name="quantite" id="quantite" value="<?php echo htmlspecialchars($quantite); ?>" />
	
	<label for="moyen_paiement">Moyen de paiement :</label>
	<select name="moyen_paiement" id="moyen_paiement" />
		<option value="carte bancaire" <?php if ($moyenPaiement == 'carte bancaire') { echo 'selected'; } ?> >Carte bancaire</option>
		<option value="chèque" <?php if ($moyenPaiement == 'chèque') { echo 'selected'; } ?> >Chèque</option>
		<option value="comptant" <?php if ($moyenPaiement == 'comptant') { echo 'selected'; } ?> >Comptant</option>
	</select>
	
	<input type="submit" name="soumission" value="Valider" />
</form>

<a href="main.php?rubrique=achat&action=lister_achats_eleve&id_eleve=<?php echo $_GET['id_eleve']; ?>">Retour</a>
