<b>Liste des examens : </b><br />

<?php

foreach ($examens as $examen) {
	echo 'Examen du '.htmlspecialchars($examen['DATEEXAM']). ' de type '.htmlspecialchars($examen['TYPEEXAM']). ' : ';
	echo '<a href="main.php?rubrique=examen&action=editer&id='.htmlspecialchars($examen['IDEXAM']).'">Editer</a> ';
	echo '<a href="main.php?rubrique=examen&action=supprimer&id='.htmlspecialchars($examen['IDEXAM']).'">Supprimer</a>';
	echo '<br />';
}

?>

<a href="main.php?rubrique=examen&action=creer">Créer un nouvel examen</a><br />
<a href="main.php?rubrique=index">Retour</a>