<b>Liste des véhicules : </b><br />

<?php

	if (isset($_SESSION['messagePersistant'])) {
		echo '<p class="info">'.htmlspecialchars($_SESSION['messagePersistant']).'</p>';
		unset($_SESSION['messagePersistant']);
	}
	
	if (empty($vehicules)) {
		echo '<p>Il n\'y a pas de véhicules à afficher.<p>';
	} else {
		foreach ($vehicules as $vehicule) {
			echo 'Véhicule numéro '.htmlspecialchars($vehicule['NUMVEHICULE']). ' : ';
			echo '<a href="main.php?rubrique=vehicule&action=editer&id='.htmlspecialchars($vehicule['NUMVEHICULE']).'">Editer</a> ';
			echo '<a href="main.php?rubrique=vehicule&action=supprimer&id='.htmlspecialchars($vehicule['NUMVEHICULE']).'">Supprimer</a>';
			echo '<br />';
		}
	}
	
?>

<a href="main.php?rubrique=vehicule&action=creer">Créer un nouveau véhicule</a>