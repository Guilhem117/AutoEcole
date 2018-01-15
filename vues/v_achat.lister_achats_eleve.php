<b>Liste des achats de <?php echo strtoupper($eleve['NOM']).' '.$eleve['PRENOM']; ?> : </b><br />

<?php
	
	if (empty($achats)) {
		echo '<p>Il n\'y a pas d\'achats de tickets pour cet élève.<p>';
	} else {

?>

<?php

foreach ($achats as $achat) {
	echo 'Achat du '.htmlspecialchars($achat['DATEACHAT']). ' de '.htmlspecialchars($achat['QUANTITE']).' tickets : ';
	echo '<a href="main.php?rubrique=achat&action=editer_achat_eleve&id_achat='.htmlspecialchars($achat['IDACHAT']).'&id_eleve='.$_GET['id_eleve'].'">Editer</a> ';
	echo '<a href="main.php?rubrique=achat&action=supprimer_achat_eleve&id_achat='.htmlspecialchars($achat['IDACHAT']).'&id_eleve='.$_GET['id_eleve'].'">Supprimer</a>';
	echo '<br />';
}

?>


<?php 

	}
	
?>

<a href="main.php?rubrique=achat&action=ajouter_achat_eleve&id_eleve=<?php echo $_GET['id_eleve']; ?>">Ajouter un achat à l'élève</a><br />
<a href="main.php?rubrique=achat&action=choisir_eleve">Retour</a>