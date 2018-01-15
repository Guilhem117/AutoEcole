<b>Liste des responsables : </b><br />

<?php

	if (isset($_SESSION['messagePersistant'])) {
		echo '<p class="info">'.htmlspecialchars($_SESSION['messagePersistant']).'</p>';
		unset($_SESSION['messagePersistant']);
	}

   if (empty($responsables)) {
		echo '<p>Il n\'y a pas de responsables à afficher.<p>';
	} else {
		foreach ($responsables as $responsable) {
			echo strtoupper($responsable['NOM']).' '.ucfirst(strtolower($responsable['PRENOM'])).' : ';
			echo '<a href="main.php?rubrique=responsable&action=editer&id='.htmlspecialchars($responsable['IDRESPONSABLE']).'">Editer</a> ';
			echo '<a href="main.php?rubrique=responsable&action=supprimer&id='.htmlspecialchars($responsable['IDRESPONSABLE']).'">Supprimer</a>';
			echo '<br />';
		}
	}
  
?>

<a href="main.php?rubrique=responsable&action=creer">Créer un nouveau responsable</a>