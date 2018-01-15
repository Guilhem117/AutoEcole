<b>Liste des relevés du véhicule numéro <?php echo $_GET['id']; ?> : </b><br />

<?php
	
	if (empty($releves)) {
		echo '<p>Il n\'y a pas de relevés à afficher.<p>';
	} else {
		foreach ($releves as $releve) {
			echo 'Relevé du '.htmlspecialchars($releve['DATERELEVE']). ' ('.htmlspecialchars($releve['KILOMETRAGE']).' kms) : ';
			echo '<a href="main.php?rubrique=vehicule&action=editer_releve&id='.$_GET['id'].'&idReleve='.htmlspecialchars($releve['IDRELEVE']).'">Editer</a> ';
			echo '<a href="main.php?rubrique=vehicule&action=supprimer_releve&id='.$_GET['id'].'&idReleve='.htmlspecialchars($releve['IDRELEVE']).'">Supprimer</a>';
			echo '<br />';
		}
	}
	
?>

<a href="main.php?rubrique=vehicule&action=creer_releve&id=<?php echo $_GET['id']; ?>">Créer un nouveau relevé pour ce véhicule</a><br />
<a href="main.php?rubrique=vehicule&action=editer&id=<?php echo $_GET['id']; ?>">Retour</a>