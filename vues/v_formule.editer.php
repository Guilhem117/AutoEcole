<h3>Editer une formule</h3>

<?php

	if (!empty($message)) {
		echo '<p class="info">'.htmlspecialchars($message).'</p>';
	}
	
?>

<form name="formule" action="main.php?rubrique=formule&action=editer&id=<?php echo $_GET['id']; ?>" method="post" accept-charset="utf-8">
	
	<label for="nom">Nom :</label>
	<input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($nom); ?>" />
	
	<label for="prix_inscription">Prix d'inscription :</label>
	<input type="number" name="prix_inscription" id="prix_inscription" value="<?php echo htmlspecialchars($prix_inscription); ?>" />
	
	<label for="nb_lecons_incluses">Nombre de leçons incluses :</label>
	<input type="number" name="nb_lecons_incluses" id="nb_lecons_incluses" value="<?php echo htmlspecialchars($nb_lecons_incluses); ?>" />
	
	<label for="prix_lecon">Prix de la leçon à l'unité :</label>
	<input type="number" name="prix_lecon" id="prix_lecon" value="<?php echo htmlspecialchars($prix_lecon); ?>" />
	
	<label for="description">Description :</label>
	<input type="text" name="description" id="description" value="<?php echo htmlspecialchars($description); ?>" />
	
	<input type="submit" name="soumission" value="Valider" />
</form>

<a href="main.php?rubrique=formule&action=lister">Retour</a>