<?php

// connexion nécessaire pour accéder à cette rubrique
if (!isset($_SESSION['mail'])) {
	header('location:main.php?rubrique=index');
}

require_once('modeles/m_salarie.php');

// définition d'une action par défaut si non spécifiée
if (isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	$action = 'lister';
}

if ($action == 'lister') 
{
	$salaries = getSalaries();
	require_once('vues/v_salarie.lister.php');
} 
else if ($action == 'creer') 
{	
	$surnom    = '';
	$nom       = '';
	$prenom    = '';
	$adresse   = '';
	$ville     = '';
	$cp        = '';
	$telephone = '';
	$fonction  = '';
	$email     = '';
	$mdp       = '';
	$mdp_conf  = '';
	
	
	// si le formulaire est validé
	if (isset($_POST['soumission'])) 
	{     
		$surnom    = $_POST['SURNOM'];
		$nom       = $_POST['NOM'];
		$prenom    = $_POST['PRENOM'];
		$adresse   = $_POST['ADRESSE'];
		$ville     = $_POST['VILLE'];
		$cp        = $_POST['CODE'];
		$telephone = $_POST['TELEPHONE'];
		$fonction  = $_POST['FONCTION'];
		$email     = $_POST['EMAIL'];
		$mdp       = $_POST['MOTDEPASSE'];
		$mdp_conf  = $_POST['MOTDEPASSECONF'];

		if ($surnom == '' OR $nom == '' OR $prenom == '' OR $adresse == '' OR $ville == '' OR $cp == '' OR $telephone == ''
				OR $fonction == '' OR $email == '' OR $mdp == '' OR $mdp_conf == '') {
			$message = 'Tous les champs doivent être renseignés';
			require_once('vues/v_salarie.creer.php');	
		} else {
			if ($mdp != $mdp_conf) {
				$message = 'Les mots de passe ne correspondent pas.';
				// on réinitialise les mots de passe si ils ne correspondent pas
				$mdp = '';
				$mdp_conf = '';
				require_once('vues/v_salarie.creer.php');
			} else {
				creerSalarie($surnom, $nom, $prenom, $adresse, $ville, $cp, $telephone, $fonction, $email, $mdp);
				header('location:main.php?rubrique=salarie&action=lister');
			}
		}
	} 
	else 
	{
		require_once('vues/v_salarie.creer.php');
	}
	
}
else if ($action == 'supprimer') 
{
	/* Pour supprimer un salarié :
		- il ne faut pas qu'il soit rattaché à des leçons de conduite
		- il ne faut pas qu'il soit le référent d'un élève
		- il ne faut pas qu'il soit responsable d'un véhicule
	*/
	if (!empty($message = supprimerSalarie($_GET['id']))) {
		$_SESSION['messagePersistant'] = $message;
	}
	
	header('location:main.php?rubrique=salarie&action=lister');
} 
else if ($action == 'editer') 
{	
	$surnom    = '';
	$nom       = '';
	$prenom    = '';
	$adresse   = '';
	$ville     = '';
	$cp        = '';
	$telephone = '';
	$fonction  = '';
	$email     = '';
	$mdp       = '';
	$mdp_conf  = '';
	
	
	// si le formulaire est validé
	if (isset($_POST['soumission'])) 
	{     
		$surnom    = $_POST['SURNOM'];
		$nom       = $_POST['NOM'];
		$prenom    = $_POST['PRENOM'];
		$adresse   = $_POST['ADRESSE'];
		$ville     = $_POST['VILLE'];
		$cp        = $_POST['CODE'];
		$telephone = $_POST['TELEPHONE'];
		$fonction  = $_POST['FONCTION'];
		$email     = $_POST['EMAIL'];
		$mdp       = $_POST['MOTDEPASSE'];
		$mdp_conf  = $_POST['MOTDEPASSECONF'];

		if ($surnom == '' OR $nom == '' OR $prenom == '' OR $adresse == '' OR $ville == '' OR $cp == '' OR $telephone == ''
				OR $fonction == '' OR $email == '' OR $mdp == '' OR $mdp_conf == '') {
			$message = 'Tous les champs doivent être renseignés';
			require_once('vues/v_salarie.editer.php');	
		} else {
			if ($mdp != $mdp_conf) {
				$message = 'Les mots de passe ne correspondent pas.';
				// on réinitialise les mots de passe si ils ne correspondent pas
				$mdp = '';
				$mdp_conf = '';
				require_once('vues/v_salarie.editer.php');
			} else {
				modifierSalarie($surnom, $_GET['id'], $nom, $prenom, $adresse, $ville, $cp, $telephone, $fonction, $email, $mdp);
				header('location:main.php?rubrique=salarie&action=lister');
			}
		}
	} 
	else 
	{
		// si c'est le premier affichage, on récupère les données du salariés
		
		$salarie = getSalarie($_GET['id']);
		
		$surnom    = $salarie['SURNOM'];
		$nom       = $salarie['NOM'];
		$prenom    = $salarie['PRENOM'];
		$adresse   = $salarie['ADRESSE'];
		$ville     = $salarie['VILLE'];
		$cp        = $salarie['CODE'];
		$telephone = $salarie['TELEPHONE'];
		$fonction  = $salarie['FONCTION'];
		$email     = $salarie['EMAIL'];
		$mdp       = $salarie['MOTDEPASSE'];
		$mdp_conf  = $salarie['MOTDEPASSE'];
		
		require_once('vues/v_salarie.editer.php');
	}
}
