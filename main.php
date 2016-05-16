<?php

require_once('inc/bdd.inc.php');
	
if (isset($_GET['rubrique'])) {
	if ($_GET['rubrique'] == 'index') {
		require_once('controleurs/c_index.php');
	} else if ($_GET['rubrique'] == 'login') {
		require_once('controleurs/c_login.php');
	} else if ($_GET['rubrique'] == 'examen') {
		require_once('controleurs/c_examen.php');
	} else if ($_GET['rubrique'] == 'calendrier') {
		require_once('controleurs/c_calendrier.php');
	}
} else {
	require_once('controleurs/c_index.php');
}