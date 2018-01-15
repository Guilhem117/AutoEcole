<h3>Editer le véhicule numéro <?php echo $_GET['id']; ?></h3>

<?php

	if (!empty($message)) {
		echo '<p class="info">'.htmlspecialchars($message).'</p>';
	}
	
?>

<form name="vehicule" action="main.php?rubrique=vehicule&action=editer&id=<?php echo $_GET['id']; ?>" method="post" accept-charset="utf-8">
	
	<label for="immatriculation">Immatriculation :</label>
	<input type="text" name="immatriculation" id="immatriculation" value="<?php echo htmlspecialchars($immatriculation); ?>" />
	
	<label for="marque">Marque :</label>
	<input type="text" name="marque" id="marque" value="<?php echo htmlspecialchars($marque); ?>" />
	
	<label for="modele">Modèle :</label>
	<input type="text" name="modele" id="modele" value="<?php echo htmlspecialchars($modele); ?>" />
	
	<label for="salarie">Salarié référent :</label>
	<select name="salarie" id="salarie" />
		<?php
			
			foreach ($salaries as $salarie) {
				echo '<option value="'.$salarie['IDSALARIE'].'" ';
				
				if ($idSalarie == $salarie['IDSALARIE']) {
					echo 'selected ';
				}
				
				echo '>'.strtoupper($salarie['NOM']).' '.ucfirst(strtolower($salarie['PRENOM'])).'</option>';
			}
		
		?>
	</select>
	
	<input type="submit" name="soumission" value="Valider" />
</form>


<a href="main.php?rubrique=vehicule&action=lister_releves&id=<?php echo $_GET['id']; ?>">Lister les relevés de compteur</a><br />
<a href="main.php?rubrique=vehicule&action=lister">Retour</a>