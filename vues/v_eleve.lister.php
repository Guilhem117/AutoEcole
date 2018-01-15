<b>Liste des élèves : </b><br />

<?php

	if (isset($_SESSION['messagePersistant'])) {
		echo '<p class="info">'.htmlspecialchars($_SESSION['messagePersistant']).'</p>';
		unset($_SESSION['messagePersistant']);
	}

   if (empty($listeEleve)) {
		echo '<p>Il n\'y a pas d\'élèves à afficher.<p>';
	} else {
		foreach ($listeEleve as $eleve) {
			echo strtoupper($eleve['NOM']).' '.ucfirst(strtolower($eleve['PRENOM'])).' : ';
			echo '<a href="main.php?rubrique=eleve&action=editer&id='.htmlspecialchars($eleve['IDELEVE']).'">Editer</a> ';
			echo '<a href="main.php?rubrique=eleve&action=supprimer&id='.htmlspecialchars($eleve['IDELEVE']).'">Supprimer</a>';
			echo '<br />';
		}
	}
  
?>

<a href="main.php?rubrique=eleve&action=creer">Créer un nouvel élève</a>