<?php

session_start();

if (isset($_SESSION['mail'])) {
	header('location:main.php?rubrique=index');
}

$mail = '';
$mdp = '';
$message = '';

if (isset($_POST['soumission'])) {
	$mail = $_POST['mail'];
	$mdp = $_POST['mdp'];
	
	if ($mail == '' or $mdp == '') {
		$message = 'Tous les champs doivent être renseignés.';
	} else {
		require_once('modeles/m_login.php');
		
		$count = verifLogin($mail, $mdp);
		
		if ($count > 0) {
			session_start();
			$_SESSION['mail'] = $mail;
			header('location:main.php');
		} else {
			$message = 'La combinaison adresse mail/mot de passe fournie est invalide.';
		}
	}
}

require_once('vues/v_login.php');