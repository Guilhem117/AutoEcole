<?php

// si déjà connecté, on redirige vers l'index
if (isset($_SESSION['mail'])) {
	header('location:main.php?rubrique=index');
}

$mail = '';
$mdp = '';
$message = '';


// si le formulaire a été validé
if (isset($_POST['soumission'])) {
	$mail = $_POST['mail'];
	$mdp = $_POST['mdp'];
	
	if ($mail == '' or $mdp == '') {
		$message = 'Tous les champs doivent être renseignés.';
	} else {
		require_once('modeles/m_login.php');

		// si le couple login/mdp est trouvé
		if (verifLogin($mail, $mdp) > 0) {
			// définition d'une variable de session qui sert à contrôler que l'utilisateur est connecté
			$_SESSION['mail'] = $mail;
			header('location:main.php?rubrique=index');
		} else {
			$message = 'La combinaison adresse mail/mot de passe fournie est invalide.';
		}
	}
}

require_once('vues/v_login.php');