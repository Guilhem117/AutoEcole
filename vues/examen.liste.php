<?php
	
	echo '<p>'.$message.'</p>';

	foreach ($examens as $examen) {
		echo 'Examen du '.htmlspecialchars($examen['DATEEXAM']). ' de type '.htmlspecialchars($examen['TYPEEXAM']). ' : ';
		echo '<a href="main.php?rubrique=examen&action=editer&id='.htmlspecialchars($examen['IDEXAM']).'">Editer</a> ';
		echo '<a href="main.php?rubrique=examen&action=supprimer&id='.htmlspecialchars($examen['IDEXAM']).'">Supprimer</a>';
		echo '<br />';
	}