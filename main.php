<?php

session_start();

require_once('inc/bdd.inc.php');
require_once('inc/header.inc.php');


// aiguillage vers le bon contrôleur à partir de la rubrique choisie	
if (isset($_GET['rubrique'])) {
	if ($_GET['rubrique'] == 'index') {
		require_once('controleurs/c_index.php');
		
	} else if ($_GET['rubrique'] == 'login') {
		require_once('controleurs/c_login.php');
		
	} else if ($_GET['rubrique'] == 'examen') {
		require_once('controleurs/c_examen.php');
		
	} else if ($_GET['rubrique'] == 'vehicule') {
		require_once('controleurs/c_vehicule.php');
		
	} else if ($_GET['rubrique'] == 'lecon') {
		require_once('controleurs/c_lecon.php');
		
	} else if ($_GET['rubrique'] == 'achat') {
		require_once('controleurs/c_achat.php');
		
	} else if ($_GET['rubrique'] == 'responsable') {
		require_once('controleurs/c_responsable.php');
		
	} else if ($_GET['rubrique'] == 'eleve') {
		require_once('controleurs/c_eleve.php');
		
	} else if ($_GET['rubrique'] == 'salarie') {
		require_once('controleurs/c_salarie.php');
		
	} else if ($_GET['rubrique'] == 'formule') {
		require_once('controleurs/c_formule.php');
		
	} 
} else {
	// le contrôleur par défaut est celui de la page d'index
	require_once('controleurs/c_index.php');
}

require_once('inc/footer.inc.php');