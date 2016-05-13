<?php

require_once('inc/bdd.inc.php');
	
if (isset($_GET['rubrique'])) {
	if ($_GET['rubrique'] == 'index') {
		require_once('controleurs/index.php');
	} else if ($_GET['rubrique'] == 'login') {
		require_once('controleurs/login.php');
	}
} else {
	require_once('controleurs/index.php');
}