<b>Liste des formules : </b><br />

<?php

	if (isset($_SESSION['messagePersistant'])) {
		echo '<p class="info">'.htmlspecialchars($_SESSION['messagePersistant']).'</p>';
		unset($_SESSION['messagePersistant']);
	}

   if (empty($listeFormule)) {
		echo '<p>Il n\'y a pas de formules à afficher.<p>';
	} else {
		foreach ($listeFormule as $formule) {
			echo $formule['NOM'].' : ';
			echo '<a href="main.php?rubrique=formule&action=editer&id='.htmlspecialchars($formule['IDFORMULE']).'">Editer</a> ';
			echo '<a href="main.php?rubrique=formule&action=supprimer&id='.htmlspecialchars($formule['IDFORMULE']).'">Supprimer</a>';
			echo '<br />';
		}
	}
  
?>

<a href="main.php?rubrique=formule&action=creer">Créer une nouvelle formule</a>