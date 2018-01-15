<b>Liste des salariés : </b><br />

<?php

	if (isset($_SESSION['messagePersistant'])) {
		echo '<p class="info">'.htmlspecialchars($_SESSION['messagePersistant']).'</p>';
		unset($_SESSION['messagePersistant']);
	}

   if (empty($salaries)) {
		echo '<p>Il n\'y a pas de salariés à afficher.<p>';
	} else {
		foreach ($salaries as $salarie) {
			echo ucfirst(strtolower($salarie['SURNOM'])).' : ';
			echo '<a href="main.php?rubrique=salarie&action=editer&id='.htmlspecialchars($salarie['IDSALARIE']).'">Editer</a> ';
			echo '<a href="main.php?rubrique=salarie&action=supprimer&id='.htmlspecialchars($salarie['IDSALARIE']).'">Supprimer</a>';
			echo '<br />';
		}
	}
  
?>

<a href="main.php?rubrique=salarie&action=creer">Créer un nouveau salarié</a>