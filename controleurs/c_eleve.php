<?php

// connexion nécessaire pour accéder à cette rubrique
if (!isset($_SESSION['mail'])) {
	header('location:main.php?rubrique=index');
}

require_once('modeles/m_eleve.php');
require_once('inc/fonctions_diverses.php');

// définition d'une action par défaut si non spécifiée
if (isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	$action = 'lister';
}



if ($action == 'lister') 
{
	// on récupère la liste des élèves
	$listeEleve = getEleves();
	require_once('vues/v_eleve.lister.php');
	
} 
else if ($action == 'creer') 
{	
	$nom               = '';
	$prenom            = '';
	$adresse           = '';
	$ville             = '';
	$dateNaissance     = '';
	$codePostal        = '';
	$telephoneDomicile = '';
	$telephonePortable = '';
	$lieuEtude         = '';
	$codePostalTravail = '';
	$villeTravail      = '';
	$idFormule         = '';
	$idResponsable     = '';
	$idSalarie         = '';
	$formules          = getFormules();
	$moniteurs         = getMoniteurs();
	$responsables      = getResponsables();
	
	// si le formulaire a été validé
	if (isset($_POST['soumission'])) 
	{     
		$nom               = $_POST['nomEleve'];
		$prenom            = $_POST['prenomEleve'];
		$adresse           = $_POST['adresseEleve'];
		$ville             = $_POST['villeEleve'];
		$dateNaissance     = $_POST['dateNaissance'];
		$codePostal        = $_POST['codePostalEleve'];
		$telephoneDomicile = $_POST['telephoneDomicileEleve'];
		$telephonePortable = $_POST['telephonePortableEleve'];
		$lieuEtude         = $_POST['adresseProEleve'];
		$codePostalTravail = $_POST['codePostalProEleve'];
		$villeTravail      = $_POST['villeProEleve'];
		$idFormule         = $_POST['formuleEleve'];
		$idResponsable     = $_POST['responsableEleve'];
		$idSalarie         = $_POST['salarieEleve'];

		if ($nom == '' OR $prenom == '' OR $adresse == '' OR $ville == '' OR $dateNaissance == '' OR $codePostal == '' OR $telephoneDomicile == '' OR $telephonePortable == '' OR 
				$lieuEtude == '' OR $codePostalTravail == '' OR $villeTravail == '') 
		{
			$message = 'Tous les champs doivent être renseignés.';
			require_once('vues/v_eleve.creer.php');
		} 
		else 
		{
			// on contrôle que la date de naissance soit valide
			if (validateDate($dateNaissance)) {
				ajouterEleve($nom, $prenom, $adresse, $ville, $codePostal, $telephoneDomicile, $telephonePortable, 
								$lieuEtude, $codePostalTravail, $villeTravail, $idFormule, $idResponsable, $idSalarie, $dateNaissance); 
				header('location:main.php?rubrique=eleve&action=lister');
			} else {
				// si la date de naissance est invalide, on prévient l'utilisateur
				$message = 'La date de naissance est invalide.';
				require_once('vues/v_eleve.creer.php');
			}
			
		}
	} 
	else 
	{
		require_once('vues/v_eleve.creer.php');
	}
	
}
else if ($action == 'supprimer') 
{
	// avant suppression d'un élève, il faut contrôler...
	
	// ... qu'il ne soit pas rattaché à des leçons...
	$lecons = checkLeconsEleve($_GET['id']);
	// ... qu'il ne soit pas rattachés à des achats de tickets...
	$achats = checkAchatsEleve($_GET['id']);
	// ... et qu'il ne soit pas rattaché à des examens.
	$examens = checkExamensEleve($_GET['id']);
	
	// si ce n'est pas le cas, on peut supprimer
	if (empty($lecons) && empty($achats) && empty($examens)) {
		supprimerEleve($_GET['id']);
	} else {
		// sinon on prévient l'utilisateur
		
		$_SESSION['messagePersistant'] = 'Impossible de supprimer cet élève : ';
		
		if (!empty($lecons)) {
			$_SESSION['messagePersistant'] = $_SESSION['messagePersistant'].'Il est rattaché à des leçons de conduite. ';
		}
		
		if (!empty($achats)) {
			$_SESSION['messagePersistant'] = $_SESSION['messagePersistant'].'Il est rattaché à des achats de tickets. ';
		}
		
		if (!empty($examens)) {
			$_SESSION['messagePersistant'] = $_SESSION['messagePersistant'].'Il est rattaché à des examens. ';
		}
	}
	
	
	header('location:main.php?rubrique=eleve&action=lister');
} 
else if ($action == 'editer') 
{	
	$nom               = '';
	$prenom            = '';
	$adresse           = '';
	$ville             = '';
	$dateNaissance     = '';
	$codePostal        = '';
	$telephoneDomicile = '';
	$telephonePortable = '';
	$lieuEtude         = '';
	$codePostalTravail = '';
	$villeTravail      = '';
	$idFormule         = '';
	$idResponsable     = '';
	$idSalarie         = '';
	$formules          = getFormules();
	$moniteurs         = getMoniteurs();
	$responsables      = getResponsables();
	
	
	// si le formulaire a été validé
	if (isset($_POST['soumission'])) 
	{     
		$nom               = $_POST['nomEleve'];
		$prenom            = $_POST['prenomEleve'];
		$adresse           = $_POST['adresseEleve'];
		$ville             = $_POST['villeEleve'];
		$dateNaissance     = $_POST['dateNaissance'];
		$codePostal        = $_POST['codePostalEleve'];
		$telephoneDomicile = $_POST['telephoneDomicileEleve'];
		$telephonePortable = $_POST['telephonePortableEleve'];
		$lieuEtude         = $_POST['adresseProEleve'];
		$codePostalTravail = $_POST['codePostalProEleve'];
		$villeTravail      = $_POST['villeProEleve'];
		$idFormule         = $_POST['formuleEleve'];
		$idResponsable     = $_POST['responsableEleve'];
		$idSalarie         = $_POST['salarieEleve'];

		if ($nom == '' OR $prenom == '' OR $adresse == '' OR $ville == '' OR $dateNaissance == '' OR $codePostal == '' OR $telephoneDomicile == '' OR $telephonePortable == '' OR 
				$lieuEtude == '' OR $codePostalTravail == '' OR $villeTravail == '') 
		{
			$message = 'Tous les champs doivent être renseignés.';
			require_once('vues/v_eleve.editer.php');
		} 
		else 
		{
			// contrôle de la validité de la date de naissance
			if (validateDate($dateNaissance)) {
				modifierEleve($_GET['id'], $nom, $prenom, $adresse, $ville, $codePostal, $telephoneDomicile, $telephonePortable, 
                        $lieuEtude, $codePostalTravail, $villeTravail, $idFormule, $idResponsable, $idSalarie, $dateNaissance);
				header('location:main.php?rubrique=eleve&action=lister');
			} else {
				$message = 'La date de naissance est invalide.';
				require_once('vues/v_eleve.editer.php');
			}
			
		}
	} 
	else 
	{
		// au premier affichage, on récupère les données de l'élève
		
		$eleve = getEleve($_GET['id']);
	
		$nom               = $eleve['NOM'];
		$prenom            = $eleve['PRENOM'];
		$adresse           = $eleve['ADRESSE'];
		$ville             = $eleve['VILLE'];
		$dateNaissance     = $eleve['DATENAISSANCE'];
		$codePostal        = $eleve['CODEPOSTAL'];
		$telephoneDomicile = $eleve['TELEPHONEDOMICILE'];
		$telephonePortable = $eleve['TELEPHONEPORTABLE'];
		$lieuEtude         = $eleve['LIEUETUDETRAVAIL'];
		$codePostalTravail = $eleve['CODEPOSTALTRAVAIL'];
		$villeTravail      = $eleve['VILLETRAVAIL'];
		$idFormule         = $eleve['IDFORMULE'];
		$idResponsable     = $eleve['IDRESPONSABLE'];
		$idSalarie         = $eleve['IDSALARIE'];
			
		require_once('vues/v_eleve.editer.php');
	}
}
