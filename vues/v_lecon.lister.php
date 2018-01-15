<h3>Calendrier des leçons</h3>

<?php

	if (!empty($message)) {
		echo '<p class="info">'.htmlspecialchars($message).'</p>';
	}
	
?>

<b>Filtrage avancé</b><br />

<form name="rechercheLecon" action="main.php?rubrique=lecon&action=lister" method="post" accept-charset="utf-8">
	
	<label for="dateDebut">Date de début (JJ/MM/AAAA HH:MM:SS) :</label>
	<input type="text" name="dateDebut" id="dateDebut" value="<?php echo $dateDebut; ?>" />
	
	<label for="dateFin">Date de fin (JJ/MM/AAAA HH:MM:SS) :</label>
	<input type="text" name="dateFin" id="dateFin" value="<?php echo $dateFin; ?>" />
	
	<label for="statut">Statut :</label>
	<select name="statut" id="statut" />
		<option value="%">Tous</option>
		<option value="en attente" <?php if ($statut == 'en attente') { echo 'selected'; } ?> >en attente</option>
		<option value="effectuée" <?php if ($statut == 'effectuée') { echo 'selected'; } ?> >effectuée</option>
		<option value="annulée" <?php if ($statut == 'annulée') { echo 'selected'; } ?> >annulée</option>
	</select>
	
	<label for="salarie">Moniteur :</label>
	<select name="salarie" id="salarie">
		<option value="%">Tous</option>
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
	
	<label for="eleve">Eleve :</label>
	<select name="eleve" id="eleve">
		<option value="%">Tous</option>
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
	
	<label for="vehicule">Véhicule :</label>
	<select name="vehicule" id="vehicule">
		<option value="%">Tous</option>
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


<b><?php echo $titreResultat; ?></b><br />

<?php

	if (empty($lecons)) {
		echo '<p>Il n\'y a pas de leçons de conduite à afficher.</p>';
	} else {

		foreach($lecons as $lecon) {
			echo '<b>'.$lecon['DATELECON'].'</b> -> ';
			echo 'Leçon donnée par '.strtoupper($lecon['NOMSALARIE']).' '.ucfirst(strtolower($lecon['PRENOMSALARIE']));
			echo ' à l\'élève '.strtoupper($lecon['NOMELEVE']).' '.ucfirst(strtolower($lecon['PRENOMELEVE']));
			echo ' sur le véhicule numéro '.$lecon['NUMVEHICULE'].'.';
			echo ' ('.$lecon['STATUTLECON'].')';
			echo ' <a href="main.php?rubrique=lecon&action=editer&id='.$lecon['IDLECON'].'">Editer</a>';
			echo ' <a href="main.php?rubrique=lecon&action=supprimer&id='.$lecon['IDLECON'].'">Supprimer</a><br />';
		}
	}

?>

<br /><a href="main.php?rubrique=lecon&action=creer">Ajouter une nouvelle leçon de conduite</a>
<br /><a href="main.php?rubrique=index">Retour</a>