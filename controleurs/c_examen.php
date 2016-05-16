<?php

session_start();

if (!isset($_SESSION['mail'])) {
	header('location:main.php?rubrique=index');
}

if (isset($_GET['action'])) {
	if ($_GET['action'] == 'lister') {
	
		require_once('modeles/m_examen.php');
		$examens = getExamens();
		require_once('vues/v_examen.liste.php');
		
	} else if ($_GET['action'] == 'creer') {
	
		$date    = '';
		$type    = '';
		$message = '';
		
		if (isset($_POST['soumission'])) {
			$date = $_POST['date'];
			$type = $_POST['type'];
			
			if ($date == '' or $type == '' ) {
				$message = 'Tous les champs doivent être renseignés';
				require_once('vues/v_examen.nouveau.php');
			} else {
				require_once('modeles/m_examen.php');
				creerExamen($date, $type);
				header('location:main.php?rubrique=examen&action=lister');
			}
		} else {
			require_once('vues/v_examen.nouveau.php');
		}
		
	} else if ($_GET['action'] == 'supprimer') {
	
		require_once('modeles/m_examen.php');
		supprimerExamen($_GET['id']);
		header('location:main.php?rubrique=examen&action=lister');
		
	} else if ($_GET['action'] == 'editer') {
	
		$date = '';
		$type = '';
	
		require_once('modeles/m_examen.php');
		
		if (isset($_POST['soumission'])) {
			$date = $_POST['date'];
			$type = $_POST['type'];
			
			modifierExamen($_GET['id'], $date, $type);
			header('location:main.php?rubrique=examen&action=lister');
		} else {
			$examen = getExamen($_GET['id']);
			
			$date = $examen['DATEEXAM'];
			$type = $examen['TYPEEXAM'];
			
			require_once('vues/v_examen.edit.php');
		}	
		
	} else if ($_GET['action'] == 'editer_participants') {
	
	
		
		require_once('modeles/m_examen.php');
	
		if (isset($_POST['soumission_ajout_participant'])) {
			inscrireEleveAExamen($_GET['id'], $_POST['participants']);
		}
		
		$examen = getExamen($_GET['id']);
		$inscrits = getInscritsAExamen($_GET['id']);
		$non_inscrits = getNonInscritsAExamen($_GET['id']);
		
		require_once('vues/v_examen_participants.edit.php');
		
		
		
		
		
	} else if ($_GET['action'] == 'supprimer_participant') {
		
		require_once('modeles/m_examen.php');
		desinscrireEleveAExamen($_GET['idExamen'], $_GET['idEleve']);
		header('location:main.php?rubrique=examen&action=editer_participants&id='.$_GET['idExamen']);
		
	}
} else {
	require_once('modeles/m_examen.php');
	$examens = getExamens();
	require_once('vues/v_examen.liste.php');
}