<?php

if (isset($_POST['soumission'])) {
	$mail = $_POST['mail'];
	$mdp = $_POST['mdp'];
	
	if ($mail = '' or $mdp = '') {
		$message = 'Tous les champs doivent être renseignés.';
	} else {
		require_once('modeles/login.php');
		
		$login = getLogin($mail, $mdp);
		
		var_dump($login);
		
		if ($login == true) {
			/*$_SESSION['mail'] = $mail;
			header('location:main.php');*/
		} else {
			$message = 'La combinaison adresse mail/mot de passe fournie est invalide.';
		}
	}
}

require_once('vues/login.php');